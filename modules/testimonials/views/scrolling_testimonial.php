<?php
$res_array=$this->db->query("select * from wl_testimonial where status='1' order by testimonial_id desc")->result_array();
//trace($res_array);
if(is_array($res_array) && !empty($res_array)){
	?>
	<p class="fr ttu black weight600 mt5"><a href="<?php echo base_url();?>testimonials" class="uo">View More »</a></p>
  <h3>Testimonials</h3>
  <div class="f_test_box rel o-hid ml12 mt5">
  	<div class="test_scroll">
    	<ul class="myulx">
				<?php
        foreach($res_array as $val){
          ?>
          <li>
          	<p class="lht-18 fs12 o-hid gray texti_text"><a href="<?php echo $val['friendly_url']; ?>"><?php echo char_limiter($val['testimonial_description'],320);?></a></p>
            <p class="red fs12 mt5"><?php echo $val['poster_name'];?></p>
          </li>
          <?php 
        }
				?>
      </ul>
    </div>
  </div>
  <?php      
}
?>