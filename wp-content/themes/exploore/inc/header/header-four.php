<header>
	<div class="bg-transparent header-04">
		<div class="header-topbar">
			<div class="container"><?php 
				if(has_action('wpml_add_language_selector')) {
					$show_laguage_switcher = Slzexploore::get_option('slz-language-switcher');
					if($show_laguage_switcher == '1'){
						echo '<ul class="topbar-left list-unstyled list-inline pull-left"><div class="wpml-language">';
						do_action('wpml_add_language_selector');
						echo '</div>'.$topbar_left.'</ul>';
					}
					else{
						echo '<ul class="topbar-left list-unstyled list-inline pull-left">'.$topbar_left.'</ul>';
					}
				}
				else{
					echo '<ul class="topbar-left list-unstyled list-inline pull-left">'.$topbar_left.'</ul>';
				}
				do_action( 'slzexploore_login_link' ) .'';?>
			</div>
		</div>
		<div class="header-main">
			<div class="container">
				<div class="header-main-wrapper">
					<div class="hamburger-menu">
						<div class="hamburger-menu-wrapper">
							<div class="icons"></div>
						</div>
					</div>
					<div class="navbar-header pull-left">
						 <div class="logo">
							<a href="<?php echo esc_url(site_url()); ?>" class="header-logo">
								<?php echo wp_kses_post($header_logo_transparent_data);?>
							</a>
						</div>
					</div>
					<nav class="navigation"><?php 
						slzexploore_show_main_menu();
						if ( Slzexploore::get_option('slz-header-search-icon') == '1' ) {?>
							<div class="button-search"><span class="main-menu"><i class="fa fa-search"></i></span></div>
							<div class="nav-search hide">
								<?php get_search_form(true);?>
							</div>
						<?php } ?>
					</nav>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
</header>