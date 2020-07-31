<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php'; ?>
<?php 
	$cat = new category();
    if(isset($_GET['delid'])){
        $id = $_GET['delid'];
   		$delCat = $cat->del_category($id);	
    }		
 ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh mục sản phẩm</h2>
                <div class="block">    
		        <?php 
		        if (isset($delCat)) {
		            echo $delCat;
		        }  
		        ?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Số thứ tự</th>
							<th>Tên danh mục</th>
							<th>Điểu khiển</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$show_cate = $cat->show_category();
						if($show_cate){
							$i = 0;
							while ($result = $show_cate->fetch_assoc()) {
								$i++;
					 ?>
						<tr class="odd gradeX">
							<td><?php echo $i ?></td>
							<td><?php echo $result['catName'] ?></td>
							<td><a href="catedit.php?catid=<?php echo $result['catId']?>">Chỉnh sửa</a> || <a onclick ="return confirm('Bạn có chắc là xóa danh mục này???')" href="?delid=<?php echo $result['catId']?>">Xóa</a></td>
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

