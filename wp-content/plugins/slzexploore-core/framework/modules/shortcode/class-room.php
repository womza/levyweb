<?php
class Slzexploore_Core_Room extends Slzexploore_Core_Custom_Post_Model {

	private $post_type = 'slzexploore_room';
	private $html_format;

	public function __construct() {
		$this->meta_attributes();
		$this->set_meta_attributes();
		$this->post_meta_prefix = $this->post_type . '_';
		$this->html_format = $this->set_default_options();
		$this->uniq_id = 'block-' . Slzexploore_Core::make_id();
		$this->taxonomy_cat = 'slzexploore_room_cat';
	}
	public function meta_attributes() {
		$meta_atts = array( 
			'display_title'        => '',
			'accommodation'        => '',
			'max_adults'           => '',
			'max_children'         => '',
			'number_room'          => '',
			'price'                => '',
			'price_infant'         => '',
			'is_price_person'      => '',
			'price_text'           => '',
			'gallery_ids'          => '',
			'allow_booking'        => ''
		);
		$this->post_meta_atts = $meta_atts;
	}
	public function set_meta_attributes() {
		$meta_arr = array();
		$meta_label_arr = array();
		foreach( $this->post_meta_atts as $att => $name ){
			$key = $att;
			$meta_arr[$key] = '';
			$meta_label_arr[$key] = $name;
		}
		$this->post_meta_def = $meta_arr;
		$this->post_meta = $meta_arr;
		$this->post_meta_label = $meta_label_arr;
	}
	public function init( $atts = array(), $query_args = array() ) {
		// set attributes
		$default_atts = array(
			'layout'               => 'room',
			'limit_post'           => '-1',
			'offset_post'          => '0',
			'room_id'              => '',
		);
		$atts = array_merge( $default_atts, $atts );
		$atts['offset_post'] = absint( $atts['offset_post'] );
		$this->attributes = $atts;

		// query
		$default_args = array(
			'post_type' => $this->post_type,
		);
		$query_args = array_merge( $default_args, $query_args );
		// setting
		$this->setting( $query_args);
	}
	public function setting( $query_args ){
		if( !isset( $this->attributes['uniq_id'] ) ) {
			$this->attributes['uniq_id'] = $this->post_type . '-' . Slzexploore_Core::make_id();
		}
		
		// query
		$this->query = $this->get_query( $query_args, $this->attributes );
		$this->post_count = 0;
		if( $this->query->have_posts() ) {
			$this->post_count = $this->query->post_count;
		}
		$this->get_thumb_size();
	}
	public function reset(){
		wp_reset_postdata();
	}
	//-------------------->> Render Html << -------------------------
	/**
	 * Render html by list.
	 *
	 * @param array $html_options
	 * @format: 1$ - img, 2$ - title, 3$ - discount, 4$ - meta, 5$ - price, 6$ - excerpt, 7$ - button, 8$ - responsive
	 */
	public function render_list( $html_options = array() ) {
		$this->set_default_options( $html_options );
		$count = 0;
		while ( $this->query->have_posts() ) {
			$this->query->the_post();
			$this->loop_index();
			$count ++;
			printf( $html_options['html_format'],
					$this->get_title( $html_options ),
					$this->get_room_slider(),
					$this->get_price(),
					$this->get_content( $html_options ),
					$this->get_button( $count )
			);
		}
		$this->reset();
	}
	
