<?php $this->load->view("top_application"); ?>

<div role="main" class="main">

<!-- Begin page top -->
<section class="page-breadcrumb">
    <div class="container">

        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>

            <li class="active"><?php
            echo category_breadcrumbs($res['category_id']);
            echo '<strong>' . char_limiter($res['product_name'], 45) . '</strong>';
            ?></li>
        </ol>
     
    </div>
</section>
<!-- End page top -->

<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <ul id="etalage">
                <li>
                    
                    <a href="optionallink.html">
                        
                        <img class="etalage_thumb_image" src="<?php echo get_image('products', $res['media']); ?>" />
                        <img class="etalage_source_image" src="<?php echo get_image('products', $res['media']); ?>" title="This is an optional description." />
                    </a>
                </li>
                <li>
                    <img class="etalage_thumb_image" src="demo_files/images/image2_thumb.jpg" />
                    <img class="etalage_source_image" src="demo_files/images/image2_large.jpg" title="This text area can also be setup to appear at the top of the image.<br>This second line shows that the description can be longer." />
                </li>

            </ul>
        </div>
        <div class="col-sm-8">
            <div class="summary entry-summary">

                <h3><?php echo $res['product_name']; ?></h3>
                <p>Product Code:<?php echo $res['product_code']; ?></p>
                <form method="post" class="cart" action="<?php echo site_url() ?>cart/add_to_cart" >
                <div class="reviews-counter clearfix">
                    <div class="rating five-stars pull-left">
                        <div class="star-rating"></div>
                        <div class="star-bg"></div>
                    </div>
                    <span><?php
                        if ($review_count > 0) {
                            $ratingVal = product_overall_rating($res['products_id'], 'product');
                           
                            //echo $ratingVal;
                            echo rating_html($ratingVal, 5);
                            echo "/";
                        }
                        ?></span>
                </div>

                <p class="price">
                    <span class="amount"><del><?php echo display_price($res['product_price']); ?></b> </del><?php echo display_price($res['product_discounted_price']); ?></b> <b class="weight300 fs16">(Save <?php echo you_save($res['product_price'], $res['product_discounted_price']); ?>%)</b></span>
                </p>
             
                                <?php
                                if ($res['color_ids'] != '' && $res['size_ids'] != '') {
                                    $col = explode(',', $res['color_ids']);
                                    $sz = explode(',', $res['size_ids']);
                                }
                                    ?>
                <ul class="list-inline list-select clearfix">
                    <li>
                        <div class="list-sort">
                            <select class="formDropdown">
                                <option>Select Size</option>
                                <?php
                                        foreach ($sz as $k => $v) {
                                            ?>
                                            <option value="<?php echo $v; ?>"><?php echo size_name($v); ?></option>
                                            <?php
                                        }
                                        ?>
                            </select>
                        </div>
                    </li>
                      <li>
                        <div class="list-sort">
                            <select class="formDropdown">
                                <option>Select Color</option>
                                 <?php
                                        foreach ($col as $key => $val) {
                                            ?>
                                            <option value="<?php echo $val; ?>"><?php echo color_name($val); ?></option>
                                            <?php
                                        }
                                        ?>
                            </select>
                            </select>
                        </div>
                    </li>
                    <!--li class="color"><a href="#" class="color1"></a></li>
                    <li class="color"><a href="#" class="color2"></a></li>
                    <li class="color"><a href="#" class="color3"></a></li>
                    <li class="color"><a href="#" class="color4"></a></li-->
                </ul>

                
                    <div class="quantity pull-left">
                        <input type="button" class="minus" value="-">
                        <input type="text" class="input-text qty" title="Qty" value="1" name="quantity" min="1" step="1">
                        <input type="button" class="plus" value="+">
                    </div>
                    <a href="#" class="btn btn-grey">
                        <span><i class="fa fa-heart"></i></span>
                    </a>
                  <input type="hidden" name="product_cart_id" value="<?php echo $res['products_id'] ?>" />
                    <input type="hidden" name="qty" id="qty" value="1" />
                    <input type="hidden" name="avlqty" id="avlqty" value="<?php echo abs($res['product_qty']); ?>" />
                    
                       <?php if($res['product_qty']<=0){ ?>   
                       <a  href="javascript:void(0)" class="btn btn-primary btn-icon"><i class="fa fa-shopping-cart"></i>Out of Stock</a>
                       <?php }else{ ?>
                    <button  class="btn btn-primary btn-icon"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                       <?php } ?>
                </form>

                <ul class="list-unstyled product-meta">
                    <li>Sku: 54329843</li>
                    <li>Categories: <a href="#">Leather</a> <a href="#">Jeans</a> <a href="#">Men</a></li>
                    <li>Tags: <a href="#">Shoes</a> <a href="#">Jeans</a> <a href="#">Men</a> <a href="#">T-shirt</a></li>
                </ul>

                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Description</a> </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="panel-body"> 
                                <p><?php echo $res['products_description']; ?><p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Addition Information</a> </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="panel-body"> <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p> </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Reviews (3)</a> </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                            <div class="panel-body post-comments">
                                <ul class="comments">
                                    <li>
                                        <div class="comment">
                                            <div class="img-circle"> <img class="avatar" width="50" alt="" src="images/content/blog/avatar.png"> </div>
                                            <div class="comment-block">
                                                <span class="comment-by"> <strong>Frank Reman</strong></span>
                                                <span class="date"><small><i class="fa fa-clock-o"></i> January 12, 2013</small></span>
                                                <p>Lorem ipsum dolor sit amet.</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="comment">
                                            <div class="img-circle"> <img class="avatar" width="50" alt="" src="images/content/blog/avatar.png"> </div>
                                            <div class="comment-block">
                                                <span class="comment-by"> <strong>Frank Reman</strong></span>
                                                <span class="date"><small><i class="fa fa-clock-o"></i> July 11, 2014</small></span>
                                                <p>Nam viverra euismod odio, gravida pellentesque urna varius vitae, gravida pellentesque urna varius vitae</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="comment">
                                            <div class="img-circle"> <img class="avatar" width="50" alt="" src="images/content/blog/avatar.png"> </div>
                                            <div class="comment-block">
                                                <span class="comment-by"> <strong>Frank Reman</strong></span>
                                                <span class="date"><small><i class="fa fa-clock-o"></i> July 11, 2014</small></span>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



</div>



























<!--content section-->
<?php $this->load->view("bottom_application"); ?>