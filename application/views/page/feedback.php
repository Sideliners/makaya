<div class="well well-small">
<h3><?=$page_title;?></h3>
    <?php 
        if ( $feedbacks ){
            foreach ($feedbacks as $feedback) {
                echo "<div>";
                echo "<h4 class='text'>{$feedback->feedback_subject}</h4>";
				echo "<span class='text text-info'>by <strong>{$feedback->feedback_email}</strong> last <strong>{$feedback->feedback_date_created}</strong></span>";
                echo "<div class='alert alert-info'>{$feedback->feedback_message}</div>";
                echo "</div>";
            }
        }
        else {
            echo "No Feedback yet.";
        }
    ?>
</div>

<?php $formAttr = array('method' => 'post', 'id' => 'feedback_form', 'class' => 'form-horizontal'); ?>
<div>
	<h4>Post Your Feedback Now!</h4>
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
            	<input type="email" id="inputEmail" name="inputEmail" placeholder="" tabindex="1" maxlength="100" value="<?php echo $this->input->post('inputEmail'); ?>" required />
				<?php endif; ?>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="subject">Subject</label>
            <div class="controls">
                <input type="text" id="subject" name="subject" placeholder="" tabindex="2" maxlength="100" value="<?php echo $this->input->post('subject'); ?>" required/>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="message">Message</label>
            <div class="controls">
            	<textarea id="message" name="message" placeholder="" tabindex="3" required><?php echo $this->input->post('message'); ?></textarea>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for=""></label>
            <div class="controls">
            	<button type="submit" class="btn btn-primary" name="create" tabindex="4">Submit</button>&nbsp;
                <a href="<?=base_url();?>" class="btn">Cancel</a>
            </div>
        </div>
    <?php echo form_close(); ?>
</div>

