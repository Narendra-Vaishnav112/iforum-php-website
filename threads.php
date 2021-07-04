<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <style>
    #foot {
        min-height: 433px;
    }
    </style>

    <title>iForum!</title>
</head>

<body>
<?php include "partials/_dbconnect.php"; ?>
    <!-- including the navigation here -->
    <?php include "partials/_header.php" ?>


    <!-- inclding the database connection file -->
    
    <?php
    $id=$_GET['catid'];
    $sql="SELECT *  FROM `categories` WHERE categories_no=$id";
    $result=mysqli_query($conn,$sql);
           
    while($row=mysqli_fetch_assoc($result)){
        $catname=$row['categories_name'];
        $catdesc=$row['categories_description'];
        
    }
    
    ?>

    <?php
         $showalert=false;
    
       if($_SERVER['REQUEST_METHOD']=='POST'){
        //    INSERT THREAD INTO THREADS
        $h_title=$_POST['title1'];
        $h_desc=$_POST['desc1'];
        $sno=$_POST['sno'];

        $h_title=str_replace("<","lt",$h_title);
        $h_title=str_replace(">","gt",$h_title);
        $h_desc=str_replace("<","lt",$h_desc);
        $h_desc=str_replace(">","gt",$h_desc);
     
       $sql="INSERT INTO `thread` ( `thread_title`, `thread_desc`, `thread_cat_id`, `timestamp`, `thread_user_id`) VALUES ('$h_title', '$h_desc', '$id', current_timestamp(), '$sno');";
       $result=mysqli_query($conn,$sql);
       $showalert=true;
    //    alert for data insertion in threads
       if($showalert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>SUCCESS!</strong> Your data has been threaded successfully . Please wait while it reviwed .
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
       }?>
    <!--showing jumbotron of following category we are in  -->


    <div class="container my-4 mb-5">
        <div class="jumbotron">
            <h1 class="display-4"> <?php echo $catname; ?> </h1>
            <p class="lead"><?php echo $catdesc; ?>.</p>
            <hr class="my-4">
            <p> This is a peer to peer forum to share knowledge with each other.</p>
            <p class="lead">
                <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>

    <!-- table for threads -->
    <?php
     if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true ){
   echo '  <div class="container">
        <h2>Ask a Question!</h2>
        <form action=" '. $_SERVER['REQUEST_URI'] .'" method="post">
            <div class="form-group">
                <label for="title">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title1" aria-describedby="emailHelp">
                <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
                <small id="emailHelp" class="form-text text-muted">Keep your title as short and crisp as
                    possible.</small>
            </div>
            <div class="form-group mb-2">
                <label for="desc">Ellaborate Your Concern</label>
                <textarea class="form-control" id="desc" name="desc1" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>';
     }
     else{
         echo '<div class="container ">
         <h2>Ask a Question!</h2>
         <p class="lead">You are not logged in. Please log in to ask a query</p>
         </div>';
     }
?>
<!-- fetching all the threads and show them on threads.php -->

    <div class="container" id="foot">
        <h2>Browse Questions!</h2>
 <?php
    $id=$_GET['catid'];
    $sql="SELECT *  FROM `thread` WHERE thread_cat_id=$id";
    $result=mysqli_query($conn,$sql);
           $noResult=true;
    while($row=mysqli_fetch_assoc($result)){
        $noResult=false;
        $t_id=$row['thread_id'];
        $title=$row['thread_title'];
        $desc=$row['thread_desc'];
        $thread_time=$row['timestamp'];
        $thread_user_id=$row['thread_user_id'];
        $sql2="SELECT user_email  FROM `users` WHERE user_id='$thread_user_id'";
        $result2=mysqli_query($conn,$sql2);
        $row2=mysqli_fetch_assoc($result2);
        $email_id=$row2['user_email'];
        echo '<div class="media my-3">
        <img class="mr-3" src="img/userdafault.jpg" width=45px alt="Generic placeholder image">
        <div class="media-body">
       
            <h5 class="mt-0"> <a class="text-dark"  href="threaddesc.php?threadid='.$t_id.'"> ' . $title. '  </a></h5>
            '. $desc. '. <p class="font-weight-bold my-0">'. $email_id .' at ' .$thread_time .'</p>
        </div>
    </div>';
    }
    
if($noResult){
echo ' <div class="jumbotron jumbotron-fluid">
    <div class="container">
        <p class="display-4">NO RESULT FOUND</p>
        <p class="lead">Be the first person to ask a question. 
        </p>
    </div>
</div>';

}

    ?>
    </div>

    <!-- adding a footer here -->
    <?php include "partials/_footer.php" ?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>