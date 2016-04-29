<?php $this->load->view('top_application');
// $this->loyalty_model->update_loyalty_points($this->userId, 22);
 ?>
<div class="container"><!--Container-Starts-->
  <section class="lh18px aj"><!--Content--Starts-->
    <h1><?=$unq_section;?></h1>
    <p class="tree"><a href="<?php echo base_url();?>">Home</a><a href="<?php echo base_url();?>members/myaccount">My Account</a> <?=$unq_section;?></p>
    <section class="mt10"><!--My-Account-Starts-->
     <?php $this->load->view('myaccount_right');?>
    <div class="w68 fr">
      <!--Right-Part-Starts-->
      <p class="bgW shadow1 fs20 p15 radius-5 ac"><img src="<?php echo theme_url();?>images/check-out.png" width="51" height="50" alt="smily" class="mr10 vam">Congratulations ! you have earned <span class="red poiret b ar ml10 fs30"><?php echo $loyalty['debited_points'];?> Points</span> </p>
      <div class="mt10 bg-grey1 ac p10 b">Remaining Points : <span class="red"><?php echo $loyalty['available_points'];?></span>    |    Used Points : <span class="blue"><?php echo $loyalty['credited_points'];?></span> </div>
      <?php echo error_message();?>      
      <div class="cb"></div>
   <?php foreach($gift as $key => $val ){?>   
      <div class="mt10 fs11 p10">
       <p class="b"><?php echo $val['gift_title'];?></p>
       <div class="mt5"><?php echo $val['gift_description'];?></div>
      </div>
      <p class="mt10 ac"><img src="<?php echo get_image('gifts', $val['gif_image'], 450, 250, 'R');?>" alt="redeem" /></p>
      <p class="mt10 ac bgW b fs20 p10"><span class="red">Use <?php echo $val['reedem_points'];?> Points To Buy This Offer - </span> <a href="<?php echo base_url();?>members/loyalty/<?php echo $val['id'];?>" class="black">Buy Now</a></p>
   <?php } ?>   
      <div class="cb"></div>
      
      <!--Right-Part-Ends-->
    </div>
    <!--My-Account-Ends--></section>
    <!--Content-Ends--></section>
  <div class="cb"></div>
  <!--Container-Ends--></div>
<?php $this->load->view('bottom_application'); ?>