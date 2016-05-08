<?php $this->load->view("top_application"); ?>

<dv role="main" class="main">

    <section class="page-breadcrumb">
        <div class="container">

            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>

                <li class="active">Category</li>
            </ol>

        </div>
    </section>
    <div class="row"></div>
    <div class="col-md-11">


        <div class="catalog">
            <div class="toolbar clearfix">

                
                <!-- Ordering -->
                
            </div>
            <?php
            $segment = 3;
            $catid = (int) $this->uri->segment(3, 0);
            if ($catid) {
                echo category_breadcrumbs($catid, $segment);
            } else {
                
            }
            ?>  
     

            <div class="row">
                <?php
if (is_array($res) && !empty($res)) {
    ?> 
                  <ul class="floater float_4">
    <?php
    foreach ($res as $val) {
        $link_url = base_url() . $val['friendly_url'];
        $catCount = count_category(" AND parent_id = '" . $val['category_id'] . "' ");
        $proCount = count_products(" AND category_id = '" . $val['category_id'] . "' ");
        if ($proCount > 0){
        $count = $proCount;
        
        }
    else{            $count = $catCount;}
        ?>
           
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
                                <a href="<?php echo $link_url; ?>" class="hvr-grow-shadow "><img src="<?php echo get_image('category', $val['category_image'], '220', '180', 'R'); ?>" alt="<?php echo $val['category_alt']; ?>"></a>
                            </div>
                            <div class="product-thumb-info-content">
                                
                                <h4><a href="<?php echo $link_url; ?>"><?php echo char_limiter($val['category_name'], 28); ?></a></h4>
                                <span class="item-cat"><small><a href="#"><?php echo $count; ?> Items</a></small></span>
                            </div>
                        </div>
                    </div>
                </div>
      <?php
           }

       } 
    ?>
               

            </div>

     

         
            
            

        </div>
    </div>  








</div>

































<!--div class="mob_hider"></div>
           


        <div class="breadcrumbs mob_hider">
        <div class="wrapper">
        <p class="ml5">
                YOU ARE HERE : 
              <a href="<?php echo base_url(); ?>"><img src="<?php echo theme_url(); ?>images/hm.png" class="vam pb3" alt=""></a> 
      
              
              
<?php
$segment = 3;
$catid = (int) $this->uri->segment(3, 0);
if ($catid) {
    echo category_breadcrumbs($catid, $segment);
} else {
    echo '<b>&gt;</b> <strong>Categories</strong>';
}
?>  
            </p>
        </div>
        </div>

        <section class="wrapper" style="min-height:600px;">
        <div class="pt30">
        <h1 class="bb2 pb3">Products by Category</h1>
      <script type="text/javascript">function serialize_form() { return $('#myform').serialize();   } </script>
<?php echo form_open("", 'id="myform"'); ?>
        <div id="my_data">
          <div class="paging_container">
            <div class="one">Showing :
<?php echo front_record_per_page('per_page1'); ?>
            </div>
            <div class="two paging"><?php echo $page_links; ?></div>
            <div class="cb"></div>
          </div>        
          <div style="min-height:600px;" class="mt20 mb10 cat_box">
<?php
if (is_array($res) && !empty($res)) {
    ?> 
                  <ul class="floater float_4">
    <?php
    foreach ($res as $val) {
        $link_url = base_url() . $val['friendly_url'];
        $catCount = count_category(" AND parent_id = '" . $val['category_id'] . "' ");
        $proCount = count_products(" AND category_id = '" . $val['category_id'] . "' ");
        if ($proCount > 0)
            $count = $proCount;
        else
            $count = $catCount;
        ?>
                          <li>
                            <div class="pro_box trans_eff">
                              <div class="pro_pc">
                                <figure><a href="<?php echo $link_url; ?>"><img src="<?php echo get_image('category', $val['category_image'], '220', '180', 'R'); ?>" alt="<?php echo $val['category_alt']; ?>"></a></figure>
                              </div>
                              <div class="p10 pt15 bg-gray ac border1 trans_eff mt10">
                                <p class="fs18 red oswald"><a href="<?php echo $link_url; ?>" class="uo"><?php echo char_limiter($val['category_name'], 28); ?></a></p>
                                <p class="osons ac fs16 gray weight300 mt10"><?php echo $count; ?> Items</p>
                              </div>
                            </div>
                          </li>
        <?php
    }
    ?>
                  </ul>
    <?php
}
else {
    echo '<div class="ac b" style="height:175px;"><br>' . $this->config->item('no_record_found') . '</div>';
}
?>
            <div class="cb"></div>
          </div>          
          <div class="paging_container">
            <div class="one">Showing :
<?php echo front_record_per_page('per_page2'); ?>
            </div>
            <div class="two paging"><?php echo $page_links; ?></div>
            <div class="cb"></div>
          </div>
        </div> 
<?php echo form_close(); ?>      
           
      
      
<?php echo get_recent_view(); ?>
         
      
      
    </div>
        </section>
        
  <section class="wrapper pt15  bt1 mid_banner_cont">
<?php
$cond = array();
$cond['position'] = "Bottom Banner";
banner_display($cond, 330, 182, 'mid_banner', '<div class="mid_banner">', '</div>', "3");
?>
        <div class="cb"></div>
        </section>
        
        <script>
        jQuery(document).ready(function(e) {
        jQuery('[id ^="per_page"]').live('change',function(){		
                        $("[id ^='per_page'] option[value=" + jQuery(this).val() + "]").attr('selected', 'selected'); jQuery('#myform').submit();
                });	
        });
        </script-->
<?php $this->load->view("bottom_application"); ?>