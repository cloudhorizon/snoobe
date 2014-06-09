<?php
/*
Template Name: Product Template
*/
?>

<?php get_template_part('templates/content', 'page'); ?>

<div class="header">
	<h1>Product</h1>
	<p>Lorem ipsum dolor.</p>
	<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/robin-product.png" class="robin">
</div>
<div class="product-1 section">
	<h1>How Snoobe Works</h1>
	<p class="subheader">Most people get so confused by the different offers that they end up keeping an 
		expensive plan because they don't know where else to go.  Snoobe is a simple app that analyzes how you 
		have been using your phone for the last few months and recommends the best plan FOR YOU!</p>
	<div class="container">
		<div class="column col-sm-4">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/column-install.png">
			<h3>Install and Run</h3>
			<p>Install and run the Snoobe app onto your smartphone. 
				With your permission, Snoobe and Robin read phone usage data (downloads, incoming and outgoing calls,
				 call times, long-distance, etc.).</p>
		</div>
		<div class="column col-sm-4">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/column-recomendation.png">
			<h3>Robin’s Recommendation</h3>
			<p>Based on actual usage, Snoobe then queries its daily dynamic database to find
			 you the very best plan in the area with the help of our patented algorithms.</p>
		</div>
		<div class="column col-sm-4">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/column-pick-plan.png">
			<h3>Pick a Better Plan</h3>
			<p>Once the perfect plan has been selected, you get to pick a mobile boutique and schedule
			 a call to setup your new contract.</p>
		</div>
	</div>
</div>
<div class="product-2 green">
	<h2>Keep Snoobe & Keep Saving</h2>
	<p>Snoobe keeps track of usage patterns and wireless plans.</br>
	If a better deal or promotion comes along, Snoobe lets you know about it.
	</p>
</div>
<div class="product-3 section">
	<h1>Carriers</h1>
	<p class="subheader">Are you confused about which carrier to turn to? 
	Run Snoobe and get the answer in a quick minute.</br>
	It compares 100+ plans from the main carriers in Canada & USA!</p>
	<div class="container">
		<img class="carriers" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/carriers.png">
	</div>
</div>
<div class="product-4 section">
	<h1>Testimonials</h1>
	<?php echo do_shortcode('[testimonialswidget_list]'); ?>
</div>

