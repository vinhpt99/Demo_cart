<?php
session_start();
require_once('database.php');
$database = new database();
if(isset($_POST) && !empty($_POST))
{  
    if(isset($_POST['action']))
    {
        switch($_POST['action'])
        {
            case 'add': if(isset($_POST['product_count']) && isset($_POST['product_id']))
            {   
                $sql = "SELECT * FROM products WHERE id =".(int)($_POST['product_id']);
                $product = $database->runQuery($sql);
                $product = current($product);
                echo "<br> product";
                echo "<pre";
                print_r($product);
                echo "</pre>";
                $product_id = $product['id'];
                if(isset($_SESSION['cart_item']) && !empty($_SESSION['cart_item']))
                {
                    if(isset($_SESSION['cart_item'][$product_id]))
                    {
                        $exits_cart_item = $_SESSION['cart_item'][$product_id];
                        $exits_product_count = $exits_cart_item['product_count'];
                        $cart_item = array();
                        $cart_item['id'] = $product['id'];
                        $cart_item['product_name'] = $product['product_name'];
                        $cart_item['product_image'] = $product['product_image'];
                        $cart_item['price'] = $product['price'];
                        $cart_item['product_count'] = $exits_product_count +  $_POST['product_count'];
                        $_SESSION['cart_item'][$product_id] = $cart_item;

                    }
                    else
                    {   
                        $cart_item = array();
                        $cart_item['id'] = $product['id'];
                        $cart_item['product_name'] = $product['product_name'];
                        $cart_item['product_image'] = $product['product_image'];
                        $cart_item['price'] = $product['price'];
                        $cart_item['product_count'] = $_POST['product_count'];
                        $_SESSION['cart_item'][$product_id] = $cart_item;
                        
                    }
                }
                else
                {
                    $_SESSION['cart_item'] = array();
                    $cart_item['id'] = $product['id'];
                    $cart_item['product_name'] = $product['product_name'];
                    $cart_item['product_image'] = $product['product_image'];
                    $cart_item['price'] = $product['price'];
                    $cart_item['product_count'] = $_POST['product_count'];
                    $_SESSION['cart_item'][$product_id] = $cart_item;

                }
              
                    
                    
            }
            break;
        default:
            echo "Action không tồn tại";
            die;
                
           
        }
    }
    //  echo "<br>POST";
    //  echo "<pre";
    //  print_r($_POST);
    //  echo "</pre>";

    //  echo "<br>SESSION";
     echo "<pre";
      print_r($_SESSION['cart_item']);
     echo "</pre>";
}
header("Location:index.php");
die;
?>