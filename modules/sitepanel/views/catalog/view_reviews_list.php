<?php
$ref_id = $this->input->get_post('ref_id');
if($ref_id > 0)
{
  $this->load->view('includes/face_header'); 
}
else
{
  $this->load->view('includes/header'); 
}
?>  
<div class="content">
    <div id="content">
  <div class="breadcrumb">
    
    <?php echo anchor('sitepanel/dashbord','Home'); 
	?>
     <span class="pr2 fs14">»</span> Reviews
        
 </div>
  <div class="box">
    <div class="heading">
      <h1><img src="<?php echo base_url(); ?>assets/sitepanel/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
	  <?php
	  if($ref_id > 0)
	  {
	  ?>
      <div class="buttons">
		<a href="<?php echo base_url();?>sitepanel/product_reviews/add/<?php echo $this->input->get('ref_id');?>" class="button">Add Review</a>
	  </div>
     <?php
	  }
	  ?>
    </div>
    <div class="content">
	<?php
	  if($ref_id > 0)
	  {
		$overall_rating = product_overall_rating($ref_id,'product');

		echo '<b>Overall Rating:</b> '.rating_html($overall_rating,5);
	  }
      ?>
    		 <?php
			  
			 
			   if(error_message() !=''){
			      echo error_message();
			   }
			    ?>  
      <script type="text/javascript">function serialize_form() { return $('#pagingform').serialize();   } </script> 
         
        
		<?php 
		echo form_open("sitepanel/product_reviews",'id="search_form" method="get" '); ?>
        <div align="right" class="breadcrumb"> Records Per Page : <?php echo display_record_per_page();?> </div>
		<table width="100%"  border="0" cellspacing="3" cellpadding="3" >
		   
           <tr>
			<td align="center" >Search [ product name,poster name,review ] 
				<input type="text" name="keyword2" value="<?php echo $this->input->get_post('keyword2');?>"  />&nbsp;
                
                <select name="status">
                
					<option value="">Status</option>
					<option value="1" <?php echo $this->input->get_post('status')==='1' ? 'selected="selected"' : '';?>>Active</option>
					<option value="0" <?php echo $this->input->get_post('status')==='0' ? 'selected="selected"' : '';?>>In-active</option>
                    
				</select>
                <input type="hidden" name="ref_id" value="<?php echo $this->input->get_post('ref_id');?>"  />
				<a  onclick="$('#search_form').submit();" class="button"><span> GO </span></a>
				
				<?php 
				if( $this->input->get_post('keyword2')!='' || $this->input->get_post('status')!='' || $this->input->get_post('ref_id')!='')
				{ 
					
					echo anchor("sitepanel/product_reviews".($ref_id > 0 ? "?ref_id=$ref_id" : ""),'<span>Clear Search</span>');
				} 
				?>
			</td>
		</tr>
		</table>
        
		<?php echo form_close();?>
        
      <div class="required"> <?php echo $category_result_found; ?></div>
		<?php	 
		if( is_array($res) && !empty($res) )
		{
			echo form_open(current_url_query_string(),'id="data_form"');
			
			?>
  
			<table class="list" width="100%" id="my_data">
			<thead>
			<tr>
			  <td><input type="checkbox" onclick="$('input[name*=\'arr_ids\']').attr('checked', this.checked);" /></td>
			  <td><strong>Product Name</strong></td>
			  <td><strong>Name</strong></td>
			  <td><strong>Review</strong></td>
			  <td><strong>Posted</strong></td>
			  <td><strong>Status</strong></td>
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
			foreach($res as $catKey=>$val)
			{ 
			?> 
			  <tr>
				<td><input type="checkbox" name="arr_ids[]" value="<?php echo $val['review_id']; ?>" /></td>
				<td><?php echo anchor_popup('sitepanel/products/details/'.$val['entity_id'], $val['product_name'], $atts);;?></td>
				<td><?php echo $val['mem_name'];?><br /><?php echo $val['author_email'];?></td>
				<td>
				  <p><?php echo rating_html($val['ads_rating'],5);?></p><?php echo $val['text'];?>
				  				</td>
				<td nowrap><?php echo date("M d,Y",strtotime($val['review_date']));?></td>
				<td><?php echo  $val['status']=='1' ? 'Active' : 'Inactive';?>
				<?php
				  
				  //echo '<br /><br />'.anchor("sitepanel/product_reviews/edit/$val[review_id]".query_string(),'Edit'); 
				  ?>
				</td>
				
			  </tr>
			<?php
			}		   
			?> 
			</tbody>
			</table>
			<?php
			if($page_links!='')
			{
			?>
			  <table class="list" width="100%">
			  <tr><td align="right" height="30"><?php echo $page_links; ?></td></tr>     
			  </table>
			<?php
			}
			?>
			<table class="list" width="100%">
			<tr>
				<td align="left" colspan="11" style="padding:2px" height="35">
                 
					
					<input name="status_action" type="submit"  value="Activate" class="button2" id="Activate" onClick="return validcheckstatus('arr_ids[]','Activate','Record','u_status_arr[]');"/>
					
					<input name="status_action" type="submit" class="button2" value="Deactivate" id="Deactivate"  onClick="return validcheckstatus('arr_ids[]','Deactivate','Record','u_status_arr[]');"/>
					
					<input name="status_action" type="submit" class="button2" id="Delete" value="Delete"  onClick="return validcheckstatus('arr_ids[]','delete','Record');"/> 
					
					
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

<script type="text/javascript">		
	function onclickgroup(){
		if(validcheckstatus('arr_ids[]','set','record','u_status_arr[]')){			
			$('#data_form').submit();
		}
	}	
</script>

<?php $this->load->view('includes/footer'); ?>