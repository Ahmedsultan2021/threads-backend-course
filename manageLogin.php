<?php
session_start();
require_once("classes.php");
if (!empty($_POST["email"] && !empty($_POST["password"]) )) {
   $email = $_POST["email"];
   $password = $_POST["password"];
   $user = users::login($email,$password);
   if (empty($user)) {
    header("location:login.php?msg=invalid_data");
   }else{
    $_SESSION["user"] = serialize($user);
    header("location:home.php");
   }


}else{
    header("location:login.php?msg=empty_field");
}