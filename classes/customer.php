<?php 
	$filepath = realpath(dirname(__FILE__));
	error_reporting(E_ERROR | E_PARSE);

	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
 ?>

<?php 
	/**
	 * summary
	 */
	class customer
	{
		private $db;
		private $fm;
	    /**
	     * summary
	     */
	    public function __construct()
	    {
	        $this->db = new Database();
	        $this->fm = new Format();
	    }

	public function insert_customer($data){
		$name = mysqli_real_escape_string($this->db->link, $data['name']);
		$address = mysqli_real_escape_string($this->db->link, $data['address']);
		$city = mysqli_real_escape_string($this->db->link, $data['city']);
		$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
		$email = mysqli_real_escape_string($this->db->link, $data['email']);
		$password = mysqli_real_escape_string($this->db->link, $data['password']);
		if ($name=="" ||$address=="" ||$city=="" ||$phone=="" ||$email=="" ||$password=="") {
	    		$alert = "<span class='error'>Bạn hãy nhập đầy đủ thông tin</span>";
	    		return $alert;
	    	}
	    	else{
	    		$check_email = "SELECT * FROM `tbl_customer` WHERE `email`='$email'";
	    		$result_check = $this->db->select($check_email);
	    		if ($result_check) {
	    			$alert = "<span class='error'>Email đã có người dùng</span>";
	    			return $alert;
	    		}else {
	    			$query = "INSERT INTO tbl_product(name,address,city,phone,email,password) VALUES('$name','$address','$city','$phone','$email','$password')";
	    			$result = $this->db->insert($query);
	    			if ($result) {
	    				$alert = "<span class='success'> Tạo tài khoản thành công</span>";
	    				return $alert;
	    			}else {
	    				$alert = "<span class='error'> Tạo tài khoản thất bại</span>";
	    				return $alert;
	    			}
	    		}
	    	}
	    }
	public function login_customer($data){
		$email = mysqli_real_escape_string($this->db->link, $data['email']);
		$password = mysqli_real_escape_string($this->db->link, $data['password']);
		if ($email=="" || $password=="") {
			$alert = "<span class='error'>Hãy điền email và mật khẩu</span>";
			return $alert;
		}else {
			$check = "SELECT * FROM tbl_customer WHERE email ='$email' AND password = '$password'";
			$result_check = $this->db->select($check);
			if ($result_check != false) {
				$value = $result_check->fetch_assoc();
				Session::set('customer_login',true);
				Session::set('customer_id',$value['id']);
				Session::set('customer_name',$value['name']);
				header('Location:order.php');
			}else {
				$alert = "<span class='error'>Email hoặc mật khẩu bị sai</span>";
				return $alert;
			}
		}
	}
	}
 ?>