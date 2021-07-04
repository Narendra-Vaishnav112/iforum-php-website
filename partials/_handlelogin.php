<?php
    if($_SERVER['REQUEST_METHOD']=="POST"){
        include "_dbconnect.php";
        $email=$_POST['loginemail'];
        $pass=$_POST['loginPassword'];

        // check whether the username exist in users database
        $sql="SELECT * FROM `users` WHERE user_email='$email' ";
        $result=mysqli_query($conn,$sql);
        $numRow=mysqli_num_rows($result);
        if($numRow==1){
            $row=mysqli_fetch_assoc($result);
            $id=$row['user_id'];
            if(password_verify($pass,$row['user_pass'])){
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['user_email']=$email;
                $_SESSION['sno']=$id;
                echo "loged in" . $email;
                header("location:/forum/index.php?loginprocess=true");
                exit();
            }
            else{
            header("location:/forum/index.php");
            exit();
             }

        }
       
        header("location:/forum/index.php");
        
    }
?>