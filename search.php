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
    #mycont{
        min-height: 82vh;
    }
    </style>   

    <title>iForum!</title>
</head>

<body>
    <!-- inclding the database connection file -->
<?php include "partials/_dbconnect.php"; ?>
    <!-- including the navigation here -->
    <?php include "partials/_header.php"; ?>  
   <!-- serch results here -->
   
  
    <div class="container my-3" id="mycont">
    <h1 class="py-4">Search results for <em>"<?php echo $_GET['search']     ?>"</em></h1>
    <?php
    $noresult=true;
    $search= $_GET['search'];
    $sql1="SELECT * FROM `thread` WHERE MATCH(thread_title, thread_desc) AGAINST('$search')";
    $result=mysqli_query($conn,$sql1);
    while($row=mysqli_fetch_assoc($result)){
       
        $title=$row['thread_title'];
        $desc=$row['thread_desc'];
        $id=$row['thread_id'];
        $noresult=false;

        echo ' 
        <div class="results">
        <h3><a class="text-dark" href="threaddesc.php?threadid='.$id.'">'.$title.'</a></h3>
        <p>'.$desc.'</p>
        </div>';
    }
    if($noresult){
       echo ' <div class="container">
        <p class="display-4">NO SEARCH RESULT FOUND</p>
        <p class="lead"> <ul>
        <li>Clearly explain that there are no matching results.</li>
        <li>Offer starting points for moving forward.</li>
        <li>Do not mock the user.</li>
        </ul>
        </p>
    </div>';
    }
    
    ?>
    </div>

  
        


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