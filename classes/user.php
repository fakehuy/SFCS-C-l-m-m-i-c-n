<?php 
	error_reporting(E_ERROR | E_PARSE);
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
 ?>

<?php 
	/**
	 * summary
	 */
	class user
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

	}
 ?>