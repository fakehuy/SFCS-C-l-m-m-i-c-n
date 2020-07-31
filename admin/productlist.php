<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/product.php';?>
<?php include_once '../../helpers/format.php';
	$pd = new product();
	$fm = new Format();
	if(isset($_GET['productid'])){
        $id = $_GET['productid'];
   		$delpro = $pd->del_product($id);	
    }	
 ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách sản phẩm</h2>
        <div class="block">  
        	<?php if ($delpro) {
        		echo $delpro;
        	} ?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Mã sản phẩm</th>
					<th>Tên sản phẩm</th>
					<th>Giá</th>
					<th>Ảnh</th>
					<th>Loại sản phẩm</th>
					<th>Tình trạng</th>
					<th>Thao tác</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$pdlist = $pd->show_product();
				if($pdlist){
					$i =0;
					while($result = $pdlist->fetch_assoc()){
						$i++;
				 ?>
				<tr class="odd gradeX">
					<td class="center"><?php echo $i ?></td>
					<td class="center"><?php echo $result['productName'] ?></td>
					<td class="center"><?php echo $result['price'] ?></td>
					<td class="center"><img src="uploads/<?php echo $result['image'] ?>" width=80></td>
					<td class="center"><?php echo $result['catName'] ?></td>
					<td class="center"><?php 
						if ($result['type'] == 1) {
							echo 'Nổi bật';
						}else {
							echo 'Không nổi bật';
						}
					 ?></td>
					<td><a href="productedit.php?productid=<?php echo $result['productId'] ?>">Sửa</a> || <a href="?productid=<?php echo $result['productId'] ?>">Xóa</a></td>
				</tr>
				<?php 
						}
					}
				 ?>
			</tbody>
		</table>

       </div>
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
