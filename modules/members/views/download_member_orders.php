<?php $this->load->view("top_application");
		$curr_symbol = display_symbol();
		$this->load->model('order/order_model');
		$condtion        = "AND customers_id = '".$this->userId."' && DATEDIFF(now(), order_received_date) >= '14'";			
		$res						 = $this->order_model->get_orders('NULL','NULL',$condtion);
?>
  <div class="bgBk white p5 b treb ttu pt7 mt5 ac">Order History</div>
 <?php 
    if( is_array($res) && !empty($res))
    {
    ?>  <div class="bgBk white p5 b treb ttu pt7 mt5">
          <table class="w100 white">
            <tr>
              <td  class="w10  al white"> S. No. </td>
              <td  class="w25 al white">OrdeR/invoice</td>
              <td class="ac w10 white">Amount (<strong><?php echo $curr_symbol;?></strong>)</td>
              <td class="ac w10 white" >status</td>
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
									<?php echo $val['invoice_number'];?></p>
                <p class="grey1 ver fs11"><?php echo getDateFormat($val['order_received_date'],3);?></p></td>
              <td class="ac w20"><strong><?php echo display_price($grand_total);?></strong></td>
              <td class="ac w10"><span class="i"><?php echo $val['payment_status'];?></span></td>
            </tr>
          </table>
        </div>
     <?php } 
				}
		?>  