<?php $this->load->view('top_application'); ?>
<?php $productId        = (int) $this->uri->segment(3);
if($productId>0)
		{
			$query_res = get_db_single_row('wl_products','product_name','products_id ='.$productId.'');
			$product_name=$query_res['product_name'];
			
		}
?>

<!--content section-->
<section>
  <div class="content-bg">
    <div class="wrapper"> 
    <h1>Send Enquiry</h1>
        <p class="tree pl8">YOU ARE HERE : <a href="<?php echo base_url();?>"><img src="<?php echo theme_url();?>images/hm.gif" class="vam pb3" alt=""></a> <b>&gt;</b>  <b>Send Enquiry</b></p>
      <div class="mt10 default">
      <div>
          <div class="fl w65"> <a id="a1"></a>
            <p class="fs20 red aleg">Still Need Help or have a Query? <b class="arial fs11">Just Fill the Below Information:</b></p>
       <?php echo form_open('pages/sendenquiry/'.$productId);?>
       <?php echo error_message(); ?>
            <div class="mt10 pt10 bg-gray1 w100 shadow2 shadow1" style="border:2px dotted #CCCCCC;">
              <fieldset class="p25 pt15" style="border:none;">
                <div class="w50 fl">
                  <p>
            <input type="text" name="product_name" id="product_name" readonly="readonly" value="<?php echo $product_name;?>" class="p7" style="width:270px;">
          </p>
                  <p class="mt8">
                     <input name="first_name" id="first_name" type="text" class="p7" style="width:270px;" placeholder="First Name *" value="<?php echo set_value('first_name');?>"><?php echo form_error('first_name');?>
                     
                  </p>
                  <p class="mt8">
                     <input name="last_name" id="last_name" type="text" class="p7" style="width:270px;" placeholder="Last Name " value="<?php echo set_value('last_name');?>"><?php echo form_error('last_name');?>
                  </p>
                  <p class="mt8">
                    
                     <input autocomplete="off"  name="company_name" id="company_name" class="p7" style="width:270px;" placeholder="Company Name" type="text"  value="<?php echo set_value('company_name');?>" ><?php echo form_error('company_name');?>
                  </p>
                  <p class="mt8">
                    <input autocomplete="off"  name="email" id="email" class="p7" style="width:270px;" placeholder="Email *" type="text"  value="<?php echo set_value('email');?>"><?php echo form_error('email');?>
                  </p>
                  <p class="mt8">
                     <input autocomplete="off"  name="phone_number" id="phone_number" class="p7" style="width:270px;" placeholder="Phone Number" type="text"  value="<?php echo set_value('phone_number');?>" ><?php echo form_error('phone_number');?>
                  </p>
                </div>
                <div class="fr">
                  <p>
                    <input autocomplete="off"  name="address" id="address" class="p7" style="width:270px;" placeholder="Address" type="text"  value="<?php echo set_value('address');?>" ><?php echo form_error('address');?>
           
                  </p>
                  <p class="mt8">
                    <textarea name="message" id="message" autocomplete="off" cols="45" rows="12" class="p7" style="width:270px; height:116px" placeholder="Inquiry / Comments *" ><?php echo set_value('message');?></textarea><?php echo form_error('message');?>
                 </p>
                </div>
                <div class="cb"></div>
                <div class="fl mt8">
                  <input type="text" name="verification_code" id="verification_code" class="p7" style="width:100px;" placeholder="Word Verification *"  autocomplete="off"><?php echo form_error('verification_code');?> 
                </div>
                <div class="fl ml10">
                  <img src="<?php echo site_url('captcha/normal'); ?>" class="vam p1 mt10" alt=""  id="captchaimage"/> <a href="javascript:viod(0);" title="Change Verification Code"  ><img src="<?php echo theme_url(); ?>images/ref12.png"  alt="Refresh"  onclick="document.getElementById('captchaimage').src='<?php echo site_url('captcha/normal'); ?>/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('verification_code').focus();" class="ml10 vam"></a>
                      
                </div>
                <div class="cb"></div>
                <div class="mt10">
                  <input name="input" type="submit" value="Submit" class="btn4" >
                  <input name="input" type="reset" value="Reset" class="btn3">
                   <input type="hidden" name="product_id" value="<?php echo $productId;?>" />
                </div>
              </fieldset>
            </div>
          
           <?php echo form_close();?> 
           </div>
          <div class="default aj fr ml10 w32">
            <div class=" pl10">
              <p class="fl"><img src="<?php echo theme_url();?>images/logo.png" alt=""></p>
              <p class="cb"></p>
              <div class="fl">
                <h2 class="fs26 ttu red mt10">Head Office</h2>
                <p class="fs13 mt5"><strong class="red"> Office Hours : </strong><br>
                  10.00 AM TO 1.00 PM
                  AND 5.00 PM TO 8.00 PM <br>
                  Monday to Saturday [Sunday Closed]</p>
              </div>
              <p class="cb"></p>
              <p class="fs13 gray mt15"> <span class="red b ft-11">[Please call to schedule an appointment.]</span></p>
               <?php echo $content;?>
             
            </div>
            <p class="cb"></p>
          </div>
          <p class="cb"></p>
        </div>
        <p class="cb"></p>
      </div>
      <p class="lh0em ac"><img src="<?php echo theme_url();?>images/shadow.jpg" alt="" title=""></p>
    </div>
  </div>
</section>
<!--content section end--> 

<?php $this->load->view('bottom_application'); ?>