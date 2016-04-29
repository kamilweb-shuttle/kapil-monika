<?php $this->load->view("top_application");?>
<section class="mb25">
    <!--tree-->
    <div class="breadcrumb mt8 mb8 mob_hider">
        <div class="wrapper">
            <b class="ttu"><span class="red">You Are Here :</span> </b>
            <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb" class="dib"><a href="<?=base_url();?>" itemprop="url"><span itemprop="title">
               <img src="<?=theme_url();?>images/tree-home.png" class="vam" alt="<?=$this->config->item('site_name');?>" title="<?=$this->config->item('site_name');?>" /></span></a></div>   
            <b>&gt;</b>   
            <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"  class="dib"><span itemprop="title"><strong><a href="<?=base_url();?>members/myaccount">My Account</a></strong></span></div>
            <b>&gt;</b>   
            <div itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"  class="dib"><span itemprop="title"><strong>Change Password</strong></span></div>
        </div>
    </div>
    <!--tree-->

    <div class="wrapper">
        <div class="pl10 pr10 cms_area">
            <h1><span>Change Password</span></h1>
            <div class="cb bt1 mb10"></div>
            <?php $this->load->view("members/myaccount_top");?>
            <div class="p15 mt10 bg-white shadow3">  
        <?php echo form_open('members/change_password'); 
          error_message(); ?>
                <div class="bb1 pb15">
                    <p class="fs16 black bb pb10 mb30">Password  Information</p>
                    <p class="input-left"><label for="old_password">Old Password <span class="red">*</span></label></p>
                    <div class="input-right">
                        <input name="old_password" id="old_password" type="password" class="w98" /><?php echo form_error('old_password');?></div>
                    <div class="cb mb10"></div>

                    <p class="input-left"><label for="new_password">New Password </label></p>
                    <div class="input-right">
                        <input name="new_password" id="new_password" type="password" class="w98" /><?php echo form_error('new_password');?></div>
                    <div class="cb mb10"></div>

                    <p class="input-left"><label for="confirm_password">Confirm Password <span class="red">*</span></label></p>
                    <div class="input-right"><input name="confirm_password" id="confirm_password" type="password" class="w98" />
		   <?php echo form_error('confirm_password');?>
                    <br>
                    <br>
                     <input name="submit" type="submit" class="btn4" value="Update" />
                      <input name="reset" type="reset" class="btn2" value="Reset" />
                    </div>
                    <div class="cb mb10"></div>
                </div>
    <?php echo form_close();?>    
            </div>
        </div>
    </div>
</section>
<?php $this->load->view("bottom_application");?>