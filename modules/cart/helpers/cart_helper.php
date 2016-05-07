<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('CI')){
	 
	function CI()
	{
		if (!function_exists('get_instance')) return FALSE;
		$CI =& get_instance();
		return $CI;
	}
}
 

function invoice_content ($ordmaster,$orddetail,$dlink=''){
	$ci = CI();
	$curr_symbol = display_symbol();
	$grandTotal = $ordmaster['total_amount']+$ordmaster['shipping_amount']+$ordmaster['cod_amount'];
	$admin_email  = get_site_email();		
	?>
 	<div class="mt15">
    <div class="inv_box2"> <img src="<?php echo theme_url(); ?>images/telepoint.png" class="img_responsive" alt=""></div>
    <div class="inv_box1 mt5">
      <p>
        <b>TELEPOINT</b><br>
        <?php echo nl2br($admin_email->address); ?><br>
        <span class="pt3">Email Us : <b class="red"><a href="#"><?php echo $admin_email->admin_email; ?></a></b></span> Phone : <?php echo $admin_email->phone; ?> 
      </p>
    </div>
    <div class="cb pb10"></div>
    
    <div class="inv_box3">
      <div class="b fs16 lht-20 bb mb10">Order Summary</div>
      <div class="mt5 lht-20 fs12">
        <b>Invoce No. : <?php echo $ordmaster['invoice_number']; ?></b><br>
        Dated : <?php echo getDateFormat($ordmaster['order_received_date'],2); ?>
      </div>
      <div class="mt10 fs12 lht-20">
        Subtotal Amount : <?php echo display_price($ordmaster['total_amount']); ?><br>
        Shipping Charge  : <?php echo display_price($ordmaster['shipping_amount']); ?><br>
        <?php
				if($ordmaster['cod_amount'] > 0){
					?>
        	COD Charge  : <?php echo display_price($ordmaster['cod_amount']); ?><br>
          <?php
				}
				?>
        <b class="fs13 lht-30 red">Total Payable Amount : <?php echo display_price($grandTotal); ?> </b>
      </div>
    </div>
    
    <div class="inv_box3 inv_box3_mar">
      <div class="b fs16 lht-20 bb mb10">Billing Details</div>
      <div class="mt5 lht-20 fs12"><b> <?php echo $ordmaster['billing_name']; ?></b></div>
      <div class="mt10 fs12 lht-20"><b>Address</b><br>
        <?php echo $ordmaster['billing_address']; ?>, <?php echo $ordmaster['billing_city']; ?>, <?php echo $ordmaster['billing_state']; ?>, <?php echo $ordmaster['billing_country']; ?> - <?php echo $ordmaster['billing_zipcode']; ?><br>
        <?php
				if($ordmaster['cod_amount'] > 0){
					?><div class="mt10 " style="height:40px;"><br /></div><?php
				}
				?>
      </div>
    </div>
    <div class="inv_box3">
      <div class="b fs16 lht-20 bb mb10">Shipping Details</div>
      <div class="mt5 lht-20 fs12"><b><?php echo $ordmaster['shipping_name']; ?></b></div>
      <div class="mt10 fs12 lht-20"><b>Address</b><br>
        <?php echo $ordmaster['shipping_address']; ?>, <?php echo $ordmaster['shipping_city']; ?>, <?php echo $ordmaster['shipping_state']; ?>, <?php echo $ordmaster['shipping_country']; ?> - <?php echo $ordmaster['shipping_zipcode']; ?><br>
        <?php
				if($ordmaster['cod_amount'] > 0){
					?><div class="mt10 " style="height:40px;"><br /></div><?php
				}
				?>
      </div>
    </div>
    <div class="cb"></div>
    
    <h3 class="mt20 b bb1 pb5">Product Details</h3>
    <div class="p15 white bg-black ttu fs14 cont_4_address mob_hider b">
      <div class="sec1">S. No.</div>
      <div class="sec2">Products</div>
      <div class="sec3">Amount</div>
      <div class="cb"></div>
    </div>
    <?php
    $i=1;
    $subtotal ='';
    $total='';
    //trace($orddetail);
    if(is_array($orddetail)	 && !empty($orddetail) ){
      foreach ($orddetail as $val){
        $sql= $ci->db->query("select * from wl_products_media where products_id='".$val['products_id']."'")->row_array();
        if(is_array($sql) && !empty($sql)){
          $img = $sql['media'];
        }
        else{
          $img='';
        }
        $subtotal = ( $val['quantity']*$val['product_price']);		  
        $total   += $subtotal;
        //trace($val);
        ?> 
        <div class="p15 bb cont_4_address mt15">
          <div class="sec1"><strong>S. No.</strong> <?php echo $i; ?>.</div>
          <div class="sec2">
            <p class="fs16 b"><b class="fl thm_cont mr10"><img src="<?php echo get_image('products',$img,'100','80','R'); ?>" alt="" width="100" height="82"></b><?php echo $val['product_name'];?>t</p>
            <p class="mt5 fs12">Product Code : <?php echo $val['product_code']; if($val['product_size']!=''){?> / Size : <?php echo $val['product_size']; } if($val['product_color']!=''){?> / Color : <?php echo $val['product_color']; }?></p>
            <p class="black fs15 mt2">Price: <b class="gray1 through normal"><span class="WebRupee">Rs.</span>50.00</b> <b class="red"><?php echo display_price($val['product_price']);?></b></p>
            <p class="mt7 fs11 verd">Quantity : <b><?php echo $val['quantity'];?></b></p>
            <div class="cb"></div>
          </div>
          <div class="sec3 b"> <strong>Amount :</strong> <?php echo display_price($subtotal);?> </div>
          <div class="cb"></div>
        </div>
        <!-- list 1 -->
        <?php
				$i++;
      }
    }
    /*$total_shiping   =  $ordmaster['shipping_amount'];
    $discount_amount =  $ordmaster['coupon_discount_amount'];
    $tax = $ordmaster['vat_amount'];
    $grand_total     = ($total-$discount_amount)+$total_shiping + $tax;
  
    $tax_cent = $ordmaster['vat_applied_cent'];
    $tax_cent_applied = fmtZerosDecimal($tax_cent);*/
    if($dlink == ''){
			?>
      <div class="cb bb1"></div>
    	<p class="mob_hider ac"><a href="<?php echo base_url(); ?>cart/print_invoice/<?php echo $ordmaster['order_id']; ?>" class="invoice1 btn2 radius-20b" style="padding:0 30px">Print Invoice</a></p>
      <?php
		}
		else{
			?>
      <br /><br />
      <div style="text-align:right; font:bold 14px/18px Arial, Helvetica, sans-serif; color:#333; padding:0 20px 15px 0">Sub Total : <?php echo display_price($grandTotal); ?></div>
      <?php
		}
		?>
  </div>   
  <?php
}

