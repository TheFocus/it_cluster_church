<?php
/**
* The header for our theme.
*
* Displays all of the <head> section and everything up till <div id="content">
	*
	* @package ultrabootstrap
	*/
	?><!DOCTYPE html>
	<html <?php language_attributes(); ?>>
		<head>
			<meta charset="<?php bloginfo( 'charset' ); ?>">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="profile" href="http://gmpg.org/xfn/11">
			<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
			<?php wp_head(); ?>
		</head>
		<body <?php body_class(); ?>>
			<?php $header_text_color = get_header_textcolor();?>

				<?php 
					if(is_home() || is_front_page()) {
						include('header-home.php');
						include('page-home.php');
					} else {
						include('header-sm.php');
					}
				?>
