<?php include_once 'header.php';
$select = "select * from slider";
$table=mysqli_query($con,$select);
?>
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
<div class="carousel-indicators">
<?php
$i=0;
while($row=$table->fetch_assoc())
{
    if($i==0)
    {
        ?>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $i ?>" class="active" aria-current="true" aria-label="Slide <?=$i?>"></button>
        <?php 
    }
    else 
    {
        ?>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $i ?>" aria-label="Slide <?=$i?>"></button>
        <?php
    }
    ?>

    <?php 
    $i++;
}
?>
</div>
<?php
$select = "select * from slider";
$table=mysqli_query($con,$select);
?>
<br><br>
<div class="carousel-inner bg-info">
<?php
$i=0;
while($row=$table->fetch_assoc())
{
    if($i==0)
    {
        ?>
            <div class="carousel-item active bg-info">
            <img src="./images/slider_images/<?=$row['slider_image']?>" class="d-block w-100" alt="<?=$i?> slide" style="height: 500px;">
            <div class="carousel-caption d-none d-md-block">
                <h5>Special Offers</h5>
                <p>Check out our latest deals and promotions</p>
            </div>
        </div>
        <?php 
    }
    else 
    {
        ?>
            <div class="carousel-item">
            <img src="./images/slider_images/<?=$row['slider_image']?>" class="d-block w-100" alt="<?=$i?>  slide" style="height: 500px;">
            <div class="carousel-caption d-none d-md-block">
                <h5>New Arrivals</h5>
                <p>Discover our newest products</p>
            </div>
        </div>
        <?php
    }
    ?>

    <?php 
    $i++;
}
?>
</div>
<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<?php include_once 'footer.php'; ?>
