<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CenturyZaytsev
 */
set_time_limit(200);
get_header();
?>
<div id="toTop">^ Наверх</div>

<div class="container main_container">
<section class="agent_info">
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-12 col-xl-8 offset-xl-4">
				<div class="agent_img_mobile"></div>
				<h1 data-aos="fade-down" data-aos-duration="1500" data-aos-once="true"><?php echo get_bloginfo( 'name' ); ?></h1>
				<div class="agent_who"><?php echo get_bloginfo( 'description' ); ?></div>
				<div data-aos="fade-up" data-aos-duration="1500" class="agent_phone" data-aos-once="true"><?php echo get_option('agent_phone'); ?></div>
				<div data-aos="fade-up" data-aos-duration="1500" class="agent_email" data-aos-once="true" data-aos-offset="-100"><?php echo get_option('agent_email'); ?></div>
				<?php if (!empty(get_option('agent_vk'))): ?><a data-aos-once="true" href="<?php echo get_option('agent_vk'); ?>" data-aos="fade-up" data-aos-delay="900" data-aos-offset="-100" data-aos-duration="1500"><i class="icon-vkontakte"></i></a><?php endif; ?>
				<?php if (!empty(get_option('agent_phone'))): ?><a data-aos-once="true" data-aos-delay="900" data-aos-offset="-100" href="https://api.whatsapp.com/send?phone=<?php $str = str_replace(str_split(' -)('), '', get_option('agent_phone')); $str[0] = '7'; echo $str; ?>" data-aos="fade-up" data-aos-duration="1500"><i class="icon-whatsapp"></i></a><?php endif; ?>
				<?php if (!empty(get_option('agent_inst'))): ?><a data-aos-once="true" href="<?php echo get_option('agent_inst'); ?>" data-aos="fade-up" data-aos-delay="900" data-aos-offset="-100" data-aos-duration="1500"><i class="icon-instagram"></i></a><?php endif; ?>				
			</div>
		</div>
	</div>
</section>

<section class="agent_text">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-7 col-12" data-aos="fade-right" data-aos-once="true">
				<?php
				  $id = 7; // Обязательно передавать переменную
				  $post = get_post($id); 
				  echo "<p>".$post->post_content."</p>";
				?>
			</div>
			<div class="col-lg-5">
				<img src="<?php the_field( 'text_img' ); ?>" height="400px" alt="">
			</div>
		</div>
	</div>
</section>

<section class="section property">
	<h2 class="section_title">Недвижимость</h2>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="controlsMix">
					<button type="button" data-filter="all">Всё</button> 
					<button type="button" data-filter=".size-1">1 комн.</button> /
					<button type="button" data-filter=".size-2">2 комн.</button> /
					<button type="button" data-filter=".size-3">3+ комн.</button> 
					<button type="button" data-filter=".category-a">Другое</button>
				</div>
			</div>
		</div>

		<div class="row containerMix">
			<?php
				$args = array(
				    'post_type'=> 'property'
				    );              

				$the_query = new WP_Query( $args );
				$aos_delay = 50;
				if($the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();			
			?>
			<!--Если есть кол-во комнат - категория "Квартиры" -->
			<div class="col-sm-12 col-md-6 col-lg-4 mix <?php if (!empty(get_post_meta(get_the_ID(), 'prop_size', true))) { if (str_replace(str_split(' комн. <span></span>'), "", get_post_meta(get_the_ID(), 'prop_size', true)) >= 3) echo "size-3"; else echo "size-".str_replace(str_split(' комн. <span></span>'), "", get_post_meta(get_the_ID(), 'prop_size', true)); } else { echo "category-a"; } ?>">
				<div class="prop_item">

					<div class="item_more">
						<img src="<?php $img = get_field( 'prop_img' ); echo $img['url']; ?>" alt="<?php echo $img['description']; ?>">
						<a target="_blank" href="<?php the_field( 'prop_link' ); ?>">Подробнее</a>
					</div>

					<div class="item_cost"><?php the_field( 'prop_cost' ); ?></div>

					<div class="item_params">
						<span><?php if (get_post_meta(get_the_ID(), 'prop_metr', true) > 0) echo get_post_meta(get_the_ID(), 'prop_metr', true)."м<sup>2</sup>"; ?></span>/
						<span><?php the_field( 'prop_place' ); ?></span>/
						<span><?php the_field( 'prop_size' ); ?></span>						
					</div>

				</div>
			</div>
			<?php endwhile; endif; ?>			

		</div>
	</div>
</section>
</div>

<?php
get_footer();
