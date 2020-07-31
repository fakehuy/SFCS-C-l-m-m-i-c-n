<?php 
	error_reporting(E_ERROR | E_PARSE);
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
	include_once ($filepath.'/../classes/category.php');
 ?>

<?php 
	/**
	 * summary
	 */
	class product
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
	    public function insert_product($data,$files)
	    {
	    	$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
	    	$category = mysqli_real_escape_string($this->db->link, $data['category']);
	    	$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
	    	$price = mysqli_real_escape_string($this->db->link, $data['price']);
	    	$type = mysqli_real_escape_string($this->db->link, $data['type']);
	    	//Kiểm tra và lấy hình ảnh cho vào folder uploads
	    	$permited = array('jpg','jpeg','png','gif');
	    	$file_name = $_FILES['image']['name'];
	    	$file_size = $_FILES['image']['size'];
	    	$file_temp = $_FILES['image']['tmp_name'];

	    	$div = explode('.', $file_name);	
	    	$file_ext = strtolower(end($div));
	    	$unique_image = substr(md5(time()),0,10).'.'.$file_ext;
	    	$uploaded_image = "uploads/".$unique_image;


	    	if ($productName=="" ||$category=="" ||$product_desc=="" ||$price=="" ||$type=="" || $file_name =="") {
	    		$alert = "<span class='error'>Bạn hãy nhập đầy đủ thông tin sản phẩm</span>";
	    		return $alert;
	    	}
	    	else{
	    		move_uploaded_file($file_temp,$uploaded_image);
	    		$query = "INSERT INTO tbl_product(productName,catId,product_desc,type,price,image) VALUES('$productName','$category','$product_desc','$type','$price','$unique_image')";
	    		$result = $this->db->insert($query);

	    		if ($result) {
	    			$alert = "<span class='success'>Thêm thành công</span>";
	    			return $alert;
	    		}else{
	    			$alert = "<span class='error'>Thêm thất bại, không kết nối được database</span>";
	    			return $alert;
	    		}
	    	}
	    }

	    public function show_product(){

    		$query = "SELECT tbl_product.*, tbl_category.catName FROM `tbl_product` INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId ORDER BY `productId` desc ";

    		$result = $this->db->select($query);
    		return $result;
	   }

	   public function getProductById($id){
    		$query = "SELECT * FROM `tbl_product` WHERE `productId` = '$id'";
    		$result = $this->db->select($query);
    		return $result;
	   }

	   public function update_produce($data,$files,$id){
	    	$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
	    	$category = mysqli_real_escape_string($this->db->link, $data['category']);
	    	$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
	    	$price = mysqli_real_escape_string($this->db->link, $data['price']);
	    	$type = mysqli_real_escape_string($this->db->link, $data['type']);
	    	//Kiểm tra và lấy hình ảnh cho vào folder uploads
	    	$permited = array('jpg','jpeg','png','gif');
	    	$file_name = $_FILES['image']['name'];
	    	$file_size = $_FILES['image']['size'];
	    	$file_temp = $_FILES['image']['tmp_name'];

	    	$div = explode('.', $file_name);	
	    	$file_ext = strtolower(end($div));
	    	$unique_image = substr(md5(time()),0,10).'.'.$file_ext;
	    	$uploaded_image = "uploads/".$unique_image;
	    	$id = mysqli_real_escape_string($this->db->link, $id);

	    	if ($productName=="" ||$category=="" ||$product_desc=="" ||$price=="" ||$type=="") {
	    		$alert = "<span class='error'>Bạn hãy nhập đầy đủ thông tin sản phẩm</span>";
	    		return $alert;
	    	}else{
	    		if(!empty($file_name)){
	    			if ($file_size > 2048) {
	    			$alert = "<span class='error'>Hình ảnh không quá 2MB!</span>";
	    			return $alert;
		    		}
		    		elseif (in_array($file_ext, $permited) === false) {
		    			$alert = "<span class='error'>Bạn chưa tải ảnh tải ảnh lên:-".implode(',',$permited)."</span>";
		    			return $alert;
		    		}
		    		move_uploaded_file($file_temp, $uploaded_image);
		    		$query = "UPDATE tbl_product SET 
		    		productName  = '$productName',
		    		catId  = '$category',
		    		product_desc  = '$product_desc',
		    		type  = '$type',
		    		price  = '$price',
		    		image  = '$unique_image'
		    		WHERE productId = '$id'";
	    		}
	    		else {
	    			move_uploaded_file($file_temp, $uploaded_image);
		    		$query = "UPDATE tbl_product SET 
		    		productName  = '$productName',
		    		catId  = '$category',
		    		product_desc  = '$product_desc',
		    		type  = '$type',
		    		price  = '$price'
		    		WHERE productId = '$id'";
	    		}
    			$result = $this->db->update($query);
	    		if ($result) {
	    			$alert = "<span class='success'>Sửa thành công</span>";
	    			return $alert;
	    		}else{
	    			$alert = "<span class='error'>Sửa thất bại.</span>";
	    			return $alert;
	    		}
	    	}
	   }
	   public function del_product($id){
	   		$query = "DELETE FROM `tbl_product` WHERE `productId` = '$id'";
    		$result = $this->db->delete($query);
    		if ($result) {
    			$alert = "<span class= 'success'> Xóa thành công nha!!!</span>";
    			return $alert;
    		}else {
    			$alert = "<span class= 'error'> Xóa không thành công nha!!!</span>";
    			return $alert;
    		}
	   }
	   	//END BACKEND
	   public function getproduct_feathered(){
	   		$query = "SELECT * FROM `tbl_product` WHERE `type` = 1";
    		$result = $this->db->delete($query);
    		return $result;
	   }
	   public function getproduct_new(){
	   		$query = "SELECT * FROM `tbl_product` ORDER BY productId desc LIMIT 4";
    		$result = $this->db->delete($query);
    		return $result;
	   }
	   public function get_details($id){
    		$query = "SELECT tbl_product.*, tbl_category.catName FROM `tbl_product` INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId WHERE tbl_product.productId = '$id' ";

    		$result = $this->db->select($query);
    		return $result;
	   }
	   public function view_all_product(){
	   		$query = "SELECT * FROM `tbl_product` ORDER BY productId";
    		$result = $this->db->select($query);
    		return $result;
	   }
	   public function search_product($tukhoa){
	   	$tukhoa =$this->fm->validation($tukhoa);
	   	$query ="SELECT * FROM tbl_product WHERE productName LIKE '%$tukhoa%'";
	   	$result = $this->db->select($query);
	   	return $result; 
	   }
	}
 ?>