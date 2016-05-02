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
				<form id="form-login" role="form" class="form-horizontal">
				<h4>Register</h4>
				<p>If you're not a member, register here.</p>
				<div class="form-group">
   
    <div class="col-sm-5">
      <input type="text" class="form-control" id="inputEmail3" placeholder="Firstname">
    </div>
<div class="col-sm-5">
      <input type="text" class="form-control" id="inputEmail3" placeholder="Lastname">
    </div>
  </div>
  			<div class="form-group">
   
    <div class="col-sm-5">
      <input type="text" class="form-control" id="inputEmail3" placeholder="Telephone">
    </div>
<div class="col-sm-5">
      <input type="email" class="form-control" id="inputEmail3" placeholder="Email Address">
    </div>
  </div>
				<div class="form-group">
   
    <div class="col-sm-5">
      <input type="password" class="form-control" id="inputEmail3" placeholder="Password">
    </div>
<div class="col-sm-5">
      <input type="password" class="form-control" id="inputEmail3" placeholder="Confirm Password">
    </div>
  </div>	
   <div class="form-group">
    <div class="col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> I accept the <a href="#" target="_blank">Terms and Coditions</a>
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
    $(document).ready(function(){
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
	
	
	
</body>
</html>