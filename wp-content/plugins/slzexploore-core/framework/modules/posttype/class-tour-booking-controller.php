<?php
/**
 * Tour Booking Controller
 * 
 * @since 1.0
 */
Slzexploore_Core::load_class( 'Abstract' );
class Slzexploore_Core_Tour_Booking_Controller extends Slzexploore_Core_Abstract {
	public function save() {
		global $post;
		$post_id = $post->ID;
		parent::save();
		if( isset( $_POST['slzexploore_tbook_meta']) ) {
			$data_meta = $_POST['slzexploore_tbook_meta'];
			foreach( $data_meta as $key => $value ) {
				update_post_meta ( $post_id, $key, $value );
			}
			// set post term
			wp_set_post_terms( $post_id, $data_meta['slzexploore_tbook_status'], 'slzexploore_tbook_status' );
		}
	}

	public function mbox_tour_booking() {
		global $post;
		$post_id = $post->ID;
		$obj_prop = new Slzexploore_Core_Tour_Booking();
		$obj_prop->loop_index();
		$data_meta = $obj_prop->post_meta;
		$this->render( 'tour_booking', array( 'data_meta' => $data_meta ) );
	}
}