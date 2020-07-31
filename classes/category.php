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
	class category
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
	    public function insert_category($catName)
	    {
	    	$catName = $this->fm->validation($catName);
	    	$catName = mysqli_real_escape_string($this->db->link, $catName);

	    	if (empty($catName)) {
	    		$alert = "Hãy nhập tên danh mục đê...";
	    		return $alert;
	    	}
	    	else{
	    		$check = "SELECT * FROM `tbl_category` WHERE `catName` = '$catName'";
	    		$varcheck = $this->db->select($check);
	    		if(empty($varcheck)) {

		    		$query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
		    		$result = $this->db->insert($query);
		    		if ($result) {
		    			$alert = "<span class='success'>Thêm thành công</span>";
		    			return $alert;
		    		}else{
		    			$alert = "<span class='error'>Thêm thất bại, không kết nối được database</span>";
		    			return $alert;
		    		}
	    		}else {
	    			$alert = "<span class='error'>Thêm thất bại, đã tồn tại</span>";
		    			return $alert;
	    		}
	    		
	    	}
	    }

	    public function show_category(){
    		$query = "SELECT * FROM `tbl_category` ORDER BY `catId` desc ";
    		$result = $this->db->select($query);
    		return $result;
	   }

	   public function getCatById($id){
    		$query = "SELECT * FROM `tbl_category` WHERE `catId` = '$id'";
    		$result = $this->db->select($query);
    		return $result;
	   }

	   public function update_category($catName,$id){
	    	$catName = $this->fm->validation($catName);
	    	$catName = mysqli_real_escape_string($this->db->link, $catName);
	    	$id = mysqli_real_escape_string($this->db->link, $id);

	    	if (empty($catName)) {
	    		$alert = "Hãy nhập tên danh mục đê...";
	    		return $alert;
	    	}else {
	    		$query = "UPDATE tbl_category SET catName  = '$catName' WHERE catId = '$id'";
	    		$result = $this->db->update($query);
	    		if ($result) {
	    			$alert = "<span class='success'>Sửa thành công</span>";
	    			return $alert;
	    		}else{
	    			$alert = "<span class='error'>Sửa thất bại, không kết nối được database</span>";
	    			return $alert;
	    		}
    		}
	   }
	   public function del_category($id){
	   		$query = "DELETE FROM `tbl_category` WHERE `catId` = '$id'";
    		$result = $this->db->delete($query);
    		if ($result) {
    			$alert = "<span class= 'success'> Xóa thành công nha!!!</span>";
    			return $alert;
    		}else {
    			$alert = "<span class= 'error'> Xóa không thành công nha!!!</span>";
    			return $alert;
    		}
	   }
	   	public function show_category_fontend(){
    		$query = "SELECT * FROM `tbl_category` ORDER BY `catId` desc ";
    		$result = $this->db->select($query);
    		return $result;
	   }

	  	public function get_product_by_cat($id){
    		$query = "SELECT * FROM `tbl_product` WHERE catId = '$id' ";
    		$result = $this->db->select($query);
    		return $result;
	  	}
	}
 ?>