	//--------------------<< Render Html >> -------------------------
	//------------------- >> Post Infomations << --------------------
	public function get_accommodation_id(){
		$accommodation_id = array();
		while ( $this->query->have_posts() ) {
			$this->query->the_post();
			$this->loop_index();
			$post_meta = $this->post_meta['accommodation'];
			if( !empty( $post_meta ) && !in_array( $post_meta, $accommodation_id ) ) {
				$accommodation_id[] = $post_meta;
			}
		}
		$this->reset();
		return $accommodation_id;
	}
	public function get_room_slider() {
		$out = $slider_for = $slider_nav = '';
		$format = $this->html_format['slider_format'];
		$item_format = $this->html_format['slider_item_format'];
		$gallery_ids = explode( ',', $this->post_meta['gallery_ids'] );
		$feature_image_id = get_post_thumbnail_id( $this->post_id );
		if( !empty( $feature_image_id ) ) {
			array_unshift( $gallery_ids, $feature_image_id );
		}
		$large_size = $this->attributes['thumb-size']['large'];
		$small_size = $this->attributes['thumb-size']['small'];
		if( !empty( $gallery_ids ) ) {
			foreach( $gallery_ids as $gallery_id ) {
				if( !empty( $gallery_id ) ) {
					$helper = new Slzexploore_Core_Helper();
					$helper->regenerate_attachment_sizes( $gallery_id, $large_size);
					$helper->regenerate_attachment_sizes( $gallery_id, $small_size);
					$large_img = wp_get_attachment_image( $gallery_id, $large_size, false, array('class' => '' ) );
					$small_img = wp_get_attachment_image( $gallery_id, $small_size, false, array('class' => '' ) );
					$slider_for .= sprintf( $item_format, $large_img );
					$slider_nav .= sprintf( $item_format, $small_img );
				}
			}
		}
		if( empty( $slider_for ) ) {
			$thumb_img = Slzexploore_Core_Util::get_no_image( $this->attributes['thumb-size'] );
			$slider_for .= sprintf( $item_format, $thumb_img );
		}
		$out .= sprintf( $format, $slider_for, $slider_nav );
		return $out;
	}
	public function get_price() {
		if( $this->post_password ) return '';
		$args = array(
			'post_type' => 'slzexploore_vacancy',
			'meta_query' => array(
				array(
					'key'     => 'slzexploore_vacancy_room_type',
					'value'   => $this->post_id
				),
				array(
					'key'     => 'slzexploore_vacancy_date_from',
					'value'   => date('Y-m-d'),
					'compare' => '<='
				),
				array(
					'relation' => 'OR',
					array(
						'key'     => 'slzexploore_vacancy_date_to',
						'value'   => ''
					),
					array(
						'key'     => 'slzexploore_vacancy_date_to',
						'value'   => date('Y-m-d'),
						'compare' => '>='
					)
				)
			)
		);
		$price = $this->post_meta['price'];
		$vacancy_post = Slzexploore_Core_Com::get_post_id2title( $args, array(), false );
		if(!empty($vacancy_post)){
			$vacancy_ids = array_keys($vacancy_post);
			if(isset($vacancy_ids[0]) && !empty($vacancy_ids[0])){
				$vacancy_price = get_post_meta($vacancy_ids[0], 'slzexploore_vacancy_price', true);
				if(trim($vacancy_price) != ''){
					$price = $vacancy_price;
				}
			}
		}
		$out = '';
		$format = $this->html_format['price_format'];
		$price = Slzexploore_Core_Format::format_number( $price );
		$sign = sprintf( $this->html_format['sign_price_format'],
						esc_html( Slzexploore_Core::get_theme_option('slz-currency-sign') ) );
		if( !empty( $price ) ) {
			$duration = $this->post_meta['price_text'];
			$price = '<span class="number">' . number_format_i18n( $price ) .'</span>';
			$sign_position = Slzexploore_Core::get_theme_option('slz-symbol-currency-position');
			if( $sign_position == 'before' ) {
				$price = $sign .$price;
			} else {
				$price = $price .$sign;
			}
			if( !empty($duration) ) {
				$duration = sprintf($this->html_format['price_subfix'], esc_html( $duration ) );
			}
			$out = sprintf($format, $price, $duration );
		}
		return $out;
	}
	public function get_column_price() {
		$out = '';
		$format = '%1$s';
		$price = Slzexploore_Core_Format::format_number( $this->post_meta['price'] );
		$sign = sprintf( $this->html_format['sign_price_format'],
				esc_attr( Slzexploore_Core::get_theme_option('slz-currency-sign') ) );
		if( !empty( $price ) ) {
			$price = '<span class="number">' . number_format_i18n( $price ) .'</span>';
			$sign_position = Slzexploore_Core::get_theme_option('slz-symbol-currency-position');
			if( $sign_position == 'before' ) {
				$price = $sign .$price;
			} else {
				$price = $price .$sign;
			}
			$out = sprintf($format, $price);
		}
		return $out;
	}
	public function get_button( $index ) {
		$btn = $cft_form_html = '';
		$booking_active   = Slzexploore::get_option('slz-booking-active', 'enabled');
		$show_ctf = Slzexploore::get_option('slz-hotel-booking-method');
		
		if( empty($show_ctf) || $show_ctf == 'booking' ){
			if( isset( $booking_active['hotel'] ) && isset($this->attributes['btn_book']) && $this->attributes['btn_book'] ) {
			$btn_url = $this->permalink;
			$btn .= sprintf($this->html_format['btn_book_format'],
							esc_url( $btn_url ),
							esc_html( $this->attributes['btn_book'] ),
							esc_attr( $this->post_id ),
							esc_attr( $this->title )
						);
			}
		}else{

			$cf7_form =  Slzexploore::get_option('slz-hotel-cf7-booking');
			$post_type = 'accommodation';
			if(!empty($cf7_form)){
				$uri = plugins_url().'/contact-form-7/includes/js/scripts.js';
				$cft_form_html .= sprintf('<div class="cf7_js_uri hide">%s</div>', esc_url( $uri ) );
				$cft_form_html .= do_shortcode('[contact-form-7 id="'.esc_attr($cf7_form).'"]');
			}
			$admin_mail = get_option('admin_email');
			$json_data = array();
			$json_data['name'] = get_the_title($this->post_meta['accommodation']);
			$json_data['url'] = get_permalink($this->post_meta['accommodation']);
			$booking_mail_cc  = get_post_meta( $this->post_meta['accommodation'], 'slzexploore_hotel_mail_cc', true );
			$booking_mail_bcc  = get_post_meta( $this->post_meta['accommodation'], 'slzexploore_hotel_mail_bcc', true );

			$booking_mail_cc = !empty($booking_mail_cc) ? $booking_mail_cc: $admin_mail;
			$booking_mail_bcc = !empty($booking_mail_bcc) ? $booking_mail_bcc: $admin_mail;
			$json_data['mail_cc'] = $booking_mail_cc;
			$json_data['mail_bcc'] = $booking_mail_bcc;

			$json_data = json_encode($json_data);
			$btn .=
			sprintf($this->html_format['btn_modal_booking_format'],
				esc_html__( 'book now', 'slzexploore-core' ),
				$this->post_meta['accommodation'],
				esc_attr($post_type),
				esc_attr( $this->post_id ),
				$json_data
			);

			$btn .= 
			sprintf( $this->html_format['modal_booking_format'],
				esc_html__('CONTACT US','slzexploore-core'),
				$cft_form_html
			);
		}
		
		return $btn;
	}
	
