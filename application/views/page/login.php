<?php $formAttr = array('method' => 'post', 'id' => 'reg_form', 'class' => 'form-horizontal'); ?>
<div class="well well-small">
	<h3><?=$page_title;?></h3>
    <?php if(isset($error_msg)): ?>
    <div class="alert alert-error"><?=$error_msg?></div>
    <?php elseif(isset($success_msg)): ?>
    <div class="alert alert-success"><?=$success_msg?></div>
    <?php endif; ?>
    <?php echo form_open('', $formAttr); ?>
    	<div class="control-group">
            <label class="control-label" for="inputEmail">Email</label>
            <div class="controls">
            	<input type="email" id="inputEmail" name="inputEmail" placeholder="" tabindex="1" maxlength="100" autofocus  value="<?php echo $this->input->post('inputEmail'); ?>" />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputPassword">Password</label>
            <div class="controls">
            	<input type="password" id="inputPassword" name="inputPassword" placeholder="" tabindex="2" />
                <span class="help-block"><a href="#forgotPasswordModal" role="button" data-toggle="modal">Forgot password?</a></span>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for=""></label>
            <div class="controls">
            	<button type="submit" class="btn btn-primary" name="login" tabindex="6">Log In</button>&nbsp;
                <a href="<?=base_url();?>" class="btn">Cancel</a>
            </div>
        </div>
    <?php echo form_close(); ?>
</div>