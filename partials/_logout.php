<?php
session_start();
echo "please wait while logging out.....";

session_destroy();
header("location:/forum");



?>