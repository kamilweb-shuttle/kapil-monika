<?php $this->load->view("top_application"); ?>
<div role="main" class="main">

    <!-- Begin page top -->
    <section class="page-breadcrumb">
        <div class="container">

            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>

                <li class="active">Ethinic Wear for Women</li>
            </ol>

        </div>
    </section>
    <!-- End page top -->

    <div class="container">

        <div class="row featured-boxes">
            <div class="col-md-8">
                <h3>Your selection (<?php echo count($this->cart->contents());  ?> Items)</h3>
                <div class="featured-box featured-box-cart">
                    <div class="box-content">
                        <form method="post" action="#">
                            <table cellspacing="0" class="shop_table" width="100%">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">
                                            Item
                                        </th>
                                        <th class="product-name">
                                            Product name
                                        </th>
                                        <th class="product-price">
                                            Price
                                        </th>
                                        <th class="product-quantity">
                                            Quantity
                                        </th>
                                        <th class="product-subtotal">
                                            SubTotal
                                        </th>
                                        <th class="product-remove">
                                            &nbsp;
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                                $i=1;
						$totweight=0;
						$shipcharge = "";
                                               // echo "<pre>";
                                              //  print_r($this->cart->contents());die;
                                                
                                                foreach ($this->cart->contents() as $items ){
                                                    $friendly_url = get_db_field_value('wl_products', 'friendly_url', array('products_id' => $items['pid']));
                                                    $link_url = base_url() . $friendly_url;
                                                    $quantity_available = "";
                                                    $size = $color = "";
                                                    if ($items['options']['Size'] != '') {
                                                    $size = size_name($items['options']['Size']);
                                                }
                                                if ($items['options']['Color'] != '') {
                                                $color = color_name($items['options']['Color']);
                            }
                                                   
                                    ?>
                                    <tr class="cart_table_item">

                                        <td class="product-thumbnail">
                                            <a href="javascript:void(0);" onClick="window.open('<?php echo $link_url; ?>', '_parent')"> <b class="fl thm_cont mr10"><img src="<?php echo get_image('products', $items['img'], '100', '80', 'R'); ?>" alt="" width="100" height="82"></a>
                                        </td>
                                        <td class="product-name">
                                            <a href="javascript:void(0)"><?php echo $items['origname']; ?></a>
                                        </td>
                                        <td class="product-price">
                                            <span class="amount"> 
                                        <p class="black fs15 mt2"><b class="red">
                                            <?php 
                                        if ($items['discount_price'] > 0) {
                                            echo display_price($items['discount_price']); 
                                        }else{
                                        echo display_price($items['product_price']);
                                        }
                                        ?></p></span>
                                        </td>
                                        <td class="product-quantity">

                                            <div class="quantity">
                                                <input type="button" class="minus" value="-">
                                                <input type="text" class="input-text qty text" title="Qty" value="<?php echo $items['qty']; ?>" name="quantity" min="1" step="1" readonly>
                                                
                                                <input type="button" class="plus" value="+">
                                            </div>

                                        </td>
                                        <td class="product-subtotal">
                                            <span class="amount"><?php echo display_price($items['qty'] * $items['price']); ?></span>
                                        </td>
                                        <td class="product-remove">
                                            <a title="Remove this item" data-rowid=<?php echo $items['rowid']  ?> class="remove remove_cart_item" href="javascript:void(0)">
                                                <i class="fa fa-times-circle"></i>
                                            </a>
                                        </td>
                                    </tr>
                                                <?php } ?>
                                    
                                </tbody>
                            </table>

                        </form>
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <?PHP 
                 $cart_total = $this->cart->total();
                        
                        $discount_amount = $this->session->userdata('discount_amount');
                        //$shipping_total  = 20;
                        $shipping_total = $this->cart_model->get_shipping($cart_total);
                        $cod_amount = $this->cart_model->get_cod($cart_total);
                        $discount_total = $discount_amount;
                        $grand_total = ($cart_total - $discount_total);
                ?>
                <div class="featured-box featured-box-secondary sidebar" style="margin-top: 42px;">
                    <div class="box-content">
                        <h4>Shopping bag summary</h4>
                        <table cellspacing="0" class="cart-totals" width="100%">
                            <tbody>
                                <tr class="cart-subtotal">
                                    <th>
                                        Cart Subtotal
                                    </th>
                                    <td class="product-price">
                                        <span class="amount"><?php echo display_price($grand_total); ?></span>
                                    </td>
                                </tr>
                                <tr class="shipping">
                                    <th>
                                        Shipping
                                    </th>
                                    <td>
                                        Free Shipping<input type="hidden" value="free_shipping" id="shipping_method" name="shipping_method">
                                    </td>
                                </tr>
                                <tr class="total">
                                    <th>
                                        Total
                                    </th>
                                    <td class="product-price">
                                        <span class="amount"><?php echo display_price($grand_total); ?></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p><input type="submit" value="Update Shopping Bag" class="btn btn-default btn-block btn-sm" data-loading-text="Loading..."></p>
                        
                        <p><a href="shop-checkout.html" class="btn btn-primary btn-block btn-sm" data-loading-text="Loading...">Proceed for Checkout</a>
                        
                        <p><input type="submit" value="Continue Shopping" class="btn btn-grey btn-block btn-sm" data-loading-text="Loading..."></p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>





<?php $this->load->view("bottom_application"); ?>




<script>
 $(".remove_cart_item").click(function(){
     obj=$(this);
     $.ajax({
         method:"post",
         url:'<?php echo base_url(); ?>cart/remove_item',
         data:{row_id:$(this).data('rowid')},
         success:function(){
           obj.closest('tr').remove();
         },
        
     })
 });
 
</script>