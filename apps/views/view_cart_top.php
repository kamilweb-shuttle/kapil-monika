<?php
if($this->cart->total_items() > 0 ){
	//  echo form_open('cart/','name="cart_frm" id="cart_frm"');?>  
  <div class="w100 rel">
    <div class="dd_cont"> 
      <img src="<?php echo theme_url(); ?>images/tuki.png" width="41" height="26" class="fr" alt="">
      <div class="dd_cont1 mt25">
        <h2 class="mb15 red fs20 bb pb2">Your Cart Items</h2>
        <div class="pr10" style="height:182px; overflow-y:scroll">
					<?php	   
          $i=1;
          $totweight=0;
          $shipcharge = "";
          foreach($this->cart->contents() as $items){
            //trace($items);
            $friendly_url=get_db_field_value('wl_products','friendly_url',array('products_id' =>$items['pid']));
            $link_url=base_url().$friendly_url; 			 
            
            $quantity_available = "";
            
            ?>  
            <div class="bb2 pb10 <?php if($i > 1) echo 'mt15'; ?>">
              <p class="fs11 tahoma black b"><a href="<?php echo $link_url;?>"><b class="fl mr8 thm_cont_s"><img src="<?php echo get_image('products',$items['img'],'80','65','R'); ?>" alt="" width="80" height="65"></b>5 Mukhi Rudraksha Pendant</a></p>
              <p class="pt3 grey1 lht-15 fs11">
                Product Code : 
                Product Code : <?php echo $items['code'];?>
                <?php 
								if($items['options']['Size']!='' && $items['options']['Color']!=''){
									$size = size_name($items['options']['Size']);
									$color = color_name($items['options']['Color']);
									echo ' / Size : '.$size;
									echo ' / Color : '.$color;
								}
								?>
              </p>
              <?php
              if($items['discount_price'] > 0){
                ?>
                <p class="fs12 mt8">Price : <b class="gray through normal"><?php echo display_price($items['product_price']); ?></b> <b class="red"><?php echo display_price($items['discount_price']); ?></b></p>
                <?php
              }
              else{
                ?>
                <p class="fs12 mt8">Price: <b class="red"><?php echo display_price($items['product_price']); ?></b></p>
                <?php
              }
              ?>
              <p class="fs11">Quantity : <?php echo $items['qty']; ?>, Sub Total : <b><?php echo display_price($items['qty']*$items['product_price']);?></b></p>
              <div class="cb"></div>
            </div>
            <?php
            $i++;
          }
          $tax_cent 		= $this->cart_model->get_vat();
          $cart_total   = $this->cart->total();
          $tax					= ($cart_total*$tax_cent)/100;
    
          $tax_cent_applied = fmtZerosDecimal($tax_cent);
    
          $discount_amount = $this->session->userdata('discount_amount');
          $set_shipping_id = $this->session->userdata('shipping_id');		
          //$shipping_res    =  $this->cart_model->get_shipping_rate( $set_shipping_id );
          //$shipping_total  = 20;<br />
          $shipping_total 	= $this->cart_model->get_shipping($cart_total);
          $cod_amount 	= $this->cart_model->get_cod($cart_total);
          $discount_total  = $discount_amount;
          $grand_total     = ($cart_total-$discount_total)+$shipping_total+$tax;
          //	trace($this->session->userdata);
          ?>    
        </div>
    		<p class="fr mt35 mr40 ttu pt3 purple"><a href="<?php echo base_url(); ?>cart" class="underline atc_btn">«Edit Items</a></p>
    		<p class="mt10 lht-24">
        	<?php
					if($shipping_total > 0){
						?>
      			<span class="dib w36 ar">Shipping </span> : <strong><?php echo display_price($shipping_total);?></strong>
      			<br>
            <?php
					}
					?>
      		<span class="dib w36 ar">Total Amount</span> : <strong class="fs20"> <?php echo display_price($grand_total);?></strong>
    		</p>
		    <p class="mt20 bt pt11 ar">
    		  <input name="input2" type="button" class="btn1 radius-3" value="Checkout" style="padding:0px 30px" onClick="window.location.href=('<?php echo base_url(); ?>cart/checkout')">
		    </p>
		    <div class="cb"></div>
    		<?php //echo form_close();
		  } 
			?>
		</div>
  </div>
</div>