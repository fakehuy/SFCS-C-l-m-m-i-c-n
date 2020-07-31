<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/order.php';?>
<?php include '../classes/product.php';?>
<?php include_once '../../helpers/format.php';
	$pd = new order();
	$fm = new Format();
 ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Mã đơn hàng</th>
					<th>Mã sản phẩm</th>
					<th>Tên sản phẩm</th>
					<th>Giá tiền</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$pdlist = $pd->show_order();
       			$sum = 0;
				if($pdlist){
					while($result = $pdlist->fetch_assoc()){	
       					$sum+=$sum + $result['price'];
				 ?>
				<tr class="odd gradeX">
					<td class="center"><?php echo $result['cartId'] ?></td>
					<td class="center"><?php echo $result['productId'] ?></td>
					<td class="center"><?php echo $result['productName'] ?></td>
					<td class="center"><?php echo $result['price'] ?></td>
				</tr>
				<?php 
						}
					}else{
						echo  'Hiện không có đơn hàng nào được đặt';
					}
				 ?>
			</tbody>
		</table>
       </div>
       <h2>Tổng cộng: <?php 
       	echo $sum;
         ?></h2>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
