<?php
session_start();
include_once('database.php');
$database = new database();
if(isset($_GET['id']))
{
   $id = (int)$_GET['id'];
   echo $id;
  
   unset($_SESSION['cart_item'][$id]);
 
 
      header("Location:index.php");
   

}


?>