<?php include 'header.php';
if (isset($_POST['add_address'])) {

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $phone = $_POST['phone'];
    $pincode = $_POST['pincode'];
    $user_id = $_SESSION['user'];

    $sql = "INSERT INTO `address`(`user_email`, `firstname`, `lastname`, `email`, `address`, `city`, `state`, `zip`, `phone`) values ('$user_id','$firstName', '$lastName', '$email', '$address', '$city', '$state', $pincode, $phone )";
    // echo $sql;

    $result = $con->query($sql);

    if ($result) {
        echo "<script>alert('Address added successfully')</script>";
    } else {
        echo "<script>alert('Address not added')</script>";
    }
}

if (isset($_POST['edit_address'])) {
    $edit_id = $_POST['edit_id'];
    $edit_firstName = $_POST['editfirstName'];
    $edit_lastName = $_POST['editlastName'];

    $edit_email = $_POST['editemail'];
    $edit_address = $_POST['editaddress'];
    $edit_city = $_POST['editcity'];
    $edit_state = $_POST['editstate'];
    $edit_phone = $_POST['editphone'];
    $edit_pincode = $_POST['editpincode'];

    $sql = "UPDATE `address` SET `firstname`='$edit_firstName',`lastname`='$edit_lastName',`email`='$edit_email',`address`='$edit_address',`city`='$edit_city',`state`='$edit_state',`zip`='$edit_pincode',`phone`='$edit_phone' WHERE id = '$edit_id'";
    // echo $sql;

    $result = $con->query($sql);

    if ($result) {
        echo "<script>alert('Address updated successfully')</script>";
    } else {
        echo "<script>alert('Error in updating address')</script>";
    }
}

if (isset($_POST['delete_address'])) {
    $delete_id = $_POST['delete_id'];
    $sql = "DELETE FROM `address` WHERE id = '$delete_id'";
    $result = $con->query($sql);
    if ($result) {
        echo "<script>alert('Address deleted successfully')</script>";
    } else {
        echo "<script>alert('Error in deleting address')</script>";
    }
}

if (isset($_POST['deliver_address'])) {
    $deliver_id = $_POST['delete_id'];
    $_SESSION['delivery_address'] = $deliver_id;
}

