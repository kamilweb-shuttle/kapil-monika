<?php $this->load->view("top_application");?>
<section>
<div class="bg1 min-h mt5 p10">
<!--tree-->
<div class="mt5">
<h1>Thank You</h1>
<p class="tree mt10"><strong class="fs11 ttu">You are here :</strong> <a href="<?php echo base_url();?>" class="home-icon"><img src="<?php echo theme_url(); ?>images/spacer.gif" width="16" alt=""></a> <span class="pr2 fs14">»</span> Thank You</p>
</div>
<!--tree-->

<div class="aj mt10">
<div class="p20 mt20 bdr-2b pb10"> <img src="<?php echo theme_url(); ?>images/cng.png" class="fl mr10" alt="" />
    <p class="fs14 brown Questrial b pt20">Thank You! <?php echo $this->session->userdata('name');?>
    <span class="black arl pt5 fs12 db verd">
	You has been register successfully.</span></p>
<?php /*?>    <div class="mt8 verd lht-16 fs11 bt bb p6 bg-grey1" style="border-color:#f1f1f1;"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </div><?php */?>
    <div class="al pb10 mt10"><a href="<?php echo base_url();?>member" class="blacklink1">:: Back To My Account ::</a></div>
</div>
</div>

</div>
</section>
<?php $this->load->view("banner/footer_banner");?>
<?php $this->load->view("bottom_application");?>