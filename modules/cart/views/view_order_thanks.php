<?php $this->load->view("public/topapplication.php");?>
<?php $this->load->view("public/header.php");?>

<!--body start-->
<div class="container bg-white">
<p><img src="<?php echo theme_url(); ?>images/spacer.gif" width="1" height="1" alt="" /></p>
<div class="p5-15">
  <div class="fl bg2">
  <p>&nbsp;</p>
  <p class="ac"><a href="<?php echo base_url();?>pages/newsletter" class="newsletter"><img src="<?php echo theme_url(); ?>images/newsletter.jpg" alt="" /></a></p>
  <p class="ac"><a href="<?php echo base_url();?>pages/feedback"><img src="<?php echo theme_url(); ?>images/feedback.jpg" alt="" /></a></p>
  <p><img src="<?php echo theme_url(); ?>images/categories-bot.gif" alt="" /></p>  
  </div>
  
  <div class="fl" style="margin-left:10px;"><img src="<?php echo theme_url(); ?>images/inner-header.jpg" alt="" /></div>
  <p class="cb"></p>
  
  <h1>Thanks</h1>
  <p class="tree mt3">Thanks <a href="<?php echo base_url();?>member">My Account</a> <a href="<?php echo base_url();?>">Home</a></p>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="mt18">
        <tr>
          <td width="17%" align="center" valign="top"><img src="<?php echo theme_url(); ?>images/thanks-img.jpg" alt="" /></td>
          <td width="83%" valign="top"><p class="b fs15 black">Congratulation</p>
            <p class="mt6 pb10">Your payment has been completed successfully. </p>
            <p class="white mt10 button-style"><a href="<?php echo base_url();?>member">Go to My Folder</a></p></td>
        </tr>
      </table></td>
    </tr>
  </table>
</div>
    
<p class="cb"></p>
</div>
<!--body end-->

<?php $this->load->view("public/footer.php");?>
