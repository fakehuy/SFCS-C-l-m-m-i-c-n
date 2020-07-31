<?php 
	include 'inc/header.php';
 
    $login_check = Session::get('customer_login');
    if ($login_check==false) {
   		header('Location:login.php');
    }
?>
<style>
	.not_found {
		font-size: 20px;
		font-weight: bold;
		color: red;
	}
</style>

<?php 
	if(isset($_GET['cartId'])){
        $cartid = $_GET['cartId'];
   		$delcart = $ct->del_product_cart($cartid);	
    }
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
    	$cartId = $_POST['cartId'];
    	$quantity = $_POST['quantity'];
        $update_quantity_cart = $ct->update_quantity_cart($quantity,$cartId);
        if ($quantity<=0) {
        	
   			$delcart = $ct->del_product_cart($cartId);
        }
    }
    if (!isset($_GET['id'])) {
    	echo "<<meta http-equiv='refresh' content='0;URL=?id=live'>";
    }
 ?>
<div class="wrap">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Giỏ hàng của bạn</h2>
			    	<?php 
			    		if(isset($update_quantity_cart)){
			    			echo $update_quantity_cart;
			    		}
			    		if(isset($delcart)){
			    			echo $delcart;
			    		}
			    	 ?>
						<table class="tblone">
							<tr>
								<th width="20%">Tên sản phẩm</th>
								<th width="10%">Ảnh</th>
								<th width="15%">Giá</th>
								<th width="25%">Số lượng</th>
								<th width="20%">Tổng giá</th>
								<th width="10%"></th>
							</tr>
							<?php 
							$get_product_cart = $ct->get_product_cart();
							$subTotal = 0;
							$qty = 0;
							if ($get_product_cart) {
								while ($result = $get_product_cart->fetch_assoc()) {
								    

							 ?>
							<tr>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
								<td><?php echo $result['price'] ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>"/>
										<input type="number" name="quantity" min="0" value="<?php echo $result['quantity'] ?>"/>
										<input type="submit" name="submit" value="Cập nhật"/>
									</form>
								</td>
								<td><?php $total = $result['price']*$result['quantity']; 
								echo $total ?></td>
								<td><a href="?cartId=<?php echo $result['cartId'] ?>">Xóa</a></td>
							</tr>
							<?php 
								$subTotal += $total;
								Session::set('sum',$subTotal);
								}
							}
							 ?>
						</table>
						<?php  
							$check_cart = $ct->check_cart();
							if ($check_cart) {
								
						?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Tổng giá tiền : </th>
								<td><?php 					
								echo $subTotal;
								 ?></td>
							</tr>
					   </table>
					<?php }else {
						Session::set('sum',$subTotal);
						echo 'Giỏ hàng của bạn trống, hãy chọn sản phẩm';
					} ?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
</div>
<?php 
	include 'inc/footer.php';
?>