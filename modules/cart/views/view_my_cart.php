<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <title><?= $this->config->item('site_name'); ?></title>

        <link href="<?php echo theme_url(); ?>css/win.css" rel="stylesheet" type="text/css">
        <link href="<?php echo theme_url(); ?>css/conditional_win.css" rel="stylesheet" type="text/css">
        <style type="text/css" media="screen">
            <!--
            @import url("<?php echo resource_url(); ?>fancybox/jquery.fancybox.css?v=2.1.5");
            @import url("<?php echo theme_url(); ?>css/fluid_dg.css");
            @import url("<?php echo theme_url(); ?>css/validationEngine.jquery.css");
            -->
        </style>
        <link href="<?php echo base_url(); ?>assets/developers/css/proj.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="<?php echo theme_url(); ?>images/favicon.ico">
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script> 
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/developers/js/common.js"></script>
        <script type="text/javascript" src="<?php echo resource_url(); ?>Scripts/languages/jquery.validationEngine-en.js"></script>
        <script type="text/javascript" src="<?php echo resource_url(); ?>Scripts/jquery.validationEngine.js"></script>
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
        <![endif]-->
    </head>
    <body>
        <section class="wrapper">
            <div class="p20">
                <?php
                if ($this->cart->total_items() > 0) {
                    echo form_open('cart/', 'name="cart_frm" id="cart_frm"');
                    ?>
                    <div class="mob_hider">
                        <?php
                        if (error_message()) {
                            echo error_message();
                        }
                        ?>
                    </div>  
                    <h1>Shopping Cart - <b class="fs14"><?php echo $this->cart->total_items(); ?> ITEMS</b></h1>
                    <div class="mt5 p15 pl25 pr25 bg-gray border1 black ttu fs14 cont_4 mob_hider b">
                        <div class="sec1">S. No.</div>
                        <div class="sec2">Products</div>
                        <div class="sec3">Quantity</div>
                        <div class="sec4">Amount</div>
                        <div class="cb"></div>
                    </div>
                    <div>
                        <?php
                        $i = 1;
                        $totweight = 0;
                        $shipcharge = "";
                        foreach ($this->cart->contents() as $items) {
                            //trace($items);
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
                            <div class="mylsttb cont_4 mt10">
                                <div class="sec1"><strong>S. No.: </strong> <?php echo $i; ?>.</div>
                                <div class="sec2"> <strong>Product Details : </strong>
                                    <p class="fs16 b"><a href="javascript:void(0);" onClick="window.open('<?php echo $link_url; ?>', '_parent')"> <b class="fl thm_cont mr10"><img src="<?php echo get_image('products', $items['img'], '100', '80', 'R'); ?>" alt="" width="100" height="82"></b><?php echo $items['origname']; ?></a></p>
                                    <p class="mt5 fs12">
                                        Product Code : <?php echo $items['code'];
                            if ($size != '') { ?> / Size : <?php echo $size;
                        } if ($color != '') { ?> / Color : <?php echo $color;
                        } ?>
                                    </p>
                                    <?php
                                    if ($items['discount_price'] > 0) {
                                        ?>
                                        <p class="black fs15 mt2">Price : <b class="gray1 through normal"><?php echo display_price($items['product_price']); ?></b> <b class="red"><?php echo display_price($items['discount_price']); ?></b></p>
                                        <?php
                                    } else {
                                        ?>
                                        <p class="black fs15 mt2">Price: <b class="red"><?php echo display_price($items['product_price']); ?></b></p>
            <?php
        }
        ?>
                                    <div class="cb"></div>
                                </div>
                                <div class="sec3"> <strong>Quantity : </strong>
                                    <p class="b fs24">
                                        <a href="javascript:void(0)" onclick="return incDnc(2, <?php echo $i; ?>, <?php echo $items['availableqty']; ?>);" data-bind="<?php echo $items['rowid']; ?>" id="Inc_<?php echo $items['rowid']; ?>">-</a>
                                        <input readonly name="<?php echo $i; ?>[qty]" id="mqty_<?php echo $i; ?>" type="text" value="<?php echo $items['qty']; ?>" class="txtbox ac bdrn" style="width:15px;" />
                                        <input readonly name="<?php echo $i; ?>[qty]" id="qty_<?php echo $i; ?>" type="hidden" value="<?php echo $items['qty']; ?>" class="txtbox ac bdrn" style="width:15px;" />
                                        <a href="javascript:void(0)" onclick="return incDnc(1, <?php echo $i; ?>, <?php echo $items['availableqty']; ?>);" data-bind="<?php echo $items['rowid']; ?>" id="Dec_<?php echo $items['rowid']; ?>">+</a>
                                        <input type="hidden" name="<?php echo $i; ?>[rowid]" id='cart_rowid_<?php echo $i; ?>' value="<?php echo $items['rowid']; ?>" /> 
                                        <!--<p><a href="#" class="btn6 radius-3 mt5">Update</a></p>-->
                                    <p class="mt10 fs11 verd">
                                        <span class="red">
                                            <a href="<?php echo base_url(); ?>cart/remove_item/<?php echo $items['rowid']; ?>" class="remove_pro" id="<?php echo $items['rowid']; ?>" onclick="return confirm('Are you sure you want to remove this item');">X Remove</a>
                                        </span>
                                    </p>
                                </div>
                                <div class="sec4"> <strong>Amount : </strong>
                                    <p class="b black fs18"><?php echo display_price($items['qty'] * $items['price']); ?></p>
                                </div>
                                <div class="cb"></div>
                            </div>
                            <!-- list 1 -->
                            <?php
                            $i++;
                        }
                        $cart_total = $this->cart->total();
                        $tax = ($cart_total * $tax_cent) / 100;
                        $tax_cent_applied = fmtZerosDecimal($tax_cent);
                        $discount_amount = $this->session->userdata('discount_amount');
                        //$shipping_total  = 20;
                        $shipping_total = $this->cart_model->get_shipping($cart_total);
                        $cod_amount = $this->cart_model->get_cod($cart_total);
                        $discount_total = $discount_amount;
                        $grand_total = ($cart_total - $discount_total) + $shipping_total + $tax;
                        ?>          

                        <div class="mt10 cart_text">
                            <p>Shipping Charges  : <span class="WebRupee">Rs.</span> <?php echo $shipping_total; ?></p>

                            <p class="fs18 pr10 b mt10">Estimated Total  : <b><span class="WebRupee"></span> <?php echo display_price($grand_total); ?></b></p>
                            <p class="mt15 cart_btns"> <b><input type="button" class="btn2 radius-3 shadow1" value="&lt; Continue Shopping" onClick="window.open('<?php echo base_url(); ?>category', '_parent')" /></b>
                                <b>
                                    <input name="UserCheckout" id="chkout" type="button" onClick="window.open('<?php echo base_url(); ?>cart/checkout', '_parent')" class="btn2x radius-3 shadow1" value="Proceed to Payment &gt;" /></b>
                            </p>
                            <div class="cb mb10"></div>
                        </div>
                    </div>
                    <?php
                    echo form_close();
                } else {
                    ?>
                    <div class="grey bdr p15 bg-dgrey radius-5 ac"><strong>Your Cart is empty</strong></div>
                    <?php
                }
                ?>
            </div>
        </section>

        <script type="text/javascript">  var Page = '';
            var site_url = '<?php echo site_url(); ?>';
            var theme_url = '<?php echo theme_url(); ?>';
            var resource_url = '<?php echo resource_url(); ?>';
        </script>
        <script type="text/javascript" src="<?php echo resource_url(); ?>Scripts/script.int.dg.js"></script>
<?php //$this->load->view("bottom_application"); ?>
    </body>
</html>