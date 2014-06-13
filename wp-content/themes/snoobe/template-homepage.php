<?php
/*
Template Name: Home Template
*/
?>

<?php get_template_part('templates/content', 'page'); ?>

<?php 
	if(isMobile()) {
		include('templates/home-mobile.php');
	} else {
		include('templates/home-desktop.php');
	} 
?>