<header>
<div id="top">
    <div class="container">
        <p class="pull-left text-note">Free Shipping on all U.S orders over $50</p>
          
        <ul class="nav nav-pills nav-top navbar-right">
            <li class="dropdown my-account">
                <?php if($this->session->userdata('user_id')!=''){ ?>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                   
                    <li><a href="<?php echo base_url()."members/myaccount" ?>">Account Information</a></li>
                    <li><a href="<?php echo base_url()."members/orders_history" ?>">My Orders</a></li>
                   
                    <li><a id="user_logout" href="javascript:void(0)">Logout</a></li>
                 
                </ul>
              <?php }else{?>
                  <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Welcome Guest <span class="caret"></span></a>
             <?php  } ?>
            </li>
            
                
            
            <li class="dropdown menu-shop">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-shopping-cart"></i> <span class="shopping-bag"><?php echo  count($this->cart->contents()) ?></span></a>
                <div class="dropdown-menu">
                    <?php if (count($this->cart->contents())<=0){ ?>
                    <h3>No Item(s) in your cart</h3>
                     <ul class="list-unstyled list-thumbs-pro">
                        <li class="product">
                            <div class="product-thumb-info">
                                
                                <div class="product-thumb-info-image"></div>
                                <div class="product-thumb-info-content"></div>
                            </div>
                        </li>
                        </ul>
                    <?php }else{ ?>
                    <h3>Recently added item(s)</h3>
                    <ul class="list-unstyled list-thumbs-pro">
                        <li class="product">
                            <div class="product-thumb-info">
                                
                                <div class="product-thumb-info-image"></div>
                                <div class="product-thumb-info-content"></div>
                            </div>
                        </li>
                              <?php  foreach ($this->cart->contents() as $items ){
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
                        <li class="product">
                            <div class="product-thumb-info">
                                <a href="#" class="product-remove"><i class="fa fa-trash-o"></i></a>
                                <div class="product-thumb-info-image">
                                    <a href="<?php echo $link_url; ?>"><img alt="" width="60" src="<?php echo get_image('products', $items['img'], '100', '80', 'R'); ?>"></a>
                                </div>
                                <div class="product-thumb-info-content">
                                    <h4><a href="shop-product-detail1.html"><?php echo $items['origname']; ?></a></h4>
                                    <span class="item-cat"><small><a href="#"></a></small></span>
                                    <span class="price">(<?php  echo $items['qty'] ?> Items )  <?php 
                                        if ($items['discount_price'] > 0) {
                                            echo display_price($items['discount_price']); 
                                        }else{
                                        echo display_price($items['product_price']);
                                        }
                                        ?></span>
                                </div>
                            </div>
                        </li>
                              <?php } ?>
                        </ul>
                     <?PHP 
                        $cart_total = $this->cart->total();
                        
                        $discount_amount = $this->session->userdata('discount_amount');
                        //$shipping_total  = 20;
                        
                        
                        $discount_total = $discount_amount;
                        $grand_total = ($cart_total - $discount_total);
                ?>
                    
                    <ul class="list-inline cart-subtotals text-right">
                        <li class="cart-subtotal"><strong>Subtotal</strong></li>
                        <li class="price"><span class="amount"><strong><?php echo display_price($grand_total); ?></strong></span></li>
                    </ul>
                    <div class="cart-buttons text-right">
                        <a href="<?php echo site_url() ?>cart/" class="btn btn-white">View Cart</a>
                        <a href="<?php echo site_url() ?>cart/checkout_user"class="btn btn-primary">Checkout</a>
                    </div>
                </div>
            </li>
        </ul>
        <?php } ?>
    </div>
</div>
