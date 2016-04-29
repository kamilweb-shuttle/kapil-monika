<?php $this->load->view("top_application"); ?>
<?php
$values_posted_back = (is_array($this->input->post())) ? TRUE : FALSE;
$is_same = $values_posted_back === TRUE ? $this->input->post('is_same') : '';
//trace($mres);
?>

  <section class="wrapper">
    <div class="inner_wrapper pt40">
      <div class="checkout_container">
        <div class="box1 fl">
          <div class="border2 rel"><img src="<?php echo theme_url(); ?>images/success.png" class="abs" style="left:-23px; top:-14px" alt="">
            <p class="bg-gray p10 green fs16 b">1. Email ID / Login!</p>
          </div>          
          <!-- slide 1 -->
          <div class="border2x mt10">
            <p class="bg-green p10 white fs16 b">2. Delivery Information</p>
            <div class="shadow3" style="min-height:320px">
              <div class="cb pb10"></div>
              <?php
              echo form_open('cart/delivery_info');
              error_message();
							?>
                <div class="short_form">
                  <p class="b fs14 mb15 ttu w62">Enter Your Delivery Information
                    <?php
                    if($this->auth->is_user_logged_in()){
                      ?>
                      , <b class="red">OR</b>
                      <span class="mt5 db"><a href="<?php echo base_url(); ?>members/view_my_addresses" class="btn6 address_pup radius-25">Select From Address Book</a></span>
                    <?php
                    }
                    ?>
                  </p>                  
                  <div class="cb"></div>
                  <fieldset class="pb15" style="border:0;">
                    <p class="w36 pt8">
                      <label for="name">Name <b class="red">*</b> </label>
                    </p>
                    <div class="w62">
                      <input name="name" id="name" value="<?php echo set_value('name', $mres['name']);?>" type="text">
                      <?php echo form_error('name');?>
                    </div>
                    <div class="cb pb7"></div>
                    <p class="w36 pt8">
                      <label for="mobile"> Mobile No. <b class="red">*</b> </label>
                    </p>
                    <div class="w62">
                      <input name="mobile" id="mobile" value="<?php echo set_value('mobile', $mres['mobile']);?>" type="text">
                      <?php echo form_error('mobile');?>
                    </div>
                    <div class="cb pb7"></div>
                    <p class="w36 pt8">
                      <label for="phone"> Phone No. </label>
                    </p>
                    <div class="w62">
                      <input name="phone" id="phone" value="<?php echo set_value('phone', $mres['phone']);?>" type="text">
                      <?php echo form_error('phone');?>
                    </div>
                    <div class="cb pb7"></div>
                    <p class="w36 pt8">
                      <label for="pincode"> Pin Code <b class="red">*</b> </label>
                    </p>
                    <div class="w62">
                      <input name="zipcode" id="zipcode" value="<?php echo set_value('zipcode', $mres['zipcode']);?>" type="text">
                      <?php echo form_error('zipcode');?>
                    </div>
                    <div class="cb pb7"></div>
                    <p class="w36 pt8">
                      <label for="address"> Address <b class="red">*</b> </label>
                    </p>
                    <div class="w62">
                      <textarea name="address" rows="3" id="address"><?php echo set_value('address', $mres['address']);?></textarea>
                      <?php echo form_error('address');?>
                    </div>
                    <div class="cb pb7"></div>
                    <p class="w36 pt8">
                      <label for="landmark"> Landmark <b class="red">*</b> </label>
                    </p>
                    <div class="w62">
                      <textarea name="landmark" rows="2" id="landmark"><?php echo set_value('landmark', $mres['landmark']);?></textarea>
                      <?php echo form_error('landmark');?>
                    </div>
                    <div class="cb pb7"></div>
                    <p class="w36 pt8">
                      <label for="city"> City <b class="red">*</b> </label>
                    </p>
                    <div class="w62">
                      <input name="city" id="city" value="<?php echo set_value('city', $mres['city']);?>" type="text">
                      <?php echo form_error('city');?>
                    </div>
                    <div class="cb pb7"></div>
                    <p class="w36 pt8">
                      <label for="state"> State/Region <b class="red">*</b> </label>
                    </p>
                    <div class="w62">
                      <input name="state" id="state" value="<?php echo set_value('state', $mres['state']);?>" type="text">
                      <?php echo form_error('state');?>
                    </div>
                    <div class="cb pb7"></div>
                    <p class="w36 pt8">
                      <label for="country"> Country <b class="red">*</b> </label>
                    </p>
                    <div class="w62">
                      <?php echo CountrySelectBox(array('name'=>'country','format'=>'','current_selected_val'=>set_value('country', $mres['country']) )); ?>
                      <?php echo form_error('country');?>
                    </div>
                    <div class="cb"></div>
                  </fieldset>
                  <p class="w62"> 
                    <?php
                    if($this->auth->is_user_logged_in()){
                      ?>
                      <span class="db mb10">
                        <input name="default_address" id="def_addr" type="checkbox" value="<?php echo $mres['address_id']; ?>" class="fl mr5 mt3" />
                        Make this as your default address
                      </span>
                      <?php
                    }
                    ?>
                    <input name="register_me" type="submit" value="Continue &gt;" class="btn2 radius-3 shadow1" />
                  </p>
                  <div class="cb pb20"></div>
                </div>
              <?php echo form_close(); ?>
              <div class="cb pb20"></div>
            </div>
          </div>          
          <!-- slide 2 -->          
          <div class="border2 mt10">
            <p class="bg-gray p10 black fs16 b">3. Make Payment</p>
          </div>
          <!-- slide 3 --> 
        </div>
        <!-- left ends -->
        <?php $this->load->view('view_cart_right');?>
        <!-- right ends -->
        <div class="cb"></div>
      </div>
      <br>
    </div>
  </section>
<?php $this->load->view("bottom_application"); ?>