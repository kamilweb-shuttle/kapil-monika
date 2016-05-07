<?php $this->load->view("top_application"); ?>

<!-- Begin Main -->
<div role="main" class="main">

    <!-- Begin page top -->
    <section class="page-breadcrumb">
        <div class="container">

            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>

                <li class="active">Ethinic Wear for Women</li>
            </ol>

        </div>
    </section>
    <!-- End page top -->
<?php if(validation_errors()!=''){?>
    <div class="alert alert-danger"><?php echo validation_errors();  ?></div>
 <?php } ?>
    <div class="container">
<form method="post" action="<?php echo site_url() ?>cart/checkout_user">
        <div class="row featured-boxes">
            
            <div class="col-md-8">

                <div class="featured-box featured-box-secondary featured-box-cart">
                    <div class="box-content">
                        <h4>Billing Address</h4>
                        <p>Constructed in cotton sweat fabric, this lovely piece, lacus eu mattis auctor, dolor lectus venenatis nulla</p>
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="selectCountry" class="col-sm-2 control-label">Country <span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <div class="list-sort">
                                        <?php $countries=$this->db->query("select * from wl_countries ")->result();  ?>
                                        <select  class="formDropdown" name="check_country">
                                            <option value="">Select a country</option>
                                            <?php foreach($countries as $country){ ?>
                                             <option value="<?php echo $country->country_id ?>" <?php if(count($user_add)>0 && $user_add['country']==$country->country_id){echo "selected";} ?>><?php echo $country->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputFN" class="col-sm-2 control-label"> Name <span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="check_name" value="<?php if(count($user_add)>0 && $user_add['name']!=''){echo $user_add['name'] ;} ?>" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputLN" class="col-sm-2 control-label">Landmark <span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="check_landmark" value="<?php if(count($user_add)>0 && $user_add['landmark']!=''){echo $user_add['landmark'] ;} ?>" >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="inputAdd" class="col-sm-2 control-label">Address <span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="check_address" value="<?php if(count($user_add)>0 && $user_add['address']!=''){echo $user_add['address'] ;} ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="text" class="form-control" name="check_state" value="<?php if(count($user_add)>0 && $user_add['state']!=''){echo $user_add['state'] ;} ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputCity" class="col-sm-2 control-label">Town / City <span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="check_city" value="<?php if(count($user_add)>0 && $user_add['city']!=''){echo $user_add['city'] ;} ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPostcode" class="col-sm-2 control-label">Postcode <span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="check_zipcode" value="<?php if(count($user_add)>0 && $user_add['zipcode']!=''){echo $user_add['zipcode'] ;} ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Email Address <span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="check_email" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPhone" class="col-sm-2 control-label">Phone <span class="required">*</span></label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="check_mobile" value="<?php if(count($user_add)>0 && $user_add['mobile']!=''){echo $user_add['mobile'] ;} ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="same_bill_ship" value="<?php if(count($user_add)>0 && $user_add['address_type']=='Bill'){echo 'checked' ;} ?>" >
                                            Ship to billing address? </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="textNotes" class="col-sm-2 control-label">Order Notes</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="5" id="textNotes"></textarea>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="featured-box featured-box-secondary sidebar">
                    <div class="box-content">
                        <h4>Your Order</h4>
                        <table cellspacing="0" class="cart-totals" width="100%">
                            <tbody>
                                 <?php 
                               //  echo "<pre>";
                                   // print_r($this->cart->contents());
                                    $total='';
                                    if(count($this->cart->contents())){ 
                                 foreach($this->cart->contents() as $item){ ?>
                                <tr class="cart_table_item">
                                    <th>
                                        <span class="product-name"><?php echo $item['origname']; ?></span><br>
                                        <span class="quantity">Quantity: <?php echo $item['qty'] ?></span>
                                    </th>
                                    <td class="product-price">
                                        <span class="amount"><?php echo $item['subtotal']; ?></span>
                                    </td>
                                </tr>
                                 <?php 
                                 $total+=$item['subtotal'];
                                } 
                                 
                                }
                                ?>
                                <tr class="cart-subtotal">
                                    <th>
                                       Cart Subtotal
                                    </th>
                                    <td class="product-price">
                                        <span class="amount"><?php echo $total; ?></span>
                                    </td>
                                </tr>
                                <tr class="shipping">
                                    <th>
                                        Shipping
                                    </th>
                                    <td>
                                        Free Shipping<input type="hidden" value="free_shipping" id="shipping_method" name="shipping_method">
                                    </td>
                                </tr>
                                <tr class="total">
                                    <th>
                                        Total
                                    </th>
                                    <td class="product-price">
                                        <strong><span class="amount"><?php echo $total; ?></span></strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <h4>Payment Method</h4>
                        <div class="panel-group panel-group2" id="accordion">
                            <!--div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title"> <label><input type="radio" id="radio1" name="radio"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Direct Bank Transfer</a></label>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in">
                                    <div class="panel-body"> 
                                        <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order wont be shipped until the funds have cleared in our account.</p>
                                    </div>
                                </div>
                            </div-->
                            <!--div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title"> <label><input type="radio" id="radio2" name="radio"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Cheque Payment</a></label> </h5>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="panel-body"> <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.</p> </div>
                                </div>
                            </div-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title"> <label><input type="radio" id="radio3" name="radio" checked> <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">COD</a></label> </h5>
                                </div>
                                <div class="panel-heading">
                                    <h5 class="panel-title"> <label><input type="radio" id="radio3" name="radio"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">PayPal</a></label> </h5>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p><input type="submit" value="Place Order" class="btn btn-primary btn-block btn-sm" data-loading-text="Loading..."></p>
                    </div>
                </div>
            </div>
        </div>
</form>
    </div>

</div>



<?php $this->load->view("bottom_application"); ?>