if (isset($_POST['apply-offer'])) {
    $offer_code = $_POST['offercode'];
    $offer_code = strtoupper($offer_code);
    $sql = "SELECT * FROM offers WHERE offer_name = '$offer_code'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['status'] == 'Active') {
            if ($row['cart_total'] <= $_SESSION['cart_total']) {
                $_SESSION['offer_status'] = "Offer Applied Successfully";
                $_SESSION['status'] = "success";
                $discount = $_SESSION['cart_total'] * $row['discount_percentage'] / 100;
                if ($discount >= $row['max_discount']) {
                    $discount = $row['max_discount'];
                } else {
                    $discount = $discount;
                }
                $_SESSION['discount'] = $discount;
                $_SESSION['total'] = $_SESSION['cart_total'] - $discount;
                $_SESSION['offer'] = strtoupper($row['offer_name']);
            } else {
                $_SESSION['offer_status'] = "Minimum order amount should be Rs. " . $row['cart_total'];
                $_SESSION['status'] = "danger";
                $_SESSION['total'] = $_SESSION['cart_total'];
            }
        } else {
            $_SESSION['offer_status'] = "Offer Code Expired";
            $_SESSION['status'] = "danger";
            $_SESSION['total'] = $_SESSION['cart_total'];
        }
    } else {
        $_SESSion['offer_status'] = "Invalid Offer Code";
        $_SESSION['status'] = "danger";
        $_SESSION['total'] = $_SESSION['cart_total'];
    }
}
?>
<div class="container py-5">
    <h2 class="text-center mb-4">Checkout</h2>

    <div class="row">
        <!-- Shipping Information -->
        <div class="col-lg-8 mb-4">
            <div class="card checkout-card">
                <div class="card-body">
                    <button type="button" class="btn btn-danger mb-3" data-bs-toggle="modal"
                        data-bs-target="#addAddressModal">
                        Add New Address
                    </button>
                    <!-- Add Address Modal -->
                    <h5 class="card-title mb-4">Select Delivery Address</h5>
                    <?php
                    $user_id = $_SESSION['user'];
                    $sql = "SELECT * FROM address WHERE user_email = '$user_id'";
                    $result = $con->query($sql);

                    if ($result->num_rows > 0) {
                        echo '<div class="row">';
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-muted">
                                            <?php echo $row['firstname'] . ' ' . $row['lastname']; ?></h6>
                                        <p class="card-text">
                                            <?php echo $row['address']; ?><br>
                                            <?php echo $row['city'] . ', ' . $row['state']; ?><br>
                                            PIN: <?php echo $row['zip']; ?><br>
                                            Phone: <?php echo $row['phone']; ?><br>
                                            Email: <?php echo $row['email']; ?>
                                        </p>

                                        <table class="table">
                                            <tr>
                                                <td>
                                                    <button class="btn btn-outline-danger editBtn" data-id="<?= $row['id'] ?>"
                                                        data-firstname="<?= $row['firstname'] ?>"
                                                        data-lastname="<?= $row['lastname'] ?>"
                                                        data-email="<?= $row['email'] ?>" data-mobile="<?= $row['phone'] ?>"
                                                        data-pincode="<?= $row['zip']; ?>" data-city="<?= $row['city']; ?>"
                                                        data-state="<?= $row['state']; ?>"
                                                        data-address="<?= $row['address']; ?>" data-bs-toggle="modal"
                                                        data-bs-target="#editaddressModal">
                                                        Edit
                                                    </button>
                                                </td>
                                                <td>
                                                    <div>
                                                        <form action="checkout.php" method="post">
                                                            <input type="hidden" name="delete_id" value="<?= $row['id']; ?>">
                                                            <button type="submit" class="btn btn-outline-danger"
                                                                name="delete_address">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                                &nbsp;
                                                <td>
                                                    <form action="checkout.php" method="post">
                                                        <input type="hidden" name="delete_id" value="<?= $row['id']; ?>">
                                                        <button type="submit" class="btn btn-outline-danger"
                                                            name="deliver_address">
                                                            Deliver to this Address
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                        echo '</div>';
                    } else {
                        echo '<div class="alert alert-info">No addresses found. Please add a new address.</div>';
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-4">
            <div class="card checkout-card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Order Summary</h5>

                    <div class="d-flex justify-content-between mb-3">
                        <span>Subtotal</span>
                        <span>Rs. <?= $_SESSION['cart_total']; ?></span>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span>Shipping</span>
                        <span>Rs. <?= $_SESSION['shipping_cost']; ?></span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <form action="checkout.php" class="my-2" method="post">
                            <div class="row align-items-center">
                                <div class="col-md-4 text-md-start">
                                    <label for="offercode" class="form-label fw-semibold">Offer Code:</label>
                                </div>
                                <div class="col-md-5 text-md-start">
                                    <input type="text" id="offercode" name="offercode" value="
                                    <?php if (isset($_SESSION['offer'])) {
                                        echo $_SESSION['offer'];
                                    } ?>" class="form-control">
                                </div>
                                <div class="col-md-3 text-md-start">
                                    <button type="submit" class="btn btn-outline-danger w-100"
                                        name="apply-offer">Apply</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div id="offer_code" class="<?php if (isset($_SESSION['status'])) {
                                                    echo "text-" . $_SESSION['status'];
                                                }  ?>">
                        <?php
                        if (isset($_SESSION['offer_status'])) {

                            echo $_SESSION['offer_status'];
                        }

                        ?>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-4">
                        <strong>Discount</strong>
                        <strong class="text-success">Rs. <?php if (isset($_SESSION['discount'])) {
                                                                echo $_SESSION['discount'];
                                                            } else {
                                                                echo "0";
                                                            } ?></strong>

                    </div>
                    <div class="d-flex justify-content-between mb-4">

                        <strong>Total</strong>
                        <strong class="text-danger">Rs. <?php if (isset($_SESSION['total'])) {
                                                            echo $_SESSION['total'];
                                                        } else {
                                                            echo "0";
                                                        } ?></strong>
                    </div>

                    <hr>
                    <strong> Choose Payment Method </strong>
                    <br>
                    <form action="payment.php" method="post" class="mt-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="cod" value="COD">
                            <label class="form-check-label" for="cod">
                                Cash on Delivery
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="pay_online"
                                value="Online" checked>
                            <label class="form-check-label" for="cod">
                                Pay Now
                            </label>

                        </div>
                        <br>
                        <button class="btn btn-outline-danger w-100" type="submit" name="payment">Place Order</button>
                    </form>
                </div>
            </div>
            <br>
            <div class="card checkout-card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Delivery Address</h5>
                    <?php
                    if (isset($_SESSION['delivery_address'])) {
                        $delivery_address = $_SESSION['delivery_address'];
                        $q = "SELECT * FROM address WHERE id = '$delivery_address'";
                        $result = mysqli_query($con, $q);
                        $row = mysqli_fetch_assoc($result); ?>
                        <h6 class="card-subtitle mb-2 text-muted">
                            <?php echo $row['firstname'] . ' ' . $row['lastname']; ?></h6>
                        <p class="card-text">
                            <?php echo $row['address']; ?><br>
                            <?php echo $row['city'] . ', ' . $row['state']; ?><br>
                            PIN: <?php echo $row['zip']; ?><br>
                            Phone: <?php echo $row['phone']; ?><br>
                            Email: <?php echo $row['email']; ?>
                        </p>

                    <?php
                    } else {
                        echo '<p class="card-text">No delivery address selected.</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title " id="addAddressModalLabel">Add New Delivery Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="checkout.php">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" data-validation="required alpha" name="firstName"
                                placeholder="First Name" id="firstName">
                            <div class="error" id="firstNameError"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName"
                                placeholder="Last Name" data-validation="required alpha">
                            <div class="error" id="lastNameError"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                            data-validation="required email">
                        <div class="error" id="emailError"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" placeholder="Address"
                            data-validation="required"></textarea>
                        <div class="error" id="addressError"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="City"
                                data-validation="required">
                            <div class="error" id="cityError"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">State</label>
                            <input type="text" class="form-control" id="state" name="state" placeholder="State"
                                data-validation="required">
                            <div class="error" id="stateError"></div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone"
                                data-validation="required numeric min max" data-min="10" data-max="10">
                            <div class="error" id="phoneError"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pin Code</label>
                            <input type="text" class="form-control" id="pincode" name="pincode"
                                data-validation="required numeric min max" data-min="6" data-max="6"
                                placeholder="Pin Code">
                            <div class="error" id="pincodeError"></div>
                        </div>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger" name="add_address">Save Address</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editaddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title " id="addAddressModalLabel">Edit Delivery Address</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="checkout.php">
                    <div class="row">

                        <input type="hidden" name="edit_id" id="edit_id">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" data-validation="required alpha"
                                    name="editfirstName" placeholder="First Name" id="editfirstName">
                                <div class="error" id="editfirstNameError"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="editlastName" name="editlastName"
                                    placeholder="Last Name" data-validation="required alpha">
                                <div class="error" id="editlastNameError"></div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="editemail" name="editemail" placeholder="Email"
                                data-validation="required email">
                            <div class="error" id="editemailError"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" id="editaddress" name="editaddress" placeholder="Address"
                                data-validation="required"></textarea>
                            <div class="error" id="editaddressError"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">City</label>
                                <input type="text" class="form-control" id="editcity" name="editcity" placeholder="City"
                                    data-validation="required">
                                <div class="error" id="editcityError"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">State</label>
                                <input type="text" class="form-control" id="editstate" name="editstate"
                                    placeholder="State" data-validation="required">
                                <div class="error" id="editstateError"></div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone</label>
                                <input type="tel" class="form-control" id="editphone" name="editphone"
                                    placeholder="Phone" data-validation="required numeric min max" data-min="10"
                                    data-max="10">
                                <div class="error" id="editphoneError"></div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pin Code</label>
                                <input type="text" class="form-control" id="editpincode" name="editpincode"
                                    data-validation="required numeric min max" data-min="6" data-max="6"
                                    placeholder="Pin Code">
                                <div class="error" id="editpincodeError"></div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" name="edit_address">Edit Address</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".editBtn").click(function() {
                var id = $(this).data("id");
                var firstname = $(this).data("firstname");
                var lastname = $(this).data("lastname");
                var email = $(this).data("email");
                var phone = $(this).data("mobile");
                var pincode = $(this).data("pincode");
                //    alert(pincode);
                var address = $(this).data("address");
                var city = $(this).data("city");
                var state = $(this).data("state");

                $("#edit_id").val(id);

                $("#editfirstName").val(firstname);
                $("#editlastName").val(lastname);
                $("#editemail").val(email);
                $("#editphone").val(phone);
                $("#editaddress").val(address);
                $("#editcity").val(city);
                $("#editstate").val(state);
                $("#editpincode").val(pincode);

                $("#editaddressModal").modal("show");
            });


        });
    </script>