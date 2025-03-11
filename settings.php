<?php include 'admin_header.php'; 

if (isset($_POST['Add_Slider'])) {
    $Slider_Image = $_FILES['Slider_Image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($Slider_Image);
    move_uploaded_file($_FILES['Slider_Image']['tmp_name'], $target_file);
    $insert = "INSERT INTO sliders (image) VALUES ('$Slider_Image')";
    $result = mysqli_query($con, $insert);
    if ($result) {
        echo "<script>alert('Slider Image Added Successfully');</script>";
        echo "<script>window.location.href='settings.php';</script>";
    } else {
        echo "<script>alert('Error Adding Slider Image');</script>";
    }
}

if (isset($_POST['editSlider_form'])) {
    $id = $_POST['id'];
    $select = "SELECT * FROM sliders WHERE id = $id";
    $table = mysqli_query($con, $select);
    $row = $table->fetch_assoc();
    ?>
    <div class="card shadow-sm my-5">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Edit Slider Image</h5>
        </div>
        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <div class="mb-3">
                    <label class="form-label">Slider Image</label>
                    <input type="file" class="form-control" name="Slider_Image" required>
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-danger" value="Edit Slider" name="edit_Slider">
                </div>
            </form>
        </div>
    </div>
    <?php
}

if (isset($_POST['edit_Slider'])) {
    $id = $_POST['id'];
    $Slider_Image = $_FILES['Slider_Image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($Slider_Image);
    move_uploaded_file($_FILES['Slider_Image']['tmp_name'], $target_file);
    $update = "UPDATE sliders SET image='$Slider_Image' WHERE id = $id";
    $result = mysqli_query($con, $update);
    if ($result) {
        echo "<script>alert('Slider Image Updated Successfully');</script>";
        echo "<script>window.location.href='settings.php';</script>";
    } else {
        echo "<script>alert('Error Updating Slider Image');</script>";
    }
}

if (isset($_POST['deleteSlider'])) {
    $id = $_POST['id'];
    $delete = "DELETE FROM sliders WHERE id = $id";
    $result = mysqli_query($con, $delete);
    if ($result) {
        echo "<script>alert('Slider Image Deleted Successfully');</script>";
        echo "<script>window.location.href='settings.php';</script>";
    } else {
        echo "<script>alert('Error Deleting Slider Image');</script>";
    }
}
?>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white">
                    <h5 class="mb-0">Slider Management</h5>
                </div>
                <div class="card-body">
                    <!-- Add Slider -->
                    <div class="mb-4">
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addSliderModal">
                            <i class="bi bi-plus-circle"></i> Add New Slider
                        </button>
                    </div>
                    <!-- Add Slider Modal -->
                    <div class="modal fade" id="addSliderModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Add New Slider</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="addSliderForm" method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label class="form-label">Slider Image</label>
                                            <input type="file" class="form-control" name="Slider_Image" required>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <input type="submit" form="addSliderForm" class="btn btn-danger" value="Add Slider" name="Add_Slider">
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Sliders Table -->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Slider Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
$select = "SELECT * FROM slider";
$table = mysqli_query($con, $select);
while ($row = $table->fetch_assoc()) {
?>
                                <tr class="align-middle">
                                    <td><?= $row['id'] ?></td>
                                    <td><img src="uploads/<?= $row['image'] ?>" alt="Slider Image" width="100"></td>
                                    <td class="d-flex">
                                        <form method="post">
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                            <input type="submit" name="editSlider_form" class="btn btn-sm btn-outline-warning me-1" value="Edit">
                                        </form>
                                        <form method="post">
                                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                            <input type="submit" name="deleteSlider" class="btn btn-sm btn-outline-danger me-1" value="Delete">
                                        </form>
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
    </div>
</div>

<?php include 'admin_footer.php'; ?>
