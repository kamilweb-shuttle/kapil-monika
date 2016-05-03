<?php 
$this->load->helper('banner');
//trace($this->meta_info);
if(isset($this->meta_info['entity_id'])){
	$catID = (int) $this->meta_info['entity_id'];
	$metaType = $this->meta_info['page_url'];
}
else{
	$catID = "";
	$metaType="";
}
?>



<nav class="navbar navbar-default navbar-main navbar-main-slide" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <a class="logo hidden-xs" href="index.html"><img src="<?php echo base_url(); ?>/assets/designer/images/logo.png" alt="Flatize"></a> 
            <a class="logo hidden-lg  visible-xs" href="index.html"><img src="<?php echo base_url(); ?>/assets/designer/images/logo-sm.png" alt="Flatize"></a>
        </div>
        <ul class="nav navbar-nav navbar-act pull-right">
            <li class="login"><a href="javascript:void(0);"><i class="fa fa-user"></i></a></li>
            <li class="search"><a href="javascript:void(0);" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-search"></i></a></li>
        </ul>
        <div class="navbar-collapse collapse">
            
            
            <!-- nav bar starts -->
            <ul class="nav navbar-nav pull-right">
                
                
                
                <li> <a href="<?php echo base_url(); ?>" <?php if($catID <=0 && $metaType == 'home'){ echo 'class="act"'; } ?>><img src="<?php echo theme_url(); ?>images/home-ico.png" class="Home" alt="">Home</a> </li>

              <!--category nav bar starts -->
                <li class="dropdown megamenu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Category</a>
                <div class="dropdown-menu">
                    <div class="mega-menu-content">
                        <div class="row">
                        <div class="col-md-4 hidden-sm hidden-xs menu-column">
                            <h3>Trends</h3>
                            <ul class="list-unstyled sub-menu list-thumbs-pro">
                                <li class="product">
                                    <div class="product-thumb-info">
                                        <div class="product-thumb-info-image">
                                            <a href="shop-product-detail1.html"><img alt="" width="60" src="<?php echo base_url(); ?>/assets/designer/images/content/products/product-1.jpg"></a>
                                        </div>

                                        <div class="product-thumb-info-content">
                                            <h4><a href="shop-product-detail1.html">Denim shirt</a></h4>
                                            <span class="item-cat"><small><a href="#">Jackets</a></small></span>
                                            <span class="price">29.99 USD</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="product">
                                <div class="product-thumb-info">
                                    <div class="product-thumb-info-image">
                                        <a href="shop-product-detail1.html"><img alt="" width="60" src="<?php echo base_url(); ?>/assets/designer/images/content/products/product-2.jpg"></a>
                                    </div>

                                    <div class="product-thumb-info-content">
                                        <h4><a href="shop-product-detail2.html">Poplin shirt with fine pleated bands</a></h4>
                                        <span class="item-cat"><small><a href="#">Jackets</a></small></span>
                                        <span class="price">29.99 USD</span>
                                    </div>
                                </div>
                                </li>

                            </ul>
                        </div>
                        <?php 
                        $main_catagories=$this->db->query('select category_name,category_id from wl_categories where parent_id=0')->result();
                        foreach($main_catagories as $main_category){
                        ?>    
                        <div class="col-md-2 menu-column">
                            <h3><?php echo  $main_category->category_name; ?></h3>
                            <ul class="list-unstyled sub-menu">
                                <?php 
                                $sub_categories=$this->db->query("select category_name,category_id,friendly_url from wl_categories where parent_id='".$main_category->category_id."'  ")->result();
                                 foreach($sub_categories as $sub_category){
                                ?>   
                                   <li><a href="<?php echo site_url()."".$sub_category->friendly_url;  ?>"><?php echo $sub_category->category_name; ?></a></li>

                                 <?php } ?>

                            </ul>
                        </div>
                            

                        <!--div class="col-md-2 menu-column">
                            <h3>Woman</h3>
                            <ul class="list-unstyled sub-menu">
                                <li><a href="shop-sidebar.html">Jewellery</a></li>
                                <li><a href="shop-sidebar.html">Saree</a></li>
                                <li><a href="shop-sidebar.html">Lehnga</a></li>

                            </ul>
                        </div-->
                      <?php    } ?>   
                            
                        <div class="col-sm-4 hidden-sm hidden-xs menu-column">
                            <h3>Explore new collection</h3>
                            <ul class="list-unstyled sub-menu list-md-pro">
                                <li class="product">
                                <div class="product-thumb-info">
                                    <div class="product-thumb-info-image">
                                        <a href="shop-product-detail1.html"><img class="img-responsive" width="330" alt="" src="<?php echo base_url(); ?>/assets/designer/images/content/products/ad-1.png"></a>
                                    </div>


                                </div>
                                </li>
                            </ul>
                        </div>
                        </div>
                    </div>
                </div><!-- -->
                </li>
            <!--category navbar ends -->
                
                
                
                
                
                <li> <a href="<?php echo base_url(); ?>aboutus" <?php if($catID <=0 && $metaType == 'aboutus'){ echo 'class="act"'; } ?>>Designer Profile</a> </li>
                
                <li> <a href="<?php echo base_url(); ?>pages/whowear" <?php if($catID <=0 && $metaType == 'whowear'){ echo 'class="act"'; } ?>>Who's wearing K&M </a> </li>
               <li> <a href="<?php echo base_url(); ?>pages/media" <?php if($catID <=0 && $metaType == 'whowear'){ echo 'class="act"'; } ?>>Media </a> </li>

                <li> <a href="<?php echo base_url(); ?>contactus" <?php if($catID <=0 && $metaType == 'contactus'){ echo 'class="act"'; } ?>>Contact</a> </li>

                </li>
            </ul>
        </div><!--/.nav-collapse --> 
    </div><!--/.container-fluid --> 
</nav>