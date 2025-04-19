<?php
include 'header.php';
include 'user_check_authentication.php';

$email = $_SESSION['user'];
$q = "select * from cart where email='$email'";
$cart_result = mysqli_query($con, $q);

?>
<script>
    function increase_cart(id) {
        // alert(id);
        $.ajax({
            url: 'increase_cart.php',
            type: 'post',
            data: {
                id: id
            },
            success: function(data) {
                // alert(data);
                location.reload();
            }
        });
    }

    function decrease_cart(id) {
        // alert(id);
        $.ajax({
            url: 'decrease_cart.php',
            type: 'post',
            data: {
                id: id
            },
            success: function(data) {
                // alert(data);
                location.reload();
            }
        });
    }
</script>
<div class="container">
    <h3 class="text-center">Shopping Cart</h3>
    <br>
    <div class="row">
        <div class="col-lg-8 mb-4 mb-lg-0">
            <!-- Cart Items -->

            <?php
            $sub_total = 0;
            if (mysqli_num_rows($cart_result) == 0) {
            ?>
                <br>
                <h5 class='text-center text-secondary flex align-item-center' style="align-items:center;">Your Cart is Empty</h5>";
                <?php
            } else {

                while ($cart_data = mysqli_fetch_assoc($cart_result)) {
                    $product_id = $cart_data['product_id'];
                    $product_data = "select * from products where id='$product_id'";
                    $product_data = mysqli_fetch_assoc(mysqli_query($con, $product_data));
                    $product_image = $product_data['main_image'];
                ?>
                    <div class="card cart-item mb-3 <?php if ($product_data['quantity'] == 0) {
                                                        echo "out-of-stock";
                                                    } ?>">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-3 mb-3 mb-md-0">
                                    <div class="overflow-hidden">
                                        <img src="images/products/<?php echo $product_image; ?>" class="img-fluid product-img" alt="Product" width="100">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <h5 class="card-title"><?php echo $product_data['product_name']; ?></h5>
                                    <p class="text-danger fw-bold mb-0"><?php echo $cart_data['total_price'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="input-group mb-3" style="width: 150px;">
                                            <button class="btn btn-danger" onclick="decrease_cart(<?php echo $cart_data['product_id']; ?>)"><i class="bi bi-dash"></i></button>
                                            <input type="text" class="form-control text-center btn btn-outline-danger" value="<?php echo $cart_data['quantity']; ?>" min="1" readonly>
                                            <button class="btn btn-danger" onclick="increase_cart(<?php echo $cart_data['product_id']; ?>)"><i class="bi bi-plus"></i></button>
                                        </div>
                                        <?php if ($product_data['quantity'] == 0) {
                                            $sub_total = $sub_total;
                                        ?>
                                            <p class="text-danger mb-0 fw-bold badge p-2 btn btn-outline-danger" style="font-size: large;">Out of Stock</p>
                                        <?php
                                        } else {
                                            $sub_total = $sub_total + $cart_data['total_price'];
                                        ?>
                                            <a href="remove_from_cart.php?id=<?php echo $cart_data['product_id']; ?>"><button class="btn btn-outline-danger remove-btn btn-sm mb-3"><i class="bi bi-trash"></i>
                                                    Remove </button></a>
                                        <?php
                                        }
                                       
                                       
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>


        </div>

        <!-- Order Summary -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Order Summary</h5>

                    <div class="d-flex justify-content-between mb-3">
                        <span>Subtotal</span>
                        <span><?php echo $sub_total; ?></span>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span>Shipping</span>

                        <?php
                        if ($sub_total == 0 || $sub_total > 1000) {
                            $shipping_cost = 0;
                        } else {
                            $shipping_cost = 50;
                        }
                        ?>
                        <span>Rs. <?php echo $shipping_cost; ?> </span>
                    </div>
                    <!-- <div class="d-flex justify-content-between mb-3"> -->

                    <!-- <div class="d-flex justify-content-between mb-3">
                        <span>Tax</span>
                        <span>$13.50</span>
                    </div> -->

                    <hr>

                    <div class="d-flex justify-content-between mb-4">
                        <strong>Total</strong>
                        <strong class="text-danger"><?php
                                                    $cart_total = $sub_total + $shipping_cost;
                                                    echo "Rs. " . $cart_total . ".00";
                                                    ?></strong>
                    </div>

                    <a href="checkout.php"><button class="btn btn-outline-danger w-100 mb-3">Proceed to
                            Checkout</button></a>
                    <a href="all_products.php"><button class="btn btn-outline-danger w-100">Continue
                            Shopping</button></a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php';
 $_SESSION['cart_total'] = $sub_total;
 $_SESSION['shipping_cost'] = $shipping_cost; ?>