	//------------------- << Post Infomations >> -------------------

	public function set_default_options( &$html_options = array() ) {
		$defaults = array(
			'title_format'             => ' <div class="timeline-title"><span>%1$s</span></div>',
			'price_format'             => '<div class="title"><div class="price">%1$s</div>%2$s</div>',
			'sign_price_format'        => '<sup>%1$s</sup>',
			'price_subfix'             => '<p class="for-price">%1$s</p>',
			'content_format'           => '<div class="text">%1$s</div>',
			'btn_book_format'          => '<div class="group-btn-tours"><a href="%1$s" data-id="%3$s" data-title="%4$s" class="left-btn btn-book-tour">%2$s</a></div>',
			'slider_format'            => '<div class="slider-for">%1$s</div><div class="slider-nav">%2$s</div>',
			'slider_item_format'       => '<div class="item">%1$s</div>',
			'thumb_href_class'         => '',
			'btn_modal_booking_format' =>'<div class="group-btn-tours"><a class="cf7-book left-btn" data-toggle="modal" data-target="#booking-form" data-id="%2$s" data-type="%3$s" data-roomtype="%4$s" data-json=\'%5$s\'>%1$s</a></div>',
			'modal_booking_format'   =>'<div id="booking-form" class="modal fade" role="dialog">
				  <div class="modal-dialog">
				    <div class="modal-content">
				    <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				    </div>
				      <div class="modal-body"><div class="slz-booking-from contact-box">
				        %2$s</div>
				      </div>
				    </div>
				  </div>
				</div>'
		);
		$html_options = array_merge( $defaults, $html_options );
		$this->html_format = $html_options;
		return $html_options;
	}
	public function get_thumb_size() {
		$params = Slzexploore_Core::get_params( 'block-image-size', $this->attributes['layout'] );
		$this->attributes['thumb-size'] = Slzexploore_Core_Util::get_thumb_size( $params, $this->attributes );
	}
}