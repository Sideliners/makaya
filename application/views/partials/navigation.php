<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </a>
             
            <!-- Be sure to leave the brand out there if you want it shown -->
            <a class="brand" href="<?=base_url();?>" titla="<?=$site_title;?>" alt="<?=$site_title;?>">Project name</a>
             
            <!-- Everything you want hidden at 940px or less, place within here -->
            <div class="nav-collapse collapse navbar-responsive-collapse">
                <!--<ul class="nav">
                    <li><a href="#">Home</a></li>
					<li><a href="#">Link</a></li>
                    <li><a href="#">Link</a></li>
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">Dropdown <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li class="nav-header">Nav header</li>
                            <li><a href="#">Separated link</a></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>-->
                
                <ul class="nav pull-right">
                	<li><a href="<?=site_url('shopping-cart');?>"><i class="badge badge-info" id="cart_count"><?=$this->cart->total_items();?></i>&nbsp;&nbsp;Cart Items <i class="icon-shopping-cart"></i></a></li>
                	<?php if(!isset($user)): ?>
                	<li class="<?php echo ($page == 'register')? 'active' : ''; ?>"><a href="<?=site_url('account/register');?>">Create Account</a></li>
                    <li class="<?php echo ($page == 'login')? 'active' : ''; ?>"><a href="<?=site_url('account/login');?>">Login</a></li>
                    <?php else: ?>
                    <li class="divider-vertical"></li>
                    <li class="dropdown">
                    	<a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php  echo ucwords($user['fname']); ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?=site_url('account/profile');?>">Profile</a></li>
                            <li class="divider"></li>
                            <li><a href="<?=site_url('account/logout');?>">Logout</a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                </ul>
                <?php $attr = array('class' => 'navbar-search pull-right margin-right form-search', 'method' => 'post'); ?>
                <?=form_open('search', $attr);?>
                	<div class="input-append">
                        <input type="text" placeholder="Search Products" name="q" class="search-query span2" />
                        <button type="submit" class="btn btn-info"><i class="icon-search"></i></button>
                    </div>
             	<?=form_close();?>
            </div>
        </div>
    </div>
</div>
