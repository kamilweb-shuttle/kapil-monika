<body>
<!-- BEGIN modal on page load -->
<div class="suscribe">
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">suscribe to newsletter</h4>
      </div>
      <div class="modal-body ">
        <p class="text-center">Sign up with your email to get updates about new resources releases and special offers.</p>
		<form class="form-inline text-center">
  
  <div class="form-group">
 
    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="jane.doe@example.com">
  </div>
  <button type="submit" class="btn btn-default">Send invitation</button>
</form>
      </div>
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</div>
	<div id="page">
		        <?php $this->load->view('top_menu'); ?>
			<?php $this->load->view('nav_menu'); ?>
		</header>
		
		<!-- Begin Login -->
		<div class="login-wrapper">
			<form id="form-login" role="form">
                            <div id="login_err" class="alert alert-danger" style="display:none"></div>
				<h4>Login</h4>
				<p>If you're a member, login here.</p>
				<div class="form-group">
					<label for="inputusername">Email</label>
					<input type="text" name="login_email" class="form-control input-lg" id="login_email" placeholder="Email">
				</div>
				<div class="form-group">
					<label for="inputpassword">Password</label>
					<input name="login_password" type="password" class="form-control input-lg" id="login_password" placeholder="Password">
				</div>
				<ul class="list-inline">
					<li><a href="#" data-toggle="modal" data-target=".bs-example2-modal-lg" id="register">Create new account</a></li>
					<li><a href="#">Request new password</a></li>
				</ul>
				<button type="submit" class="btn btn-white">Log in</button>
				<button type="submit" class="btn-close btn btn-white" >Close</button>
			</form>
		</div>