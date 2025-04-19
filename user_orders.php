<?php
include_once("header.php");
include_once("user_check_authentication.php");

$email = $_SESSION['user'];
$q = "select * from orders where email='$email'";
$result = mysqli_query($con, $q);

$q1 = "select * from registration where email='$email'";
$result1  = mysqli_fetch_assoc(mysqli_query($con, $q1));

if()

?>
<div class="container">
    <div class="row text-center">
        <h3>My Orders</h3>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Sr.NO</th>
                            <th scope="col">Order ID</th>
                            <th scope="col">Product</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Order Status</th>
                            <th scope="col">Payment</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            $pid = $row['product_id'];
                            $p = "select * from products where id=$pid";
                            $p_result = mysqli_fetch_assoc(mysqli_query($con, $p));
                        ?>

                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['order_id']; ?></td>

                                <td><img src="images/products/<?php echo $p_result['main_image']; ?>" height="50px"></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td><?php echo $row['actual_amount']; ?></td>
                                <td><?php echo $row['delivery_status']; ?></td>
                                <td><?php echo $row['payment_status']; ?></td>
                                <td>
                                    <?php
                                    if ($row['rating'] == NULL and $row['review'] == NULL) {
                                    ?>
                                        <button type="button" class="btn btn-success" id="rate_review_btn" data-bs-toggle="modal" data-bs-target="#ratingReviewModal" data-order_id="<?php echo $row['sub_order_id'] ?>" onclick="setOrderID(<?php echo $row['sub_order_id']; ?>)">Review</button>
                                    <?php
                                    }
                                    ?>
                                    <a href="user_view_order.php?id=<?php echo $row['sub_order_id']; ?>"
                                        class="btn btn-info">View</a>
                                    <?php
                                    if ($row['delivery_status'] == "Ordered") { ?>
                                        <a href="user_cancel_order.php?id=<?php echo $row['sub_order_id']; ?>"
                                            class="btn btn-danger">Cancel</a>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
include_once('footer.php'); ?>

<!-- Rating and Review Modal -->
<div class="modal fade" id="ratingReviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Rate and Review</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="user_orders.php" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-col">
                            <div class="mb-3">
                                <label for="rating" class="form-label"><b>Rating (1-5)</b></label>
                                <select class="form-control" id="rating" name="rating" data-validation="required">
                                    <option value="">Select Rating</option>
                                    <option value="1">1 Star </option>
                                    <option value="2">2 Stars</option>
                                    <option value="3">3 Stars</option>
                                    <option value="4">4 Stars</option>
                                    <option value="5">5 Stars</option>
                                </select>
                                <div class="error" id="ratingError"></div>
                            </div>
                            <div class="mb-3">
                                <label for="review" class="form-label"><b>Review</b></label>
                                <textarea class="form-control" id="review" name="review" rows="3" data-validation="required"></textarea>
                                <div class="error" id="reviewError"></div>
                            </div>
                            <input type="hidden" name="order_id" id="order_id" value="">
                            <button type="submit" class="btn btn-danger" name="rate_review_btn1">Submit</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#rate_review_btn').on('click', function() {
            // alert("hello");
            var order_id = $(this).data('order_id');
            $('#order_id').val(order_id);
            $('#ratingReviewModal').modal('show');
        });
    });
</script>