<?php $this->load->view('includes/header'); ?>  
  <div id="content">
  
  <div class="breadcrumb">
  
       <?php echo anchor('sitepanel/dashbord','Home'); ?> &raquo; <?php echo $heading_title; ?> </a>   
             
   </div>      
       
 <div class="box">
 
    <div class="heading">
    
      <h1><img src="<?php echo base_url(); ?>assets/sitepanel/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      
      <div class="buttons">  <?php echo anchor("sitepanel/zip_location/add/",'<span>Add Zip Location</span>','class="button" ' );?></div>
      
    </div>
      
     <div class="content">   
     	<?php echo validation_message();?>
	    <?php echo error_message(); ?>
     	<?
			echo form_open_multipart("sitepanel/zip_location",'id="form"');?>
				<table width="55%" align="center" bgcolor="#999999" border="0" cellspacing="1" cellpadding="3" >
					<tr bgcolor="#FFFFFF">
						<td align="left"><strong style="font-size:14px">Bulk Upload - Location</strong></td>
					</tr>
					<tr bgcolor="#FFFFFF">
						<td align="" ><strong>Upload Excel File</strong> 
							<input type="file" name="excel_file" />&nbsp;
							<input type="hidden" name="action" value="submit_excel" />
							<input type="submit" name="submit" value="Submit" />&nbsp;&nbsp;&nbsp; <a href="<?php echo base_url()?>assets/sample/sample_location.xls">Download Excel File</a>
            </td>
					</tr>  
				</table>
			<?php echo form_close();?>
     
      <?php 
	
	       echo form_open("sitepanel/zip_location/",'id="search_form" method="get" ');?>
             <div align="right" class="breadcrumb"> Records Per Page : <?php echo display_record_per_page();?> </div>
			<table width="100%"  border="0" cellspacing="3" cellpadding="3" >
				<tr>
					<td align="center" >Search [ Location Name,Zip Code] 
					  <input type="text" name="keyword" value="<?php echo $this->input->get_post('keyword');?>"  />&nbsp;
					<a  onclick="$('#search_form').submit();" class="button"><span> GO </span></a>
					
					 <?php if($this->input->get_post('keyword')!='')
					   {
						    
					     echo anchor("sitepanel/zip_location/",'<span>Clear Search</span>');
						
					   }
					   ?>
					</td>
				</tr>
			</table>
            
	 <?php echo form_close();?>	
     
      
	 <?php 
	   if( is_array($res) && !empty($res) )
	  {
	 
	    echo form_open("sitepanel/zip_location/",'id="data_form"');?>
     
	  <table class="list" width="100%" id="my_data">
     
        <thead>
          <tr>
            <td width="25" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'arr_ids\']').attr('checked', this.checked);" /></td>
            <td width="375" class="left">Location Name</td>
            <td width="100" class="center">Zip Code</td>
            <td width="100" class="center">Cod Available</td>
						<td width="100" class="center">Status</td>
            <td width="100" class="center">Action</td>
          </tr>
        </thead>
		
        <tbody>
          <?php
		  $j=1; 
			foreach($res as $catKey=>$pageVal)
			{
		   ?> 
          <tr>
            <td style="text-align: center;">
            <input type="checkbox" name="arr_ids[]" value="<?php echo $pageVal['zip_location_id'];?>" /></td>
            <td class="left"><?php echo $pageVal['location_name'];?></td>
            <td class="center"><?php echo $pageVal['zip_code'];?></td>
            <td class="center"><?php echo ($pageVal['cod']=='N')?"Not Available":"Available";?></td>
		    		<td class="center"><?php echo ($pageVal['status']==1)?"Active":"In-active";?></td>
            <td class="center"><?php echo anchor("sitepanel/zip_location/edit/$pageVal[zip_location_id]/".query_string(),'Edit'); ?></td>
          </tr>
          <?php
		   $j++;}		  
		  ?> 
          <tr><td colspan="7" align="right" height="30"><?php echo $page_links; ?></td></tr>     
        </tbody>
    	<tr>
			<td align="left" colspan="7" style="padding:2px" height="35">
				<input name="status_action" type="submit"  value="Activate" class="button2" id="Activate" onClick="return validcheckstatus('arr_ids[]','Activate','Record','u_status_arr[]');"/>
				<input name="status_action" type="submit" class="button2" value="Deactivate" id="Deactivate"  onClick="return validcheckstatus('arr_ids[]','Deactivate','Record','u_status_arr[]');"/>
				<input name="status_action" type="submit" class="button2" id="Delete" value="Delete"  onClick="return validcheckstatus('arr_ids[]','delete','Record');"/>
			</td>
	</tr>
      </table>
	<?php echo form_close();
	 }else{
	    echo "<center><strong> No record(s) found !</strong></center>" ;
	 }
	?> 
	 
  </div>
</div>
<?php $this->load->view('includes/footer'); ?>