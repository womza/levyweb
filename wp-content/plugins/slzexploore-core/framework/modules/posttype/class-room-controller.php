<?php
/**
 * Room Controller
 * 
 * @since 1.0
 */
Slzexploore_Core::load_class( 'Abstract' );
class Slzexploore_Core_Room_Controller extends Slzexploore_Core_Abstract {
	public function save() {
		global $post;
		$post_id = $post->ID;
		parent::save();
		if( isset( $_POST['slzexploore_room_meta']) ) {
			$data_meta = $_POST['slzexploore_room_meta'];
			if( empty( $data_meta['slzexploore_room_display_title'] ) ) {
				$data_meta['slzexploore_room_display_title'] = $post->post_title;
			}

			// update slzexploore_hotel_room_type meta
			$old_accommodation_id = get_post_meta ( $post_id, 'slzexploore_room_accommodation', true );
			$meta_key = 'slzexploore_hotel_room_type';
			// clear room type of old accommodation
			if( !empty( $old_accommodation_id ) ) {
				$old_room_type = get_post_meta ( $old_accommodation_id, $meta_key, true );
				$old_room_type = str_replace( $post_id . ',', '', $old_room_type);
				update_post_meta ( $old_accommodation_id, $meta_key, $old_room_type );
			}
			// add room type of new accommodation
			if( !empty( $data_meta['slzexploore_room_accommodation'] ) ) {
				$accommodation_id = $data_meta['slzexploore_room_accommodation'];
				$room_type = get_post_meta ( $accommodation_id, $meta_key, true );
				$room_type .= $post_id . ',';
				update_post_meta ( $accommodation_id, $meta_key, $room_type );
			}

			foreach( $data_meta as $key => $value ) {
				update_post_meta ( $post_id, $key, $value );
			}
		}
	}

	public function mbox_room_options() {
		global $post;
		$post_id = $post->ID;
		$obj_prop = new Slzexploore_Core_Room();
		$obj_prop->loop_index();
		$data_meta = $obj_prop->post_meta;
		$this->render( 'room', array( 'data_meta' => $data_meta ) );
	}
}