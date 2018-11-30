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

get_header();
?>
<div id="toTop">^ Наверх</div>

<div class="container main_container">
<section class="agent_info">
	<div class="container">
		<div class="row justify-content-center align-items-center">
			<div class="col-12 col-xl-8 offset-xl-4">
				<div class="agent_img_mobile"></div>
				<h1 data-aos="fade-down" data-aos-duration="1500"><?php echo get_bloginfo( 'name' ); ?></h1>
				<div class="agent_who"><?php echo get_bloginfo( 'description' ); ?></div>
				<div data-aos="fade-up" data-aos-duration="1500" class="agent_phone"><?php echo get_option('agent_phone'); ?></div>
				<div data-aos="fade-up" data-aos-duration="1500" class="agent_email"><?php echo get_option('agent_email'); ?></div>
				<?php if (!empty(get_option('agent_vk'))): ?><a href="<?php echo get_option('agent_vk'); ?>" data-aos="fade-up" data-aos-delay="900" data-aos-offset="-100" data-aos-duration="1500"><i class="fab fa-vk"></i></a><?php endif; ?>
				<?php if (!empty(get_option('agent_phone'))): ?><a data-aos-delay="900" data-aos-offset="-100" href="https://api.whatsapp.com/send?phone=<?php $str = str_replace(str_split(' -)('), '', get_option('agent_phone')); $str[0] = '7'; echo $str; ?>" data-aos="fade-up" data-aos-duration="1500"><i class="fab fa-whatsapp"></i></a><?php endif; ?>
			</div>
		</div>
	</div>
</section>

<section class="agent_text">
	<div class="container">
		<div class="row">
			<div class="col-lg-7 col-12" data-aos="fade-right">
				<?php
				  $id = 7; // Обязательно передавать переменную
				  $post = get_post($id); 
				  echo "<p>".$post->post_content."</p>";

				  // Получаем около 20 первых недвижимостей агента (нужно больше? увеличивай MAX_FILE_SIZE)
					/*require_once("simple_html_dom.php");
					$html = file_get_contents('https://www.century21.ru/agencies/alfa/agents/zaycev.aleksandr/');
					$html = str_get_html($html);

					foreach ($html->find(".real-estate__list__item") as $item) {

						// Добавление post недвижимости
						$post_id = wp_insert_post(array (
							'post_type' => 'property',
							'post_title' => $item->find(".real-estate__list__name", 0)->innertext,
							'post_status' => 'publish',
							'comment_status' => 'closed'
						));

						// Цена
						update_field("field_5bfd863dfb66a", $item->find(".real-estate__list__price", 0)->innertext, $post_id);
						// Район
						$place = $item->find(".real-estate__list__place", 0)->innertext;
						$place = str_replace('Петрозаводск, ', '', $place);
						update_field("field_5bfd8751531f7", $place, $post_id);
						// Комнат
						if ($item->find(".rooms", 0)->innertext)
							update_field("field_5bfd871049d09", $item->find(".rooms", 0)->innertext, $post_id);
						// Метраж
						if ($item->find(".square", 0)->plaintext)
							update_field("field_5bfec88eae597", str_replace(" м2", "", $item->find(".square", 0)->plaintext), $post_id);
						// Ссылка
						update_field("field_5bffe17310ecb", $item->find(".real-estate__list__link", 0)->attr["href"], $post_id);
						// Изображение
						$img_url = $item->find(".real-estate__list__link", 0)->attr["href"];
						$img_url = file_get_contents($img_url);
						$img_url = str_get_html($img_url);
						$img_url = "https://www.century21.ru/".$img_url->find(".object-media-content img", 0)->src;
						update_field("field_5bfd8edc4291a", $img_url, $post_id);
					}*/
				?>
			</div>
			<div class="col-lg-5">
				<img src="<?php the_field( 'text_img' ); ?>" height="100%" alt="">
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
					<button type="button" data-filter=".category-a">Квартиры</button>
					<button type="button" data-filter=".category-b">Другое</button>
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
			<div class="col-sm-12 col-md-6 col-lg-4 mix <?php echo !empty(get_post_meta(get_the_ID(), 'prop_size', true)) ? 'category-a' : 'category-b'; ?>">
				<div class="prop_item">

					<div class="item_more">
						<img src="<?php echo get_field( 'prop_img' ); ?>" alt="">
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
