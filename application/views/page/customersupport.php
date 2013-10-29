<?php $formAttr = array('method' => 'post', 'id' => 'customersupport_form', 'class' => 'form-horizontal'); ?>
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
            	<?php if($this->session->userdata('email')): ?>
                <label class="label label-success"><?=$this->session->userdata('email')?></label>
                <?php else: ?>
            	<input type="email" id="inputEmail" name="inputEmail" placeholder="" tabindex="1" maxlength="100" autofocus  value="<?php echo $this->input->post('inputEmail'); ?>" />
				<?php endif; ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="user_name">Name</label>
            <div class="controls">
            	<?php if($this->session->userdata('email')): ?>
                <label class="label label-success"><?=$this->session->userdata('user_name')?></label>
                <?php else: ?>
            	<input type="text" id="user_name" name="user_name" placeholder="" tabindex="2" maxlength="30" value="<?php echo $this->input->post('user_name'); ?>" />
				<?php endif; ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="message">Message</label>
            <div class="controls">
            	<textarea id="message" name="message" placeholder="" tabindex="3" ><?php echo $this->input->post('message'); ?></textarea>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for=""></label>
            <div class="controls">
            	<button type="submit" class="btn btn-primary" name="send" tabindex="4">Send</button>&nbsp;
                <a href="<?=base_url();?>" class="btn">Cancel</a>
            </div>
        </div>
    <?php echo form_close(); ?>
</div>