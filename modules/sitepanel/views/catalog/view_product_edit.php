<?php $this->load->view('includes/header'); ?>
<?php
$values_posted_back=(is_array($this->input->post())) ? TRUE : FALSE;

$actual_product_colors = array();

if($res['color_ids']!='')
{
  $actual_product_colors = explode(',',$res['color_ids']);
}

$posted_color_arr = ($values_posted_back===TRUE) ? $this->input->post('color_id') : $actual_product_colors;

$posted_color_arr = ! is_array($posted_color_arr) ? array() : $posted_color_arr;

$actual_product_sizes = array();

if($res['size_ids']!='')
{
  $actual_product_sizes = explode(',',$res['size_ids']);
}

$posted_size_arr = ($values_posted_back===TRUE) ? $this->input->post('size_id') : $actual_product_sizes;

$posted_size_arr = ! is_array($posted_size_arr) ? array() : $posted_size_arr;

$embed_code = $res['video_type'] == 'embed' ? $res['video_code'] : '';

$video_file = $res['video_type'] == 'file' ? $res['video_code'] : '';

?>  
 
   <div class="content">
    <div id="content">
  <div class="breadcrumb">
     <?php echo anchor('sitepanel/dashbord','Home'); ?>&raquo; <?php echo anchor('sitepanel/products','Back To Listing'); ?> &raquo;  <?php echo $heading_title; ?>
      </div>
      
      <div class="box">
    <div class="heading">
      <h1><img src="<?php echo base_url(); ?>assets/sitepanel/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      
      <div class="buttons">
        <a href="javascript:void(0);" onclick="$('#form').submit();" class="button">Save</a>
	   <a href="javascript:void(0);" onclick="history.back();" class="button">Cancel</a>  
	</div>
      
    </div>
    <div class="content"> 
       
         <div id="tabs" class="htabs">         
         <a href="#tab-general">General</a>    
         </div> 
	   
        <?php echo validation_message();?>
         <?php echo error_message(); ?>  
		
		<?php echo form_open_multipart(current_url_query_string(),array('id'=>'form'));?>  
      <div id="tab-general">
			<table width="90%"  class="form"  cellpadding="3" cellspacing="3">
			<tr>
				<th colspan="2" align="right" >
					<span class="required">*Required Fields</span><br>
					<span class="required">**Conditional Fields</span>
				 </th>
			</tr>
			<tr>
				<th colspan="2" align="center" > </th>
			</tr>
			
             <tr class="trOdd">
				<td width="38%" height="26" align="right" valign="top" ><span class="required">*</span> Category:</td>
				<td width="62%" align="left">
                
				<select name="category_id" style="width:350px;"  size="8">
				<?php echo get_nested_dropdown_menu(0,$res['category_id']);?>
                </select>
                <?php echo form_error('category_id');?>
                </td>
                </tr>
			<?php
			$default_params = array(
							'heading_element' => array(
													  'field_heading'=>$heading_title." Name",
													  'field_name'=>"product_name",
													  'field_value'=>$res['product_name'],
													  'field_placeholder'=>"Your product Name",
													  'exparams' => 'size="40"'
													),
							'url_element'  => array(
													  'field_heading'=>"Page URL",
													  'field_name'=>"friendly_url",
													  'field_value'=>$res['friendly_url'],			  
													  'field_placeholder'=>"Your Page URL",
													  'exparams' => 'size="40"',
												   )

						  );
			seo_edit_form_element($default_params);
			
			?>
            <tr class="trOdd">
			<td width="38%" height="26" align="right" ><span class="required">*</span> Product Code:</td>
			<td align="left"><input type="text" name="product_code" size="50" value="<?php echo set_value('product_code',$res['product_code']);?>" />
			<?php echo form_error('product_code');?>
			</td>

			</tr> 
			<tr class="trOdd">
				<td align="right" valign="top" ><span class="required">*</span> Color:</td>
				<td  align="left">
				  <select name="color_id[]" style="width:380px;"  size="10" multiple>
				  <option value="">Select</option>
				  <?php
				  if(is_array($colors) && !empty($colors))
				  {
					foreach($colors as $val)
					{

					  echo '<option value="'.$val['color_id'].'"'.(in_array($val['color_id'],$posted_color_arr) ? ' selected="selected"' : '').'>'.$val['color_name'].'</option>';

					}
				  }
				  ?>
				  </select>
				  <?php echo form_error('color_id[]');?>
				</td>
			  </tr>
			  <tr class="trOdd">
				<td align="right" valign="top" ><span class="required">*</span> Size:</td>
				<td  align="left">
				  <select name="size_id[]" style="width:380px;"  size="10" multiple>
				  <option value="">Select</option>
				  <?php
				  if(is_array($sizes) && !empty($sizes))
				  {
					foreach($sizes as $val)
					{

					  echo '<option value="'.$val['size_id'].'"'.(in_array($val['size_id'],$posted_size_arr) ? ' selected="selected"' : '').'>'.$val['size_name'].'</option>';

					}
				  }
				  ?>
				  </select>
				  <?php echo form_error('size_id[]');?>
				</td>
			  </tr>
      <tr class="trOdd">
			  <td width="38%" height="26" align="right" >Base Quantity:</td>
			  <td align="left"><input type="text" name="qty" size="25" value="<?php echo set_value('qty');?>" />
			  <?php echo form_error('qty');?>
			  </td>

			</tr>
			<tr class="trOdd">
			  <td width="38%" height="26" align="right" >Product Material:</td>
			  <td align="left"><input type="text" name="product_material" size="50" value="<?php echo set_value('product_material',$res['product_material']);?>" />
			  <?php echo form_error('product_material');?>
			  </td>

			</tr>
			<tr class="trOdd">
			  <td width="38%" height="26" align="right" ><span class="required">*</span> Price:</td>
			  <td width="62%" align="left">
				<input type="text" name="product_price" size="40" value="<?php echo set_value('product_price',formatNumber($res['product_price'],2));?>">
				<?php echo form_error('product_price');?>
			  </td>
			</tr>
			<tr class="trOdd">
			  <td width="38%" height="26" align="right" ><span class="required">**</span> Discounted price:</td>
			  <td width="62%" align="left">
				<input type="text" name="product_discounted_price" size="40" value="<?php echo set_value('product_discounted_price',$res['product_discounted_price']);?>">
				<?php echo form_error('product_discounted_price');?>
			  </td>
			</tr>
			<tr class="trOdd">
			  <td width="38%" height="26" align="right" >Delivery Text:</td>
			  <td align="left"><input type="text" name="delivery_text" size="50" value="<?php echo set_value('delivery_text',$res['delivery_text']);?>" />
			  <?php echo form_error('delivery_text');?>
			  </td>

			</tr>  
            <tr class="trOdd">
				<td width="28%" height="26" align="right" >Alt</td>
				<td align="left">
					<input type="text" name="product_alt" value="<?php echo set_value('product_alt',$res['product_alt']);?>" size="50" />
					<?php echo form_error('product_alt');?>
					<br />
				</td>
			</tr>
			<tr class="trOdd">
				<td width="28%" height="26" align="right" >Images</td>
				<td align="left">
					<a href="<?php echo base_url();?>sitepanel/upload_media?action=browse" class="upload_media">Select/Upload from the server</a><br /><br /><div class="red">(You can browse <span id="img_item_count"></span> images from the server)</div><br />
					[ <?php echo $this->config->item('product.best.image.view');?> ]
					<br /><br />
					<div id="db_image_container">
					<?php
					$j = 0;
					$db_image = 0;
					for($i=1;$i<=$this->config->item('total_product_images');$i++)
					{
					  $media_id  = @$res_photo_media[$j]['id'];
					  $product_img  = @$res_photo_media[$j]['media'];
					  $product_path = "products/".$product_img;
					  $product_img_auto_id  = @$res_photo_media[$j]['id'];
					  if( $product_img!='' && file_exists(UPLOAD_DIR."/".$product_path) )
					  {
						$db_image++;
						echo '<div style="float:left;padding-left:5px;" id="db_imglist_'.$media_id.'"><a href="'.base_url().'uploaded_files/products/'.$product_img.'" class="dg2"><img src="'.base_url().'uploaded_files/products/'.$product_img.'" width="100" height="100" /></a>&nbsp;<a class="red delete_db_media" data-src="'.$media_id.'"><img src="'. base_url().'assets/sitepanel/image/edit-cut.png"></a></div>';
					  }
					  $j++; 
					}
					?>
					</div>
					<div style="clear:both;"></div>
					<p><b>Images Selected from server</b></p> 
					<div id="browsed_container">
					<?php
					$items_browsed = FALSE;
					$browsed_image = set_value('browsed_image');
					$actual_browsed_image = array();
					if($browsed_image!='')
					{
					  $browsed_arr  = explode(",",$browsed_image);
					  $product_img_str  = "";
					  foreach($browsed_arr as $val)
					  {
						if(file_exists(UPLOAD_DIR.'/product_images/thumb/'.$val))
						{
						  array_push($actual_browsed_image,$val);
						  $items_browsed = TRUE;
						  $product_img_str .= '<li data-src="'.$val.'"><img src="'.base_url().'uploaded_files/product_images/thumb/'.$val.'" />&nbsp;<a class="red delete_media"><img src="'.base_url().'assets/sitepanel/image/edit-cut.png"></a></li>';
						}
					  }
					  if($items_browsed === TRUE)
					  {
						echo '<ul class="image_select_list">'.$product_img_str.'</ul>';
					  }
					}
					else
					{
					  echo '<span class="red">None</span>';
					}
					?>  
					</div>
					<input type="hidden" name="browsed_image" id="browsed_image" value="<?php echo implode(",",$actual_browsed_image);?>" />
				</td>
			</tr>
		    <tr class="trOdd">
				<td width="28%" height="26" align="right" >Video Type</td>
				<td align="left">
					<input type="radio" name="video_type" value="embed" class="video_type" <?php echo set_value('video_type',$res['video_type'])=='embed' ? 'checked="checked"' : '';?>/>You Tube <input type="radio" name="video_type" value="file" class="video_type" <?php echo set_value('video_type',$res['video_type'])=='file' ? 'checked="checked"' : '';?> />File
					<?php echo form_error('video_type');?>
					<br />
				</td>
			</tr>
			<tr class="trOdd" id="embed" style="display:<?php echo set_value('video_type',$res['video_type'])=='embed' ? 'table-row' : 'none';?>;">
				<td width="28%" height="26" align="right" ><span class="required">*</span>You Tube URL</td>
				<td align="left">
					<input type="text" name="embed_code" value="<?php echo set_value('embed_code',$embed_code);?>" size="50" />
					<?php echo form_error('embed_code');?>
					<br />
				</td>
			</tr>
			<tr class="trOdd" id="vfile" style="display:<?php echo set_value('video_type',$res['video_type'])=='file' ? 'table-row' : 'none';?>;">
				<td width="28%" height="26" align="right" ><span class="required">*</span>Video File</td>
				<td align="left" valign="middle">
					<input type="file" name="video_file" value="" size="50" />
					<?php 
					echo form_error('video_file');
					if($res['video_type'] = 'file' && $res['video_file']!=''){
						$file_name		=	$res['video_file'];
						$exp_file_name	=	explode('.',$file_name);
						$file_img_name	=	$exp_file_name[0].'.jpeg'; 

						?>
            <div class="shadow1" style="width:360px; height:240px; border:10px solid #000; float:right; ">
			        <div  id="video-area1">  
      				</div>          
        		</div>
            <script type="text/javascript" src="<?php echo resource_url();?>jwplayer/jwplayer.js"></script>
            <script type="text/javascript">
							jwplayer("video-area1").setup({file: "<?php echo base_url(); ?>uploaded_files/products/videos/<?php echo $res['video_file']; ?>",image: "<?php echo base_url(); ?>uploaded_files/products/videos/<?php echo $file_img_name; ?>",width:'360',height:'240'});
						</script>
            <?php
					}
					?>
					<br />
				</td>
			</tr>
          
			                     
			<tr class="trOdd">
				<td width="38%" height="26" align="right" > Description:</td>
				<td align="left"><textarea name="products_description" rows="5" cols="50" id="description" ><?php echo $res['products_description'];?></textarea> <?php  echo display_ckeditor($ckeditor); ?>
				<?php echo form_error('products_description');?>
				</td>
			</tr>
			<tr class="trOdd">
				<td align="left">&nbsp;</td>
				<td align="left">					
					
					<input type="hidden" name="products_id" value="<?php echo $res['products_id'];?>">
                    
				</td>
			</tr>
			</table>
    </div>
    
    
	<?php echo form_close(); ?>
        
