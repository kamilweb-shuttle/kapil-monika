<?php $this->load->view('admin/header'); 
$pagesection=$this->config->item('bannersections');
?>  
<div class="breadcrumb"> <?php echo anchor('sitepanel/dashbord','Home'); ?>
&raquo; <?php echo $heading_title; ?> </div>
<div class="box">
	<div class="left"></div>
	<div class="right"></div>
	<div class="heading">
		<h1 style="background-image: url('<?php echo base_url(); ?>assets/admin/image/category.png');">   <?php echo $heading_title; ?></h1>
		<div class="buttons" style="vertical-align:top; ">
			<?php //echo anchor("sitepanel/banners/add/",'<span>Add Banner</span>','class="button" ' );?>
		</div>
	</div>
	<script type="text/javascript">function serialize_form() { return $('#srchform').serialize();   } </script> 
	<div class="content">
    
    
		<?php echo $this->admin_lib->display_set_msg(); ?>         
        
        
		<?php echo form_open("sitepanel/banners/advertise/",'id="srchform"'); ?>
			<input type="hidden" name="keyword" value="<?php echo $this->input->post('keyword');?>"  />
		<?php echo form_close();?> 
		<?php echo form_open("sitepanel/banners/advertise/",'id="form"'); ?>
		<table width="100%"  border="0" cellspacing="3" cellpadding="3" >
		<tr>
			<td align="center" >Search[ name,email ] 
				<input type="text" name="keyword" value="<?php echo $this->input->post('keyword');?>"  />&nbsp;
				<a  onclick="$('#form').submit();" class="button"><span> GO </span></a>
				<input type="hidden" name="stchstatussrch" value="1">
				<?php 
				if($this->input->post('keyword')!=''){ 
					echo anchor("sitepanel/banners/advertise/",'<span>Clear Search</span>');
				} 
				?>
			</td>
		</tr>
		</table>
		<?php echo form_close();?>
        
        
        
		<?php 
		$position_arr = $this->config->item('banner_position');
		
		 if( is_array($res) && !empty($res) )
		 {
			echo form_open("sitepanel/banners/advertise_change_status/",'id="myform"');
			
			
			?>
			<table class="list" width="100%" id="my_data">
			<thead>
			<tr>
				<td width="20" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'arr_ids\']').attr('checked', this.checked);" /></td>
				<td width="145" class="left"><strong>Poster information</strong></td>
				<?php /*<td width="145" class="left">Banner Position</td>*/?>
				<td width="145" class="left"><strong>Position/URL</strong></td>
				<td width="202" class="left">Banner </td>
				<td width="134" class="right">Status</td>
			  </tr>
			</thead>
			<tbody>
			<?php 	
			$atts = array(
			'width'      => '740',
			'height'     => '600',
			'scrollbars' => 'yes',
			'status'     => 'yes',
			'resizable'  => 'yes',
			'screenx'    => '0',
			'screeny'    => '0'
			);
		foreach($res as $catKey=>$pageVal)
		{ 
		?> 
			<tr>
				<td style="text-align: center;">
					<input type="checkbox" name="arr_ids[]" value="<?=$pageVal['id'];?>" />
				</td>
				<td class="left">
                  <p><strong>    Posted On : </strong> <?php echo $pageVal['inserted_on']; ?> <br />
                  <strong>        Name : </strong> <?php echo $pageVal['name']; ?><br />
                  <strong>Email Id : </strong> <?php echo $pageVal['email']; ?> <br />
                   <strong>Country : </strong> <?php echo $pageVal['country']; ?> <br />                    
                    <strong>   Phone No : </strong> <?php echo $pageVal['phone']; ?> <br />             
                    <br />
                </p></td>
			
				<td class="left">
                
               <strong>Duration</strong> :  <?php echo $pageVal['banner_duration']; ?>Month   <br />                      
               <strong> Banner URL</strong> :  <?php echo $pageVal['website_url']; ?>  <br /> 
               <?php if($pageVal['payment_mode']!='' )
			   {
				   ?>
                <strong>Payment Method</strong> :  <?php echo $pageVal['payment_mode']; ?> <br /> 
                <?php
			   }
			   ?>                 
                <strong>Order Status</strong> :  <?php echo $pageVal['payment_status']; ?> <br />                
                <strong>Payment Status</strong> :  <?php echo $pageVal['order_status']; ?><br /> 
              
               
                </td>
				<td align="left">
					
                    <?php
					if($pageVal['banner_type']=='image')
					{
						?>
                    
                    <a href="<?php echo base_url()."uploaded_files/advertise/".$pageVal['banner'];?>"  class="dg2">View Banner</a>
                    
                  <?php
					}else
					{						
				    ?>
                    <strong> Banner Title </strong> :  <?php echo $pageVal['text_banner_title']; ?> <br />                
                    <strong>Banner Text  </strong> :  <?php echo $pageVal['text_banner_desc']; ?> 
                    
                    <?php
					}					
					?>
                   
				</td>
				<td class="right"><?php echo ($pageVal['status']==1)? "Active":"In-active";?></td>
			  </tr>
		<?php
		}		   
		?> 
		<tr><td colspan="5" align="right" height="30"><?php echo $page_links; ?></td></tr>     
		</tbody>
		<tr>
			<td align="left" colspan="5" style="padding:2px" height="35">
				<input name="Activate" type="submit"  value="Activate" class="button2" id="Activate" onClick="return validcheckstatus('arr_ids[]','Activate','Record','u_status_arr[]');"/>
				<input name="Deactivate" type="submit" class="button2" value="Deactivate" id="Deactivate"  onClick="return validcheckstatus('arr_ids[]','Deactivate','Record','u_status_arr[]');"/>              
				<input name="Delete" type="submit" class="button2" id="Delete" value="Delete"  onClick="return validcheck('arr_ids[]','delete','Record');"/>
			</td>
		</tr>
		</table>
		<?php
		echo form_close();
	}else
	{
		echo "<center><strong> No record(s) found !</strong></center>" ;
	}
	?> 
	</div>
</div>
<?php $this->load->view('admin/footer'); ?>