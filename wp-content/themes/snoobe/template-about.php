<?php
/*
Template Name: About Template
*/
?>

<?php get_template_part('templates/content', 'page'); ?>

<div class="header">
	<h1>About</h1>
	<p>Learn more about the people behind Snoobe.</p>
	<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/robin-about.png" class="robin">
</div>
<div class="about-1 section">
	<h1>Who are we?</h1>
	<p class="subheader">Aenean commodo ligula eget dolor. Aenean massa. 
		Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. 
		Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Donec pede justo, fringilla vel, aliquet 
		nec, vulputate eget, arcu. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et 
		magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, 
		pretium quis, sem. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</br>
		Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, 
		nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. 
		Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.</p>
</div>
<div class="about-2 grey">
	<h1>Press</h1>
	<ul class="container">
		<li class="col-md-6 col-sm-12 col-xs-12">
			<div class="company-image">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/press-1.png">
			</div>
			<div class="press-content">
				<p class="headline">Snoobe wants you to pay less for your mobile plans</p>
				<p class="source">Heri Rakotomalala, Montreal Tech Watch</p>
			</div>
		</li>
		<li class="col-md-6 col-sm-12 col-xs-12">
			<div class="company-image">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/press-2.png">
			</div>
			<div class="press-content">
				<p class="headline">De l'aide pour choisir son forfait cellulaire</p>
				<p class="source">Stéphanie Grammond, La Presse</p>
			</div>
		</li>
		<li class="col-md-6 col-sm-12 col-xs-12">
			<div class="company-image">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/press-3.png">
			</div>
			<div class="press-content">
				<p class="headline">Avez-vous choisi le bon forfait de téléphonie mobile?</p>
				<p class="source">Julien Brault, Les Affaires</p>
			</div>
		</li>
		<li class="col-md-6 col-sm-12 col-xs-12">
			<div class="company-image">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/press-4.png">
			</div>
			<div class="press-content">
				<p class="headline">Snoobe, le Robin des forfaits mobiles</p>
				<p class="source">Martin Lessard, Radio-Canada</p>
			</div>
		</li>
		<li class="col-md-6 col-sm-12 col-xs-12">
			<div class="company-image">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/press-2.png">
			</div>
			<div class="press-content">
				<p class="headline">Une appli pour réduire son forfait sans fil</p>
				<p class="source">Jean-François Coderre, La Presse</p>
			</div>
		</li>
		<li class="col-md-6 col-sm-12 col-xs-12">
			<div class="company-image">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/press-5.png">
			</div>
			<div class="press-content">
				<p class="headline">Snoobe: une application pour trouver le meilleur forfait 
de téléphone</p>
				<p class="source">Maxime Johnson, Metro Journal</p>
			</div>
		</li>
	</ul>
</div>
<div class="about-3 section">
	<h1>Meet the team</h1>
	<div class="container">
		<div class="col-xs-12 col-sm-6 col-md-4">
			<div class="team-member">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/thierry.jpg">
				<div class="description">
					<p class="name">Thierry Marechal</p>
					<p class="title">Co-Founder and CEO</p>
					<p>Phasellus vehicula justo eget posuere sollicitudin eu.</p>
				</div>
				<div class="more-section">
					<div class="left">
						<a href="#" class="facebook"></a>
						<a href="#" class="twitter"></a>
						<a href="#" class="vimeo"></a>
					</div>
					<a href="#" class="more">More</a>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4">
			<div class="team-member">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/frederic.jpg">
				<div class="description">
					<p class="name">Frederic Stemmelin</p>
					<p class="title">President Snoobe</p>
					<p>Phasellus vehicula justo eget posuere sollicitudin eu.</p>
				</div>
				<div class="more-section">
					<div class="left">
						<a href="#" class="facebook"></a>
						<a href="#" class="twitter"></a>
						<a href="#" class="vimeo"></a>
					</div>
					<a href="#" class="more">More</a>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4">
			<div class="team-member">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/stephane.jpg">
				<div class="description">
					<p class="name">Stephane Rainville</p>
					<p class="title">Co-Founder and CEO</p>
					<p>Phasellus vehicula justo eget posuere sollicitudin eu.</p>
				</div>
				<div class="more-section">
					<div class="left">
						<a href="#" class="facebook"></a>
						<a href="#" class="twitter"></a>
						<a href="#" class="vimeo"></a>
					</div>
					<a href="#" class="more">More</a>
				</div>
			</div>
		</div>
	</div>
</div>