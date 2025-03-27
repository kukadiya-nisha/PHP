<?php include 'admin_header.php'; ?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Products Management</h2>
    </div>
    <div class="col-12 col-md-6">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search Products...">
            <button class="btn btn-danger" type="button">
                <i class="bi bi-search"></i>
            </button>
        </div>
    </div>
    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addProductModal">
        <i class="bi bi-plus-lg"></i> Add New Product
    </button>
</div>
<style>
    .modal-dialog {
        max-width: 800px;
        /* Increased from default 500px */
        width: 90%;
        /* Responsive width */
        margin: 1.75rem auto;
    }
</style>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <img src="product3.jpg" alt="Product 3" style="width: 50px; height: 50px; object-fit: cover;">
                        </td>
                        <td>Smart Watch</td>
                        <td>$299.99</td>
                        <td>Feature-rich smartwatch with health tracking</td>
                        <td>
                            <button class="btn btn-outline-primary btn-sm me-2 edit-product">
                                <i class="bi bi-eye"></i> View
                            </button>

                            <button class="btn btn-outline-success btn-sm me-2 edit-product">
                                <i class="bi bi-pencil"></i> Edit
                            </button>
                            <button class="btn btn-outline-warning btn-sm me-2 edit-product">
                                <i class="bi bi-box"></i> Add Stock
                            </button>
                            <button class="btn btn-outline-dark btn-sm me-2 edit-product">
                                <i class="bi bi-pencil"></i> Activate
                            </button>
                            <button class="btn btn-outline-danger btn-sm">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <input type="text" class="form-control" id="productName" placeholder="Enter Product Name" name="productName"
                                    data-validation="required">
                                <div class="error" id="productNameError"></div>
                            </div>
                            <div class="mb-3">
                                <label for="mainImage" class="form-label"><b>Main Image</b></label>
                                <input type="file" class="form-control" id="mainImage" name="mainImage" data-validation="required file filesize" data-filesize="200">
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
                                    $query = "SELECT id, category_name FROM categories WHERE category_status = 'active'";
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
                            <button type="submit" class="btn btn-danger w-45 mb-3" name="add_product_btn">Sign Up</button>
                            <button type="button" class="btn btn-secondary w-45 mb-3">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProductForm" novalidate>
                        <div class="mb-3">
                            <label for="editProductName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="editProductName" name="editProductName">
                        </div>
                        <div class="mb-3">
                            <label for="editProductPrice" class="form-label">Price</label>
                            <input type="number" class="form-control" id="editProductPrice" name="editProductPrice">
                        </div>
                        <div class="mb-3">
                            <label for="editProductDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editProductDescription" name="editProductDescription" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editProductImage" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="editProductImage" name="editProductImage">
                            <div class="mt-2">
                                <img id="currentProductImage" src="" alt="Current Product Image" style="max-width: 100px; display: none;">
                            </div>
                        </div>
                        <div class="modal-footer px-0 pb-0">
                            <button type="button" class="btn btn-secondary modal-close-btn">Close</button>
                            <button type="submit" class="btn btn-danger">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .table td,
        .table th {
            vertical-align: middle;
        }

        .btn {
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: scale(1.05);
        }

        .error {
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add Product Form Validation
            $("#addProductForm").validate({
                rules: {
                    productName: {
                        required: true,
                        minlength: 3
                    },
                    productPrice: {
                        required: true,
                        number: true,
                        min: 0
                    },
                    productDescription: {
                        required: true,
                        minlength: 10
                    },
                    productImage: {
                        required: true,
                        accept: "image/*"
                    }
                },
                messages: {
                    productName: {
                        required: "Please enter a product name",
                        minlength: "Product name must be at least 3 characters long"
                    },
                    productPrice: {
                        required: "Please enter a price",
                        number: "Please enter a valid number",
                        min: "Price cannot be negative"
                    },
                    productDescription: {
                        required: "Please enter a description",
                        minlength: "Description must be at least 10 characters long"
                    },
                    productImage: {
                        required: "Please select a product image",
                        accept: "Please select a valid image file"
                    }
                },
                errorElement: 'div',
                errorClass: 'error'
            });

            // Edit Product Form Validation
            var editValidator = $("#editProductForm").validate({
                rules: {
                    editProductName: {
                        required: true,
                        minlength: 3
                    },
                    editProductPrice: {
                        required: true,
                        number: true,
                        min: 0
                    },
                    editProductDescription: {
                        required: true,
                        minlength: 10
                    }
                },
                messages: {
                    editProductName: {
                        required: "Please enter a product name",
                        minlength: "Product name must be at least 3 characters long"
                    },
                    editProductPrice: {
                        required: "Please enter a price",
                        number: "Please enter a valid number",
                        min: "Price cannot be negative"
                    },
                    editProductDescription: {
                        required: "Please enter a description",
                        minlength: "Description must be at least 10 characters long"
                    }
                },
                errorElement: 'div',
                errorClass: 'error',
                submitHandler: function(form) {
                    // Handle form submission here
                    alert('Form is valid! Processing...');
                    // Add your AJAX call here

                    // Only close modal if submission is successful
                    $('#editProductModal').modal('hide');
                }
            });

            // Handle Edit Button Click
            $('.edit-product').click(function() {
                var row = $(this).closest('tr');
                var name = row.find('td:eq(1)').text();
                var price = row.find('td:eq(2)').text().replace('$', '');
                var description = row.find('td:eq(3)').text();
                var imgSrc = row.find('img').attr('src');

                $('#editProductName').val(name);
                $('#editProductPrice').val(price);
                $('#editProductDescription').val(description);
                $('#currentProductImage').attr('src', imgSrc).show();

                $('#editProductModal').modal('show');
            });

            // Handle modal close button
            $('.modal-close-btn').click(function(e) {
                e.preventDefault();
                if ($("#editProductForm").valid()) {
                    $('#editProductModal').modal('hide');
                }
            });

            // Prevent form submission on enter key
            $('#editProductForm input').keydown(function(e) {
                if (e.keyCode == 13) {
                    e.preventDefault();
                    return false;
                }
            });

            // Reset validation when modal is hidden
            $('#editProductModal').on('hidden.bs.modal', function() {
                editValidator.resetForm();
                $("#editProductForm")[0].reset();
            });
        });
    </script>

    <?php include 'admin_footer.php'; ?>