function invoice_content_print ($ordmaster,$orddetail )
{
	$ci = CI();
	$curr_symbol = display_symbol();
	$grandTotal = $ordmaster['total_amount']+$ordmaster['shipping_amount']+$ordmaster['cod_amount'];
	$admin_email  = get_site_email();		
	?>
 	<div>
    <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1">
      <tr>
        <td align="left">
        	<p style="padding-top:2px; margin:0px; color:#333; line-height:18px;">
        		<strong>Kapil Monika</strong><br>
        		<?php echo nl2br($admin_email->address); ?><br>
        		<span class="pt3">Email Us : <b class="red"><a href="#"><?php echo $admin_email->admin_email; ?></a></b></span> Phone : <?php echo $admin_email->phone; ?> 
      		</p>
        </td>  
        <td align="right" valign="middle" style="padding-right:10px;"><img src="<?php echo theme_url(); ?>images/telepoint.png" alt="" width="375" height="90"></td>
      </tr>
    </table>
    
    <div style="width:30%; border:10px solid #eee; padding:15px; min-height:170px; float:left">
    	<div style="font:bold 16px/20px Arial, Helvetica, sans-serif; color:#333; border-bottom:1px solid #ccc; margin-bottom:10px">Order Summary</div>
      <div style="margin-top:5px; font:normal 12px/20px Arial, Helvetica, sans-serif">
      	<b>Invoce No. : <?php echo $ordmaster['invoice_number']; ?></b><br>
        
        Dated : <?php echo getDateFormat($ordmaster['order_received_date'],2); ?>
      </div>
      
      <div style="margin-top:10px; font:normal 12px/20px Arial, Helvetica, sans-serif">
      	Subtotal Amount : <?php echo display_price($ordmaster['total_amount']); ?><br>
        Shipping Charge  : <?php echo display_price($ordmaster['shipping_amount']); ?><br>
        <?php
				if($ordmaster['cod_amount'] > 0){
					?>
        	COD Charge  : <?php echo display_price($ordmaster['cod_amount']); ?><br>
          <?php
				}
				?>
        <b style="font:bold 16px/30px Arial, Helvetica, sans-serif; color:#000">Total Payable Amount : <?php echo display_price($grandTotal); ?> </b>
      </div>
    </div>
    
    <div style="width:24.5%; border:10px solid #eee; padding:15px; min-height:170px; float:left; margin-left:20px">
    	<div style="font:bold 16px/20px Arial, Helvetica, sans-serif; color:#333; border-bottom:1px solid #ccc; margin-bottom:10px">Billing Details</div>
      <div style="margin-top:5px; font:normal 12px/20px Arial, Helvetica, sans-serif"><b><?php echo $ordmaster['billing_name']; ?></b></div>
      <div style="margin-top:10px; font:normal 12px/20px Arial, Helvetica, sans-serif">
      	<b>Address</b><br>
        <?php echo $ordmaster['billing_address']; ?>, <?php echo $ordmaster['billing_city']; ?>, <?php echo $ordmaster['billing_state']; ?>, <?php echo $ordmaster['billing_country']; ?> - <?php echo $ordmaster['billing_zipcode']; ?><br>
        <?php
				if($ordmaster['cod_amount'] > 0){
					?><div class="mt10 " style="height:40px;"><br /></div><?php
				}
				?>
      </div>
    </div>
    
    <div style="width:24.5%; border:10px solid #eee; padding:15px; min-height:170px; float:right;">
    	<div style="font:bold 16px/20px Arial, Helvetica, sans-serif; color:#333; border-bottom:1px solid #ccc; margin-bottom:10px">Shipping Details</div>
      
      <div style="margin-top:5px; font:normal 12px/20px Arial, Helvetica, sans-serif"><b><?php echo $ordmaster['shipping_name']; ?></b></div>
      <div style="margin-top:10px; font:normal 12px/20px Arial, Helvetica, sans-serif"><b>Address</b><br>
        <?php echo $ordmaster['shipping_address']; ?>, <?php echo $ordmaster['shipping_city']; ?>, <?php echo $ordmaster['shipping_state']; ?>, <?php echo $ordmaster['shipping_country']; ?> - <?php echo $ordmaster['shipping_zipcode']; ?><br>
        <?php
				if($ordmaster['cod_amount'] > 0){
					?><div class="mt10 " style="height:40px;"><br /></div><?php
				}
				?>
      </div>
    </div>
    <div class="cb"></div><br />
    
    <div style="font:bold 22px/20px 'Trebuchet MS', Arial, Helvetica, sans-serif; color:#000; margin-top:10px">Product Details</div>
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="1" style="margin-top:10px;">
        <tr style="font-size:13px; color:#fff; line-height:36px; background:#111">
          <td width="10%" align="center" style="line-height:20px; width:10%"><strong>S.No</strong></td>
          <td align="left" colspan="2"><strong>Products</strong></td>
          <td width="10%" align="center" style="width:10%"><strong>Amount</strong></td>
        </tr>
        <tr align="center">
          <td colspan="4" valign="top" ><img src="<?php echo theme_url();?>images/spacer.gif" width="1" height="1" alt=""></td>
        </tr>
        <?php
        $i=1;
        $subtotal ='';
        $total='';
        //trace($orddetail);
        if(is_array($orddetail)	 && !empty($orddetail) ){
          foreach ($orddetail as $val){
            $sql= $ci->db->query("select * from wl_products_media where products_id='".$val['products_id']."'")->row_array();
            if(is_array($sql) && !empty($sql)){
              $img = $sql['media'];
            }
            else{
              $img='';
            }
            $subtotal = ( $val['quantity']*$val['product_price']);		  
            $total   += $subtotal;
            //trace($val);
            ?>
            <tr>
              <td align="center" valign="top" style="border-bottom:1px solid #ddd; padding-bottom:10px;">1.</td>
              <td align="left" valign="top" style="border-bottom:1px solid #ddd; padding-bottom:10px;"><img src="<?php echo get_image('products',$img,'100','80','R'); ?>" alt="" width="100" height="82" style="margin-right:10px; border:1px solid #ccc; padding:5px"></td>
              <td align="left" valign="top" style="border-bottom:1px solid #ddd; padding-bottom:10px;"><p style="color:#333; font-size:13px; padding-top:5px; margin:0px; line-height:18px"> <strong style="font-size:18px"><?php echo $val['product_name'];?></strong> <span style="font-size:11px; display:block; padding-top:8px; font-family:Verdana, Geneva, sans-serif">Product Code : <?php echo $val['product_code'];if($val['product_size']!=''){?> / Size : <?php echo $val['product_size']; } if($val['product_color']!=''){?> / Color : <?php echo $val['product_color']; }?><br>
                Unit Price: <span style="color:red; text-decoration:line-through"><?php echo display_price($val['product_price']);?></span> <b><?php echo display_price($val['product_price']);?></b> / Quantity : <b><?php echo $val['quantity'];?></b></span></p></td>
              <td align="center" valign="top" style="width:10%; border-bottom:1px solid #ddd; padding-bottom:10px;"><strong><?php echo display_price($val['product_price']*$val['quantity']);?></strong></td>
            </tr>
            <tr align="center">
              <td colspan="4" valign="top" ><img src="<?php echo theme_url();?>images/spacer.gif" width="1" height="1" alt=""></td>
            </tr>
            <!-- list 1 -->
            <?php
            $i++;
          }
        }
        ?>
      </table>
      <br>  
      <?php
      /*$total_shiping   =  $ordmaster['shipping_amount'];
      $discount_amount =  $ordmaster['coupon_discount_amount'];
      $tax = $ordmaster['vat_amount'];
      $grand_total     = ($total-$discount_amount)+$total_shiping + $tax;
    
      $tax_cent = $ordmaster['vat_applied_cent'];
      $tax_cent_applied = fmtZerosDecimal($tax_cent);*/
      ?>
      <div style="text-align:right; font:bold 14px/18px Arial, Helvetica, sans-serif; color:#333; padding:0 20px 15px 0">Sub Total : <?php echo display_price($grandTotal); ?></div>
    </div>
  </div>
  <?php
}