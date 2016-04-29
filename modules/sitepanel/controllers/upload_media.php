<?php
class upload_media extends Admin_Controller {

  public function __construct()
  {
	parent::__construct(); 

  }

  public function index()
  {
	if($this->input->post('del_sbt') !='')
	{
	  $del_imgs = $this->input->post('delete');

	  if(is_array($del_imgs) && !empty($del_imgs))
	  {
		  foreach($del_imgs as $val)
		  {
			$orig_path = UPLOAD_DIR."/product_images/".$val;
			$thumb_path = UPLOAD_DIR."/product_images/thumb/".$val;
			unlink($orig_path);
			unlink($thumb_path);
		  }
	  }
	  $this->session->set_userdata(array('msg_type'=>'success'));
	  $this->session->set_flashdata('success',lang('deleted') );
	  ?>
	  <script type="text/javascript">
	  window.location.href= '<?php echo  base_url();?>sitepanel/upload_media';
	  </script>
	<?php
	}
	$this->load->view('uploader/upload','');
  }

  public function response()
  {
	if($_FILES['filex']['name']!='')
	{
	  $this->load->library('upload');	
						
	  $uploaded_data =  $this->upload->my_upload('filex','product_images');

	  if( is_array($uploaded_data)  && !empty($uploaded_data) )
	  { 								
		  $uploaded_file = $uploaded_data['upload_data']['file_name'];
		  $cfg_img = array(
									'width'            =>    93,
									'height'           =>    62,
									'source_path'      =>    UPLOAD_DIR.'/product_images/',
									'org_image'        =>    $uploaded_file,
									'destination_path' =>    UPLOAD_DIR.'/product_images/thumb'
								  );
		  Image_thumb($cfg_img);	
	  
	  }	
	}
	//trace($_FILES['filex']);
  }
}
// End of controller