<?php 
	include 'inc/header.php';
	include 'inc/slider.php';

 ?>
 <div class="wrap">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3 style="font-size: 40px;">Loại sản phẩm</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group" style="font-size: 30px; text-align: center;">
					<ul>
						<?php 
						$getall_category = $cat->show_category_fontend();
						if ($getall_category) {
							while($result_allcat = $getall_category->fetch_assoc()){

						 ?>

				      <li><a href="productbycat.php?catId=<?php echo $result_allcat['catId'] ?>"><?php echo $result_allcat['catName'] ?></a></li>
				      <?php 
							}
						}
						 ?>

    				</ul>
			</div>
    </div>
 </div>
<?php 
	include 'inc/footer.php';
?>