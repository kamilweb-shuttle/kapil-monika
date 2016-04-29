<?php $this->load->view("top_application");?>
<div class="container"><!--Container-Starts-->
  <section class="lh18px aj"><!--Content--Starts-->
    <h1>Thank You</h1>
    <p class="tree"><a href="<?php echo base_url();?>">Home</a> Thank You</p>
    <div class="p10 mt10">
      <p class="ac"><img src="<?php echo theme_url();?>images/footer-logo.png" width="258" height="70" alt="footer"></p>
      <p class="ac mt10 fs26 oswald"><?php echo  $this->session->flashdata('msg');?></p>
      <?php /*if($this->session->userdata('user_id') > 0 ) 
    	{
		?>
      <p class="mt10">
        <input name="button3" type="submit" class="button-style" id="button2" value="Go to My Account" onClick="window.open('<?php echo base_url();?>members/myaccount','_parent');" />
      </p>
      	<?php
	  	}*/
		?>

    </div>
    <!--Content-Ends--></section>
  <div class="cb"></div>
  <!--Container-Ends--></div>
<?php $this->load->view("bottom_application");?>