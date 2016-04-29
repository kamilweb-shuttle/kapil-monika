<?php $this->load->view('includes/face_header'); ?>
    <table width="100%" border="0" cellspacing="1" cellpadding="5" class="grey">
      <tr valign="top" >
        <td align="right" >
          <table width="100%"  border="0" cellspacing="1" cellpadding="3">
            <tr align="left" bgcolor="#1588BB" class="white">
              <td colspan="3" bgcolor="#CCCCCC" ><strong> Login Details (IP Address) : </strong></td>
            </tr>
            <tr bgcolor="#CCCCCC" class="white">
            	<td width="20%"><strong>Sl.</strong></td>
              <td width="60%"><strong>IP Address</strong></td>
              <td width="20%"><strong>Login Date</strong></td>
            </tr>
            <?php
						if(is_array($mres) && !empty($mres)){
							$sl=1;
							foreach($mres as $key=>$val){
								?>
                <tr>
                  <td><?php echo $sl; ?>.</td>
                  <td><?php echo $val['ip_address']; ?></td>
                  <td><?php echo getDateFormat($val['recv_date'],2);?></td>
                </tr>
                <?php
								$sl++;
							}
						}
						?>
            <tr>
              <td colspan="3">&nbsp;</td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
	</body>
</html>