<html>

<head>
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <script src="./css/bootstrap.bundle.min.js"></script>
</head>

<body>
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="javascript:void(0)">Logo</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mynavbar">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)">Link</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="text" placeholder="Search">
          <button class="btn btn-primary" type="button">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <div id="demo" class="carousel slide py-5" data-bs-ride="carousel">

    <!-- Indicators/dots -->
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
    </div>

    <!-- The slideshow/carousel -->
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="./images/s1.jpg" alt="Los Angeles" class="d-block" height="400px" style="width:100%">
      </div>
      <div class="carousel-item">
        <img src="./images/s2.jpg" alt="Chicago" class="d-block" height="400px" style="width:100%">
      </div>
      <div class="carousel-item">
        <img src="./images/s3.avif" alt="New York" class="d-block" height="400px" style="width:100%">
      </div>
    </div>

    <!-- Left and right controls/icons -->
    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>

  <div class="row g-0 ">

    <div class="col-lg-4 col-md-5 col-11 bg-dark text-light p-5">
      <div class="bg-danger">IMG</div>
    </div>


    <div class="col-lg-4 col-md-5 col-11 bg-dark text-light p-5"><div class="bg-danger">IMG</div></div>


    <div class="col-lg-4 col-md-5 col-11 bg-dark text-light p-5"><div class="bg-danger">IMG</div></div>


  </div>
</body>

</html>