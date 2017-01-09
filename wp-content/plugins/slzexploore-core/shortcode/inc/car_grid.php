<?php
$category = Slzexploore_Core_Com::get_tax_options2slug( 'slzexploore_car_cat', array('empty' => esc_html__( '--All Categories--', 'slzexploore-core' ) ) );
$location = Slzexploore_Core_Com::get_tax_options2slug( 'slzexploore_car_location', array('empty' => esc_html__( '--All Locations--', 'slzexploore-core' ) ) );
$author = Slzexploore_Core_Com::get_user_login2id(array(), array('empty' => esc_html__( '-All Authors-', 'slzexploore-core' ) ) );

$sort_by = Slzexploore_Core::get_params('sort-car');
$featured_filter = Slzexploore_Core::get_params('featured-filter');
$paging = array(
	esc_html__('No', 'slzexploore-core')  => '',
	esc_html__('Yes', 'slzexploore-core') => 'yes',
);
$columns = array(
	esc_html__('Two', 'slzexploore-core')     => '2',
	esc_html__('Three', 'slzexploore-core')   => '3',
);

$style = array(
	esc_html__('List', 'slzexploore-core')     => 'list',
	esc_html__('Grid', 'slzexploore-core')     => 'grid',
);

$params = array(
	array(
		'type'        => 'dropdown',
		'heading'     => esc_html__( 'Style', 'slzexploore-core' ),
		'param_name'  => 'style',
		'value'       => $style,
		'std'         => 'list',
		'description' => esc_html__( 'Select style to display list cars.', 'slzexploore-core' ),
	),
	array(
		'type'        => 'dropdown',
		'heading'     => esc_html__( 'Columns', 'slzexploore-core' ),
		'param_name'  => 'columns',
		'value'       => $columns,
		'std'         => '2',
		'dependency'     => array(
			'element'  => 'style',
			'value'    => array( 'grid' ),
		),
		'description' => esc_html__( 'Select column to display list cars.', 'slzexploore-core' ),
	),
	array(
		'type'        => 'textfield',
		'heading'     => esc_html__( 'Limit posts', 'slzexploore-core' ),
		'param_name'  => 'limit_post',
		'value'       => '6',
		'description' => esc_html__( 'Add limit posts per page. Set -1 to show all.', 'slzexploore-core' )
	),
	array(
		'type'        => 'textfield',
		'heading'     => esc_html__( 'Offset post', 'slzexploore-core' ),
		'param_name'  => 'offset_post',
		'value'       => '',
		'description' => esc_html__( 'Enter offset to pass over posts. If you want to start on record 6, using offset 5', 'slzexploore-core' )
	),
	array(
		'type'        => 'dropdown',
		'heading'     => esc_html__( 'Sort by', 'slzexploore-core' ),
		'param_name'  => 'sort_by',
		'value'       => $sort_by,
		'description' => esc_html__( 'Select order to display list cars.', 'slzexploore-core' ),
	),
	array(
		'type'        => 'dropdown',
		'heading'     => esc_html__( 'Show pagination', 'slzexploore-core' ),
		'param_name'  => 'pagination',
		'value'       => $paging,
		'std'         => 'yes',
		'description' => esc_html__( 'Show or hide pagination.', 'slzexploore-core' ),
	),
	array(
		'type'        => 'textfield',
		'heading'     => esc_html__( 'Extra Class', 'slzexploore-core' ),
		'param_name'  => 'extra_class',
		'value'       => '',
		'description' => esc_html__( 'Add extra class to block', 'slzexploore-core' )
	),
	array(
		'type'        => 'dropdown',
		'heading'     => esc_html__( 'Featured Car', 'slzexploore-core' ),
		'param_name'  => 'featured_filter',
		'value'       => $featured_filter,
		'description' => esc_html__( 'Filter by featured car or none.', 'slzexploore-core' ),
		'group'       => esc_html__( 'Filter By', 'slzexploore-core')
	),
	array(
		'type'       => 'param_group',
		'heading'    => esc_html__( 'Categories', 'slzexploore-core' ),
		'param_name' => 'category_list',
		'params'     => array(
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'heading'     => esc_html__( 'Add Category', 'slzexploore-core' ),
				'param_name'  => 'category_slug',
				'value'       => $category,
				'description' => esc_html__( 'Choose special category to filter', 'slzexploore-core'  )
			),
		),
		'value'       => '',
		'callbacks'   => array(
			'after_add' => 'vcChartParamAfterAddCallback'
		),
		'description' => esc_html__( 'Default no filter by category.', 'slzexploore-core' ),
		'group'       => esc_html__( 'Filter By', 'slzexploore-core')
	),
	array(
		'type'       => 'param_group',
		'heading'    => esc_html__( 'Locations', 'slzexploore-core' ),
		'param_name' => 'location_list',
		'params'     => array(
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'heading'     => esc_html__( 'Select Location', 'slzexploore-core' ),
				'param_name'  => 'location_slug',
				'value'       => $location,
				'description' => esc_html__( 'Choose special location to filter car', 'slzexploore-core'  )
			),
		),
		'value'       => '',
		'callbacks'   => array(
			'after_add' => 'vcChartParamAfterAddCallback'
		),
		'description' => esc_html__( 'Default no filter by location.', 'slzexploore-core' ),
		'group'       => esc_html__( 'Filter By', 'slzexploore-core')
	),
	array(
		'type'       => 'param_group',
		'heading'    => esc_html__( 'Authors', 'slzexploore-core' ),
		'param_name' => 'author_list',
		'params'     => array(
			array(
				'type'        => 'dropdown',
				'admin_label' => true,
				'heading'     => esc_html__( 'Add Author', 'slzexploore-core' ),
				'param_name'  => 'author',
				'value'       => $author,
				'description' => esc_html__( 'Choose special author to filter', 'slzexploore-core'  )
			),
		),
		'value'       => '',
		'callbacks'   => array(
			'after_add' => 'vcChartParamAfterAddCallback'
		),
		'description' => esc_html__( 'Default no filter by author.', 'slzexploore-core' ),
		'group'       => esc_html__( 'Filter By', 'slzexploore-core')
	),
	// Read more button
	array(
		'type'        => 'textfield',
		'heading'     => esc_html__( 'Read More Text', 'slzexploore-core' ),
		'param_name'  => 'btn_book',
		'value'       => '',
		'description' => esc_html__( 'Enter content to button', 'slzexploore-core' ),
		'group'       => esc_html__( 'Buttons', 'slzexploore-core'),
	),
	//custom list button
	array(
		'type'        => 'textfield',
		'heading'     => esc_html__( 'Custom Button Text', 'slzexploore-core' ),
		'param_name'  => 'btn_custom',
		'value'       => '',
		'description' => esc_html__( 'Enter content to button', 'slzexploore-core' ),
		'group'       => esc_html__( 'Buttons', 'slzexploore-core'),
	),
	array(
		'type'        => 'vc_link',
		'heading'     => esc_html__( 'Custom Button Link', 'slzexploore-core' ),
		'param_name'  => 'btn_link',
		'value'       => '',
		'description' => esc_html__( 'Add link to custom button.', 'slzexploore-core' ),
		'group'       => esc_html__( 'Buttons', 'slzexploore-core'),
	),
	array(
		'type'        => 'colorpicker',
		'heading'     => esc_html__( 'Text Color', 'slzexploore-core' ),
		'param_name'  => 'btn_book_color',
		'value'       => '',
		'description' => esc_html__( 'Enter text color to button', 'slzexploore-core' ),
		'group'       => esc_html__( 'Buttons', 'slzexploore-core'),
	),
	array(
		'type'        => 'colorpicker',
		'heading'     => esc_html__( 'Background Color', 'slzexploore-core' ),
		'param_name'  => 'btn_book_bg_color',
		'value'       => '',
		'description' => esc_html__( 'Enter background button color to button', 'slzexploore-core' ),
		'group'       => esc_html__( 'Buttons', 'slzexploore-core'),
	),
	array(
		'type'        => 'colorpicker',
		'heading'     => esc_html__( 'Hover Background Color', 'slzexploore-core' ),
		'param_name'  => 'btn_book_hover_bg_color',
		'value'       => '',
		'description' => esc_html__( 'Enter background button color to button', 'slzexploore-core' ),
		'group'       => esc_html__( 'Buttons', 'slzexploore-core'),
	),
);
vc_map(array(
	'name'        => esc_html__( 'SLZ Car Grid', 'slzexploore-core' ),
	'base'        => 'slzexploore_core_car_grid_sc',
	'class'       => 'slzexploore_core-sc',
	'icon'        => 'icon-slzexploore_core_car_grid_sc',
	'category'    => SLZEXPLOORE_CORE_SC_CATEGORY,
	'description' => esc_html__( 'List car in grid.', 'slzexploore-core' ),
	'params'      => $params
));