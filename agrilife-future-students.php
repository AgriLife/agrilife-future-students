<?php
/**
 * Plugin Name: AgriLife Future Students
 * Plugin URI: https://github.com/AgriLife/future-students
 * Description: Template for future students landing page
 * Version: 1.0.0
 * Author: Zachary Watkins
 * Author Email: watkinza@gmail.com
 * License: GPL2+
 */

require 'vendor/autoload.php';

define( 'AG_FUST_DIRNAME', 'agrilife-future-students' );
define( 'AG_FUST_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'AG_FUST_DIR_FILE', __FILE__ );
define( 'AG_FUST_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'AG_FUST_TEMPLATE_PATH', AG_FUST_DIR_PATH . 'templates' );

// Add page templates
$agrilife_template_future_students = new \AgriLife\FutureStudents\PageTemplate();
$agrilife_template_future_students->with_path( AG_FUST_TEMPLATE_PATH )->with_file('future-students')->with_name( 'Future Students' );
$agrilife_template_future_students->register();

add_action( 'plugins_loaded', function() {
    if ( class_exists( 'acf' ) ) {
        require_once(AG_FUST_DIR_PATH . '/fields/futurestudents-details.php');
    }
}, 15);

add_image_size( 'future_student_background', 1140, 442, array( 'center', 'center' ) );
