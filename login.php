<?php 
	include 'inc/header.php';


    $login_check = Session::get('customer_login');
    if ($login_check) {
   		header('Location:order.php');
    }


    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
        $insertCustomers = $cs->insert_customer($_POST);
    }
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login'])){
        $loginCustomers = $cs->login_customer($_POST);
    }   


 ?>

 <div class="wrap">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Đã có tài khoản</h3>
        	<?php 
    		if (isset($loginCustomers)) {
    			echo $loginCustomers;
    		}
        	 ?>
        	<p>Đăng nhập</p>
        	<form action="" method="POST">
                	<input type="text" name="email" class="field" placeholder="E-Mail">
                    <input type="password" name="password" class="field" placeholder="Mật khẩu">
<!-- 
                 <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p> -->
                    <div class="buttons"><div><input type="submit" name="login" class="grey" value="Đăng nhập"></div></div>
                    </div>
                 </form>
    	<div class="register_account">
    		<h3>Đăng kí tài khoản mới</h3>
    		<?php 
    		if (isset($insertCustomers)) {
    			echo $insertCustomers;
    		}
    		 ?>
    		<form action="" method="POST">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Nhập tên ..." >
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="Nhập thành phố ...">
							</div>
							
							<div>
								<input type="text" name="email" placeholder="Nhập E-Mail ...">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Nhập địa chỉ ...">
						</div>
		    		<div>
				 </div>		        
	
		           <div>
		          <input type="text" name="phone" placeholder="Nhập số điện thoại ...">
		          </div>
				  
				  <div>
					<input type="text" name="password" placeholder="Nhập mật khẩu ...">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><input type="submit" name="submit" class="grey" value="Tạo tài khoản"></div></div>
		    <p class="terms"></p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php 
	include 'inc/footer.php';
?>