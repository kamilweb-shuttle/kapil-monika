<?php $this->load->view("top_application"); ?>


<?php
/*echo "<pre>";
print_r($res);
die;*/
?>

  <div role="main" class="main">

<section class="page-breadcrumb">
    <div class="container">

        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>

            <li class="active">Ethinic Wear for Women</li>
        </ol>

    </div>
</section>

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <aside class="sidebar">
                <aside class="block filter-blk">
                    <h4>Filter By Price</h4>
                    <div id="price-range">
                        <div class="padding-range">
                            <div id="slider-range"></div>
                        </div>
                        <label for="amount">Price:</label>
                        <input type="text" id="amount">
                        <p class="clearfix"><a href="#" class="btn btn-primary btn-sm">Apply Filter</a></p>
                    </div>
                </aside>
                <aside class="block blk-cat">

                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h4 class="">Category</h4>
                            <span class="pull-right clickable"><i class="fa fa-minus"></i></span>
                        </div>
                        <div class="panel-body">
                            <ul class="list-unstyled list-cat">
                                <li><a href="#">Ethinic Wear for Men</a></li>
                                <li><a href="#">Ethinic Wear for Women</a></li>
                                <li><a href="#">Leather Bag</a></li>
                                <li><a href="#">Leather Jacket</a></li>
                                <li><a href="#">Jewellery</a></li>

                            </ul>
                        </div>
                    </div>
                </aside>
                <aside class="block blk-cat">

                    <div class="panel panel-info panel-collapsed">
                        <div class="panel-heading ">
                            <h4 class="">Size</h4>
                            <span class="pull-right clickable "><i class="fa fa-minus"></i></span>
                        </div>
                        <div class="panel-body">
                            <ul class="list-unstyled list-cat">
                                <li><input type="checkbox" id="check1"> S</li>
                                <li><input type="checkbox" id="check1"> M</li>
                                <li><input type="checkbox" id="check1"> L</li>
                                <li><input type="checkbox" id="check1"> XL</li>
                                <li><input type="checkbox" id="check1"> XXL</li>

                            </ul>
                        </div>
                    </div>
                </aside>


            </aside>
        </div>
        <div class="col-md-9">


            <div class="catalog">
                <div class="toolbar clearfix">

                    <p class="pull-left">Showing 1-12 of 50 results</p>
                    <!-- Ordering -->
                    <div class="list-sort pull-right">
                        <select class="formDropdown">
                            <option>Default Sorting</option>
                            <option>Sort by Popularity</option>
                            <option>Sort by Newness</option>
                        </select>
                    </div>
                </div>

                
                <!--div style="min-height:600px;" class="mt20 mb10 cat_box">
    <?php
    if (is_array($res) && !empty($res)) {
        ?> 
        <ul class="floater float_3">
            <?php
            $ix = 1;
            foreach ($res as $val) {
                $link_url = base_url() . $val['friendly_url'];
                $productStock = product_stock($val['products_id']);
                ?> 
                <li>
                    <div class="pro_box trans_eff">
                        <div class="pro_pc">
                            <figure>
                                <a href="<?php echo $link_url; ?>">
                                    <?php 
                                    if($productStock <= 0){
                                    ?>
                                    <img src="<?php echo theme_url(); ?>images/outstock.png" class="outstock" alt="">
                                    <?php
                    }
                }
                                ?>
                                <img src="<?php echo get_image('products', $val['media'], '220', '180', 'R'); ?>" alt="<?php echo $val['product_alt']; ?>">
                            </a>
                        </figure>
                    </div>
                    <div class="p10 pt8 pb5">
                        <p class="fs13 black bb2 pb8 pl5"><a href="<?php echo $link_url; ?>" class="uo"><?php echo char_limiter($val['product_name'], 20); ?></a></p>
                        <a href="<?php echo $link_url; ?>" class="red_btn radius-5 fr mt12">Add to Cart</a>
                        <?php
                        if ($val['product_discounted_price'] > 0) {
                            ?>
                            <p class="black weight400 fs16 mt10 pl5 lht-18"><?php echo display_price($val['product_discounted_price']); ?> <b class="weight400 gray1 db fs14 through"><?php echo display_price($val['product_price']); ?></b></p>
                            <?php
                        } else {
                            ?>
                            <p class="black weight400 fs16 mt10 pl5 lht-18"><?php echo display_price($val['product_price']); ?></p>
                            <?php
                            //	}
                            ?>
                        </div>
                    </div>
                </li>
                <?php
            }
            ?>
        </ul>
        <?php
    } else {
        echo '<div class="ac b" style="height:175px;"><br>' . $this->config->item('no_record_found') . '</div>';
    }
    ?>
    <div class="cb"></div>
