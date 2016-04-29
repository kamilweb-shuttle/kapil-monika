<?php 
$this->load->view("top_application");

	?>
  <section class="wrapper">
    <div class="inner_wrapper pt40">
      <div class="checkout_container">
        <div class="box1 fl">
          <div class="border2 rel"><img src="<?php echo theme_url(); ?>images/success.png" class="abs" style="left:-23px; top:-14px" alt="">
            <p class="bg-gray p10 green fs16 b">1. Email ID / Login!</p>
          </div>
          <!-- slide 1 -->
          <div class="border2 rel mt10"><img src="<?php echo theme_url(); ?>images/success.png" class="abs" style="left:-23px; top:-14px" alt="">
            <p class="bg-gray p10 green fs16 b">2. Delivery Information</p>
          </div>
          <!-- slide 2 -->
          <div class="border2x mt10">
            <p class="bg-green p10 white fs16 b">3. Make Payment</p>
            <div class="shadow3" style="min-height:320px">
              <div class="cb pb25"></div>
              <p class="fs18 mb10 ml10">
              	Payable Amount : 
                <b class="red"><?php $total = $this->cart->total()+$this->cart_model->get_shipping($this->cart->total()); echo display_price($total); ?></b>
              </p>
              <?php 
							echo form_open('cart/make_payment');
							echo validation_message();
							echo error_message();
							$postedData = $this->session->userdata('posted_data');
							?>
                <div class="m15 border1 radius-5 o-hid bg-gray">
                  <div class="payment_left mob_hider">
                    <p class="pay_links tabs1"> 
                      <a href="#credit" id="credit_card" class="act">Credit Card</a> 
                      <a href="#debit" id="debit_card">Debit Card</a> 
                      <a href="#net" id="netbanking">Net Banking</a> 
                      <a href="#cash"  id="cod">Cash on Delivery</a>
                    </p>
                  </div>
                  <!-- links ends -->                
                  <div class="payment_right">
                    <div class="tabs_cont" id="credit">
                      <h2 class="mb10 mob_only">Credit Card</h2>
                      <p class="fs14 b">Select a Card Type to Continue</p>
                      <label class="fs14 mt10 p10 border2 bg-white db mr10 radius-5">
                        <input name="credit_type" id="credit_visa" type="radio" value="Visa Card" class="vam credittype">
                        <img src="<?php echo theme_url(); ?>images/Visa.png" class="vam" alt=""> Visa Card </label>
                      <label class="fs14 mt10 p10 border2 bg-white db mr10 radius-5">
                        <input name="credit_type" id="credit_master" type="radio" value="Master Card" class="vam">
                        <img src="<?php echo theme_url(); ?>images/Mastercard.png" class="vam" alt=""> Master Card </label>
                      <label class="fs14 mt10 p10 border2 bg-white db mr10 radius-5">
                        <input name="credit_type" id="credit_amex" type="radio" value="American Express" class="vam">
                        <img src="<?php echo theme_url(); ?>images/Amex.png" class="vam" alt=""> American Express Card </label>
                        <p class="mt10">
                          <input name="register_me" type="submit" value="Complete My Order &gt;" class="btn2 radius-3 shadow1 complete_order_credit" />
                        </p>
                    </div>
                    <!-- tab1 -->
                    
                    <p class="b red fs18 mt25 mob_only">OR</p>
                    <div class="tabs_cont tabs_hider" id="debit">
                      <h2 class="mb10 mob_only">Debit Card</h2>
                      <p class="fs14 b mob_hider">Debit Card</p>
                      <p class="mt5 fs11 b green">List of supported Debit Cards &amp; respective verification codes needed:</p>
                      <div class="mt10 mylist">
                        <p>All VISA debit cards issued in India (VBV)</p>
                        <p>All MasterCard debit cards issued in India (MasterCard Secure)</p>
                        <p>Canara Bank debit cards (ATM PIN)</p>
                        <p>Citibank debit cards (iPIN)</p>
                        <p>Indian Overseas bank debit cards (ATM PIN)</p>
                        <p>Punjab National Bank debit cards (ATM PIN)</p>
                        <p>State Bank Of India debit cards (ATM PIN)</p>
                        <p>Union Bank Of India debit cards (ATM PIN)</p>
                      </div>
                      <p class="mt25">
                        <input name="register_me" type="submit" value="Complete My Order &gt;" class="btn2 radius-3 shadow1 complete_order_debit" />
                      </p>
                    </div>
                    <!-- tab2 -->
                    
                    <p class="b red fs18 mt25 mob_only">OR</p>
                    <div class="tabs_cont tabs_hider" id="net">
                      <h2 class="mb10 mob_only">Net Banking</h2>
                      <p class="fs14 b pb10">Continue with Net Banking</p>
                      <p class="mt20 fl w25 pt3">Select your Bank</p>
                      <p class="mt20 fl w72">
                        <select name="select_bank" id="select_bank" class="p7 w100">
                          <option value="">--Please Select--</option>
                          <option value="HDEB_N">HDFC Bank</option>
                          <option value="UTI_N">AXIS Bank</option>
                          <option value="SBI_N">State Bank of India</option>
                          <option value="IDEB_N">ICICI Bank</option>
                          <option value="CBIBAN_N">Citibank</option>
                          <option value=""> ----------------- </option>
                          <option value="SBM_N">State Bank of Mysore</option>
                          <option value="SBH_N">State Bank of Hyderabad</option>
                          <option value="NPNB_N">Punjab National Bank Retail Accnt</option>
                          <option value="UBI_N">United Bank of India</option>
                          <option value="CITIUB_N">City Union Bank</option>
                          <option value="UNI_N">Union Bank of India</option>
                          <option value="VJYA_N">Vijaya Bank</option>
                          <option value="IOB_N">Indian Overseas Bank</option>
                          <option value="KTKB_N">Karnataka Bank</option>
                          <option value="BOM_N">Bank of Maharashtra</option>
                          <option value="CAN_N">Canara Bank</option>
                          <option value="COP_N">Corporation Bank</option>
                          <option value="IDBI_N">IDBI Bank</option>
                          <option value="PNBCO_N">Punjab National Bank Corp Accnt</option>
                          <option value="NKMB_N">Kotak Mahindra Bank</option>
                          <option value="CSB_N">Catholic Syrian Bank</option>
                          <option value="DEUNB_N">Deutsche Bank</option>
                          <option value="DCB_N">DCB Bank </option>
                          <option value="BOB_N">Bank of Baroda Retail Accnt</option>
                          <option value="SYNBK_N">Syndicate Bank</option>
                          <option value="BOBCO_N">Bank of Baroda Corp Accnt</option>
                          <option value="NIIB_N">IndusInd Bank</option>
                          <option value="SBT_N">State Bank of Travancore</option>
                          <option value="KVB_N">Karur Vysya Bank</option>
                          <option value="YES_N">YES Bank</option>
                          <option value="1143">Indian Bank</option>
                          <option value="BOI_N">Bank of India</option>
                          <option value="FDEB_N">Federal Bank</option>
                          <option value="ING_N">ING Vysya Bank</option>
                          <option value="SCB_N">Standard Chartered Bank</option>
                          <option value="JKB_N">Jammu &amp; Kashmir Bank</option>
                          <option value="1147">Central Bank of India</option>
                          <option value="TNMB_N">Tamilnad Mercantile Bank</option>
                          <option value="BBK_N">Bank of Bahrain &amp; Kuwait</option>
                          <option value="SIB_N">South Indian Bank</option>
                          <option value="OBPRF_N">Oriental Bank of Commerce</option>
                          <option value="LVB_N">Lakshmi Vilas Bank</option>
                          <option value="AND_N">Andhra Bank</option>
                        </select>
                      </p>
                      <div class="cb pb10"></div>
                      <p class="ml100 pl5">
                        <input name="register_me" type="submit" value="Complete My Order &gt;" class="btn2 radius-3 shadow1 complete_order_netbanking" />
                      </p>
                    </div>
                    <!-- tab3 -->
                    
                    <p class="b red fs18 mt25 mob_only">OR</p>
                    <div class="tabs_cont tabs_hider" id="cash">
                      <h2 class="mb10 mob_only">Cash On Delivery</h2>
                      <p class="fs14 b">Pay using Cash On Delivery</p>
                      <?php
											$zc=$this->db->query("select zip_code, cod from tbl_zip_location where zip_code='".$postedData['zipcode']."' AND status='1'")->row_array();	
											//trace($zc);
											if(!empty($zc)){
												if($zc['cod'] == 'Y'){
													?>
  		                    <p class="fs12 mt15">COD Charges : <b><?php echo display_price($this->cart_model->get_cod($this->cart->total())); ?></b></p>
    		                  <p class="fs12">Total Payable Amount : <b><?php $total = $this->cart->total()+$this->cart_model->get_shipping($this->cart->total())+$this->cart_model->get_cod($this->cart->total()); echo display_price($total); ?></b></p>
                          <br>
                          <p class="fl w25 pt3 mt20">Enter Code</p>
                          <div class="fl w72 mt20">
                            <input name="verification_code" id="verification_code" type="text" class="w90 vam p7" />
                            <p class="mt5"><img src="<?php echo site_url('captcha/normal');?>" id="captchaimage" class="vam" alt=""> <img src="<?php echo theme_url(); ?>images/ref.png" onclick="document.getElementById('captchaimage').src='<?php echo site_url('captcha/normal'); ?>/<?php echo uniqid(time()); ?>'+Math.random(); document.getElementById('verification_code').focus();" class="vam" alt=""></p>
                          </div>
                          <p class="ml100 pl5">
                            <input name="register_me" type="submit" value="Complete My Order &gt;" class="btn2 radius-3 shadow1 complete_order_cod" />
                          </p>
                   	     <?php
												}
												else{
													?>
                          <p class="fs12 mt15">COD not available at your location!!!</p>
                          <?php
												}
											}
											else{
												?>
												<p class="fs12 mt15">COD not available and not serviceable at your location!!!</p>
												<?php
											}
											?>
                      <div class="cb pb10"></div>
                    </div>
                    <!-- tab4 --> 
                  </div>
                  <div class="cb pb25"></div>
                  <input type="hidden" name="pay_method" id="pay_method" value="" />
                </div>
              <?php echo form_close();?>  
              <p class="ac pb20"><b class="red">Note : </b>Your Order Information will be sent to your email id <b>(<?php echo $this->session->userdata('username'); ?>)</b></p>
            </div>
            
            <!-- slide 3 --> 
            
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
  <script type="text/javascript">
		$(document).ready(function(){
			$('.complete_order_credit').click(function(e){
				//e.preventDefault();
				var pay_type = 'credit_card';//$('.payment_left .act').attr('id');
				$('#pay_method').val(pay_type);
				if(pay_type == 'credit_card' && $('[id ^="credit_"]:checked').length==0){					
					$('.credittype').validationEngine('showPrompt', 'Please Select Credit Card', 'error', true);
					$('.credittype').focus();
					return false;	
				}
				if(cmp_ref==''){
					cmp_ref='xxx';	
				}
			});
			
			
			$('.complete_order_debit').click(function(e){
				//e.preventDefault();
				var pay_type = 'debit_card';//$('.payment_left .act').attr('id');
				$('#pay_method').val(pay_type);
				
				if(pay_type == 'debit_card'){
					/**/
				}
				if(cmp_ref==''){
					cmp_ref='xxx';	
				}
			});
			
			$('.complete_order_netbanking').click(function(e){
				//e.preventDefault();
				var pay_type = 'netbanking';//$('.payment_left .act').attr('id');
				$('#pay_method').val(pay_type);
				if(pay_type == 'netbanking' && $('#select_bank').val()==''){					
					$('#select_bank').validationEngine('showPrompt', 'Please Select Your Bank', 'error', true);
					$('#select_bank').focus();
					return false;	
				}
				if(cmp_ref==''){
					cmp_ref='xxx';	
				}
			});
			
			$('.complete_order_cod').click(function(e){
				//e.preventDefault();
				var pay_type = 'cod';//$('.payment_left .act').attr('id');
				$('#pay_method').val(pay_type);				
				if(pay_type == 'cod' && $('#verification_code').val()==''){					
					$('#verification_code').validationEngine('showPrompt', 'Please Enter Valid Code', 'error', true);
					$('#verification_code').focus();
					return false;	
				}
				if(cmp_ref==''){
					cmp_ref='xxx';	
				}
			});
		});
		//})(jQuery);
	</script>
<?php $this->load->view("bottom_application");?>