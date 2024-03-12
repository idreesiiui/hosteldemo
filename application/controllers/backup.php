<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Muhammad Idrees 
 * @version : 2.0
 * @since : 17 November 2022
 */
class Backup extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn();
        $this->load->helper('url');
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->library('zip');   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {		
		if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {
			/*$this->load->dbutil();
			$db_format=array('format'=>'zip','filename'=>'my_db_backup.sql');
			$backup=& $this->dbutil->backup($db_format);
			$dbname='backup-on-'.date('Y-m-d').'.zip';
			$save='assets/db_backups/'.$dbname;
			write_file($save,$backup);
			force_download($dbname,$backup);*/
			
					 $this->load->dbutil();
			$prefs = array(
					//'tables'      => array('hotel_accomodation'),  // Array of tables to backup.
					'ignore'      => array(),           // List of tables to omit from the backup
					'format'      => 'txt',             // gzip, zip, txt
					'filename'    => ''.date("Y-m-d-H-i-s").'hostel.sql',    // File name - NEEDED ONLY WITH ZIP FILES
					'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
					'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
					'newline'     => "\n"               // Newline character used in backup file
				  );
		
			$backup =& $this->dbutil->backup($prefs);
			//I tried it with and without the next 2 Lines.
			$this->load->helper('file');
			write_file('../E:/Hostel System bkup/MysqlDB backup/'.date("Y-m-d-H-i-s").'hostel.sql', $backup); 
		}
		
		$this->session->set_flashdata('success', 'Hostel Database Backup Done Successfully.');
			    
				redirect('setting/settings/');    
    
   
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'IIUI Hostels : 404 - Page Not Found';
        
        $this->loadViews("404", $this->global, NULL, NULL);
    }
}

?>