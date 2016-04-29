<?php $this->load->view('includes/header'); ?>
<div id="content">
  
  <div class="breadcrumb">
    
  <?php echo anchor('sitepanel/dashbord','Home'); ?>
 &raquo; <?php echo $heading_title; ?>
 
   </div>      
       
 <div class="box">
 
    <div class="heading">
    
      <h1><img src="<?php echo base_url(); ?>assets/sitepanel/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      
      <div class="buttons">&nbsp;</div>
      
    </div>
       <div class="content">  
       
        <?php echo validation_message();?>
        <?php echo error_message(); ?>
             

  <?php echo form_open('sitepanel/setting/edit/');?>  
	<table width="90%"  class="tableList" align="center">
		<tr>
			<th colspan="2" align="center" > </th>
		</tr>
		<tr class="trOdd">
			<td width="217" height="26"><span class="required">*</span> Old Password:</td>
			<td width="633">
            <input type="password" name="old_pass" id="old_pass" size="40" value=''>
            </td>
		</tr>
		<tr class="trEven">
			<td height="26"><span class="required">*</span> New Password:</td>
			<td>
            <input type="password" name="new_pass" size="40" value=''>
           
            </td>
		</tr>
		<tr class="trOdd">
			<td height="26"><span class="required">*</span> Confirm Password:</td>
			<td><input type="password" name="confirm_password" size="40" value="" />  
            </td>
		</tr>
		
        <tr class="trOdd">
		  <td align="left"><span class="required">*</span> Email : </td>
		  <td align="left">
         <input type="text" name="admin_email" size="40" value="<?php echo set_value('admin_email',$admin_info->admin_email);?>" /></td>
	    </tr>
        
        <tr class="trOdd">
		  <td align="left"><span class="required">*</span> Address :</td>
		  <td align="left">
          <textarea name="address" cols="55" rows="6"><?php echo set_value('address',$admin_info->address);?></textarea></td>
	  </tr>
		
        
		<tr class="trOdd">
			<td height="26">&nbsp;&nbsp;</td>
			<td><input type="submit" class="button2" value="Update Info"  />  
            </td>
		</tr>
	</table>
<?php echo form_close(); ?>
  </div>
</div>
<?php $this->load->view('includes/footer'); ?>