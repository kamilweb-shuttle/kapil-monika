<?php $this->load->view('includes/header'); ?>  
   
<div class="content">
    <div id="content">
  <div class="breadcrumb">
       <?php echo anchor('sitepanel/dashbord','Home'); ?>
        &raquo; <?php echo anchor('sitepanel/color','Back To Listing'); ?> &raquo; <?php echo $heading_title; ?> </a>
        
      </div>
      
      <div class="box">
    <div class="heading">
      <h1><img src="<?php echo base_url(); ?>assets/sitepanel/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      
      <div class="buttons">
	   <a href="javascript:void(0);" onclick="history.back();" class="button">Cancel</a>  
	</div>
      
    </div>
    <div class="content">
    	    
	<?php echo validation_message('alert');?>
    <?php echo error_message(); ?>  
    
	<?php echo form_open_multipart("sitepanel/color/add/");?>  
		<div id="tab_pinfo">
			<table width="90%"  class="form"  cellpadding="3" cellspacing="3">
			<tr>
				<th colspan="2" align="center" > </th>
			</tr>
			<tr class="trOdd">
				<td width="28%" height="26" align="right" ><span class="required">*</span> Name:</td>
				<td width="72%" align="left"><input type="text" name="color_name" size="40" value="<?php echo set_value('color_name');?>"></td>
			</tr>
			<tr class="trOdd">
				<td width="28%" height="26" align="right" ><span class="required">*</span> Code:</td>
				<td width="72%" align="left"><input type="text" name="color_code" id="color_code" size="40" value="<?php echo set_value('color_code');?>"></td>
			</tr>
			<tr class="trOdd">
				<td align="left">&nbsp;</td>
				<td align="left">
					<input type="submit" name="sub" value="Add" class="button2" />
					<input type="hidden" name="action" value="add" />
                </td>
			</tr>
			</table>
		</div>
	<?php echo form_close(); ?>
	</div>
</div>
<link rel="stylesheet" href="<?php echo base_url();?>assets/developers/js/colorpicker/css/colorpicker.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/developers/js/colorpicker/colorpicker.js"></script>
<script type="text/javascript">
  $('#color_code').ColorPicker({
	onSubmit: function(hsb, hex, rgb, el) {
		$(el).val(hex);
		$(el).ColorPickerHide();
	},
	onBeforeShow: function () {
		$(this).ColorPickerSetColor(this.value);
	}
})
.bind('keyup', function(){
	$(this).ColorPickerSetColor(this.value);
});
</script>
<?php $this->load->view('includes/footer'); ?>