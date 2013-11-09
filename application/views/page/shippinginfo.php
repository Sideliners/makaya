<div class="well well-small">
	<h3><?=$page_title;?></h3>
    <?php $formAttr = array('method' => 'post', 'id' => 'shippinginfo_form', 'class' => 'form-horizontal'); ?>
    
    <?php if(isset($error_msg)): ?>
    <div class="alert alert-error"><?=$error_msg?></div>
    <?php elseif(isset($success_msg)): ?>
    <div class="alert alert-success"><?=$success_msg?></div>
    <?php endif; ?>
    
    <?php echo form_open('', $formAttr); ?>
    	<h4>Shipping Address</h4>
    	<div class="control-group">
            <label class="control-label" for="country">Country</label>
            <div class="controls">
            	<select class="select2" autofocus tabindex="1">
                	<option value="0" selected> - Country - </option>
                    <?php
					if ($countries) {						
	                    foreach ($countries as $country) {							
							echo "<option value='{$country->country_code}'>{$country->country_name}</option>";
						}
					}
					?>                    
                </select>
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="firstname">First Name</label>
            <div class="controls">            	
            	<input type="text" id="firstname" name="firstname" placeholder="First Name" tabindex="2" value="<?php 
					if ($firstname = $this->session->userdata('firstname')) echo $firstname;
					else echo $this->input->post('firstname');
				?>" />
            </div>
        </div>
        
		<div class="control-group">
            <label class="control-label" for="lastname">Last Name</label>
            <div class="controls">
            	<input type="text" id="lastname" name="lastname" placeholder="Last Name" tabindex="3" value="<?php 
					if ($lastname = $this->session->userdata('lastname')) echo $lastname;
					else echo $this->input->post('lastname');
				?>" />				
            </div>
        </div>
        
		<div class="control-group">
            <label class="control-label" for="street_address_1">Street Address Line 1</label>
            <div class="controls">
            	<input type="text" id="street_address_1" name="street_address_1" placeholder="Street Address Line 1" tabindex="4" value="<?php  echo $this->input->post('street_address_1'); ?>" />
            </div>
        </div>
       
		<div class="control-group">
            <label class="control-label" for="street_address_2">Street Address Line 2</label>
            <div class="controls">
            	<input type="text" id="street_address_2" name="street_address_2" placeholder="Street Address Line 2" tabindex="5" value="<?php  echo $this->input->post('street_address_2'); ?>" />
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="city">City</label>
            <div class="controls">
            	<input type="text" id="city" name="city" placeholder="City" tabindex="6" value="<?php  echo $this->input->post('city'); ?>" />
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for="province">State/Province/Region</label>
            <div class="controls">
            	<input type="text" id="province" name="province" placeholder="State/Province/Region" tabindex="7" value="<?php echo $this->input->post('province'); ?>" />
            </div>
        </div>        
              
        <div class="control-group">
            <label class="control-label" for="postal_code">Postal Code</label>
            <div class="controls">
            	<input type="text" id="postal_code" name="postal_code" placeholder="Postal Code" tabindex="8" value="<?php  echo $this->input->post('postal_code'); ?>" />
            </div>
        </div>
        
        <h4>Contact Info</h4>
    	<div class="control-group">
            <label class="control-label" for="email_address">Email Address</label>
            <div class="controls">
            	<?php if($this->session->userdata('email')): ?>
                <label class="label label-success"><?=$this->session->userdata('email')?></label>
                <?php else: ?>
            	<input type="text" id="email_address" name="email_address" placeholder="Email Address" tabindex="9" maxlength="100" value="<?php echo $this->input->post('email_address'); ?>" />
				<?php endif; ?>
            </div>
        </div>
        
		<div class="control-group">
            <label class="control-label" for="phone_number">Phone Number</label>
            <div class="controls">
            	<input type="text" id="phone_number" name="phone_number" placeholder="Phone Number" tabindex="10" value="<?php  echo $this->input->post('phone_number'); ?>" />
            </div>
        </div>
        
        <div class="control-group">
        	<label class="control-label" for=""></label>
            <div class="controls">
        		<a href="#" class="btn btn-info" name="continue" tabindex="11">Continue</a>
            </div>
        </div>

        
    <?php echo form_close(); ?>
</div>