<?php $this->load->view('admin/header'); ?>  
<div class="breadcrumb"> <?php echo anchor('sitepanel/dashbord','Home'); ?>
&raquo; <?php echo anchor('sitepanel/banners/banners_price_lists','Back To Listing'); ?> &raquo;  <?php echo $heading_title; ?> </div>
<div class="box">
	<div class="left"></div>
	<div class="right"></div>
	<div class="heading">
		<h1 style="background-image: url('<?php echo base_url(); ?>assets/admin/image/category.png');">   <?php echo $heading_title; ?></h1>
	</div>
	<div class="content">
		<?php
		$bann_arr = $this->config->item('bannersz');
		$processing_result=validation_errors();
		if($processing_result!='')
		{
		?>
			<div class="warning" style="padding: 5px;">
				<?php echo $processing_result; ?>
			</div>
		<?php 
		} 
		?>
		<?php echo form_open_multipart('sitepanel/banners/add_price/');?>  
		<div id="tab_pinfo">
			<table width="90%"  class="form"  cellpadding="3" cellspacing="3">
			<tr>
				<th colspan="2" align="center" > </th>
			</tr>
			<!--
            <tr class="trOdd">
			  <td width="28%" height="26" align="right" ><span class="required">*</span> Position:</td>
			  <td width="72%" align="left"><select name="position" >
			    <option value="">Select Position</option>
			    <?php 
						foreach ($this->config->item('banner_position')  as $key=>$val)
						{
							$sel = ($this->input->post('position')==$key ) ? "selected" : "";
							?>
			    <option value="<?php echo $key;?>" <?php echo $sel;?> ><?php echo $val ;?></option>
			    <?php 
						} 
						?>
		      </select></td>
			  </tr>
              -->
			<tr class="trOdd">
			  <td height="26" align="right" ><span class="required">*</span> Duration :</td>
			  <td align="left"><select name="duration" >
			    <option value="">Select Duration</option>
			    <?php 
						foreach ($this->config->item('banner_duration')  as $key=>$val)
						{
							
							$sel = ($this->input->post('duration')==$val ) ? "selected" : "";
							
							?>
                            
			    <option value="<?php echo $val;?>" <?php echo $sel;?> ><?php echo $val ;?> Months</option>
			    <?php 
						} 
						?>
		      </select></td>
			  </tr>
			<!--<tr class="trOdd">
			  <td height="26" align="right" ><span class="required">*</span> Banner Type :</td>
			  <td align="left">
              
               <input type="radio" name="banner_type"  checked="checked" value="image"/> Image  
          <input type="radio" name="banner_type" value="text" <?php if($this->input->post('banner_type')=='text'){ ?> checked="checked" <?php } ?> /> Text 
              
              </td>
			  </tr>-->
			<tr class="trOdd">
			  <td height="26" align="right" ><span class="required">* </span>Price(<?php echo $this->config->item('currency_format');?>)  :</td>
			  <td align="left"><input type="text" name="banner_price" value="<?php echo $this->input->post('banner_price');?>" size="50" /></td>
			  </tr>
			<tr class="trOdd">
				<td align="left">&nbsp;</td>
				<td align="left">
					<input type="submit" name="sub" value="Add" class="button2" />
					<input type="hidden" name="action" value="addbanner" />
				</td>
			</tr>
			</table>
    </div>
		<?php echo form_close(); ?>
	</div>
</div>
<?php $this->load->view('admin/footer'); ?>