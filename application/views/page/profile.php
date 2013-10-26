<?php $formAttr = array('method' => 'post', 'id' => 'profile_form', 'class' => 'form-horizontal'); ?>
<div class="well well-small">
	<h3><?=$page_title;?>
    <div class="btn-group pull-right">
            <button class="btn">Personal Info</button>
            <a class="btn btn-info" href="<?=site_url('account/password');?>">Change Password</a>
        </div>
    </h3>
    <div>
		<?php if(isset($error_msg)): ?>
        <div class="alert alert-error"><?=$error_msg?></div>
        <?php elseif(isset($success_msg)): ?>
        <div class="alert alert-success"><?=$success_msg?></div>
        <?php endif; ?>
        <?php echo form_open('', $formAttr); ?>
            <div class="control-group">        
                <label class="control-label" for="email">Email</label>
                <div class="controls">
                    <span class="label label-info"><?=$this->session->userdata('email');?></span>
                </div>
            </div>
            <div class="control-group">        
                <label class="control-label" for="f_name">First Name</label>
                <div class="controls">
                    <input type="text" id="f_name" name="f_name" placeholder="" tabindex="1" autofocus  maxlength="30" value="<?php echo $this->input->post('f_name'); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="l_name">Last Name</label>
                <div class="controls">
                    <input type="text" id="l_name" name="l_name" placeholder="" tabindex="2"  maxlength="30" value="<?php echo $this->input->post('l_name'); ?>" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for=""></label>
                <div class="controls">
                    <button type="submit" class="btn btn-primary" name="update" tabindex="3">Save</button>&nbsp;
                    <a href="<?=base_url();?>" class="btn">Cancel</a>               
                    
                </div>
            </div>
        <?php echo form_close(); ?>
    </div>
    
</div>