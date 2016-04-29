<?php $this->load->view('includes/header'); ?>  
 <div id="content">
  <div class="breadcrumb">
       <?php echo anchor('sitepanel/dashbord','Home'); ?>
        &raquo; <?php echo anchor('sitepanel/orders/','Back To Orders'); ?> &raquo; <?php echo $heading_title; ?> </a>
        
      </div>
      
      <div class="box">
    <div class="heading">
      <h1><img src="<?php echo base_url(); ?>assets/sitepanel/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      
     <div class="buttons"><?php echo anchor("sitepanel/orders/",'<span>Cancel</span>','class="button" ' );?></div>
      
    </div>
    
    <div class="content">
       
	<?php echo validation_message();?>
    <?php echo error_message(); ?>  
    
	<?php echo form_open_multipart(current_url_query_string());?>  
		<div id="tab_pinfo">
			<table width="90%"  class="form"  cellpadding="3" cellspacing="3">
			<tr>
				<th colspan="2" align="center" > </th>
			</tr>
			<tr class="trOdd">
				<td width="28%" height="26" align="right" ><span class="required">*</span> Free COD Amount </td>
        <td width="72%" align="left">
        	<input type="text" name="free_cod_amt" size="40" value="<?php echo set_value('free_cod_amt',$result['free_cod_amt']);?>">
      	</td>
			</tr>
      <tr class="trOdd">
				<td width="28%" height="26" align="right" ><span class="required">*</span> COD Amount </td>
        <td width="72%" align="left">
        	<input type="text" name="cod_amt" size="40" value="<?php echo set_value('cod_amt',$result['cod_amt']);?>">
      	</td>
			</tr>
     	<tr class="trOdd">
				<td width="28%" height="26" align="right" ><span class="required">*</span> Free Shipping Amount </td>
        <td width="72%" align="left">
        	<input type="text" name="free_ship_amt" size="40" value="<?php echo set_value('free_ship_amt',$result['free_ship_amt']);?>">
      	</td>
			</tr>
      <tr class="trOdd">
				<td width="28%" height="26" align="right" ><span class="required">*</span> Shipping Amount </td>
        <td width="72%" align="left">
        	<input type="text" name="ship_amt" size="40" value="<?php echo set_value('ship_amt',$result['ship_amt']);?>">
      	</td>
			</tr>
			<tr class="trOdd">
				<td align="left">&nbsp;</td>
				<td align="left">
					<input type="submit" name="sub" value="Update" class="button2" />
					<input type="hidden" name="action" value="edit" />
					<input type="hidden" name="size_id" value="<?php echo $result['id'];?>">
				</td>
			</tr>
			</table>
		</div>
	<?php echo form_close(); ?>
	</div>
</div>
<?php $this->load->view('includes/footer'); ?>