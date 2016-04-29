<div class="p10 bg-gray1 mt10 radius-5">
    <div class="ac-link-left">
        <p class="fs15 black"><?php echo ($this->fname!='' || $this->fname!=0)?$this->fname:'Member';?></p>
        
    </div>
    <div class="ac-link-right">
        <div class="acclnk">
            <a href="<?php echo base_url();?>members/edit_account">Edit Account</a> 
            <a href="<?php echo base_url();?>members/change_password">Change Password</a> 
            <a href="<?php echo base_url();?>members/orders_history">Order History</a> 
            <a href="<?php echo base_url();?>members/favourites">My Favorites</a> 
            <a href="<?php echo base_url();?>users/logout">Logout</a>
        </div>
    </div>
    <div class="cb"></div>
</div>