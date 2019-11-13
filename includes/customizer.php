<?php 
function wpmu_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'wpmu_header' , array(
        'title' => __( 'Header Details', 'wpmu')
    ) );
    // section for colors 
$wp_customize->add_section( 'wpmu_colors', array(
	'title' => __( 'Color Scheme', 'wpmu' )
));
class wpmu_Customize_Textarea_Control extends WP_Customize_Control {
	
	public $type = 'textarea';
	public function render_content() {
		
		echo '<label>';
			echo '<span class="customize-control-title">' . esc_html( $this-> label ) . '</span>';
			echo '<textarea rows="5" style ="width: 100%;"';
			$this->link();
			echo '>' . esc_textarea( $this->value() ) . '</textarea>';
		echo '</label>';
		
	}
}

class wpmu_Customize_Input_Control extends WP_Customize_Control {
	
	public $type = 'input';
	public function render_content() {
		
		echo '<label>';
			echo '<span class="customize-control-title">' . esc_html( $this-> label ) . '</span>';
			echo '<input style ="width: 100%;"';
			$this->link();
			echo '></input>';
		echo '</label>';
		
	}
}

//Title 1
$wp_customize->add_setting( 'wpmu_title1_setting', array (
	'default' => __( 'Clean', 'wpmu' )
) );
$wp_customize->add_control( new wpmu_Customize_Input_Control(
	$wp_customize,
	'wpmu_title1_setting',
	array( 
		'label' => __( 'Title1', 'wpmu' ),
		'section' => 'wpmu_header',
		'settings' => 'wpmu_title1_setting'
)));

//Title 2
$wp_customize->add_setting( 'wpmu_title2_setting', array (
	'default' => __( 'Slick', 'wpmu' )
) );
$wp_customize->add_control( new wpmu_Customize_Input_Control(
	$wp_customize,
	'wpmu_title2_setting',
	array( 
		'label' => __( 'Title2', 'wpmu' ),
		'section' => 'wpmu_header',
		'settings' => 'wpmu_title2_setting'
)));

//Title 3
$wp_customize->add_setting( 'wpmu_title3_setting', array (
	'default' => __( 'Pixel Perfect', 'wpmu' )
) );
$wp_customize->add_control( new wpmu_Customize_Input_Control(
	$wp_customize,
	'wpmu_title3_setting',
	array( 
		'label' => __( 'Title3', 'wpmu' ),
		'section' => 'wpmu_header',
		'settings' => 'wpmu_title3_setting'
)));

//Description
$wp_customize->add_setting( 'wpmu_description_setting', array (
	'default' => __( 'lldy is a great one-page theme, perfect for developers and designers but also for someone who just wants a new website for his business. Try it now!', 'wpmu' )
) );
$wp_customize->add_control( new wpmu_Customize_Textarea_Control(
	$wp_customize,
	'wpmu_description_setting',
	array( 
		'label' => __( 'Description', 'wpmu' ),
		'section' => 'wpmu_header',
		'settings' => 'wpmu_description_setting'
)));




// main color - site title, h1, h2, h4, widget headings, nav links, footer background
$textcolors[] = array(
	'slug' => 'wpmu_color1',
	'default' => '#f1d204',
	'label' => __( 'Main color', 'wpmu' )
);

// secondary color - navigation background
$textcolors[] = array(
	'slug' => 'wpmu_color2',
	'default' => '#f18b6d',
	'label' => __( 'Secondary color', 'wpmu' )
);

// link color
$textcolors[] = array(
	'slug' => 'wpmu_color3',
	'default' => '#6a4d8a',
	'label' => __( 'Thirdary color', 'wpmu' )
);

foreach ( $textcolors as $textcolor ) {
	
	// settings
	$wp_customize->add_setting(
		$textcolor[ 'slug' ], array (
			'default' => $textcolor[ 'default' ],
			'type' => 'option'
		)
	);
	// controls
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		$textcolor[ 'slug' ],
		array (
			'label' => $textcolor[ 'label' ],
			'section' => 'wpmu_colors',
			'settings' => $textcolor[ 'slug' ]
		)
	));
}

function wpmu_add_color_scheme() { ?>

    <?php }
    add_action( 'wp_head', 'wpmu_add_color_scheme' );


function wpmu_display_contact_details_in_header() { ?>

    <?php }
    add_action( 'wpmu_in_header', 'wpmu_display_contact_details_in_header' );
}
add_action( 'customize_register', 'wpmu_customize_register' );
?>