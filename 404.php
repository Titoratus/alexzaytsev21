<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package CenturyZaytsev
 */

get_header();
?>

<div class="container main_container error_404">
	<div class="row align-items-center">
		<div class="col-lg-6 col-12">
			<h1>404</h1>
		</div>
		<div class="col-lg-6 eror_404_img">
			<img src="<?php echo get_template_directory_uri(); ?>/img/man2.jpg" alt="">
		</div>
	</div>
</div>

<?php
get_footer();
