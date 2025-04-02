<?php
include 'header.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $q = "select * from products where id='$id'";
    $res = mysqli_query($con, $q);
    $row = mysqli_fetch_assoc($res);
    $other_images = explode(',', $row['other_images']);

?>
    <div class="container py-5">
        <div class="row">
            <!-- Product Image -->
            <div class="col-md-6 mb-4">
                <div class="card overflow-hidden">
                    <img src="images/products/<?php echo $row['main_image']; ?>" class="card-img-top product-image" alt="Product">
                </div>

                <!-- Thumbnail Images -->
                <div class="row mt-3 g-2">
                    <?php
                    foreach ($other_images as $img) {
                    ?>
                        <div class="col-2">
                            <img src="images/products/<?php echo $img; ?>" class="img-fluid cursor-pointer border" alt="Thumbnail" width="100" height="100">
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>

            <!-- Product Details -->
            <div class="col-md-6">
                <div class="product-details">
                    <h2 class="mb-3"><?php echo $row['product_name']; ?></h2>

                    <div class="mb-3">
                        <span class="text-danger h3 fw-bold"><?php if ($row['discount'] > 0)
                                                                    echo $row['discounted_price'];
                                                                else
                                                                    echo $row['price']; ?></span>
                        <span class="text-decoration-line-through text-muted ms-2">
                            <?php
                            if ($row['discount'] > 0) {
                                echo $row['price'];
                            } else {
                                echo "";
                            }
                            ?>
                        </span>
                        &nbsp;
                        <span class=" badge bg-danger text-white"><?php if ($row['discount'] > 0) {
                                                                        echo "(" . $row['discount'] . '% OFF' . ")";
                                                                    } ?></span>

                    </div>

                    <div class="mb-3 text-warning">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-half"></i>
                        <span class="text-dark ms-2">(128 reviews)</span>
                    </div>

                    <p class="mb-4">
                        <?php echo $row['description']; ?>
                    </p>

                    <!-- <div class="mb-4">
                        <h5>Color</h5>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-dark rounded-circle p-3"></button>
                            <button class="btn btn-outline-secondary rounded-circle p-3"></button>
                            <button class="btn btn-outline-danger rounded-circle p-3"></button>
                        </div>
                    </div> -->
                    <form method="post" action="add_to_cart.php">
                        <div class="mb-4">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <label class="form-label">Quantity</label>
                            <div class="input-group" style="width: 150px;">
                                <input type="number" class="form-control text-center" name="quantity" value="1" min="1" max="5">
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit " class="btn btn-outline-danger" name="add_to_cart">Add to Cart</button></a>
                            <a href="checkout.php"><button class="btn btn-outline-danger">Buy Now</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Product Description -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-4">Product Description</h4>
                        <p>Experience premium sound quality with our wireless headphones featuring:</p>
                        <ul>
                            <li>Active Noise Cancellation</li>
                            <li>30-hour battery life</li>
                            <li>Bluetooth 5.0 connectivity</li>
                            <li>Premium comfort with memory foam ear cushions</li>
                            <li>Built-in microphone for calls</li>
                            <li>Touch controls for easy operation</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}

include 'footer.php';
