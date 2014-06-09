<?php
/*
Template Name: FAQ Template
*/
?>

<?php get_template_part('templates/content', 'page'); ?>

<div class="header">
	<h1>FAQ</h1>
	<p>Lorem ipsum dolor.</p>
	<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/robin-faq.png" class="robin">
</div>

<div class="faq-top">
	<div class="container">
		<p class="left">Frequently Asked Questions</p>
		<?php get_search_form(); ?>
	</div>
</div>

<div class="faq-1">
	<div class="container">
		<div class="bs-example">
		  <div class="panel-group" id="accordion">
			  <div class="panel panel-default">
			    <div class="panel-heading">
			      <h4 class="panel-title">
			        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">1. How much can I save?</a>
			      </h4>
			    </div>
			    <div id="collapseOne" class="panel-collapse collapse in">
			      <div class="panel-body">
			      	<p>Our early tests show that people on the wrong personal plan can save around $300 per year and professionals even more. Our current record holder saves a whopping $1,416 per year AND she got a brand new Nexus 4 with her new plan.</p>
			      </div>
			    </div>
			  </div>
			  <div class="panel panel-default">
			    <div class="panel-heading">
			      <h4 class="panel-title">
			        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">2. Yes... but I’m in a contract!</a>
			      </h4>
			    </div>
			    <div id="collapseTwo" class="panel-collapse collapse">
			      <div class="panel-body">
			      	<p>Lorem ipsum dolor.</p>
			      </div>
			    </div>
			  </div>
			  <div class="panel panel-default">
			    <div class="panel-heading">
			      <h4 class="panel-title">
			        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">3. Is my phone history safe?</a>
			      </h4>
			    </div>
			    <div id="collapseThree" class="panel-collapse collapse">
			      <div class="panel-body">
			      	<p>Lorem ipsum dolor.</p>
			      </div>
			    </div>
			  </div>
			  <div class="panel panel-default">
			    <div class="panel-heading">
			      <h4 class="panel-title">
			        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">4. Great, but I’m not in the US or Canada...</a>
			      </h4>
			    </div>
			    <div id="collapseFour" class="panel-collapse collapse">
			      <div class="panel-body">
			      	<p>Lorem ipsum dolor.</p>
			      </div>
			    </div>
			  </div>
			  <div class="panel panel-default">
			    <div class="panel-heading">
			      <h4 class="panel-title">
			        <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">5. Lorem ipsum dolor</a>
			      </h4>
			    </div>
			    <div id="collapseFive" class="panel-collapse collapse">
			      <div class="panel-body">
			      	<p>Lorem ipsum dolor.</p>
			      </div>
			    </div>
			  </div>
			</div>
		</div>
	</div>
</div>
