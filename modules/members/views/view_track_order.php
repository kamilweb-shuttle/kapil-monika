<?php $this->load->view('top_application'); ?>
<!--body-->
<div class="container">
  <div class="p10">
    <h1>Contact Us</h1>
    <p class="tree mt5"><img src="<?php echo theme_url();?>images/youarehere.png" alt="" class="vat mr5"> <a href="<?php echo base_url();?>">Home</a> Contact Us</p>
    
    <div class="p15 mt10 fs13 bdr2 bg-grey bdrT">
     <?php echo error_message(); ?>
    <p class="mt15 bdrB2"></p>
     <?php echo form_open('','id="contfrm"');?>    
      
      <p class="mt15">Enter your Order/Invoice No.</p>
      <p class="mt5"><input type="text" name="order_id" class="bg-txtbox w30" /><?php echo form_error('order_id');?></p>
      <p class="mt10"><input name="button3" type="submit" class="button-style" value="Submit"></p>
     <?php echo form_close();?>     
    </div>
    
    <p class="ac"><?php $this->load->view("banner/footer_banner");?></p>   
    
    </div>    
    
    <p class="cb"></p>
</div>
<!--body end-->
</div>
<script type="text/javascript" language="javascript">
	jQuery("#contfrm").validationEngine('attach', {promptPosition : "topRight", autoPositionUpdate : true, autoHidePrompt: true});
</script>
<?php $this->load->view('bottom_application'); ?>