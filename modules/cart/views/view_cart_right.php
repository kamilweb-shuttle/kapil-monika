<div class="box2">
	<h3>Your Cart Items</h3>
	<?php 
  if($this->cart->total_items() > 0 ){
		//  echo form_open('cart/','name="cart_frm" id="cart_frm"');?>  
		<div class="mt10">
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
        <div class="border1 p10 radius-3 mt5">
        	<p class="fs11 tahoma black b"> 
          	<a href="<?php echo base_url();?>cart/remove_item/<?php echo $items['rowid'];?>" title="Remove"><img src="<?php echo theme_url();?>images/m-no.png" class="fr" alt="remove" /></a> 
            <a href="<?php echo $link_url;?>"><?php echo $items['origname'];?></a>
          </p>
          <p class="pt3 grey1 lht-15 fs11">
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
	        <p class="fs11">Quantity : <?php echo $items['qty']; ?>, Sub Total : <b><?php echo display_price($items['subtotal']);?></b></p>
          <div class="cb"></div>
        </div>
        <?php
				$i++;
      }
     	$tax_cent = $this->cart_model->get_vat();
     	$cart_total      = $this->cart->total();
     	$tax = ($cart_total*$tax_cent)/100;

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
  	<div class="ar">
    	<?php 
			if($shipping_total > 0){
				?>  
      	<p class="mt10 mb5 fs12">Shipping Charges : <?php echo display_price($shipping_total);?></p>
    		<?php
      }
      if($discount_total > 0){
				?>   
      	<p class="mt5 mb5 fs12">Tax : <?php echo display_price($discount_total);?></p>
        <?php
      }
			?>  
      <p class="b mt10 black fs16 mb5">Estimated Total : <?php echo display_price($grand_total);?></p>
  	</div>
		<?php //echo form_close();
  } 
	?>
</div>