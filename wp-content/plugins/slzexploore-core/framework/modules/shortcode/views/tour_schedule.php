<?php
$def = array(
	'title'       => '',
	'icon'        => '',
	'subtitle'    => '',
	'description' => '',
	'image'       => '',
	'img_item'    => '',
	);
$custom_css = '';
$block_uniq = 'block_' . Slzexploore_Core::make_id();
$idx = 0;
?>
<div class="slz-shortcode tour-schedule overview-block clearfix <?php echo esc_attr($atts['extra_class'])?>">
	<?php if( !empty( $atts['block_title'] ) ):?>
	<h3 class="title-style-3"><?php echo esc_attr($atts['block_title'])?></h3>
	<?php endif;?>

	<div class="timeline-container">
		<div class="timeline">
			<?php
			foreach($atts['tour_schedule'] as $item ):
				if( empty( $item ) ) continue;
				$idx ++;
				$block_item = 'timeline-'.$idx;
				$item = array_merge($def, $item);
				extract($item);
				$class = '';
				$image = absint($image);
				if( empty($image) ) {
					$class = 'w-full';
					$custom_css .= '.' . $block_uniq. ' .' .$block_item .' .timeline-custom-col.image-col::before{width:0px;}' . "\n";
				} else{
					$thumbnail = wp_get_attachment_image_src($image, 'full');
					if( $thumbnail ) {
						$img_item = '<div class="timeline-custom-col image-col">
										<div class="timeline-image-block">
											<img src="'.esc_url($thumbnail[0]).'" alt="">
										</div>
									</div>';
					}
				}
			?>
			<div class="timeline-block <?php echo $block_item;?>">
				<div class="timeline-title">
					<span><?php echo esc_html( $title );?></span>
				</div>
				<div class="timeline-content medium-margin-top">
					<div class="row">
						<div class="timeline-point"><i class="fa fa-circle-o"></i></div>
						<div class="timeline-custom-col content-col <?php echo esc_attr($class)?>">
							<div class="timeline-location-block">
								<p class="location-name">
									<?php echo esc_html( $subtitle )?>
									<?php if( !empty($icon)):?>
									<i class="<?php echo esc_attr( $icon );?> icon-marker"></i>
									<?php endif;?>
								</p>
								<div class="description">
									<?php echo wp_kses_post($description);?>
								</div>
							</div>
						</div>
						<?php echo wp_kses_post($img_item);?>
					</div>
				</div>
			</div>
			<?php endforeach;?>
		</div>
	</div>
</div>
<?php
if( $custom_css ){
	do_action( 'slzexploore_core_add_inline_style', $custom_css );
}?>