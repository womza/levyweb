<?php
$style = Slzexploore_Core::get_params('item_list_style');
$params = array(
	array(
		'type'          => 'textfield',
		'heading'       => esc_html__( 'Block Title', 'slzexploore-core' ),
		'param_name'    => 'block_title',
		'value'         => $style,
		'description'   => esc_html__( 'Enter title for block.', 'slzexploore-core' )
		),
	array(
		'type'       => 'param_group',
		'heading'    => esc_html__( 'Tour Schedule', 'slzexploore-core' ),
		'param_name' => 'tour_schedule_list',
		'params'     => array(
			array(
				'type'          => 'textfield',
				'admin_label'   => true,
				'heading'       => esc_html__( 'Title', 'slzexploore-core' ),
				'param_name'    => 'title',
				'value'         => '',
				'description'   => esc_html__( 'Enter title for each item.', 'slzexploore-core' )
			),
			array(
				'type'          => 'iconpicker',
				'heading'       => esc_html__( 'Icon', 'slzexploore-core' ),
				'param_name'    => 'icon',
				'value'         => '',
				'description'   => esc_html__( 'Select icon for each item.', 'slzexploore-core' )
			),
			array(
				'type'          => 'textfield',
				'heading'       => esc_html__( 'Information 1', 'slzexploore-core' ),
				'param_name'    => 'subtitle',
				'value'         => '',
				'description'   => esc_html__( 'Enter information for each item.', 'slzexploore-core' )
			),
			array(
				'type'           => 'textarea',
				'heading'        => esc_html__( 'Information 2', 'slzexploore-core' ),
				'param_name'     => 'description',
				'description'    => esc_html__( 'Enter information for each item.', 'slzexploore-core' ),
			),
			array(
				'type'           => 'attach_image',
				'heading'        => esc_html__( 'Add Image', 'slzexploore-core' ),
				'param_name'     => 'image',
				'description'    => esc_html__( 'Choose image for each item.', 'slzexploore-core' ),
			),
		),
		'value'       => '',
		'callbacks'   => array(
			'after_add' => 'vcChartParamAfterAddCallback'
		),
		'description' => esc_html__( 'Add item for tour schedule block.', 'slzexploore-core' ),
	),
	array(
		'type'          => 'textfield',
		'heading'       => esc_html__( 'Extra Class', 'slzexploore-core' ),
		'param_name'    => 'extra_class',
		'description'   => esc_html__( 'Enter extra class name.', 'slzexploore-core' )
	)
);
vc_map(array(
	'name'        => esc_html__( 'SLZ Tour Schedule', 'slzexploore-core' ),
	'base'        => 'slzexploore_core_tour_schedule_sc',
	'class'       => 'slzexploore_core-sc',
	'icon'        => 'icon-slzexploore_core_tour_schedule_sc',
	'category'    => SLZEXPLOORE_CORE_SC_CATEGORY,
	'description' => esc_html__( 'List schedules in the tour.', 'slzexploore-core' ),
	'params'      => $params
));