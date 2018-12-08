<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CenturyZaytsev
 */

wp_footer(); ?>
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-2">
					<h5 class="company_name">Century21 <span>Альфа</span></h5>
				</div>
				<div class="col-xs-12 col-md-3 offset-md-1 offset-lg-0 col-xl-2 footer_contacts">
					<h6>Офис</h6>
					<p><i class="icon-globe"></i> alfa.century21.ru</p>
					<p><i class="icon-phone"></i> <?php echo get_option('comp_phone'); ?></p>
					<p><i class="icon-mail-alt"></i> <?php echo get_option('comp_email'); ?></p>
				</div>
				<div class="col-md-5 col-sm-12 footer_contacts">
					<h6>Агент</h6>
					<p><i class="icon-phone"></i> <?php echo get_option('agent_phone'); ?></p>
					<p><i class="icon-mail-alt"></i> <?php echo get_option('agent_email'); ?></p>
				</div>				
			</div>
		</div>
	</footer>
	<script src="<?php echo get_template_directory_uri(); ?>/js/libs.min.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/script.min.js"></script>
</body>
</html>
