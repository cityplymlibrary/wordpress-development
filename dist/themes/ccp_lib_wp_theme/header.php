<!doctype html>  

<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<a class="skip-link sr-only sr-only-focusable" href="#main">
		<?php _e( 'Skip to content', 'simple-bootstrap' ); ?>
	</a>
	<div id="content-wrapper">
		<header id="header-region">
			<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
				<h1 id="logo">
					<a class="navbar-brand" href="/cgi-bin/koha/opac-main.pl">
						City College Plymouth
					</a>
				</h1>
				<?php if (has_nav_menu("main_nav")): ?>
				<button class="navbar-toggler" type="button" data-toggle="collapse"
					data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
					aria-expanded="false" aria-label="<?php _e('Toggle Navigation', 'simple-bootstrap'); ?>">
					<span class="navbar-toggler-icon"></span>
				</button>
				<?php endif ?>
				<?php if (has_nav_menu("main_nav")): ?>
				<div id="navbarSupportedContent" class="collapse navbar-collapse">
					<?php
					    simple_bootstrap_display_main_menu();
					?>
				</div>
				<?php endif ?>
				<div class="float-right">
					<ul id="menu-login-menu" class="navbar-nav mr-auto">
						<?php if (!is_user_logged_in()): ?>
						<li id="menu-item-login" class="nav-item menu-item menu-item-type-post_type menu-item-object-page">
							<a class="nav-link" href="<?php echo home_url() . '/wp-login.php'; ?>"><i class="fa fa-user fa-fw" aria-hidden="true"></i> <span>Log in to your account</span></a>
						</li>
						<?php endif ?>
						<?php if (is_user_logged_in()): ?>
						<li id="menu-item-logout" class="nav-item menu-item menu-item-type-post_type menu-item-object-page">
							<a class="nav-link" href="<?php echo home_url() . '/wp-login.php?action=logout'; ?>"><i class="fas fa-sign-out-alt fa-fw" aria-hidden="true"></i> <span>Log out</span></a>
						</li>
						<?php endif ?>
					</ul>
				</div>
			</nav>
                       <div id="header-image-container">
                           <div id="header-image" style="background-image: url('<?php echo get_header_image(); ?>')">&nbsp;</div>
                       </div>
                   </header>
		<div id="page-content">
