<?php
$col_res = $this->db->query("SELECT * FROM wl_colors WHERE status = '1' order by sort_order")->result_array();
$size_res = $this->db->query("SELECT * FROM wl_sizes WHERE status = '1' order by sort_order")->result_array();
//if(empty($catid)) $catid = 0;
?>
<?php echo form_open("",'id="refineSearch" method="post" ');?>
<div class="left_zone mob_hider">
  <p class="black b fr mt40"><a href="javascript:void(0);" class="clear_all uu">Clear All</a></p>
  <h2><b class="fs14 lht-16">Filter</b><br>Records</h2>
  <p class="bg-gray border1 p6 pl6 lht-24 ttu black mt7 oswald fs16">
  	<a href="<?php echo base_url(); ?>category">
    	<img src="<?php echo theme_url(); ?>images/blt0.png" class="fl mr5 mt3" alt="">Category
    </a>
  </p>
  <div class="mylinks1 mt15 ml9">
		<?php	
		if(!empty($catid)){ echo category_breadcrumbs_left($catid);	}
		else{
			$cat_res = $this->db->query("SELECT * FROM wl_categories WHERE status = '1' and parent_id = '0'")->result_array();
			$sl=1;
			foreach($cat_res as $key=>$val){
				if($sl == 1) $cls = 'class="act"';
				else $cls = "";
				?>
  	    <a href="<?php echo base_url().$val['friendly_url']; ?>" <?php echo $cls; ?>><?php echo $val['category_name']; ?></a>
    	  <?php
				$sl++;
			}
		}
		?>
  </div>
  
  <p class="bg-gray border1 p6 pl6 lht-24 ttu black mt25 oswald fs16"><img src="<?php echo theme_url(); ?>images/blt0.png" class="fl mr5 mt3" alt="">Color <span class="fr fs11"><a href="javascript:void(0);" class="clear_color uu">Clear All</a></span></p>
  <div class="p10 fs13 gray lht-20" style="height:150px; overflow:scroll">
  	<?php
		if(is_array($col_res) && !empty($col_res)){
			foreach($col_res as $key=>$val){
				$chks="";
				if($this->input->post('color',TRUE)){
					if(in_array($val['color_id'],$this->input->post('color'))) $chks = 'checked="checked"';					
				}
				?>
		  	<p class="mt3">
    		  <label>
        		<input name="color[]" type="checkbox" <?php echo $chks; ?> value="<?php echo $val['color_id'] ;?>" class="col fl mr10 mt4"><b style="background:#<?php echo $val['color_code']; ?>" class="color_box_n"></b>
		        <?php echo $val['color_name'] ;?>
    		  </label>
		    </p>
        <?php
			}
		}
		?>
  </div>
  
  <p class="bg-gray border1 p6 pl6 lht-24 ttu black mt25 oswald fs16"><img src="<?php echo theme_url(); ?>images/blt0.png" class="fl mr5 mt3" alt="">Size <span class="fr fs11"><a href="javascript:void(0);" class="clear_size uu">Clear All</a></span></p>
  <div class="p10 fs13 gray lht-20" style="height:150px; overflow:scroll">
	  <?php
		if(is_array($size_res) && !empty($size_res)){
			foreach($size_res as $key=>$val){
				$chk="";
				if($this->input->post('size',TRUE)){
					if(in_array($val['size_id'],$this->input->post('size'))) $chk = 'checked="checked"';					
				}
				?>
        <p class="mt3">
          <label>
            <input name="size[]" type="checkbox" <?php echo $chk; ?> value="<?php echo $val['size_id'] ;?>" class="sz fl mr10 mt4">
            <?php echo $val['size_name'] ;?>
          </label>
        </p>
        <?php
			}
		}
		?>
  </div>
  <p class="bg-gray border1 p6 pl6 lht-24 ttu black mt25 oswald fs16"><img src="<?php echo theme_url(); ?>images/blt0.png" class="fl mr5 mt3" alt="">Price <span class="fr fs11"><a href="javascript:void(0);" class="clear_price uu">Clear All</a></span></p>
  <div class="p10 fs13 gray lht-20" style="min-height:150px; overflow:scroll;">
  	<?php
		$priceArray = $this->config->item('priceRange');
		
		foreach($priceArray as $key=>$val){
			$chkp="";
				if($this->input->post('price',TRUE)){
					if($key==$this->input->post('price')) $chkp = 'checked="checked"';					
				}
			?>
    	<p class="mt3">
      	<label>
        	<input name="price" type="radio" <?php echo $chkp; ?> value="<?php echo $key; ?>" class="pr fl mr10 mt4">
        	<?php echo $val; ?></label>
    	</p>
      <?php
		}
		?>
  </div>
  <?php
	if($this->input->post('keyword')!=''){
		?>
		<input type="hidden" name="keyword" value="<?php echo $this->input->post('keyword'); ?>" />
    <?php
	}
	?>
  <!-- filter ends -->
  <p class="bb2 pb15"></p>
  <br />
  <?php 
	$cond = array();
	$cond['position'] = "Left Banner";
	banner_display($cond,200,900,'r_banner', '<p class="r_banner">', '</p>', "1");
	?>
</div>
<?php echo form_close(); ?>
<script type="text/javascript">
	jQuery(document).ready(function(e) {
		jQuery(':checkbox, :radio').live('click',function(){
			jQuery('#refineSearch').submit();
		});	
		jQuery('.clear_color').live('click',function(){
			jQuery('.col').attr('checked', false);	
			jQuery('#refineSearch').submit();
		});
		jQuery('.clear_size').live('click',function(){
			jQuery('.sz').attr('checked', false);	
			jQuery('#refineSearch').submit();
		});
		jQuery('.clear_price').live('click',function(){
			jQuery('.pr').attr('checked', false);	
			jQuery('#refineSearch').submit();
		});
		jQuery('.clear_all').live('click',function(){
			jQuery('.pr, .sz, .col').attr('checked', false);	
			jQuery('#refineSearch').submit();
		});
	});
</script>