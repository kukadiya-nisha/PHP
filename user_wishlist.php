<?php
include "header.php";
include "user_check_authentication.php";
$email = $_SESSION['user'];
$wishlist = "select * from wishlist where email='$email'";
$wishlist_result1 = mysqli_query($con, $wishlist);
$wishlist_rows = mysqli_num_rows($wishlist_result1);
?>
<div class="container">
    <h1 class="text-center">My Wishlist</h1>
    <br>
    <div class="row">
        <?php
        if ($wishlist_rows > 0) {

            while ($wishlist_result = $wishlist_result1->fetch_assoc()) {
                $product_id = $wishlist_result['product_id'];
                $product_data = "select * from products where id='$product_id'";
                $product_result = mysqli_fetch_assoc(mysqli_query($con, $product_data));
                // $product_data = ($product_data);
        ?>

                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card product-card h-100 ">
                        <div class="overflow-hidden">
                            <a href="view_product.php?id=<?php echo $product_result['id']; ?>">
                                <img src="images/products/<?php echo $product_result['main_image']; ?>" class="card-img-top product-img" alt="Product">
                            </a>
                            <a href="remove_from_wishlist.php?id=<?php echo $product_result['id']; ?>"><i class="bi bi-trash wishlist-icon bg-danger text-white"></i></a>
                        </div>
                        <a href="view_product.php?id=<?php echo $product_result['id']; ?>" class="text-dark text-decoration-none">
                            <div class="card-body">
                                <h5 class="card-title product-title"><?php echo $product_result['product_name']; ?></h5>
                                <?php
                                if ($product_result['discount'] > 0) {
                                ?>
                                    <div class="row">
                                        <div class="col-12">
                                            <del class="card-text text-danger"><?php echo $product_result['price']; ?></del>
                                            <span class="badge bg-danger text-white">Sale <?php echo $product_result['discount']; ?>% Discount</span>
                                            <br>
                                            <span class="card-text text-success fw-bold"><?php echo $product_result['discounted_price']; ?></span>
                                            <div class="text-warning">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-half"></i>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="row">
                                        <div class="col-12">
                                            <span class="card-text text-success fw-bold"><?php echo $product_result['price']; ?></span>
                                            <div class="text-warning">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-half"></i>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                                <div class="d-flex justify-content-between align-items-center">

                                    <div class="d-flex align-items-center">
                                        <a href="add_to_cart.php?id=<?php echo $product_result['id']; ?>"><button class="btn btn-outline-danger btn-sm">Add to Cart</button></a>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Pagination -->
            <?php
            }

            ?>
    </div>
</div>
<?php
        } else {
?>
    <br>
    <h5 class='text-center text-secondary'>No products added to Wishlist</h5>
<?php
        }
?>
<!-- <nav class="mt-5">
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
        </li>
        <li class="page-item active"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
            <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</nav> -->
<?php
include 'footer.php';
?>