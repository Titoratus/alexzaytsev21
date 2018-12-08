<?php
// Получаем недвижимость агента
require_once("simple_html_dom.php");
$html = file_get_contents('https://www.century21.ru/agencies/alfa/agents/zaycev.aleksandr/');
$html = str_get_html($html);

foreach ($html->find(".real-estate__list__item") as $item) {

	// Если уже есть такая недвижимость
	if (get_page_by_title($item->find(".real-estate__list__name", 0)->innertext, OBJECT, 'property'))
		continue;

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
	$image_url = $item->find(".real-estate__list__link", 0)->attr["href"];
	$image_url = file_get_contents($image_url);
	$image_url = str_get_html($image_url);
	$image_url = "https://www.century21.ru/".$image_url->find(".object-media-content img", 0)->src;
	$upload_dir = wp_upload_dir();
	$image_data = file_get_contents( $image_url );
	$filename = basename( $image_url );

	if ( wp_mkdir_p( $upload_dir['path'] ) ) {
	  $file = $upload_dir['path'] . '/' . $filename;
	}
	else {
	  $file = $upload_dir['basedir'] . '/' . $filename;
	}

	file_put_contents( $file, $image_data );

	$wp_filetype = wp_check_filetype( $filename, null );

	$attachment = array(
	  'post_mime_type' => $wp_filetype['type'],
	  'post_title' => $item->find(".real-estate__list__name", 0)->innertext,
	  'post_content' => $item->find(".real-estate__list__name", 0)->innertext,
	  'post_status' => 'inherit'
	);

	$attach_id = wp_insert_attachment( $attachment, $file );
	require_once( ABSPATH . 'wp-admin/includes/image.php' );
	$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
	wp_update_attachment_metadata( $attach_id, $attach_data );

	update_field("field_5bfd8edc4291a", $attach_id, $post_id);
}
?>