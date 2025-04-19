<?php
include 'admin_header.php';
$limit = 5; // Number of categories per page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;
// Handling Add Category
if (isset($_POST['Add_Category'])) {
    $Category_Name = $_POST['categoryName'];
    $insert = "INSERT INTO categories (Category_Name) VALUES ('$Category_Name')";
    $result = mysqli_query($con, $insert);
    if ($result) {
        echo "<script>alert('Category Added Successfully');</script>";
        echo "<script>window.location.href='admin_categories.php';</script>";
    } else {
        echo "<script>alert('Error Adding Category');</script>";
    }
}

// Handling Edit Category Submission
if (isset($_POST['edit_Category'])) {
    $id = $_POST['id'];
    $Category_Name = $_POST['Category_Name'];
    $category_status = $_POST['category_status'];
    $update = "UPDATE categories SET category_name='$Category_Name', category_status='$category_status' WHERE id = $id";
    $result = mysqli_query($con, $update);
    if ($result) {
        echo "<script>alert('Category Updated Successfully');</script>";
        echo "<script>window.location.href='admin_categories.php';</script>";
    } else {
        echo "<script>alert('Error Updating Category');</script>";
    }
}

// Handling Delete Category
if (isset($_POST['deleteCategory'])) {
    $id = $_POST['id'];
    $delete = "DELETE FROM categories WHERE id = $id";
    $result = mysqli_query($con, $delete);
    if ($result) {
        echo "<script>alert('Category Deleted Successfully');</script>";
        echo "<script>window.location.href='admin_categories.php';</script>";
    } else {
        echo "<script>alert('Error Deleting Category');</script>";
    }
}

//Deactivating category

if (isset($_POST['deactivateCategory'])) {
    $id = $_POST['id'];
    $update = "update categories set category_status='Inactive' where id=$id";
    $result = mysqli_query($con, $update);
    if ($result) {
        echo "<script>alert('Category Deactivated Successfully');</script>";
        echo "<script>window.location.href='admin_categories.php';</script>";
    } else {
        echo "<script>alert('Error in deactivating Category');</script>";
    }
}

// Activate Category    
if (isset($_POST['activateCategory'])) {
    $id = $_POST['id'];
    $update = "update categories set category_status='Active' where id=$id";
    $result = mysqli_query($con, $update);
    if ($result) {
        echo "<script>alert('Category Activated Successfully');</script>";
        echo "<script>window.location.href='admin_categories.php';</script>";
    } else {
        echo "<script>alert('Error in activating Category');</script>";
    }
}
?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Category Management</h2>
    </div>

    <div class="card-body">
        <!-- Search and Add Category -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="input-group">
                    <form method="post" action="admin_categories.php">
                        <input type="text" class="form-control" placeholder="Search categories..." class="m-4" name="search">

                        <button class="btn btn-danger mt-3" type="submit">
                            <i class="bi bi-search"></i> Search
                        </button>
                    </form>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    <i class="bi bi-plus-circle"></i> Add New Category
                </button>
            </div>
        </div>

        <!-- Add Category Modal -->
        <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Add New Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="categoryForm" action="admin_categories.php" method="post">
                            <div class="mb-3">
                                <label for="categoryName" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="categoryName" name="categoryName"
                                    placeholder="Enter category name" data-validation="required alpha">
                                <div class="error" id="categoryNameError"></div>
                            </div>
                            <button type="submit" class="btn btn-danger" name="Add_Category">Add Category</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Category Modal -->
        <div class=" modal fade" id="editCategoryModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Edit Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editCategoryForm" method="post">
                            <input type="hidden" name="id" id="editCategoryId">
                            <div class="mb-3">
                                <label class="form-label">Category Name</label>
                                <input type="text" class="form-control" name="Category_Name" id="editCategoryName" data-validation="required alpha">
                                <div class="error" id="Category_NameError"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="category_status" id="editCategoryStatus">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <input type="submit" class="btn btn-danger" value="Edit Category" name="edit_Category">
                            </div>
                        </form>
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
                        <th>Category Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST['search'])) {
                        $search = $_POST['search'];
                        $select = "SELECT * FROM categories WHERE category_name LIKE '%$search%' LIMIT $start, $limit";
                    } else {
                        $select = "SELECT * FROM categories LIMIT $start, $limit";
                    }

                    // Get total records for pagination
                    $countQuery = str_replace("SELECT *", "SELECT COUNT(*) as total", $select);
                    $countQuery = str_replace("LIMIT $start, $limit", "", $countQuery);
                    $totalResult = mysqli_query($con, $countQuery);
                    $totalRecords = mysqli_fetch_assoc($totalResult)['total'];
                    $totalPages = ceil($totalRecords / $limit);
                    $table = mysqli_query($con, $select);
                    if (mysqli_num_rows($table) > 0) {
                        while ($row = $table->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['category_name'] ?></td>
                                <td><span class="badge bg-<?= $row['category_status'] == "Inactive" ? "danger" : "success" ?>">
                                        <?= $row['category_status'] ?>
                                    </span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-warning me-1 editBtn" data-id="<?= $row['id'] ?>" data-name="<?= $row['category_name'] ?>" data-status="<?= $row['category_status'] ?>" data-bs-toggle="modal" data-bs-target="#editCategoryModal">Edit</button>
                                    <form method="post" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <input type="submit" name="deleteCategory" class="btn btn-sm btn-outline-danger" value="Delete">
                                    </form>
                                    <?php
                                    if ($row['category_status'] == "Active") {
                                    ?>
                                        <form method="post" style="display:inline;">
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                            <input type="submit" name="deactivateCategory" class="btn btn-sm btn-outline-secondary" value="Deactivate">
                                        </form>
                                    <?php
                                    } else {
                                    ?>
                                        <form method="post" style="display:inline;">
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                            <input type="submit" name="activateCategory" class="btn btn-sm btn-outline-success" value="Activate">
                                        </form>
                                    <?php
                                    }   ?>

                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr> <td colspan='4' class='text-center text-secondary'><h5>No results found.</h5></td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <nav>
            <ul class="pagination justify-content-center">
                <?php if ($page > 1) { ?>
                    <li class="page-item"><a class="page-link" href="admin_categories.php?page=<?= $page - 1 ?>">Previous</a></li>
                <?php }
                for ($i = 1; $i <= $totalPages; $i++) {
                    echo "<li class='page-item " . ($page == $i ? "active" : "") . "'><a class='page-link' href='admin_categories.php?page=$i'>$i</a></li>";
                }
                if ($page < $totalPages) { ?>
                    <li class="page-item"><a class="page-link" href="admin_categories.php?page=<?= $page + 1 ?>">Next</a></li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".editBtn").click(function() {
            let categoryId = $(this).data("id");
            let categoryName = $(this).data("name");
            let categoryStatus = $(this).data("status");

            // Populate modal input fields
            $("#editCategoryId").val(categoryId);
            $("#editCategoryName").val(categoryName);
            $("#editCategoryStatus option[value='" + categoryStatus + "']").prop("selected", true);

        });
    });
</script>

<?php include 'admin_footer.php'; ?>