<?php $this->load->view('project_footer'); ?>

</div>


<!-- Begin Search -->
<div class="modal fade bs-example-modal-lg search-wrapper" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <p class="clearfix"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button></p>
            <form class="form-inline form-search" role="form">
                <div class="form-group">
                    <label class="sr-only" for="textsearch">Enter text search</label>
                    <input type="text" class="form-control input-lg" id="textsearch" placeholder="Enter text search">
                </div>
                <button type="submit" class="btn btn-white">Search</button>
            </form>
        </div>
    </div>
</div>
<!-- End Search -->
<!-- Begin Registration -->
<div class="modal fade bs-example2-modal-lg search-wrapper register" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <p class="clearfix"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button></p>
            <div class="alert alert-danger" id="reg_err" style="display:none"></div>
            <div class="alert alert-success" id="reg_suc" style="display:none"></div>
            <form id="form-registration" role="form" class="form-horizontal">
                <h4>Register</h4>
                <p>If you're not a member, register here.</p>
                <div class="form-group">

                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="firstname" name="first_name" placeholder="Firstname">
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="lastname" name="last_name" placeholder="Lastname">
                    </div>
                </div>
                <div class="form-group">

                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="telephone" name="mobile_num" placeholder="Mobile Number">
                    </div>
                    <div class="col-sm-5">
                        <input type="email" class="form-control" name="email_address"  class="form-control"  placeholder="Email Address" placeholder="Email Address">
                    </div>
                </div>
                <div class="form-group">

                    <div class="col-sm-5">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" id="c_password" name="c_password" placeholder="Confirm Password">
                    </div>
                </div>	
                <div class="form-group">
                    <div class="col-sm-10">
                        <div class="checkbox">
                            <label>
                                <input name="terms" id="terms" type="checkbox"> I accept the <a href="#" target="_blank">Terms and Coditions</a>
                            </label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-white">Register</button>

            </form>
        </div>
    </div>
</div>
<!-- End Registration -->


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo base_url(); ?>/assets/designer/vendor/jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="<?php echo base_url(); ?>/assets/designer/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
// $("#myModal").modal('show');
    });
</script>
<script src="<?php echo base_url(); ?>/assets/designer/bootstrap/js/bootstrap-hover-dropdown.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/designer/vendor/owl-carousel/owl.carousel.js"></script>
<script src="<?php echo base_url(); ?>/assets/designer/vendor/modernizr.custom.js"></script>
<script src="<?php echo base_url(); ?>/assets/designer/vendor/jquery.stellar.js"></script>
<script src="<?php echo base_url(); ?>/assets/designer/vendor/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/designer/vendor/masonry.pkgd.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/designer/vendor/jquery.pricefilter.js"></script>
<script src="<?php echo base_url(); ?>/assets/designer/vendor/bxslider/jquery.bxslider.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/designer/vendor/mediaelement-and-player.js"></script>
<script src="<?php echo base_url(); ?>/assets/designer/vendor/waypoints.min.js"></script>
<script src="<?php echo base_url(); ?>/assets/designer/vendor/flexslider/jquery.flexslider-min.js"></script>

<!-- Theme Initializer -->
<script src="<?php echo base_url(); ?>/assets/designer/js/theme.plugins.js"></script>
<script src="<?php echo base_url(); ?>/assets/designer/js/theme.js"></script>

<script>
    $(document).on('click', '.panel-heading span.clickable', function (e) {
        var $this = $(this);
        if (!$this.hasClass('panel-collapsed')) {
            $this.parents('.panel').find('.panel-body').slideUp();
            $this.addClass('panel-collapsed');
            $this.find('i').removeClass('fa fa-minus').addClass('fa fa-plus');
        } else {
            $this.parents('.panel').find('.panel-body').slideDown();
            $this.removeClass('panel-collapsed');
            $this.find('i').removeClass('fa fa-plus').addClass('fa fa-minus');
        }
    });
    
  //registeration function
  
 $(document).ready(function(){
     $("#form-registration").submit(function(e){
        e.preventDefault();
        var form_data=$(this).serialize();
        $.ajax({
            type:"Post",
            url:'<?php echo site_url(); ?>users/register',
            data:form_data,
            dataType:"html",
            //async:false,
            success:function(msg){
               
             if (msg==1){
                $("#reg_suc").html("You are successfully Resitered enjoy shopping with us").fadeIn('slow').delay(3000).fadeOut('slow',function(){
                   
                    
                 });
                 window.location.replace('<?php echo base_url() ?>members/myaccount');
               
             }else if(msg==2){
                $("#reg_suc").html("You are successfully Resitered enjoy shopping with us").fadeIn('slow').delay(3000).fadeOut('slow',function(){
                      
                 });
                setTimeout(function(){
                    window.location.href='<?php echo base_url() ?>members/myaccount';
                },4000);
                }  else{
                 
               $("#reg_err").html(msg).fadeIn('slow').delay(3000).fadeOut('slow');
                        
                }   
            },
            
        });
     });
     
     
    $(document).on('click','#user_logout',function(){
      $.ajax({
            url:'<?php echo site_url(); ?>users/logout',
            success:function(){
              location.reload(); 
              
            },
            
        });
    }); 
    
    $("#form-login").submit(function(e){
    e.preventDefault();
      var form_data=$(this).serialize();
        $.ajax({
            type:"Post",
            url:'<?php echo site_url(); ?>users/login',
            data:form_data,
            async:false,
            dataType:"html",
            success:function(msg){
              //location.reload();
              if(msg==2){
                  $("#login_err").html("You are successfully Logedin").fadeIn('slow').delay(3000).fadeOut('slow');
                  setTimeout(function(){
                    window.location.href='<?php echo base_url() ?>members/myaccount';
                },4000);
              }else if(msg==3){
                  $("#login_err").html("Login failed invaid Email/Password").fadeIn('slow').delay(3000).fadeOut('slow'); 
              }else if(msg==4){
               $("#login_err").html("You are successfully Logedin").fadeIn('slow').delay(3000).fadeOut('slow');
                    setTimeout(function(){
                    window.location.href='<?php echo base_url() ?>members/myaccount';
                },4000);
              }else{
             $("#login_err").html(msg).fadeIn('slow').delay(3000).fadeOut('slow');
              }    
        },
            
        });
    });
    
     
     
 }); 
    
    
    
    
</script>

</body>
</html>