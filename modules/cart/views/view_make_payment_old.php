<?php $this->load->view("top_application");?>
<div class="container"><!--Container-Starts-->
  <section class="lh18px aj"><!--Content--Starts-->
    <h1>Make Payment</h1>
    <p class="tree"><a href="<?php echo base_url();?>">Home</a> Make Payment</p>
    <div class="p10  mt10">
      <p class="step-three mt10 ac">&nbsp;</p>
      <div class="mt10 aj p10  radius-5">
        <div class="mt5">
 	      <?php echo form_open('payment');?>
          <table class="w100 bdrAll1" >
            <tr>
              <td><div class="p10 mb10 shadow1">
   <?php	$page_content = get_db_field_value('wl_cms_pages','page_description'," AND friendly_url='payment_page' AND status='1'"); ?>
                <p class="b fs13 red">Select a payment method</p>
                <div class="fs11 verd pt5"><?php echo $page_content;?></div>
              </div></td>
            </tr>
            <tr>
              <td class="ac"><table align="center"  class="ac w80 bgW">
                <tr>
                  <td><input type="radio" name="pay_method" id="radio" value="paypal" checked="checked" />
           						 <img src="<?php echo theme_url(); ?>images/mycrd1.png" alt="" class="vam" /></td>
                  <td><input type="radio" name="pay_method" id="radio1" value="paypal" />
          						 <img src="<?php echo theme_url(); ?>images/mycrd2.png" alt="" class="vam" /></td>
                  <td><input type="radio" name="pay_method" id="radio2" value="cash" />
            					 <img src="<?php echo theme_url(); ?>images/mycrd3.png" alt="" class="vam" /></td>
                  <td><input type="radio" name="pay_method" id="radio3" value="paypal" />
            					 <img src="<?php echo theme_url(); ?>images/mycrd4.png" alt="" class="vam" /></td>
                  <td><input type="radio" name="pay_method" id="radio4" value="paypal" />
            					 <img src="<?php echo theme_url(); ?>images/mycrd5.png" alt="" class="vam" /></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td  class="pt35 ac"><input name="input" type="submit" class="btn-bg2" value="Make Payment" /></td>
            </tr>
          </table>
    <?php echo form_close();?>  
        </div>
      </div>
    </div>
    <!--Content-Ends--></section>
  <div class="cb"></div>
  <!--Container-Ends--></div>
<?php $this->load->view("bottom_application");?>