</div-->

                
                
                <div class="row">
                
               <?php  if (is_array($res) && !empty($res)) { 
                $ix = 1;
                foreach ($res as $val) {
                $link_url = base_url() . $val['friendly_url'];
                $productStock = product_stock($val['products_id']);
                ?> 
                    
                    <div class="col-xs-4 animation">
                        <div class="product">
                            <div class="product-thumb-info">
                                <div class="product-thumb-info-image">
                                    <span class="product-thumb-info-act">
                                        <a href="javascript:void(0)" class="view-product">
                                            <span><i class="fa fa-heart"></i></span>
                                        </a>
                                        <a href="shop-cart-sidebar.html" class="add-to-cart-product">
                                            <span><i class="fa fa-shopping-cart"></i></span>
                                        </a>
                                    </span>
                                    <img  class="img-responsive" src="<?php echo get_image('products', $val['media'], '220', '180', 'R'); ?>" alt="<?php echo $val['product_alt']; ?>">
                                </div>
                                <div class="product-thumb-info-content">
                                    <?php 
                                    if ($val['product_discounted_price'] > 0) {
                                       ?>
                                    <span class="price pull-right"><?php echo display_price($val['product_discounted_price']); ?><del><?php echo display_price($val['product_price']); ?></del></span>
                                    <h4><a href="<?php echo $link_url; ?>"><?php echo char_limiter($val['product_name'], 20); ?></a></h4>
                                    
                                    <?php }else{ ?>
                                       <span class="price pull-right"><?php echo display_price($val['product_discounted_price']); ?></span>
                                    <h4><a href="<?php echo $link_url; ?>"><?php echo char_limiter($val['product_name'], 20); ?></a></h4> 
                                   <?php  } ?>  
                                </div>
                            </div>
                        </div>
                    </div>
                
               <?php
                  }
               } 
               ?>
                </div>
                
                
                    <!--div class="col-xs-4 animation">
                        <div class="product">
                            <div class="product-thumb-info">
                                <div class="product-thumb-info-image">
                                    <span class="product-thumb-info-act">
                                        <a href="javascript:void(0)"  class="view-product">
                                            <span><i class="fa fa-heart"></i></span>
                                        </a>
                                        <a href="shop-cart-sidebar.html" class="add-to-cart-product">
                                            <span><i class="fa fa-shopping-cart"></i></span>
                                        </a>
                                    </span>
                                    <img alt="" class="img-responsive" src="<?php echo base_url(); ?>/assets/designer/images/content/products/suit2.jpg">
                                </div>
                                <div class="product-thumb-info-content">
                                    <span class="price pull-right">39.99 USD</span>
                                    <h4><a href="shop-product-detail2.html">Striped full skirt</a></h4>
                                    <span class="item-cat"><small><a href="#">Skirts</a></small></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4 animation">
                        <div class="product">
                            <a href="shop-product-detail1.html">
                                <span class="bag bag-onsale">Sale</span>
                            </a>
                            <div class="product-thumb-info">
                                <div class="product-thumb-info-image">
                                    <span class="product-thumb-info-act">
                                        <a href="javascript:void(0)"  class="view-product">
                                            <span><i class="fa fa-heart"></i></span>
                                        </a>
                                        <a href="shop-cart-sidebar.html" class="add-to-cart-product">
                                            <span><i class="fa fa-shopping-cart"></i></span>
                                        </a>
                                    </span>
                                    <img alt="" class="img-responsive" src="<?php echo base_url(); ?>/assets/designer/images/content/products/suit3.jpg">
                                </div>
                                <div class="product-thumb-info-content">
                                    <span class="price pull-right">79.99 USD</span>
                                    <h4><a href="shop-product-detail2.html">Structured double-breasted blazer</a></h4>
                                    <span class="item-cat"><small><a href="#">Outerwear</a></small></span>
                                </div>
                            </div>
                        </div>
                    </div>
                      

                <div class="row">
                    <div class="col-xs-4 animation">
                        <div class="product">
                            <div class="product-thumb-info">
                                <div class="product-thumb-info-image">
                                    <span class="product-thumb-info-act">
                                        <a href="javascript:void(0)" class="view-product">
                                            <span><i class="fa fa-heart"></i></span>
                                        </a>
                                        <a href="shop-cart-sidebar.html" class="add-to-cart-product">
                                            <span><i class="fa fa-shopping-cart"></i></span>
                                        </a>
                                    </span>
                                    <img alt="" class="img-responsive" src="<?php echo base_url(); ?>/assets/designer/images/content/products/suit1.jpg">
                                </div>
                                <div class="product-thumb-info-content">
                                    <span class="price pull-right">69.99 USD</span>
                                    <h4><a href="shop-product-detail2.html">Classic blazer</a></h4>
                                    <span class="item-cat"><small><a href="#">Outerwear</a></small></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4 animation">
                        <div class="product">
                            <div class="product-thumb-info">
                                <div class="product-thumb-info-image">
                                    <span class="product-thumb-info-act">
                                        <a href="javascript:void(0)"  class="view-product">
                                            <span><i class="fa fa-heart"></i></span>
                                        </a>
                                        <a href="shop-cart-sidebar.html" class="add-to-cart-product">
                                            <span><i class="fa fa-shopping-cart"></i></span>
                                        </a>
                                    </span>
                                    <img alt="" class="img-responsive" src="<?php echo base_url(); ?>/assets/designer/images/content/products/suit2.jpg">
                                </div>
                                <div class="product-thumb-info-content">
                                    <span class="price pull-right">39.99 USD</span>
                                    <h4><a href="shop-product-detail2.html">Striped full skirt</a></h4>
                                    <span class="item-cat"><small><a href="#">Skirts</a></small></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4 animation">
                        <div class="product">
                            <a href="shop-product-detail1.html">
                                <span class="bag bag-onsale">Sale</span>
                            </a>
                            <div class="product-thumb-info">
                                <div class="product-thumb-info-image">
                                    <span class="product-thumb-info-act">
                                        <a href="javascript:void(0)"  class="view-product">
                                            <span><i class="fa fa-heart"></i></span>
                                        </a>
                                        <a href="shop-cart-sidebar.html" class="add-to-cart-product">
                                            <span><i class="fa fa-shopping-cart"></i></span>
                                        </a>
                                    </span>
                                    <img alt="" class="img-responsive" src="<?php echo base_url(); ?>/assets/designer/images/content/products/suit3.jpg">
                                </div>
                                <div class="product-thumb-info-content">
                                    <span class="price pull-right">79.99 USD</span>
                                    <h4><a href="shop-product-detail2.html">Structured double-breasted blazer</a></h4>
                                    <span class="item-cat"><small><a href="#">Outerwear</a></small></span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-xs-4 animation">
                        <div class="product">
                            <div class="product-thumb-info">
                                <div class="product-thumb-info-image">
                                    <span class="product-thumb-info-act">
                                        <a href="javascript:void(0)"  class="view-product">
                                            <span><i class="fa fa-heart"></i></span>
                                        </a>
                                        <a href="shop-cart-sidebar.html" class="add-to-cart-product">
                                            <span><i class="fa fa-shopping-cart"></i></span>
                                        </a>
                                    </span>
                                    <img alt="" class="img-responsive" src="<?php echo base_url(); ?>/assets/designer/images/content/products/saree1.jpg">
                                </div>
                                <div class="product-thumb-info-content">
                                    <span class="price pull-right">59.99 USD</span>
                                    <h4><a href="shop-product-detail2.html">Gold chrono watch</a></h4>
                                    <span class="item-cat"><small><a href="#">Accessories</a></small></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4 animation">
                        <div class="product">
                            <div class="product-thumb-info">
                                <div class="product-thumb-info-image">
                                    <span class="product-thumb-info-act">
                                        <a href="javascript:void(0)"  class="view-product">
                                            <span><i class="fa fa-heart"></i></span>
                                        </a>
                                        <a href="shop-cart-sidebar.html" class="add-to-cart-product">
                                            <span><i class="fa fa-shopping-cart"></i></span>
                                        </a>
                                    </span>
                                    <img alt="" class="img-responsive" src="<?php echo base_url(); ?>/assets/designer/images/content/products/saree2.jpg">
                                </div>
                                <div class="product-thumb-info-content">
                                    <span class="price pull-right">7.99 USD</span>
                                    <h4><a href="shop-product-detail2.html">Long earrings</a></h4>
                                    <span class="item-cat"><small><a href="#">Accessories</a></small></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4 animation">
                        <div class="product">
                            <div class="product-thumb-info">
                                <div class="product-thumb-info-image">
                                    <span class="product-thumb-info-act">
                                        <a href="javascript:void(0)"  class="view-product">
                                            <span><i class="fa fa-heart"></i></span>
                                        </a>
                                        <a href="shop-cart-sidebar.html" class="add-to-cart-product">
                                            <span><i class="fa fa-shopping-cart"></i></span>
                                        </a>
                                    </span>
                                    <img alt="" class="img-responsive" src="<?php echo base_url(); ?>/assets/designer/images/content/products/saree3.jpg">
                                </div>
                                <div class="product-thumb-info-content">
                                    <span class="price pull-right">19.99 USD</span>
                                    <h4><a href="shop-product-detail2.html">Braided belt</a></h4>
                                    <span class="item-cat"><small><a href="#">Belts</a></small></span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-xs-4 animation">
                        <div class="product">
                            <div class="product-thumb-info">
                                <div class="product-thumb-info-image">
                                    <span class="product-thumb-info-act">
                                        <a href="javascript:void(0)"  class="view-product">
                                            <span><i class="fa fa-heart"></i></span>
                                        </a>
                                        <a href="shop-cart-sidebar.html" class="add-to-cart-product">
                                            <span><i class="fa fa-shopping-cart"></i></span>
                                        </a>
                                    </span>
                                    <img alt="" class="img-responsive" src="<?php echo base_url(); ?>/assets/designer/images/content/products/product-4.jpg">
                                </div>
                                <div class="product-thumb-info-content">
                                    <span class="price pull-right">29.99 USD</span>
                                    <h4><a href="shop-product-detail2.html">Denim shirt</a></h4>
                                    <span class="item-cat"><small><a href="#">Jackets</a></small></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4 animation">
                        <div class="product">
                            <a href="shop-product-detail1.html">
                                <span class="bag bag-hot">Hot</span>
                            </a>
                            <div class="product-thumb-info">
                                <div class="product-thumb-info-image">
                                    <span class="product-thumb-info-act">
                                        <a href="javascript:void(0)"  class="view-product">
                                            <span><i class="fa fa-heart"></i></span>
                                        </a>
                                        <a href="shop-cart-sidebar.html" class="add-to-cart-product">
                                            <span><i class="fa fa-shopping-cart"></i></span>
                                        </a>
                                    </span>
                                    <img alt="" class="img-responsive" src="<?php echo base_url(); ?>/assets/designer/images/content/products/product-5.jpg">
                                </div>
                                <div class="product-thumb-info-content">
                                    <span class="price pull-right">29.99 USD</span>
                                    <h4><a href="shop-product-detail2.html">Poplin shirt with fine pleated bands</a></h4>
                                    <span class="item-cat"><small><a href="#">Shirts</a></small></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-4 animation">
                        <div class="product">
                            <div class="product-thumb-info">
                                <div class="product-thumb-info-image">
                                    <span class="product-thumb-info-act">
                                        <a href="javascript:void(0)"  class="view-product">
                                            <span><i class="fa fa-heart"></i></span>
                                        </a>
                                        <a href="shop-cart-full.html" class="add-to-cart-product">
                                            <span><i class="fa fa-shopping-cart"></i></span>
                                        </a>
                                    </span>
                                    <img alt="" class="img-responsive" src="<?php echo base_url(); ?>/assets/designer/images/content/products/product-6.jpg">
                                </div>
                                <div class="product-thumb-info-content">
                                    <span class="price pull-right">29.99 USD</span>
                                    <h4><a href="shop-product-detail2.html">Contrasting shirt</a></h4>
                                    <span class="item-cat"><small><a href="#">Stock clearance</a></small></span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div-->
                <div class="text-center" style="margin-bottom:20px;"><a href="#" class="btn btn-primary btn-sm">Load More</a></div>

            </div>
        </div>
    </div>


</div>

</div>



















<?php $this->load->view("bottom_application"); ?>
