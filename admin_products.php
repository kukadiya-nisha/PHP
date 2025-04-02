<?php
include 'admin_header.php';
$limit = 4; // Number of categories per page
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;
?>
<script>
    $(document).ready(function() {
        $("#editProductModal").on("shown.bs.modal", function() {
            if (CKEDITOR.instances["editProductDescription"]) {
                CKEDITOR.instances["editProductDescription"].destroy();
            }
            CKEDITOR.replace("editProductDescription");
        });
    });
</script>


<?php
// Handling Add Category
if (isset($_POST['add_product_btn'])) {
    $product_name = $_POST['productName']; // Assuming you have a field for product name in your form
    $category_id = $_POST['category_id']; // Fetch the category ID from the form
    $price = $_POST['price'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $quantity = $_POST['quantity'];
    $discount = $_POST['discount'];
    $target_dir = "images/products/";
    $main_image = uniqid() . $_FILES['mainImage']['name'];
    $discounted_price = $price - ($discount * $price / 100);

    // Loop through each file in the $_FILES array
    if (!empty($_FILES['otherImages']['name'][0])) {
        foreach ($_FILES['otherImages']['name'] as $key => $extra_image_name) {
            $extra_image_tmp = $_FILES['otherImages']['tmp_name'][$key];
            $extra_image_unique_name = uniqid() . $extra_image_name;
            $extra_images[] = $extra_image_unique_name;
        }
    }

    // Convert the array of image names to a comma-separated string
    $other_images = implode(",", $extra_images);
    $insert_query = "INSERT INTO products (product_name, main_image, other_images, category_id, price, description, status, quantity, discount,discounted_price)  VALUES ('$product_name', '$main_image', '$other_images', $category_id, $price, '$description', '$status', $quantity, $discount,$discounted_price)";

    // Execute the insert query
    if (mysqli_query($con, $insert_query)) {
        if (!is_dir($target_dir)) {
            mkdir($target_dir);
        }
        // $main_image_path = $target_dir . $main_image;
        move_uploaded_file($_FILES['mainImage']['tmp_name'], $target_dir . "/" . $main_image);
        $i = 0;
        for ($i = 0; $i < count($extra_images); $i++) {
            move_uploaded_file($_FILES['otherImages']['tmp_name'][$i], $target_dir . "/" . $extra_images[$i]);
        }
?>
        <script>
            alert('Product added successfully.');
            window.location.href = 'admin_products.php';
        </script>
    <?php
    } else {
    ?>
        <script>
            alert('Error in adding product.');
            window.location.href = 'manage_products.php';
        </script>";
    <?php
    }
}

// Handling Edit product
if (isset($_POST['edit_product_btn'])) {
    $id = $_POST['id'];
    // echo $id;
    $product_name = $_POST['productName'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $quantity = $_POST['quantity'];
    $discount = $_POST['discount'];
    $result = mysqli_query($con, "SELECT * FROM products WHERE id = $id");
    $product = mysqli_fetch_assoc($result);
    $target_dir = "images/products/";

    $discounted_price = $price - ($discount * $price / 100);
    $update_query = "UPDATE products SET 
                        product_name = '$product_name', 
                        category_id = '$category_id', 
                        price = '$price', 
                        status = '$status', 
                        discount = $discount,
                        quantity = $quantity,
                        discounted_price = $discounted_price,
                        description = '$description'";
    if (!empty($_FILES['mainImage']['name'])) {
        $old_image  = $product['main_image'];
        $main_image = uniqid() . $_FILES['mainImage']['name'];
        $main_image_tmp = $_FILES['mainImage']['tmp_name'];
        $main_image_folder = $target_dir . $main_image;
        $update_query = $update_query . ", main_image = '$main_image'";
    }

    // Handle other images upload
    // $other_images = [];
    if (!empty($_FILES['otherImages']['name'][0])) {
        // Remove old other images
        $old_other_images = explode(',', $product['other_images']);
        if (!empty($_FILES['otherImages']['name'][0])) {
            foreach ($_FILES['otherImages']['name'] as $key => $extra_image_name) {
                $extra_image_tmp = $_FILES['otherImages']['tmp_name'][$key];
                $extra_image_unique_name = uniqid() . $extra_image_name;
                $extra_images[] = $extra_image_unique_name;
            }
        }
        $other_images = implode(',', $extra_images);
        $update_query = $update_query . ", other_images = '$other_images'";
    }

    $update_query = $update_query . " where id = $id";
    // Update product details in the database

    // echo $update_query;
    if (mysqli_query($con, $update_query)) {
        if (!empty($_FILES['mainImage']['name'])) {
            if (file_exists("$target_dir" . $product['main_image'])) {
                unlink("$target_dir" . $product['main_image']);
                move_uploaded_file($main_image_tmp, $main_image_folder);
            }
        }
        if (!empty($_FILES['otherImages']['name'][0])) {
            $i = 0;
            for ($i = 0; $i < count($extra_images); $i++) {
                move_uploaded_file($_FILES['otherImages']['tmp_name'][$i], $target_dir . "/" . $extra_images[$i]);
            }
            foreach ($old_other_images as $old_image) {
                if (file_exists("$target_dir" . trim($old_image))) {
                    unlink("$target_dir" . trim($old_image));
                }
            }
        }
        echo "<script>alert('Product updated successfully');</script>";
    } else {
        echo "<script>alert('Error updating product');</script>";
    }
    echo "<script>window.location.href='admin_products.php';</script>";
}

// Handling Delete Category


//Deactivating category
if (isset($_POST['deactivateproduct'])) {
    $productId = $_POST['id'];
    $update_query = "UPDATE products SET status = 'Inactive' WHERE id = $productId";
    if (mysqli_query($con, $update_query)) {
        echo "<script>alert('Product deactivated successfully.');</script>";
    } else {
        echo "<script>alert('Error in deactivating product.');</script>";
    }
}


// Activate Category    
if (isset($_POST['activateproduct'])) {
    $productId = $_POST['id'];
    $update_query = "UPDATE products SET status = 'Active' WHERE id = $productId";
    if (mysqli_query($con, $update_query)) {
        echo "<script>alert('Product activated successfully.');</script>";
    } else {
        echo "<script>alert('Error in activating product.');</script>";
    }
}

// Delete Product
if (isset($_POST['deleteProduct'])) {
    $productId = $_POST['id'];
    $delete_query = "DELETE FROM products WHERE id = $productId";
    if (mysqli_query($con, $delete_query)) {
        echo "<script>alert('Product deleted successfully.');
       
        </script>";
    } else {
        echo "<script>alert('Error in deleting product.');</script>";
    }
    ?>
    <script>
        window.location.href = "admin_products.php";
    </script>
<?php
}
?>



<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Product Management</h2>
    </div>

    <div class="card-body">
        <!-- Search and Add Category -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="input-group">

                    <form method="post" action="admin_products.php">
                        <input type="text" class="form-control" placeholder="Search Products..." class="m-4" name="search">

                        <button class="btn btn-danger mt-3" type="submit">
                            <i class="bi bi-search"></i> Search
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    <i class="bi bi-plus-circle"></i> Add New Product
                </button>
            </div>
        </div>
        <style>
            .modal-dialog {
                max-width: 900px;
                /* Increased from default 500px */
                width: 100%;
                /* Responsive width */
                margin: 1.75rem auto;
            }
        </style>

        <!-- Add Category Modal -->
        <div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Add New Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <style>
                            .form-row {
                                display: flex;
                                gap: 20px;
                                margin-bottom: 15px;
                            }

                            .form-col {
                                flex: 1;
                            }
                        </style>

                        <form action="admin_products.php" method="post" enctype="multipart/form-data" id="form1">
                            <div class="form-row">
                                <div class="form-col">
                                    <div class="mb-3">
                                        <label for="productName" class="form-label"><b>Product Name</b></label>
                                        <input type="text" class="form-control" id="productName" placeholder="Enter Product Name" name="productName" data-validation="required">
                                        <div class="error" id="productNameError"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="mainImage" class="form-label"><b>Main Image</b></label>
                                        <input type="file" class="form-control" id="mainImage" name="mainImage" data-validation="required file filesize" data-filesize="500">
                                        <div id="mainImageError" class="error"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="otherImages" class="form-label"><b>Other Images</b></label>
                                        <input type="file" class="form-control" id="otherImages" name="otherImages[]" multiple>
                                    </div>
                                    <div class="mb-3">
                                        <label for="categoryId" class="form-label"><b>Category ID</b></label>
                                        <select name="category_id" id="categoryId" class="form-control">
                                            <?php
                                            // Fetch categories from the database
                                            $query = "SELECT id, category_name FROM categories WHERE category_status = 'Active'";
                                            $result = mysqli_query($con, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='" . $row['id'] . "'>" . $row['category_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label"><b>Price</b></label>
                                        <input type="number" class="form-control" id="price" placeholder="Enter Price" name="price" step="0.01">
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label"><b>Status</b></label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label"><b>Quantity</b></label>
                                        <input type="number" class="form-control" id="quantity" placeholder="Enter Quantity" name="quantity">
                                    </div>
                                    <div class="mb-3">
                                        <label for="discount" class="form-label"><b>Discount</b></label>
                                        <input type="number" class="form-control" id="discount" placeholder="Enter Discount" name="discount">
                                    </div>
                                </div>
                                <div class="form-col">

                                    <div class="mb-3">
                                        <label for="editor-content" class="form-label"><b>Description</b></label>
                                        <textarea id="editor" name="description" class="form-control"></textarea>

                                        <!-- Display HTML output -->
                                        <div class="mt-3">
                                            <label class="form-label">Generated HTML Code:</label>
                                            <textarea id="htmlOutput" class="form-control" rows="5" readonly></textarea>
                                        </div>
                                        <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>

                                        <script>
                                            CKEDITOR.replace('editor');

                                            // Update HTML Output in real-time
                                            CKEDITOR.instances.editor.on('change', function() {
                                                document.getElementById('htmlOutput').value = CKEDITOR.instances.editor.getData();
                                            });
                                        </script>
                                    </div>
                                    <div class="mb-3">
                                        <label for="after_discount" class="form-label"><b>Price After Discount</b></label>
                                        <input type="number" class="form-control" id="after_discount" placeholder="Enter Discount" name="after_discount">
                                    </div>
                                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                                    <button type="submit" class="btn btn-danger" name="add_product_btn">Add Product</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Category Modal -->
        <div class=" modal fade" id="editProductModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Edit Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="admin_products.php" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="editProductId" value="">
                            <div class="form-row">
                                <div class="form-col">
                                    <div class="mb-3">
                                        <label for="productName" class="form-label"><b>Product Name</b></label>
                                        <input type="text" class="form-control" id="editProductName" placeholder="Enter Product Name" name="productName" data-validation="required">
                                        <div class="error" id="productNameError"></div>
                                    </div>
                                    <div class="mb-3">
                                        <div>

                                        </div>
                                        <label for="mainImage" class="form-label"><b>Main Image</b></label>
                                        <input type="file" class="form-control" id="mainImage" name="mainImage" data-validation="required file filesize" data-filesize="500">
                                        <div id="mainImageError" class="error"></div>
                                        <div id="mainImagePreview">

                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="otherImages" class="form-label"><b>Other Images</b></label>
                                        <input type="file" class="form-control" id="otherImages" name="otherImages[]" multiple>
                                        <div id="editProductOtherImagesPreview">

                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="categoryId" class="form-label"><b>Category ID</b></label>
                                        <select name="category_id" id="editProductCategoryId" class="form-control">
                                            <?php
                                            // Fetch categories from the database
                                            $query = "SELECT id, category_name FROM categories WHERE category_status = 'Active'";
                                            $result = mysqli_query($con, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='" . $row['id'] . "'>" . $row['category_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label"><b>Price</b></label>
                                        <input type="number" class="form-control" id="editProductPrice" placeholder="Enter Price" name="price" step="0.01">
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label"><b>Status</b></label>
                                        <select name="status" id="editProductStatus" class="form-control">
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="form-col">
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label"><b>Quantity</b></label>
                                        <input type="number" class="form-control" id="editProductQuantity" placeholder="Enter Quantity" name="quantity">
                                    </div>
                                    <div class="mb-3">
                                        <label for="discount" class="form-label"><b>Discount</b></label>
                                        <input type="number" class="form-control" id="editProductDiscount" placeholder="Enter Discount" name="discount">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editor-content" class="form-label"><b>Description</b></label>
                                        <textarea id="editProductDescription" name="description" class="form-control"></textarea>

                                        <!-- Display HTML output -->
                                        <!-- <div class="mt-3">
                                            <label class="form-label">Generated HTML Code:</label>
                                            <textarea id="htmlOutput" class="form-control" rows="5" readonly></textarea>
                                        </div> -->
                                    </div>

                                    <!-- Load CKEditor -->
                                    <!-- Load CKEditor -->
                                    <script src="https://cdn.ckeditor.com/4.25.1/standard/ckeditor.js"></script>

                                    <script>
                                        $(document).ready(function() {
                                            // Initialize CKEditor
                                            CKEDITOR.replace('editProductDescription');

                                            // Wait for CKEditor to fully initialize before attaching events
                                            CKEDITOR.on('instanceReady', function(event) {
                                                let editor = event.editor; // Get CKEditor instance

                                                // Function to update HTML output
                                                function updateHtmlOutput() {
                                                    let editorData = editor.getData();
                                                    $("#htmlOutput").val(editorData);
                                                }

                                                // Attach event listeners to update HTML output
                                                editor.on('change', updateHtmlOutput);
                                                editor.on('key', updateHtmlOutput);
                                                editor.on('paste', function() {
                                                    setTimeout(updateHtmlOutput, 100);
                                                });

                                                // Handle edit button click to load data
                                                $(".editBtn").click(function() {
                                                    let productDescription = $(this).data("description");
                                                    editor.setData(productDescription, {
                                                        callback: function() {
                                                            updateHtmlOutput(); // Ensure the output updates after setting data
                                                        }
                                                    });
                                                });
                                            });
                                        });
                                    </script>


                                    <!-- <div class="mb-3">
                                        <label for="after_discount" class="form-label"><b>Price After Discount</b></label>
                                        <input type="number" class="form-control" id="editProductAfterDiscount" placeholder="Enter Discount" name="after_discount">
                                    </div> -->
                                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                                    <button type="submit" class="btn btn-danger" name="edit_product_btn">Edit Product</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- view product modal -->
        <div class="modal fade" id="viewProductModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content shadow-lg">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title"><i class="bi bi-box"></i> Product Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row">
                            <div class="col-6">
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <img id="view_product_image" class="border shadow-sm rounded" width="150" height="150" alt="Product Image">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <strong><i class="bi bi-collection"></i> Other Images:</strong>
                                        <div id="view_product_other_images" class="mt-2"></div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <h4 id="view_product_name" class="mb-3"></h4>

                                        <div class="col-md-12">
                                            <strong><i class="bi bi-tags"></i>Product Category</strong> <span id="view_product_category"></span>
                                        </div>


                                        <div class="col-md-12">
                                            <h5 id="view_product_category" class="mb-3 text-muted"></h5>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <strong><i class="bi bi-currency-dollar"></i> Price:</strong> <span id="view_product_price"></span>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <strong><i class="bi bi-percent"></i> Discount:</strong> <span id="view_product_discount"></span>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <strong><i class="bi bi-tags"></i> Price After Discount:</strong> <span id="view_product_after_discount"></span>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <strong><i class="bi bi-clipboard-data"></i> Stock:</strong> <span id="view_product_stock"></span>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <strong><i class="bi bi-check-circle"></i> Status:</strong> <span id="view_product_status" class="badge bg-success"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <strong><i class="bi bi-info-circle"></i> Description:</strong>
                                        <p id="view_product_description" class="mt-2"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories Table -->
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST['search'])) {
                        $search = $_POST['search'];
                        $select = "SELECT * FROM products WHERE product_name LIKE '%$search%' LIMIT $start, $limit";
                    } else {
                        $select = "SELECT * FROM products LIMIT $start, $limit";
                    }
                    $countQuery = str_replace("SELECT *", "SELECT COUNT(*) as total", $select);
                    $countQuery = str_replace("LIMIT $start, $limit", "", $countQuery);
                    $totalResult = mysqli_query($con, $countQuery);
                    $totalRecords = mysqli_fetch_assoc($totalResult)['total'];
                    $totalPages = ceil($totalRecords / $limit);
                    $table = mysqli_query($con, $select);

                    while ($row = $table->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td style="max-width: 200px; height: auto;"><?= $row['product_name'] ?></td>
                            <td><img src=" images/products/<?= $row['main_image']; ?>" class="img-fluid" style="max-width: 70px; height: auto;" />
                            </td>

                            <td><span class="badge bg-<?= $row['status'] == "Inactive" ? "danger" : "success" ?>">
                                    <?= $row['status'] ?>
                                </span></td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary me-1 viewBtn"
                                    data-id="<?= $row['id'] ?>"
                                    data-name="<?= $row['product_name'] ?>"
                                    data-status="<?= $row['status'] ?>"
                                    data-price="<?= $row['price'] ?>"
                                    data-description="<?= htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8') ?>"
                                    data-image="<?= $row['main_image'] ?>"
                                    data-discount="<?= $row['discount'] ?>"
                                    data-after_discount="<?= $row['discounted_price'] ?>"
                                    data-category_id="<?= $row['category_id'] ?>"
                                    data-quantity="<?= $row['quantity'] ?>"
                                    data-other_images="<?= $row['other_images'] ?>"
                                    data-bs-toggle="modal"
                                    data-bs-target="#viewProductModal">
                                    View
                                </button>
                                <button class="btn btn-sm btn-outline-warning me-1 editBtn"
                                    data-id="<?= $row['id'] ?>"
                                    data-name="<?= $row['product_name'] ?>"
                                    data-status="<?= $row['status'] ?>"
                                    data-price="<?= $row['price'] ?>"
                                    data-description="<?= htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8') ?>"
                                    data-image="<?= $row['main_image'] ?>"
                                    data-discount="<?= $row['discount'] ?>"
                                    data-after_discount="<?= $row['discounted_price'] ?>"
                                    data-category_id="<?= $row['category_id'] ?>"
                                    data-quantity="<?= $row['quantity'] ?>"
                                    data-other_images="<?= $row['other_images'] ?>"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editProductModal">
                                    Edit
                                </button>
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <input type="submit" name="deleteProduct" class="btn btn-sm btn-outline-danger" value="Delete">
                                </form>
                                <form method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <input type="submit" name="managestock" class="btn btn-sm btn-outline-info" value="Add Stock">
                                </form>
                                <?php
                                if ($row['status'] == "Active") {
                                ?>
                                    <form method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <input type="submit" name="deactivateproduct" class="btn btn-sm btn-outline-secondary" value="Deactivate">
                                    </form>
                                <?php
                                } else {
                                ?>
                                    <form method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <input type="submit" name="activateproduct" class="btn btn-sm btn-outline-success" value="Activate">
                                    </form>
                                <?php
                                }   ?>

                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

        </div>

        <nav>
            <ul class="pagination justify-content-center">
                <?php if ($page > 1) { ?>
                    <li class="page-item"><a class="page-link" href="admin_products.php?page=<?= $page - 1 ?>">Previous</a></li>
                <?php }
                for ($i = 1; $i <= $totalPages; $i++) {
                    echo "<li class='page-item " . ($page == $i ? "active" : "") . "'><a class='page-link' href='admin_products.php?page=$i'>$i</a></li>";
                }
                if ($page < $totalPages) { ?>
                    <li class="page-item"><a class="page-link" href="admin_products.php?page=<?= $page + 1 ?>">Next</a></li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".editBtn").click(function() {
            let productId = $(this).data("id");
            let productName = $(this).data("name");
            let productStatus = $(this).data("status");
            let productPrice = $(this).data("price");
            let productDescription = $(this).data("description");
            let productImage = $(this).data("image");
            let productDiscount = $(this).data("discount");
            let productAfterDiscount = $(this).data("after_discount");
            let productCategoryId = $(this).data("category_id");
            let productQuantity = $(this).data("quantity");
            let productOtherImages = $(this).data("other_images");

            if (productImage) {
                $('#mainImagePreview').html('<img src="images/products/' + productImage + '" width="100" class="rounded">');
            } else {
                $('#mainImagePreview').html('<p>No Image</p>');
            }

            if (productOtherImages) {
                let images = productOtherImages.split(",");
                let imgPreview = "";
                images.forEach(img => {
                    imgPreview += `<img src="images/products/${img}" class="img-thumbnail" width="50px"> `;
                });
                $("#editProductOtherImagesPreview").html(imgPreview);
            } else {
                $("#editProductOtherImagesPreview").html("");
            }
            // Populate modal input fields
            $("#editProductId").val(productId);
            $("#editProductName").val(productName);
            $("#editProductStatus").val(productStatus);
            $("#editProductPrice").val(productPrice);
            $("#editProductDescription").val(productDescription);
            $("#editProductImagePreview").attr("src", "images/products/" + productImage);
            $("#editProductDiscount").val(productDiscount);
            $("#editProductAfterDiscount").val(productAfterDiscount);
            $("#editProductCategoryId").val(productCategoryId);
            $("#editProductQuantity").val(productQuantity);

            // Handle multiple images if needed

        });
        $(".viewBtn").click(function() {
            let productId = $(this).data("id");
            let productName = $(this).data("name");
            let productStatus = $(this).data("status");
            let productPrice = $(this).data("price");
            let productDescription = $(this).data("description");
            let productImage = $(this).data("image");
            let productDiscount = $(this).data("discount");
            let productAfterDiscount = $(this).data("after_discount");
            let productCategoryId = $(this).data("category_id");
            let productQuantity = $(this).data("quantity");
            let productOtherImages = $(this).data("other_images");

            if (productImage) {
                $('#mainImagePreview').html('<img src="images/products/' + productImage + '" width="150" class="rounded">');
            } else {
                $('#mainImagePreview').html('<p>No Image</p>');
            }

            if (productOtherImages) {
                let images = productOtherImages.split(",");
                let imgPreview = "";
                images.forEach(img => {
                    imgPreview += `<img src="images/products/${img}" class="img-thumbnail" width="100px"> `;
                });
                $("#view_product_other_images").html(imgPreview);
            } else {
                $("#view_product_other_images").html("");
            }
            // Populate modal input fields
            $("#view_product_name").text(productName);
            $("#view_product_status").text(productStatus);
            $("#view_product_price").text(productPrice);
            $("#view_product_description").html(productDescription);
            $("#view_product_image").attr("src", "images/products/" + productImage);
            $("#view_product_discount").text(productDiscount);
            $("#view_product_after_discount").text(productAfterDiscount);
            $("#view_product_category").text(productCategoryId);
            $("#view_product_stock").text(productQuantity);
            // $("#view_product_other_images").html(generateImageGallery(otherImages));


            $('#viewProductModal').show();

        });
    });
</script>

<?php include 'admin_footer.php'; ?>