<?php include 'header.php';
if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $q = "select * from products where category_id='$category' and status='Active'";
} else if (isset($_POST['apply_filters'])) {
    $category = $_POST['category'];
    $price_sort = $_POST['price_sort'];
    $search_term = $_POST['search_product'];
    $q = "select * from products where status='Active'";
    if ($category != '') {
        $q = $q . " and category_id='$category'";
    }

    if ($search_term != '') {
        $q .= " and product_name LIKE '%$search_term%'";
    }
    if ($price_sort != '') {
        $q .= " ORDER BY price $price_sort";
    }
    // echo $q;
} else {
    $q = "select * from products where status='Active'";
}

$res = mysqli_query($con, $q);
$total_rows = mysqli_num_rows($res);
?>

<div class="container ">
    <h2 class="text-center mb-4">All Products</h2>

    <!-- Filters Row -->
    <form action="all_products.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <!-- Category Dropdown -->
            <div class="col-12 col-md-6 col-lg-3">
                <select class="form-select" name="category">
                    <option value="">Select Category</option>
                    <?php
                    $select = "SELECT * FROM categories WHERE category_status='active'";
                    $table = mysqli_query($con, $select);
                    while ($row = $table->fetch_assoc()) {
                    ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <!-- Price Sorting Dropdown -->
            <div class="col-12 col-md-6 col-lg-3">
                <select class="form-select" name="price_sort">
                    <option value="">Sort by Price</option>
                    <option value="ASC">Low to High</option>
                    <option value="DESC">High to Low</option>
                </select>
            </div>

            <!-- Search Box -->
            <div class="col-12 col-md-6 col-lg-3">
                <input type="text" class="form-control" placeholder="Search..." aria-label="Search" name="search_product">
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <button class="btn btn-outline-danger w-100" type="submit" name="apply_filters">Apply Filters</button>
            </div>
        </div>
    </form>
    <div class="row g-4">
        <?php
        if ($total_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
        ?>
                <!-- Product Card 1 -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 <?php if ($row['quantity'] == 0) {
                                                                    echo  "out-of-stock";
                                                                } ?>">

                    <div class="card h-100 product-card ">
                        <div class="overflow-hidden">
                            <a href="view_product.php?id=<?php echo $row['id']; ?>">
                                <?php if ($row['quantity'] == 0): ?>
                                    <div class="out-of-stock-text">Out of Stock</div>
                                <?php endif; ?>
                                <img src="images/products/<?php echo $row['main_image']; ?>" class="card-img-top product-img" alt="Product">
                            </a>
                            <a href="<?php
                                        if (isset($_SESSION['user'])) {
                                            echo "add_to_wishlist.php?id=" . $row['id'];
                                        } else {
                                            echo "login.php?redirect=add_to_wishlist.php?id=" . $row['id'];
                                        }
                                        ?>"><i class="bi bi-heart wishlist-icon bg-danger text-white"></i></a>
                        </div>
                        <a href="view_product.php?id=<?php echo $row['id']; ?>" class="text-dark text-decoration-none">
                            <div class="card-body">
                                <h5 class="card-title product-title"><?php echo $row['product_name']; ?></h5>
                                <?php
                                if ($row['discount'] > 0) {
                                ?>
                                    <div class="row">
                                        <div class="col-12">
                                            <del class="card-text text-danger"><?php echo $row['price']; ?></del>
                                            <span class="badge bg-danger text-white">Sale <?php echo $row['discount']; ?>% Discount</span>
                                            <br>
                                            <span class="card-text text-success fw-bold"><?php echo $row['discounted_price']; ?></span>
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
                                            <span class="card-text text-success fw-bold"><?php echo $row['price']; ?></span>
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
                                        <a href="<?php
                                                    if (isset($_SESSION['user'])) {
                                                        echo "add_to_cart.php?id=" . $row['id'];
                                                    } else {
                                                        echo "login.php?redirect=add_to_cart.php?id=" . $row['id'];
                                                    }
                                                    ?>"><button class="btn btn-outline-danger btn-sm">Add to Cart</button></a>
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
<?php
        } else {
            echo "<h4 class='text-center text-secondary'>No Products Found</h4>";
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
</div>
<?php
include 'footer.php';
?>