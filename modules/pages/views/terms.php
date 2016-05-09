<?php $this->load->view("top_application");?>
	
      <div role="main" class="main">
	<section class="page-breadcrumb">
            <div class="container">
                <ol class="breadcrumb">
                 <li><a href="#">Home</a></li>
                 <li class="active"><?php echo "Who Wear";?></li>
                </ol>
            </div>
	</section>  
        
        <!-- Page Static Content -->
        <section class="main-slide">
				<div class="container">
					<div id="owl-second-demo" class="owl-carousel main-demo second-demo">
		<?php
                        $sliders_path= $this->db->query("select banner_image from wl_banners where banner_page='inner' and banner_position='Middle Banner' ")->result(); 
                        ?>				
                                            
                                          <?php if(count($sliders_path)<=0 ){ ?>  
                                                <div class="item"><img src="images/content/slides/home-slider1.jpg" class="img-responsive" alt="Photo">
							
						</div>
						<div class="item"><img src="<?php echo base_url(); ?>/assets/designer/images/content/slides/home-slider2.jpg" class="img-responsive" alt="Photo">
						
						</div>
						<div class="item"><img src="<?php echo base_url(); ?>/assets/designer/images/content/slides/home-slider3.jpg" class="img-responsive" alt="Photo">
						
						</div>
						<div class="item"><img src="<?php echo base_url(); ?>/assets/designer/images/content/slides/home-slider4.jpg" class="img-responsive" alt="Photo">
						
						</div>
						<div class="item"><img src="<?php echo base_url(); ?>/assets/designer/images/content/slides/home-slider5.jpg" class="img-responsive" alt="Photo">
						
						</div>
						<div class="item"><img src="<?php echo base_url(); ?>/assets/designer/images/content/slides/home-slider6.jpg" class="img-responsive" alt="Photo">
						
						</div>
						<div class="item"><img src="<?php echo base_url(); ?>/assets/designer/images/content/slides/home-slider7.jpg" class="img-responsive" alt="Photo">
						
						</div>
                                          <?php }else{
                                              foreach ($sliders_path as $slider_path){ ?>
                                             <div class="item">
                                                 <img src="<?php echo base_url(); ?>uploaded_files/banner/<?php echo $slider_path->banner_image ?>" class="img-responsive" alt="Photo">
						
						</div>     
                                                  
                                           <?php   }
                                              
                                          } ?>
						
					</div>
				</div>
			</section>
			<!-- End Main Slide -->
		<!-- Begin Ads -->
			<section class="collections">
				<div class="container">
					<div class="row">
						<div class="col-sm-4 collect-item animation">
							<a href="#" class="collect-item-thumb"><img src="<?php echo base_url(); ?>/assets/designer/images/content/products/collect-1.jpg" class="img-responsive" alt="Ad"></a>
							<h2>T-shirts for all your summer</h2>
							<p>Elementum vel augue eu, congue accumsan nulla. Curabitur blandit lectus nunc, ac egestas quam facilisis sit amet.</p>
							<a href="#" class="btn">Read More</a>
						</div>
						<div class="col-sm-4 collect-item animation">
							<a href="#" class="collect-item-thumb"><img src="<?php echo base_url(); ?>/assets/designer/images/content/products/collect-2.jpg" class="img-responsive" alt="Ad"></a>
							<h2>Womens wear collections</h2>
							<p>Vestibulum metus diam, elementum vel augue eu, congue accumsan nulla. Curabitur blandit lectus nunc, ac egestas quam facilisis.</p>
							<a href="#" class="btn">Read More</a>
						</div>
						<div class="col-sm-4 collect-item animation">
							<a href="#" class="collect-item-thumb"><img src="<?php echo base_url(); ?>/assets/designer/images/content/products/collect-3.jpg" class="img-responsive" alt="Ad"></a>
							<h2>Accesories LookBook 2014</h2>
							<p>Curabitur blandit lectus nunc, ac egestas quam facilisis sit amet. Vestibulum metus diam, elementum vel congue accumsan nulla. </p>
							<a href="#" class="btn">Read More</a>
						</div>
					</div>
				</div>
			</section>
			<!-- End Ads -->
			
			<!-- Begin press Women -->
			<section>
				<div class="container">
				<div class="short-intro text-center">
				<h1>Press Release</h1>
				</div>
					
  
  <div class="row">
    <div class="col-md-12">
      <div class="carousel slide media-carousel" id="media">
        <div class="carousel-inner">
          <div class="item  active">
            <div class="row">
              <div class="col-md-4 col-xs-4">
                <a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox" >
				 <img src="<?php echo base_url(); ?>/assets/designer/images/content/press/1.jpg" alt="...">
				</a>
              </div>         
             <div class="col-md-4 col-xs-4">
                <a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox" >
				 <img src="<?php echo base_url(); ?>/assets/designer/images/content/press/2.jpg" alt="...">
				</a>
              </div>
             <div class="col-md-4 col-xs-4">
                <a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox" ><img alt="" src="<?php echo base_url(); ?>/assets/designer/images/content/press/3.jpg"></a>
              </div>        
            </div>
          </div>
          <div class="item">
            <div class="row">
              <div class="col-md-4 col-xs-4">
                <a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"><img alt="" src="<?php echo base_url(); ?>/assets/designer/images/content/press/4.jpg"></a>
              </div>          
              <div class="col-md-4 col-xs-4">
                <a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"><img alt="" src="<?php echo base_url(); ?>/assets/designer/images/content/press/5.jpg"></a>
              </div>
              <div class="col-md-4 col-xs-4">
                <a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"><img alt="" src="<?php echo base_url(); ?>/assets/designer/images/content/press/6.jpg"></a>
              </div>        
            </div>
          </div>
          <div class="item">
            <div class="row">
              <div class="col-md-4 col-xs-4">
                <a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"><img alt="" src="<?php echo base_url(); ?>/assets/designer/images/content/press/7.jpg"></a>
              </div>          
              <div class="col-md-4 col-xs-4">
                <a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"><img alt="" src="<?php echo base_url(); ?>/assets/designer/images/content/press/8.jpg"></a>
              </div>
              <div class="col-md-4 col-xs-4">
                <a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"><img alt="" src="<?php echo base_url(); ?>/assets/designer/images/content/press/9.jpg"></a>
              </div>      
            </div>
          </div>
		   <div class="item">
            <div class="row">
              <div class="col-md-4 col-xs-4">
                <a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"><img alt="" src="<?php echo base_url(); ?>/assets/designer/images/content/press/10.jpg"></a>
              </div>          
              <div class="col-md-4 col-xs-4">
                <a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"><img alt="" src="<?php echo base_url(); ?>/assets/designer/images/content/press/11.jpg"></a>
              </div>
              <div class="col-md-4 col-xs-4">
                <a href="#" class="thumbnail" data-toggle="modal" data-target="#lightbox"><img alt="" src="<?php echo base_url(); ?>/assets/designer/images/content/press/12.jpg"></a>
              </div>      
            </div>
          </div>
        </div>
        <a data-slide="prev" href="#media" class="left carousel-control">‹</a>
        <a data-slide="next" href="#media" class="right carousel-control">›</a>
      </div>                          
    </div>
  </div>
<div id="lightbox" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <button type="button" class="close hidden" data-dismiss="modal" aria-hidden="true">×</button>
        <div class="modal-content">
            <div class="modal-body">
                <img src="" alt="" />
            </div>
        </div>
    </div>
</div>
				</div>
			</section>
        
        
        
        <!-- End Static Content -->
          
          
          
        
        
        
	<!--  MIDDLE STARTS -->
	<!--section class="wrapper cms_area" style="min-height:600px">
  	<div class="p10 pt30">
    	<h1 class="bb2 pb3"><?php// echo $content['page_name'];?></h1>
	    <?php// echo $content['page_description'];?>    
  	</div>
	</section>
	<!-- MIDDLE ENDS -->
	<!--section class="wrapper pt15  bt1 mid_banner_cont">
  	<?php 
		//$cond = array();
		//$cond['position'] = "Bottom Banner";
		//banner_display($cond,330,182,'mid_banner', '<div class="mid_banner">', '</div>', "3");
		?>
	</section>

<!--content section-->
<?php $this->load->view("bottom_application");?>