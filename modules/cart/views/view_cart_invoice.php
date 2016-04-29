<?php $this->load->view("top_application");?>
  <section class="wrapper" style="min-height:450px">
    <div class="inner_wrapper pt20">
      <div class="inv_ttl bg-pale p10"> <img src="<?php echo theme_url(); ?>images/yes.png" class="fl mr10" alt="">
        <h3 class="b">Thank You, <?php echo $ordmaster['first_name']; ?></h3>
        <p>Your Order has been placed successfully. A confirmation email and invoice have been sent to your email id <b>(<?php echo $this->session->userdata('username'); ?>)</b></p>
      </div>
      <h1 class="mt40 bb2 pb5">Invoice</h1>
      <?php echo invoice_content($ordmaster,$orddetail,$dlink='');?>    
      <br>
      <br>
    </div>
  </section>
<?php $this->load->view("bottom_application");?>