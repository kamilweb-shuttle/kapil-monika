<?php //$this->load->view("top_application");

	//	$curr_symbol = display_symbol();
?>
 <?php echo 'sdfg sdfg sdf gsdfg sdfg sdg sdf gsdf gsdf gsdgf'; 
    trace($res);
    if( is_array($res) && !empty($res))
    {
    ?>  <div class="bgBk white p5 b treb ttu pt7 mt5">
          <table class="w100">
            <tr>
              <td  class="w10  al"> S. No. </td>
              <td  class="w25 al">OrdeR/invoice</td>
              <td class="ac w10">Amount (<strong><?php echo $curr_symbol;?></strong>)</td>
              <td class="ac w10" >status</td>
            </tr>
          </table>
        </div>
			<?php
        $i=1;
        foreach($res as $val)
        {
          $total           =  $val['total_amount'];
          $discount_total  =  $val['coupon_discount_amount'];
          $shipping_total  =  $val['shipping_amount'];
          $tax = $val['vat_amount'];
    
          $grand_total      = ($total-$discount_total)+$shipping_total+$tax;			
        ?>   
        <div class="mt7">
          <table class="bdrAll w100">
            <tr>
              <td class="w10 al"><?php echo $i++;?>.</td>
              <td class="w28 al"><p class="black b">
              	<a href="<?php echo base_url();?>members/print_invoice/<?php echo $val['order_id'];?>" class="invoice">	
									<?php echo $val['invoice_number'];?></a></p>
                <p class="grey1 ver fs11"><?php echo getDateFormat($val['order_received_date'],3);?></p></td>
              <td class="ac w20"><strong><?php echo display_price($grand_total);?></strong></td>
              <td class="ac w10"><span class="i"><?php echo $val['payment_status'];?></span></td>
            </tr>
          </table>
        </div>
     <?php } 
				}
		?>  
<?php $this->load->view("bottom_application");?>