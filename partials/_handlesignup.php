<?php
// if the method is post then include the database
if($_SERVER['REQUEST_METHOD']=="POST"){
    $showalert=false;
    include "_dbconnect.php";
    $user_email=$_POST['signupemail'];
    $pass=$_POST['signupPassword'];
    $cpass=$_POST['signupcPassword'];

    //checking if the user is already exist
    $existsql="SELECT * FROM   `users` WHERE user_email='$user_email' ";
    $result=mysqli_query($conn,$existsql);
    $rows=mysqli_num_rows($result);
    if($rows>0){
        $showerror="Email alredy exist";
        header("location:/forum/index.php?'.$showerror.'");
        exit();
    }
    else{
        // checking if both the passwords are same
        if($pass==$cpass){
            $hash=password_hash($pass,PASSWORD_DEFAULT);
            $sql="INSERT INTO `users` ( `user_email`, `user_pass`, `timestamp`) VALUES ( '$user_email', '$hash', current_timestamp())";
            $result=mysqli_query($conn,$sql);
           
            if($result){
                $showalert=true;
                header("location: /forum/index.php?signupprocess=true");
                exit();
            }

        
        else{
            $showerror="please enter same paswords ";
        }
    }
   
   
    
    header("location: /forum/index.php?signupprocess=false&error=$showerror");
}
}
?>