<?php
error_reporting(E_ERROR | E_PARSE);
include 'lib/session.php';
Session::init();
include 'lib/database.php';
include 'helpers/format.php';

spl_autoload_register(function($className){	
	include_once "classes/".$className.".php";
});

$db = new Database();
$fm = new Format();
$ct = new cart();
$us = new user();
$cat = new category();
$cs = new customer();
$product = new product();
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE HTML>
<head>
<title>SFCS</title>
<meta http-equiv="Content-Type" content="text/php; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="grid_12 header-repeat">
			<div class="logo">
				<a href="index.php"><img src="images/logo2.png" alt="" width="260px" height="150px"/></a>
				<a href="index.php"><img src="admin/uploads/96795110_1838752326261638_2131402689148354560_n.png" alt="" width="150px" height="150px"/></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form action="search.php" method="post">
				    	<input type="text" placeholder="Tìm kiếm sản phẩm" name="tukhoa">
				    	<input type="submit" name="search_product" value="Tìm kiếm">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="cart.php" title="View my shopping cart" rel="nofollow">
								<span class="cart_title"></span>
								<span class="no_product"><?php 
								$check_cart = $ct->check_cart();
								if ($check_cart) {
									$sum = Session::get("sum");
									echo $sum.' '.'đ';
								}
								else {
									echo "empty";
								}
								 ?></span>
							</a>
						</div>
			      </div>
			<?php 
				if (isset($_GET['customerid'])) {
					$delCart = $ct->del_all_data_cart();
					Session::destroy();
				}
			 ?>
		   <div class="login grey"><a href="login.php"><?php 
		   $login_check = Session::get('customer_login');
		   if ($login_check ==false) {
		   		echo '<a href="login.php">Đăng nhập</a></div>';
		   }else {
		   		echo '<a href="?customerid='.Session::get('customer_id').'">Đăng xuất</a></div>';
		   }
		    ?></a></div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="wrap">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Trang chủ</a></li>
	  <li><a href="products.php">Tất cả sản phẩm</a> </li>
	  <li><a href="category.php">Loại sản phẩm</a></li>
	  <li><a href="cart.php">Giỏ hàng</a></li>
	  <li><a href="contact.php">Liên hệ</a> </li>
	  <div class="clear"></div>
	</ul>
</div>