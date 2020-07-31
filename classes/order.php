<?php 
	error_reporting(E_ERROR | E_PARSE);
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
	include_once ($filepath.'/../classes/order.php');
 ?>

<?php 
	/**
	 * summary
	 */
	class order
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
	    public function show_order(){
    		$query = "SELECT * FROM `tbl_order` JOIN `tbl_product` WHERE `tbl_order`.productId = `tbl_product`.productId ORDER BY `catId` desc ";
    		$result = $this->db->select($query);
    		return $result;
	    }
	}
?>