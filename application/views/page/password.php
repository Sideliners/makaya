<?php $formAttr = array('method' => 'post', 'id' => 'password_form', 'class' => 'form-horizontal'); ?>
<div class="well well-small">
	<h3><?=$page_title;?>
    <div class="btn-group pull-right">            
            <a class="btn btn-info" href="<?=site_url('account/profile');?>">Personal Info</a>
            <button class="btn">Change Password</button>
        </div>
    </h3>
    <?php if(isset($error_msg)): ?>
    <div class="alert alert-error"><?=$error_msg?></div>
    <?php elseif(isset($success_msg)): ?>
    <div class="alert alert-success"><?=$success_msg?></div>
    <?php endif; ?>
	<?php echo form_open('', $formAttr); ?>
        <div class="control-group">
            <label class="control-label" for="oldPassword">Old Password</label>
            <div class="controls">
            	<input type="password" id="oldPassword" name="oldPassword" placeholder="" autofocus tabindex="1" value="" />
            </div>
        </div>
    
        <div class="control-group">
            <label class="control-label" for="newPassword">New Password</label>
            <div class="controls">
            	<input type="password" id="newPassword" name="newPassword" placeholder="" tabindex="2" value="" />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="confirmPassword">Confirm Password</label>
            <div class="controls">
            	<input type="password" id="confirmPassword" name="confirmPassword" placeholder="" tabindex="3" value="" />
            </div>
        </div>
        <div class="control-group">
        	<label class="control-label" for=""></label>
            <div class="controls">
        		<button type="submit" class="btn btn-primary" name="update" tabindex="4">Submit</button>&nbsp;
                <a href="<?=site_url('account/profile');?>" class="btn">Cancel</a>
            </div>
        </div>
    <?php echo form_close(); ?>
</div>