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
            <label class="control-label" for="inputEmail">Email</label>
            <div class="controls">
            	<input type="email" id="inputEmail" name="inputEmail" placeholder="" tabindex="3" maxlength="100" value="<?php echo $this->input->post('inputEmail'); ?>"  />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputPassword">Password</label>
            <div class="controls">
            	<input type="password" id="inputPassword" name="inputPassword" placeholder="" tabindex="4" value="" />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="confirmPassword">Confirm Password</label>
            <div class="controls">
            	<input type="password" id="confirmPassword" name="confirmPassword" placeholder="" tabindex="5" value="" />
            </div>
        </div>
        <div class="control-group">
        	<label class="control-label" for=""></label>
            <div class="controls">
        		<button type="submit" class="btn btn-primary" name="create" tabindex="6">Create</button>
            </div>
        </div>
    <?php echo form_close(); ?>
</div>