</div>   
    
    
</div>
<?php 
$total_product_images = $this->config->item('total_product_images');
$total_db_limit = $total_product_images - $db_image;
$total_db_limit = $total_db_limit < 0 ? 0 : $total_db_limit;
?>
<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs(); 
$('#vtab-option a').tabs();
//-->
var total_db_limit = <?php echo $total_db_limit;?>;

$('#img_item_count').html((total_db_limit==0 ? 'none' : total_db_limit));

$('#product_exclude_images_ids').val('');


function delete_product_images(img_id)
{
	//alert($('#product_exclude_images_ids').val());
	 img_id = img_id.toString();
	 exclude_ids1 = $('#product_exclude_images_ids').val();
	 exclude_ids1_arr = exclude_ids1=='' ? Array() : exclude_ids1.split(',');
	 
	 if($.inArray(img_id,exclude_ids1_arr)==-1){
		  exclude_ids1_arr.push(img_id);
	 }
	 
	 exclude_ids1 =  exclude_ids1_arr.join(',');
	 
	 
	$('#product_exclude_images_ids').val(exclude_ids1);
	$('#product_image'+img_id).remove();
	$('#del_img_link_'+img_id).remove();
		
	alert($('#product_exclude_images_ids').val());
	
}
$(document).ready(function(){
  $('.video_type').click(function(){
	lobj = $(this);
	lval = lobj.val();
	if(lval=='embed'){
	  $('#vfile').hide(200,function(){$('#embed').show()});
	}else{
	  $('#embed').hide(200,function(){$('#vfile').show()});
	}
  });
  $('.delete_db_media').click(function(e){
	e.preventDefault();
	var crfm = confirm('Are you sure you want to delete this');
	if(crfm){
	  $('.buttons').hide();
	  media_id = $(this).attr('data-src');
	  $.post('<?php echo base_url();?>sitepanel/products/delete_media',{id:media_id},function(data){
		if(data =='success'){
		  $('#db_imglist_'+media_id).remove();
		  total_db_limit = total_db_limit + 1;
		  $('#img_item_count').html(total_db_limit);
		  $('.buttons').show();
		}
	  });
	}
  });
});

</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/sitepanel/js/uploader.js"></script> 
<?php $this->load->view('includes/footer'); ?>