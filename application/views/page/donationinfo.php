<div class="well well-small">
	<h3><?=$page_title;?></h3>
    <?php $formAttr = array('method' => 'post', 'id' => 'donationinfo_form', 'class' => 'form-horizontal'); ?>
    
    <?php if(isset($error_msg)): ?>
    <div class="alert alert-error"><?=$error_msg?></div>
    <?php elseif(isset($success_msg)): ?>
    <div class="alert alert-success"><?=$success_msg?></div>
    <?php endif; ?>
    
    <?php echo form_open('', $formAttr); ?>
		<?php
		$artisans_enterprises = "";
        if ($artisans) {
            foreach ($artisans as $artisan) {							
                $artisans_enterprises .= "<option value='{$artisan->artisan_id}'>{$artisan->artisan_name}</option>";
            }
        }
        if ($enterprises) {
            foreach ($enterprises as $enterprise) {							
                $artisans_enterprises .= "<option value='{$enterprise->enterprise_id}'>{$enterprise->enterprise_name}</option>";
            }
        }
        ?>              
    
    	<h4>Artisan / Enterprise</h4>
    	<div class="control-group">
            <label class="control-label" for="artisan_enterprise">Artisan/Enterprise</label>
            <div class="controls">
            	<select class="select2" autofocus tabindex="1">
                	<option value="0" selected> - Artisan/Enterprise - </option>
      				<?=$artisans_enterprises?>
                </select>
            </div>
        </div>
        
		<div class="control-group">
            <label class="control-label" for="recipient">Recipient</label>
            <div class="controls">
            	<select class="select2" tabindex="2">
                	<option value="0" selected> - Choose a Recipient - </option>
      				<?=$artisans_enterprises?>
                </select>
            </div>
        </div>
        
        <h4>Enter An Amount</h4>
		<div class="control-group">
            <label class="control-label" for="amount">Amount</label>
            <div class="controls">
	            <input type="radio" id="amount" name="amount" tabindex="3" value="" />Php xxx.xx
            </div>
            <div class="controls">
                <input type="radio" id="amount" name="amount" tabindex="3" value="" />Php xxx.xx
            </div>
            <div class="controls">
                <input type="radio" id="amount" name="amount" tabindex="3" value="" />Php xxx.xx
            </div>
            <div class="controls">
                <input type="radio" id="amount" name="amount" tabindex="3" value="" />Other Amount
            </div>
            <div class="controls">
                <input type="text" id="amount" name="amount" placeholder="Php xxx.xx" tabindex="3" value="" />
            </div>
        </div>
        
        <div class="control-group">
            <div class="controls">
                <input type="checkbox" id="make_honor" name="make_honor" tabindex="4"/> Make this donation in honor of                
            </div>
            <div class="controls">
                <input type="text" id="donator" name="donator" placeholder="" tabindex="5" value="" />
            </div>
        </div>
        
        <h4>Donor Information</h4>
        <div class="control-group">
            <label class="control-label" for="firstname">First Name</label>
            <div class="controls">            	
            	<input type="text" id="firstname" name="firstname" placeholder="First Name" tabindex="6" value="<?php 
					if ($firstname = $this->session->userdata('firstname')) echo $firstname;
					else echo $this->input->post('firstname');
				?>" />
            </div>
        </div>
        
		<div class="control-group">
            <label class="control-label" for="lastname">Last Name</label>
            <div class="controls">
            	<input type="text" id="lastname" name="lastname" placeholder="Last Name" tabindex="7" value="<?php 
					if ($lastname = $this->session->userdata('lastname')) echo $lastname;
					else echo $this->input->post('lastname');
				?>" />				
            </div>
        </div>

    	<div class="control-group">
            <label class="control-label" for="email_address">Email Address</label>
            <div class="controls">
            	<?php if($this->session->userdata('email')): ?>
                <label class="label label-success"><?=$this->session->userdata('email')?></label>
                <?php else: ?>
            	<input type="text" id="email_address" name="email_address" placeholder="Email Address" tabindex="8" maxlength="100" value="<?php echo $this->input->post('email_address'); ?>" />
				<?php endif; ?>
            </div>
        </div>
        
		<div class="control-group">
            <label class="control-label" for="phone_number">Phone Number</label>
            <div class="controls">
            	<input type="text" id="phone_number" name="phone_number" placeholder="Phone Number" tabindex="9" value="<?php  echo $this->input->post('phone_number'); ?>" />
            </div>
        </div>
        
        <div class="control-group">
        	<label class="control-label" for=""></label>
            <div class="controls">
        		<a href="#" class="btn btn-info" name="continue" tabindex="10">Continue</a>
            </div>
        </div>

        
    <?php echo form_close(); ?>
</div>