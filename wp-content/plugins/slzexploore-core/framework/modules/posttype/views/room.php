<?php $prefix = 'slzexploore_room_'; ?>
<div class="tab-panel">
	<ul class="tab-list">
		<li class="active">
			<a href="slz-tab-accommodation-general"><?php esc_html_e( 'General', 'slzexploore-core' );?></a>
		</li>
		<li class="">
			<a href="slz-tab-accommodation-gallery"><?php esc_html_e( 'Gallery', 'slzexploore-core' );?></a>
		</li>
	</ul>
	<div class="tab-container">
		<div class="tab-wrapper slz-page-meta">
			<!-- General -->
			<div id="slz-tab-accommodation-general" class="tab-content active slzexploore_core-map-metabox">
				<table class="form-table">
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Display Title', 'slzexploore-core' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'This content will display title of the room type publicly.', 'slzexploore-core' ) );?></span>
						</th>
						<td>
							<?php echo ( $this->text_field( 'slzexploore_room_meta['. $prefix .'display_title]',
																$this->get_field( $data_meta, 'display_title' ),
																array( 'class' => 'slz-block' ) ) );?>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Accommodation', 'slzexploore-core' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Choose accommodation that the room type belong to.', 'slzexploore-core' ) );?></span>
						</th>
						<td>
							<?php
							$options = array('empty' => esc_html__( '-- All Accommodation --', 'slzexploore-core' ) );
							$args = array('post_type' => 'slzexploore_hotel');
							$arr_accommodation = Slzexploore_Core_Com::get_post_id2title( $args, $options );
							echo ( $this->drop_down_list('slzexploore_room_meta['. $prefix .'accommodation]',
												$this->get_field( $data_meta, 'accommodation' ),
												$arr_accommodation,
												array('class' => 'slz-block-half') ) );
							?>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Max Adults', 'slzexploore-core' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Maximum adults are allowed in the room.', 'slzexploore-core' ) );?></span>
						</th>
						<td>
							<?php echo ( $this->text_field( 'slzexploore_room_meta['. $prefix .'max_adults]',
																$this->get_field( $data_meta, 'max_adults' ),
																array( 'class' => 'slz-block-half' ) ) );?>
							<p class="description"><?php esc_html_e( 'Example: 2', 'slzexploore-core' );?></p>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Max Children', 'slzexploore-core' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Maximum children are allowed in the room.', 'slzexploore-core' ) );?></span>
						</th>
						<td>
							<?php echo ( $this->text_field( 'slzexploore_room_meta['. $prefix .'max_children]',
																$this->get_field( $data_meta, 'max_children' ),
																array( 'class' => 'slz-block-half' ) ) );?>
							<p class="description"><?php esc_html_e( 'Example: 2', 'slzexploore-core' );?></p>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Number Of Rooms', 'slzexploore-core' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Number of rooms in this accommodation.', 'slzexploore-core' ) );?></span>
						</th>
						<td>
							<?php echo ( $this->text_field( 'slzexploore_room_meta['. $prefix .'number_room]',
																$this->get_field( $data_meta, 'number_room' ),
																array( 'class' => 'slz-block-half' ) ) );?>
							<p class="description"><?php esc_html_e( 'Example: 5', 'slzexploore-core' );?></p>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Price', 'slzexploore-core' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Price of this room per night.', 'slzexploore-core' ) );?></span>
						</th>
						<td>
							<?php echo ( $this->text_field( 'slzexploore_room_meta['. $prefix .'price]',
																$this->get_field( $data_meta, 'price' ),
																array( 'class' => 'slz-block-half' ) ) );?>
							<p class="description"><?php esc_html_e( 'Example: 50', 'slzexploore-core' );?></p>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Infant Price', 'slzexploore-core' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'This price only apply when calculating booking price by person.', 'slzexploore-core' ) );?></span>
						</th>
						<td>
							<?php echo ( $this->text_field( 'slzexploore_room_meta['. $prefix .'price_infant]',
																$this->get_field( $data_meta, 'price_infant' ),
																array( 'class' => 'slz-block-half' ) ) );?>
							<p class="description"><?php esc_html_e( 'Example: 50', 'slzexploore-core' );?></p>
						</td>
					</tr>
					<tr>
						<th scope="row">
							<label><?php esc_html_e( 'Is Person Price?', 'slzexploore-core' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'If checked, Above price is price per person.', 'slzexploore-core' ) );?></span>
						</th>
						<td>
							<?php
								$is_price_person = array(
									'1' => esc_html__( 'Yes ', 'slzexploore-core' ),
									''  => esc_html__( 'No', 'slzexploore-core' )
								);
								$html_options = array(
									'separator' => '&nbsp;&nbsp;',
									'class' => 'slz-w190'
								);
								echo ( $this->radio_button_list( 'slzexploore_room_meta['. $prefix .'is_price_person]',
																	$this->get_field( $data_meta, 'is_price_person', 1 ),
																	$is_price_person,
																	$html_options ) );
							?>
						</td>
					</tr>
					<tr class="last">
						<th scope="row">
							<label><?php esc_html_e( 'Price Text', 'slzexploore-core' );?></label>
							<span class="f-right"><?php $this->tooltip_html( esc_html__( 'Subfix to description price in detail page.', 'slzexploore-core' ) );?></span>
						</th>
						<td>
							<?php echo ( $this->text_field( 'slzexploore_room_meta['. $prefix .'price_text]',
																$this->get_field( $data_meta, 'price_text' ),
																array( 'class' => 'slz-block-half' ) ) );?>
							<p class="description"><?php esc_html_e( 'Example: per night', 'slzexploore-core' );?></p>
						</td>
					</tr>
				</table>
			</div>
			<!-- Gallery Images -->
			<div id="slz-tab-accommodation-gallery" class="tab-content">
				<table class="form-table">
					<tr class="last">
						<th scope="row" colspan="2">
							<label><?php esc_html_e( 'Gallery Images', 'slzexploore-core' );?></label>
							<p class="description"><?php esc_html_e( 'Images should have minimum size: 800x540. Bigger size images will be cropped automatically.', 'slzexploore-core' );?></p>
						</th>
					</tr>
					<tr class="last">
						<td colspan="2">
							<?php $this->gallery( 'slzexploore_room_meta['. $prefix .'gallery_ids]', $data_meta['gallery_ids'] ); ?>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>