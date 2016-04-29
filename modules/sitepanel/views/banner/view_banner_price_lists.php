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
			<?php echo anchor("sitepanel/banners/add_price/",'<span>Add Banner Price</span>','class="button" ' );?>
		</div>
	</div>
	<script type="text/javascript">function serialize_form() { return $('#srchform').serialize();   } </script> 
	<div class="content">
    
    
		<?php echo $this->admin_lib->display_set_msg(); ?>         
        
		<?php echo form_open("sitepanel/banners/banners_price_lists/",'id="srchform"'); ?>
			<input type="hidden" name="keyword" value="<?php echo $this->input->post('keyword');?>"  />
		<?php echo form_close();?> 
		<?php echo form_open("sitepanel/banners/banners_price_lists/",'id="form"'); ?>
		<table width="100%"  border="0" cellspacing="3" cellpadding="3" >
		<tr>
			<td align="center" >Search[Duration] 
				<input type="text" name="keyword" value="<?php echo $this->input->post('keyword');?>"  />&nbsp;
                
               <!-- <select name="keyword" onchange="this.form.submit();">
			    <option value="">Select Position</option>
			    <?php 
						foreach ($this->config->item('banner_position')  as $key=>$val)
						{
							$sel = ($this->input->post('keyword')==$key ) ? "selected" : "";
							
							?>
			    <option value="<?php echo $key;?>" <?php echo $sel;?> ><?php echo $val ;?></option>
			    <?php 
						} 
						?>
		      </select>
              -->
              
				<a  onclick="$('#form').submit();" class="button"><span> GO </span></a>
				<input type="hidden" name="stchstatussrch" value="1">
				<?php 
				if($this->input->post('keyword')!=''){ 
					echo anchor("sitepanel/banners/banners_price_lists/",'<span>Clear Search</span>');
				} 
				?>
			</td>
		</tr>
		</table>
		<?php echo form_close();?>
        
        
        
		<?php 
		
		$position = $this->config->item('banner_position'); 
		
		 if( is_array($res) && !empty($res) )
		 {
			echo form_open("sitepanel/banners/advertise_change_status/",'id="myform"');
			
			
			?>
			<table class="list" width="100%" id="my_data">
			<thead>
			<tr>
				<?php /*<td width="145" class="left">Banner Position</td>*/?>
				<td width="146" align="left" class="left">Duration</td>
				<td width="195" class="left">Price</td>
				<td width="195" align="left" class="right">Action</td>
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
			  <td class="left">
				<?php echo $pageVal['duration']; ?> Months
                <br /> 
                   <br /></td>
				<td align="left">
				<?php echo $this->config->item('currency_format');?>
				<?php echo $pageVal['banner_price']; ?>          </td>
				<td class="right">
                <a href="<?php echo base_url();?>sitepanel/banners/edit_banner_price/<?php echo $pageVal['id'];?> ">Edit</a>
                </td>
			  </tr>
		<?php
		}		   
		?> 
		<tr><td colspan="3" align="right" height="30"><?php echo $page_links; ?></td></tr>     
		</tbody>
		<tr>
			<td align="left" colspan="3" style="padding:2px" height="35">&nbsp;</td>
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