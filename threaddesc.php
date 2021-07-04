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
    <?php include "partials/_header.php"; ?>
  
  
    <?php
    // fetching the complete value of respective thread
    $showalert=false;

    $id=$_GET['threadid'];
    $sql1="SELECT *  FROM `thread` WHERE thread_id=$id";
    $result=mysqli_query($conn,$sql1);

    while($row=mysqli_fetch_assoc($result)){
        $id=$row['thread_id'];
        $title=$row['thread_title'];
        $desc=$row['thread_desc'];
        $thread_user_id=$row['thread_user_id'];
        $sql2="SELECT user_email  FROM `users` WHERE user_id='$thread_user_id'";
        $result2=mysqli_query($conn,$sql2);
        $row2=mysqli_fetch_assoc($result2);
        $posted_by=$row2['user_email'];

        
        
    }
    
    ?>





    <?php
         $showalert=false;
    
       if($_SERVER['REQUEST_METHOD']=='POST'){
        //    INSERT comments into comment
        $comment=$_POST['comment'];
        $sno=$_POST['sno'];

        $comment=str_replace("<","lt",$comment);
        $comment=str_replace(">","gt",$comment);
     
       $sql="INSERT INTO `comments` ( `comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp());";
       $result=mysqli_query($conn,$sql);
       $showalert=true;
         //    alert for data insertion in threads
      if($showalert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>SUCCESS!</strong> Your comment has been added successfully .
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    }
//   jumbotron showing the data about the needed thread
       ?>
    <div class="container my-4 mb-5">
        <div class="jumbotron">
            <h1 class="display-4"><?php  echo $title; ?></h1>
            <p class="lead"><?php echo $desc; ?></p>
            <hr class="my-4">
            <p> This is a peer to peer forum to share knowledge with each other.</p>
            <p class="lead">
            <p>Posted by:<b><?php echo $row2['user_email']; ?></b></p>
            </p>
        </div>
    </div>

    <?php
     if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true ){
   echo '  <div class="container">
   <h2>Post a comment!</h2>
   <form action=" '. $_SERVER['REQUEST_URI'] .'" method="post">

       <div class="form-group mb-2">
           <label for="desc">Type your comment</label>
           <textarea class="form-control" id="desc" name="comment" rows="3"></textarea>
           <input type="hidden" name="sno" value="'.$_SESSION["sno"].'">
       </div>

       <button type="submit" class="btn btn-success">Submit</button>
   </form>
</div>';
     }
     else{
         echo '<div class="container ">
         <h2>Post a comment!</h2>
         <p class="lead">You are not logged in. Please log in to comment</p>
         </div>';
     }
?>

   
    <!-- adding a container for discussions -->
    <div class="container" id="foot">
        <h2>Discussions!</h2>
        <?php
    $id=$_GET['threadid'];
    $sql="SELECT *  FROM `comments` WHERE thread_id=$id";
    $result=mysqli_query($conn,$sql);
           $noResult=true;
    while($row=mysqli_fetch_assoc($result)){
        $noResult=false;
        $id=$row['comment_id'];
        $content=$row['comment_content'];
        $comment_time=$row['comment_time'];
        $thread_user_id=$row['comment_by'];
        $sql2="SELECT user_email  FROM `users` WHERE user_id='$thread_user_id'";
        $result2=mysqli_query($conn,$sql2);
        $row2=mysqli_fetch_assoc($result2);
        
       
        echo '<div class="media my-3">
        <img class="mr-3" src="img/userdafault.jpg" width=45px alt="Generic placeholder image">
        <div class="media-body">
        <p class="font-weight-bold my-0">'.$row2['user_email'].' at ' . $comment_time .'</p>
            
            '. $content. '.
        </div>
    </div>';
    }
    
if($noResult){
echo ' <div class="jumbotron jumbotron-fluid">
    <div class="container">
        <p class="display-4">NO RESULT FOUND</p>
        <p class="lead">Be the first person to post a comment. 
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