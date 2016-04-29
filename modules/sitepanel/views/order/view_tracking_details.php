<?php 
$this->load->view('includes/face_header'); 
echo form_open('');
echo error_message();
	?>
	<table width="100%" border="0" cellspacing="4" cellpadding="0" class="grey">
  	<tr valign="top" >
    	<td colspan="4" align="right" >
      	<table width="100%"  border="0" cellspacing="2" cellpadding="2">
        	<tr align="left" bgcolor="#1588BB" class="white">
          	<td colspan="7" bgcolor="#CCCCCC" ><strong> Update Tracking Details : </strong></td>
          </tr>
          <tr valign="top" >
            <td width="40%" align="left" ><strong>  Tracking Code : </strong></td>
            <td width="60%" align="left" >
 							<input type="text" name="tracking_code" value="<?php echo set_value('tracking_code',$result['tracking_code']); ?>"><?php echo form_error('tracking_code');?>
           	</td>
          </tr>
          <tr valign="top" >
            <td align="left" ><strong>User Id : </strong></td>
            <td align="left" >
            	<textarea name="tracking_text" cols="70" rows="20"><?php echo set_value('tracking_text',$result['tracking_text']); ?></textarea><?php echo form_error('tracking_text');?>
            </td>
          </tr>          
          <tr>
          	<td colspan="4"><input type="submit" name="action" value="Update" /></td>
          </tr>
        </table>
			</td>
    </tr>
    <tr align="left" valign="top" bgcolor="#FFFFFF" >
    	<td colspan="4" ><span class="b white"><strong> </strong></span></td>
    </tr>
	</table>
<?php echo form_close(); ?>  
</body>
</html>