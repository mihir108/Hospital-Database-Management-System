<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("location: /login/login.php");
}


?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>rdbms project</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="icon" href="https://img.icons8.com/dusk/2x/database-restore.png">
</head>
<style>
  /*****************************TAG SELECTOR*************************/
  * {
    margin: 0;
  }


  
  /* h1 {
  color: rgb(66, 53, 53);
  position: relative;
  top: 12.5rem;
  left: 19.2rem;
  font-size: 40px;
  font-family: 'Sacramento', cursive;
} */

  h5 {
    color: black;
  }



  /*****************************CLASS SELECTOR************************/

  .container {
    width: 900px;
    position: relative;
    top: 10rem;
    margin: auto;
    text-align: center;
  }

  .section {
    margin: 40px 0 50px 0;
    color: purple;
  }

  .bbsr {
  width: 100%;
    height: 100%;
    opacity: 0.95;
    position: absolute;
  }


  .btn18 {
    background: #d934c6;
    background-image: -webkit-linear-gradient(top, #d934c6, #2bb6b8);
    background-image: -moz-linear-gradient(top, #d934c6, #2bb6b8);
    background-image: -ms-linear-gradient(top, #d934c6, #2bb6b8);
    background-image: -o-linear-gradient(top, #d934c6, #2bb6b8);
    background-image: linear-gradient(to bottom, #d934c6, #2bb6b8);
    -webkit-border-radius: 10;
    -moz-border-radius: 10;
    border-radius: 10px;
    font-family: Arial;
    color: #000000;
    font-size: 20px;
    padding: 7px 14px 1px 14px;
    text-decoration: none;
    margin-right: 40px;
  }

  .btn18:hover {
    background: #299454;
    background-image: -webkit-linear-gradient(top, #299454, #e83c64);
    background-image: -moz-linear-gradient(top, #299454, #e83c64);
    background-image: -ms-linear-gradient(top, #299454, #e83c64);
    background-image: -o-linear-gradient(top, #299454, #e83c64);
    background-image: linear-gradient(to bottom, #299454, #e83c64);
    text-decoration: none;
  }








  /******************************ID SELECTOR****************************/
</style>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#"><img src="https://img.collegepravesh.com/2016/05/IIIT_Bhubaneswar_Logo.png" height="38px" width="40px" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="/rdbms/index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="/login/logout.php">Logout</a>
        </li>



      </ul>

      <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#"> <img src="https://img.icons8.com/metro/26/000000/guest-male.png"> <?php echo "Welcome " . $_SESSION['username'] ?></a>
          </li>
        </ul>
      </div>


    </div>
  </nav>

  <img class="bbsr" src="https://img.jagranjosh.com/imported/images/institute/IIIT-BHUBANESWAR-365x240.jpg" alt="">
  <div class="container">
    <h1>WELCOME TO IIIT BHUBANESWAR EMERGENCY HEALTH CARE MANAGEMENT DATABASE</h1>
    <h1 class="section">SECTIONS</h1>
    <button class="btn18"><a href="/rdbms/department/department.php" style="text-decoration: none;">
        <h5>DEPARTMENT</h5>
      </a></button>
    <button class="btn18"><a href="/rdbms/doctor/doctor.php" style="text-decoration: none;">
        <h5>DOCTOR</h5>
      </a></button>
    <button class="btn18"><a href="/rdbms/patient/patient.php" style="text-decoration: none;">
        <h5>PATIENT</h5>
      </a></button>
    <button class="btn18"><a href="/rdbms/room/room.php" style="text-decoration: none;">
        <h5>ROOMS</h5>
      </a></button>
    <button class="btn18"><a href="/rdbms/salary/salary.php" style="text-decoration: none;">
        <h5>SALARY</h5>
      </a></button>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>