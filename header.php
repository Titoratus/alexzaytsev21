<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CenturyZaytsev
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="image_src" href="<?php echo get_template_directory_uri(); ?>/img/man2.jpg">
	<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/img/man2.jpg">
	<?php 
	$id = 7; // Обязательно передавать переменную
	$post = get_post($id); 
	?>
	<meta name="description" content="<?php echo $post->post_content; ?>">	
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicon.png" sizes="16x16">
	<script>function loadFont(a,b,c,d){function e(){if(!window.FontFace)return!1;var a=new FontFace("t",'url("data:application/font-woff2,") format("woff2")',{}),b=a.load();try{b.then(null,function(){})}catch(c){}return"loading"===a.status}var f=navigator.userAgent,g=!window.addEventListener||f.match(/(Android (2|3|4.0|4.1|4.2|4.3))|(Opera (Mini|Mobi))/)&&!f.match(/Chrome/);if(!g){var h={};try{h=localStorage||{}}catch(i){}var j="x-font-"+a,k=j+"url",l=j+"css",m=h[k],n=h[l],o=document.createElement("style");if(o.rel="stylesheet",document.head.appendChild(o),!n||m!==b&&m!==c){var p=c&&e()?c:b,q=new XMLHttpRequest;q.open("GET",p),q.onload=function(){q.status>=200&&q.status<400&&(h[k]=p,h[l]=q.responseText,d||(o.textContent=q.responseText))},q.send()}else o.textContent=n}}loadFont('Gilroy Bold','<?php echo get_template_directory_uri(); ?>/css/gilroy-extrabold.css');loadFont('Gilroy Extrabold','<?php echo get_template_directory_uri(); ?>/css/gilroy-light.css');</script>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/libs.min.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header>
	<div class="container no-margin">
		<div class="row align-items-center">
			<div class="col-lg-2 col-md-3 col-5">
				<h5 class="company_name">Century21 <span>Альфа</span></h5>
			</div>
			<div class="col-7 company_data">
				<p><i class="icon-phone"></i> <?php echo get_option('comp_phone'); ?></p>
				<p><i class="icon-mail-alt"></i> <?php echo get_option('comp_email'); ?></p>
			</div>
		</div>
	</div>
</header>