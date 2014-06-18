<?php
/*
Template Name: Contact Template
*/
?>

<?php get_template_part('templates/content', 'page'); ?>

<div class="contact-1 section">
	<div class="container">
		<!-- <div id="contact-map"></div> -->
		<div class="contact-area">
			<div class="contact-form">
				<img class="leaning-robin" src='<?php echo get_stylesheet_directory_uri(); ?>/assets/img/contact-robin.png'/>
				<h3>Let's get in touch.</h3>
				<?php echo do_shortcode('[contact-form-7 id="27" title="Contact form 1"]'); ?>
			</div>
			<!-- <div class="contact-address col-sm-3">
				<h3>Meet Us In Person</h3>
				<div class="contact-data">
					<div class="row">
						<a href="#">Address line, P.O Box, City, Country</a>
					</div>
					<div class="row">
						<span>Phone:</span>
						<a href="#">123 (88) 999 258</a>
					</div>
					<div class="row">
						<span>Fax:</span>
						<a href="#">123 (88) 999 258</a>
					</div>
					<div class="row">
						<span>Email:</span>
						<a href="#">info@Mintmegapack.com</a>
					</div>
					<div class="row">
						<span>URL:</span>
						<a href="#">www.Mintmegapack.com</a>
					</div>
				</div>
				<ul>
					<li><a href="#" class="contact-facebook"></a></li>
					<li><a href="#" class="contact-twitter"></a></li>
					<li><a href="#" class="contact-vimeo"></a></li>
					<li><a href="#" class="contact-myspace"></a></li>
					<li><a href="#" class="contact-flickr"></a></li>
					<li><a href="#" class="contact-dribbble"></a></li>
				</ul>
			</div> -->
		</div>
	</div>
</div>
