<?php
require 'vendor/autoload.php';

use Razorpay\Api\Api;

// Include any necessary authentication or session management
include_once("header.php");
include_once("user_check_authentication.php");
$email = $_SESSION['user'];

// Check if the form was submitted
if (isset($_POST['payment'])) {

    $total = isset($_SESSION['total']) ? $_SESSION['total'] : 0;

    if ($total <= 0) {
        echo "Invalid total price. Please check your cart.";
        exit;
    }
    if ($_POST['payment_method'] == "COD") {
        $order_id = "order_" . uniqid();
        $email = $_SESSION['user'];
        $order_total = $_SESSION['total'];
        $address = $_SESSION['delivery_address'];
        $offer_code = $_SESSION['offer_code'];
        $order_discount = $_SESSION['discount'];
        $actual_price = $total - $discount_amount;
        $address = $_SESSION['delivery_address'];
        $q = "SELECT * FROM cart WHERE email = '$email'";
        $cart_result = mysqli_query($con, $q);
        while ($order_result = mysqli_fetch_assoc($cart_result)) {
            $product_id = $order_result['product_id'];
            $p = "SELECT * FROM products WHERE id = $product_id";
            $p_result = mysqli_fetch_assoc(mysqli_query($con, $p));

            if ($p_result['quantity'] > 0) {
                $total_price = $order_result['total_price'];
                $discount_amount = ($total_price / $order_total) * $order_discount;
                $actual_price = $total_price - $discount_amount;
                $quantity = $order_result['quantity'];

                $insert_order = "INSERT INTO `orders`(`order_id`, `sub_order_id`, `product_id`, `quantity`, `email`, `delivery_address`, `total_amount`, `offer_name`, `discount_amount`, `actual_amount`,`payment_mode`) 
                             VALUES ('$order_id', '$order_id-$product_id', $product_id, $quantity, '$email', '$address', $total_price, '$offer_code', $discount_amount, $actual_price,'COD')";
                mysqli_query($con, $insert_order);

                $remaining_quantity = $p_result['quantity'] - $quantity;
                $update_stock = "UPDATE products SET quantity = $remaining_quantity WHERE id = $product_id";
                mysqli_query($con, $update_stock);

                $del_cart = "DELETE FROM cart WHERE email = '$email' AND product_id = $product_id";
                mysqli_query($con, $del_cart);
                unset($_SESSION['order_id']);
                unset($_SESSION['total']);
                unset($_SESSION['delivery_address']);
                unset($_SESSION['offer']);
                unset($_SESSION['discount']);
                unset($_SESSION['offer_code']);
                unset($_SESSION['offer_status']);
                unset($_SESSION['status']);
?>
<script>
window.location.href = "user_orders.php";
</script>
<?php
            }
        }
    }
    // Initialize Razorpay API
    else {

        $api_key = 'your Api Key';
        $api_secret = 'Your secret Key';
        $api = new Api($api_key, $api_secret);

        try {
            // Create a Razorpay order
            $order = $api->order->create([
                'receipt' => 'order_rcptid_' . time(),
                'amount' => $total * 100, // Amount in paise
                'currency' => 'INR'
            ]);
            $_SESSION['order_id'] = $order->id;

            // Get the order ID


        } catch (Exception $e) {
            echo "Error creating Razorpay order: " . $e->getMessage();
            exit;
        }
        ?>


<div class="container">
    <div class="container">

        <div class="container py-5">
            <div class="card login-card">
                <div class="card-body p-4">
                    <h3 class="card-title text-center mb-4">Paying to Janki Kansagra</h3>

                    <form action="payment.php" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Net Payable Amount</label>
                            <input type="text" class="form-control" id="email" placeholder="Enter your email"
                                name="email" value="<?php echo $total; ?>" disabled>
                            <div class="error" id="emailError"></div>
                        </div>

                        <div class="mb-3">
                            <label for="order_id" class="form-label">Transaction ID</label>
                            <input type="text" class="form-control" id="password" placeholder="Enter your password"
                                value="<?php echo $_SESSION['order_id']; ?>" disabled>
                            <div class="error" id="passwordError"></div>
                        </div>
                        <button id="rzp-button" class="btn btn-danger w-100 mb-3" name="login_btn">Pay
                            Now</button>
                        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                        <script>
                        var options = {
                            "key": "<?php echo $api_key; ?>", // Enter the API key here
                            "amount": "<?php echo $total * 100; ?>", // Amount in paise
                            "currency": "INR",
                            "name": "Janki Kansagra",
                            "description": "Test Transaction",
                            "image": "https://upload.wikimedia.org/wikipedia/en/5/5b/RK_University_logo.png",
                            "order_id": "<?php echo $_SESSION['order_id']; ?>", // Razorpay Order ID
                            "prefill": {
                                "name": "Janki Kansagra",
                                "email": "janki.kansagra@rku.ac.in",
                                "contact": "8155825235"
                            },
                            "theme": {
                                "color": "#ffffff"
                            },
                            "handler": function(response) {
                                $.post("payment_razorpay_checkout.php", {
                                    razorpay_payment_id: response.razorpay_payment_id,
                                    razorpay_order_id: response.razorpay_order_id,
                                    razorpay_signature: response.razorpay_signature
                                }, function(data) {
                                    alert(data);
                                    if (data === "success") {
                                        // Redirect to user order page
                                        window.location.href = "user_orders.php";
                                    } else {
                                        alert("Payment verification failed. Please contact support.");
                                    }
                                });
                            }
                        };

                        var rzp = new Razorpay(options);
                        document.getElementById('rzp-button').onclick = function(e) {
                            rzp.open();
                            e.preventDefault();
                        };
                        </script>
                        <input type="hidden" name="hidden">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    }
}
include_once("footer.php");
?>