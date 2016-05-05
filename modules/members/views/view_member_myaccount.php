<?php $this->load->view("top_application"); ?>
<div role="main" class="main">

<!-- Begin page top -->
 <?php if($this->session->userdata('user_id')!=''){ ?>
<section class="page-breadcrumb">
    <div class="container">

        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>

            <li class="active">Ethinic Wear for Women</li>
        </ol>

    </div>
</section>
<!-- End page top -->

<div class="container">
    <h2>Account Information</h2>
    <div class="row">
        <div class="col-md-8 animation">
            <ul role="tablist" class="nav nav-tabs pro-tabs">
                <li class="active"><a data-toggle="tab" role="tab" href="#myaccount">My Dashboard</a></li>
                <li><a data-toggle="tab" role="tab" href="#edit">Edit Account</a></li>
                <li><a data-toggle="tab" role="tab" href="#address">Address Book</a></li>

            </ul>
            
            <div class="tab-content">
                <div id="myaccount" class="tab-pane active">
                    
                    <h2>Hello <?php echo $this->session->userdata('first_name'); ?></h2>

                    <p>From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.</p>

                </div>
                <div id="edit" class="tab-pane">
                    <form class="form-horizontal">

                        <div class="form-group">
                            <label for="inputFN" class="col-sm-2 control-label">First Name </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="inputFN">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputLN" class="col-sm-2 control-label">Last Name </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="inputLN">
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Email Address </label>
                            <div class="col-sm-6">
                                <input type="email" class="form-control" id="inputEmail3">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6 col-sm-offset-2">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox">
                                        Change Password</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6 col-sm-offset-2">
                                <input type="submit" value="Edit" class="btn btn-primary btn-sm">
                                <input type="submit" value="Save" class="btn btn-primary btn-sm">
                            </div>
                        </div>

                    </form>

                </div>
                <div id="address" class="tab-pane">
                    <form class="form-horizontal">

                        <div class="form-group">
                            <label for="inputFN" class="col-sm-3 control-label">First Name </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="inputFN">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputLN" class="col-sm-3 control-label">Last Name </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="inputLN">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputCN" class="col-sm-3 control-label">Company Name</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="inputCN">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPhone" class="col-sm-3 control-label">Phone </label>
                            <div class="col-sm-5">
                                <input type="number" class="form-control" id="inputPhone">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAdd" class="col-sm-3 control-label">Address </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="inputAdd">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-5 col-sm-offset-3">
                                <input type="text" class="form-control" id="inputAdd">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputCity" class="col-sm-3 control-label">Town / City </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="inputCity">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPostcode" class="col-sm-3 control-label">Postcode </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="inputPostcode">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="selectCountry" class="col-sm-3 control-label">Country </label>
                            <div class="col-sm-5">
                                <div class="list-sort">
                                    <select id="selectCountry" class="formDropdown">
                                        <option value="">Select a country</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-sm-5 col-sm-offset-3">
                                <input type="submit" value="Edit" class="btn btn-primary btn-sm">
                                <input type="submit" value="Save" class="btn btn-primary btn-sm">
                            </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>	

</div>
</div>
 <?php } ?>













<!--div class="mob_hider"></div>
<!-- HEADER ENDS -->
<!--div class="breadcrumbs mob_hider">
<div class="wrapper">
<p class="ml5">YOU ARE HERE : <a href="<?php echo base_url(); ?>"><img src="<?php echo theme_url(); ?>images/hm.png" class="vam pb3" alt=""></a> <b>&gt;</b><strong>My Account</strong></p>
</div>
</div>

<section class="wrapper pt30" style="min-height:450px">
<div class="inner_wrapper">
<h1 class="mb5">My Account</h1>
<ul class="emp_acc_link">
<li><a href="<?php echo base_url(); ?>members/myaccount" class="act">My Home</a></li>
<li><a href="<?php echo base_url(); ?>members/orders_history">Order History</a></li>
<li><a href="<?php echo base_url(); ?>members/manage_addresses">My Addresses</a></li>
<li><a href="<?php echo base_url(); ?>members/subscriptions">My Subscriptions</a></li>
<li><a href="<?php echo base_url(); ?>members/edit_account">Manage Account</a></li>
</ul>
<div class="cb"></div>
<div class="mt2">
<div>
        <div class="p1 pt2 bg-white">
        <div class="p15 bg-gray border1 acc_title">
        <img src="<?php echo theme_url(); ?>images/user.png" width="42" height="43" class="fl mr10" alt="">
        <p class="fs18 ttu b black">
        Welcome <?php echo ($this->fname != '' || $this->fname != 0) ? $this->fname : 'Member'; ?>!
      </p>
        <p class="mt5">Last Login : <?php echo getDateFormat($this->last_login, 6); ?>/ <span class="red"><a href="<?php echo base_url(); ?>users/logout" class="underline"><img src="<?php echo theme_url(); ?>images/lgt.png" width="17" height="17" class="vam mr5" alt="">Logout!</a></span></p>
    </div>
<!-- left ends --> 
<br />
<br />
<!--div class="acc_mid_boxes">
    <div class="p20 pb30">
    <div class="acc_mid_boxes_title">
            <p class="fs28 black weight300 ttu lht-28">Welcome to <b>Telepoint</b></p>
            <p class="fs16 ml3 mt5 bree gray">What do you want to do today?</p>
    </div>
    <div class="mt50">
            <div class="box1">
            <p class="ac"><img src="<?php echo theme_url(); ?>images/add1.gif" width="110" height="86" alt=""></p>
              <p class="fs16 mt5">Review Your Previous Orders</p>
            <p class="mt10"> <a href="<?php echo base_url(); ?>members/orders_history" class="btn1 radius-20">Continue</a> </p>
            </div>
            <div class="box1">
            <p class="ac"><img src="<?php echo theme_url(); ?>images/add2.gif" width="110" height="86" alt=""></p>
            <p class="fs16 mt5">Update Your Account Info.</p>
            <p class="mt10"> <a href="<?php echo base_url(); ?>members/edit_account" class="btn1 radius-20">Continue</a> </p>
            </div>
            <div class="box1">
            <p class="ac"><img src="<?php echo theme_url(); ?>images/add3.gif" width="110" height="86" alt=""></p>
            <p class="fs16 mt5"> Manage Your Addresses</p>
            <p class="mt10"> <a href="<?php echo base_url(); ?>members/manage_addresses" class="btn1 radius-20">Continue</a> </p>
            </div>
            <div class="cb pb50"></div>
          </div>
      </div>
  </div>
<div class="auto w50 bb3 pb5"></div>
      <div class="auto w70 bb3 pb5"></div>
    <br>
    </div>
</div>
</div>
<div class="cb"></div>
</div>
</section>
<section class="wrapper pt15  bt1 mid_banner_cont">

<div class="cb"></div>
</section-->

<?php $this->load->view("bottom_application"); ?>