<?php 
	include 'inc/header.php';
	include 'inc/slider.php';

    if(!isset($_GET['catId']) || $_GET['catId']==''){
        echo "<script>window.location ='404.php'</script>";
    }else{
        $id = $_GET['catId'];
    }
    // if($_SERVER['REQUEST_METHOD']==='POST'){
    //     $catName = $_POST['catName'];

    //     $updateCat = $cat->update_category($catName,$id);
    // }
 ?>

 <div class="wrap">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    			<h3><?php echo $result_name['catName'] ?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php 
	      	$productbycat=$cat->get_product_by_cat($id);
	      	if ($productbycat) {
	      		while ($result = $productbycat->fetch_assoc()) {
	      	 ?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details-3.php"><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></a>
					 <h2><?php echo $result['productName'] ?></h2>
					 <p><?php echo $result['product_desc'] ?></p>
					 <p><span class="price"><?php echo $result['price'] ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>" class="details">Chi tiết</a></span></div>
				</div>
				<?php 
	      		}
	      	}
				 ?>
			</div>

	
	
    </div>
 </div>
<?php 
	include 'inc/footer.php';
?>
