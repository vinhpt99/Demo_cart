<?php
session_start();
//nạp file kết nối cơ sở dữ liệu
include_once('database.php');
$database = new database();
// echo "<pre>";
// print_r($database);
// echo "</pre>";
echo "<pre>";
print_r($_SESSION);
 echo "</pre>";


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <?php
    if(isset($_SESSION['cart_item']) && !empty($_SESSION['cart_item']))
    {?>
         <div class="container">
        <h2>Giỏ hàng</h2>
        <p>Chi tiết giỏ hàng</p>            
        <table class="table table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Tên sản phẩm</th>
              <th>Hình ảnh</th>
              <th>Gía tiền</th>
              <th>Số lượng</th>
              <th>Thành tiền</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($_SESSION['cart_item'] as $key => $val_key):?>
            <tr>
              <td><?php echo $val_key['id'] ?></td>
              <td><?php echo $val_key['product_name'] ?></td>
              <td><img width="70px" height="60px" src="<?php echo $val_key['product_image'] ?>" alt=""></td>
              <td><?php echo $val_key['price'] ?></td>
              <td><?php echo $val_key['product_count'] ?></td>
              <td><?php echo ($val_key['price'] * $val_key['product_count'])?></td>
              <td><button type="button" class="btn btn-danger"><a href="delete.php?id=<?php echo $val_key['id'] ?>">Xóa</a></button></td>
            </tr>
               <?php endforeach; ?>
            
          </tbody>
        </table>
        <div>Tổng hóa đơn thanh toán:<strong>200000</strong></div>
    </div>
   <?php } else { ?>
              <div class="container">
                  <h2>Giỏ hàng</h2>
                  <p>Giỏ hàng của bạn đang rỗng</p>

              </div>

           <?php } ?>
    
    <div class="container" style="margin-top: 50px;">
    <div class="row">
        <?php
        $sql = "SELECT * FROM products";
        $products = $database->runQuery($sql);
        // echo "<pre>";
        // echo print_r($product);
        // echo "</pre>";
        
        ?>
        <?php if( !empty($products )) : ?>
            <?php foreach($products as $product): ?>
                <div class="col-sm-6">
               <form action="process.php" method="post" name="<?php echo $product['id'] ?>">
                <div class="card mb-4 shadow-sm">
                    <img src="<?php echo $product['product_image'] ?>" class="rounded" height="255" width="255" alt="Cinque Terre">
                    <div class="card-body">
                    <p class="card-text" style="font-weight: bold;"><?php echo $product['product_name'] ?></p>
                    <div class="d-flex  align-items-center">
                        <div class="form-inline">
                           <input type="text" name="product_count" value="">
                           <input type="hidden" name="action" value="add">
                           <input type="hidden" name="product_id" value="<?php echo $product['id'] ?>">
                           <input type="submit" style="margin-left: 10px;" value="Thêm vào giỏ hàng" name="submit" class = "btn btn-secondary">
                        </div>
                    </div>
                </div>
               </div>
               </form>
        </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    
</body>
</html>