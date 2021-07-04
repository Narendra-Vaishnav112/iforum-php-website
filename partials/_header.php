<?php 
session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="/forum">iForum</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="/forum">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Top Categories
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';

    //  here we code about categories
    $sql="SELECT `categories_no`, `categories_name` FROM `iforum`.`categories` LIMIT 3";
    $result=mysqli_query($conn,$sql);
    // echo var_dump($result);
  
  
while($row=mysqli_fetch_assoc($result)){
 echo '   <li><a class="dropdown-item" href="threads.php?catid='.$row['categories_no'].'">'.$row['categories_name'].'</a></li>';
         
}



  echo  '</ul>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="contact.php" tabindex="-1">Contact</a>
      </li>
    </ul>';
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true ){
      echo '
      <form class="d-flex" method="get" action="search.php">
      <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success" type="submit">Search</button>
      <p class="text-light my-0 mx-2">Welcome '.$_SESSION['user_email'].'</p>
      <a href="partials/_logout.php" class="btn btn-outline-success my-2" >Logout</a>
      </form>
    
    ';
    }
    else{
      echo '
    <form class="d-flex">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success" type="submit">Search</button>
    </form>
    <div class=" mx-2">
 
        <button class="btn btn-outline-success ml-2" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
        <button class="btn btn-outline-success my-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
    </div>';
    }
   echo ' 
  </div>
</div>
</nav>';
include "partials/_signupmodal.php";
include "partials/_loginmodal.php";
if(isset($_GET['signupprocess']) && $_GET['signupprocess']==true){
  echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
  <strong>Success!</strong>Now you can login.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if(isset($_GET['loginprocess']) && $_GET['loginprocess']==true){
  echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
  <strong>Success!</strong>you are loged in now.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}



?>