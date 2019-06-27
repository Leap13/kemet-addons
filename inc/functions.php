<?php
/**
 * Locate template.
 *
 * Locate the called template.
 * Search Order:
 * 1. /themes/theme/templates/$template_name
 * 2. /themes/theme/$template_name
 * 3. /plugins/kemet-addons/addons/
 *
 * @since 1.0.0
 *
 * @param   string  $template_name          Template to load.
 * @param   string  $string $template_path  Path to templates.
 * @param   string  $default_path           Default path to template files.
 * @return  string                          Path to the template file.
 */
function kemetaddons_locate_template( $template_name, $template_path = '', $default_path = '' ) {
  // Set variable to search in the templates folder of theme.
  if ( ! $template_path ) :
    $template_path = KEMET_ADDONS_DIR . 'addons/';
  endif;
  // Set default plugin templates path.
  if ( ! $default_path ) :
    $default_path = KEMET_ADDONS_DIR . 'addons/'; // Path to the template folder
  endif;
  // Search template file in theme folder.
  $template = locate_template( array(
    $template_path . $template_name,
    $template_name
  ) );
  // Get plugins template file.
  if ( ! $template ) :
    $template = $default_path . $template_name;
  endif;
  return apply_filters( 'kemetaddons_locate_template', $template, $template_name, $template_path, $default_path );
}

/**
 * Get template.
 *
 * Search for the template and include the file.
 *
 * @since 1.0.0
 *
 * @see PLUGIN_locate_template()
 *
 * @param string  $template_name          Template to load.
 * @param array   $args                   Args passed for the template file.
 * @param string  $string $template_path  Path to templates.
 * @param string  $default_path           Default path to template files.
 */
function kemetaddons_get_template( $template_name, $args = array(), $tempate_path = '', $default_path = '' ) {
  if ( is_array( $args ) && isset( $args ) ) :
    extract( $args );
  endif;
  $template_file = kemetaddons_locate_template( $template_name, $tempate_path, $default_path );
  if ( ! file_exists( $template_file ) ) :
    _doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $template_file ), '1.0.0' );
    return;
  endif;
  include $template_file;
}

// Control core classes for avoid errors
if( class_exists( 'CSF' ) ) {

  //
  // Set a unique slug-like ID
  $prefix = 'kmt_header_customizer_options';

  //
  // Create customize options
  CSF::createCustomizeOptions( $prefix, array(
    'database'        => 'option',
    'transport'       => 'refresh',
    'capability'      => 'manage_options',

  ) );


  	// $wp_customize->add_control(
		// new WP_Customize_Image_Control(
		// 	$wp_customize, KEMET_THEME_SETTINGS . '[kmt-header-retina-logo]', array(
  //
  // Create a section
  CSF::createSection( $prefix, array(
    'assign' => 'section-kemet-footer',
    'fields' => array(

      //
      // A text field

      array(
        'id'        => 'header-layoutrr',
        'type'      => 'image_select',
        'title'     => 'Image Select',
        'options'   => array(
          'header-main-layout-5' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50a.gif',
          'header-main-layout-6' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50a.gif',
          'header-main-layout-7' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50a.gif',
        ),
        //'default'   => 'header-main-layout-6'
      ),
      array(
        'id'    => 'option',
        'type'  => 'text',
        'priority' => 1,
        'title' => 'Simple Textttttttt',
      ),
            array(
        'id'        => 'header-layoutk',
        'type'      => 'image_select',
        'title'     => 'Image Select',
        'options'   => array(
          'header-main-layout-k5' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50a.gif',
          'header-main-layout-6k' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50a.gif',
          'header-main-layout-7k' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50a.gif',
        ),
      ),

//       array(
//   'id'         => 'header-layouts',
//   'type'       => 'radio',
//   'title'      => 'Radio',
//   'options'    => array(
//     'header-main-layout-5' => 'Option 1',
//     'header-main-layout-6' => 'Option 2',
//     'header-main-layout-7' => 'Option 3',
//   ),
//   'default'    => 'option-2'
// ),

    )
  ) );

  //
  // Create a section
  CSF::createSection( $prefix, array(
    'title'  => 'Tab Title 2',
    'fields' => array(

      // A textarea field
      array(
        'id'    => 'opt-textarea',
        'type'  => 'textarea',
        'title' => 'Simple Textarea',
      ),
      array(
        'id'        => 'header-layouts',
        'type'      => 'image_select',
        'title'     => 'Image Select',
        'options'   => array(
          'header-main-layout-1' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50a.gif',
          'header-main-layout-2' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50a.gif',
          'header-main-layout-3' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50a.gif',
          'header-main-layout-4' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50a.gif',
          'header-main-layout-5' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50a.gif',
          'header-main-layout-6' => 'http://codestarframework.com/assets/images/placeholder/80x80-2c3e50a.gif',
        ),
       )

    )
  ) );

}

