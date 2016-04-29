<?php $this->load->view('includes/header'); ?>  
   
<div class="content">
    <div id="content">
  <div class="breadcrumb">
       <?php echo anchor('sitepanel/dashbord','Home'); ?>
        &raquo; <?php echo $heading_title; ?> </a>
        
      </div>
      
      <div class="box">
    <div class="heading">
      <h1><img src="<?php echo base_url(); ?>assets/sitepanel/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      
      <div class="buttons">
	   <a href="javascript:void(0);" onclick="history.back();" class="button">Cancel</a>  
	</div>
      
    </div>
    <div class="content">
    	    
	<?php echo validation_message();?>
    <?php echo error_message(); ?>  
    
	<?php echo form_open_multipart("sitepanel/testimonial/edit/".$res['testimonial_id']);?>  
		<div id="tab_pinfo">
			<table width="90%"  class="form"  cellpadding="3" cellspacing="3">
			<tr>
				<th colspan="2" align="center" > </th>
			</tr>
			<!--<tr class="trOdd">
			  <td height="26" align="right" ><span class="required">*</span>Email Id: </td>
			  <td align="left"><input type="text" name="email" size="40" value="<?php //echo set_value('email',$res['email']);?>" /></td>
			  </tr>-->
			<tr class="trOdd">
				<td width="28%" height="26" align="right" ><span class="required">*</span> Name:</td>
				<td width="72%" align="left">
                <input type="text" name="poster_name" size="40" value="<?php echo set_value('poster_name',$res['poster_name']);?>"></td>
			</tr>
      <tr class="trOdd">
      	<td width="28%" height="26" align="right" ><span class="required">*</span> Friendly Url:</td>
				<td width="72%" align="left">
                <input type="text" name="friendly_url" size="40" value="<?php echo set_value('friendly_url',$res['friendly_url']);?>"></td>
			</tr>
			<tr class="trOdd">
                <td height="26" align="right"> <span class="required">*</span> Comment:</td>
                <td>
               <textarea name="testimonial_description" rows="5" cols="50" id="testimonial_description" >
			   <?php echo set_value('testimonial_description',$res['testimonial_description']);?></textarea>
			   <?php echo display_ckeditor($ckeditor); ?>
                </td>
            </tr>
        <!--<tr class="trOdd">
				<td width="28%" height="26" align="right" > Image :</td>
				<td align="left">
					<input type="file" name="testimonial_image" />
					<?php
					if($res['testimonial_image']!='' && file_exists(UPLOAD_DIR."/testimonial/".$res['testimonial_image']))
					{ 
					?>
						 <a href="#"  onclick="$('#dialog').dialog();">View</a>
						| <input type="checkbox" name="cat_img_delete" value="Y" />Delete
                        
					<?php	
					}
					?>
					<br />
                    <br />
					[ ( File should be .jpg, .png, .gif format and file size should not be more then 2 MB (2048 KB)) ( Best image size 211X175 ) ]
            <div id="dialog" title="testimonial Image" style="display:none;">
        <img src="<?php echo base_url().'uploaded_files/testimonial/'.$res['testimonial_image'];?>"  /> </div>
				</td>
			</tr>-->
			<tr class="trOdd">
				<td align="left">&nbsp;</td>
				<td align="left">
					<input type="submit" name="sub" value="Post" class="button2" />
				                 
				</td>
			</tr>
			</table>
		</div>
	<?php echo form_close(); ?>
	</div>
</div>

<?php $this->load->view('includes/footer'); ?>