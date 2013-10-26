<div id="forgotPasswordModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<?php  echo form_open('', array('method' => 'post', 'class' => 'no-margin', 'id' => 'forgot-form')); ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Reset Password</h3>
    </div>
    <div class="modal-body">
    	<p>We will send you an email to reset your password.</p>
        <p class="form-inline"><label>Email</label>&nbsp;&nbsp;&nbsp;<input type="email" id="inputEmail" name="inputEmail" placeholder="" tabindex="3" maxlength="100" autocomplete="off" />&nbsp;&nbsp;&nbsp;<span id="progress"></span></p>
        <p id="form-msg"></p>
    </div>
    <div class="modal-footer">
          <button type="button" class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
          <button type="submit" name="forgot" class="btn btn-primary">Submit</button>
    </div>
    <?php echo form_close(); ?>
</div>

<div id="detailsModal" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">	
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" id="cancel_modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">    	
    	<p><?=$highlights?></p>
		<span id="progress"></span>
        <p id="form-msg"></p>
    </div>
    <div class="modal-footer">
        <div class="pull-left" id="modal-msg"></div>
        <button type="button" class="btn" data-dismiss="modal" id="cancel_modal" aria-hidden="true">Close</button>
	    <button type="button" class="btn btn-primary" id="add_to_cart" name="add_to_cart" style="display: none;">
            <i class="icon-shopping-cart"></i> Add To Cart
        </button>
    </div>
</div>
