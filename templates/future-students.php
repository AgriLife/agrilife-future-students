<?php
/**
 * Template Name: Future Students
 */

// Queue styles
add_action( 'wp_enqueue_scripts', 'fc_register_styles' );
add_action( 'wp_enqueue_scripts', 'fc_enqueue_styles' );

// Register asset functions
function fc_register_styles() {

  wp_register_style(
    'future-student-styles',
    AG_FUST_DIR_URL . 'css/future-students.css',
    array(),
    '',
    'screen'
  );

}

function fc_enqueue_styles(){

  wp_enqueue_style( 'future-student-styles' );

}

add_filter( 'genesis_post_title_text', function( $title ){

  if ( get_field( 'header_image' ) ){

    $title = sprintf( '<span>%s</span>',
      $title );

  }

  return $title;

});

add_action( 'genesis_entry_header', function( $markup ){

  if ( get_field( 'header_image' ) ){

    echo '<div class="image-wrap">';

  }

}, 5);

add_action( 'genesis_entry_header', function( $markup ){

  if ( get_field( 'header_image' ) ){

    echo sprintf( '<img src="%s"></div>',
    get_field('header_image') );

  }

}, 10);

// Display content
add_action( 'genesis_entry_content', 'ag_fust_content' );

function ag_fust_content()
{

  ?>
    <div class="student-status"><a href="#">Freshman</a><a href="#">Graduate</a><a href="#">Online</a><a href="#">Transfer</a></div><?php

  if ( get_field( 'summary_1' ) || get_field( 'summary_2' ) ){ ?>
    <div class="summaries"><?php
    if ( get_field( 'summary_1' ) ){ ?>
      <div class="one-of-two"><?php the_field('summary_1'); ?></div><?php
    }

    if ( get_field( 'summary_2' ) ){ ?>
      <div class="one-of-two"><?php the_field('summary_2'); ?></div><?php
    } ?>
    </div><?php
  }

  if ( get_field( 'course_info' ) ){ ?>
    <div class="course-buttons"><?php
      $course_buttons = get_field('course_info');

      foreach ($course_buttons as $key => $value) {
        echo sprintf('<a href="%s">%s</a>',
          $value['link'],
          $value['label']
        );
      }

    ?></div>
  <?php }

  if ( get_field( 'campus_info' ) ){ ?>
    <div class="campus-info"><?php
    $campus_info = get_field('campus_info');

    ?>
      <div class="buttons"><?php

    foreach ($campus_info['actions'] as $key => $value) {

      echo sprintf('<a href="%s">%s</a>',
        $value['link'],
        $value['label']
      );

    }

      ?></div><?php

    if(!empty($campus_info['button']['button_image'])){

      if(!empty($campus_info['button']['button_link'])){
        echo '<a href="' . $campus_info['button']['button_link'] . '">';
      }

      echo '<img src="' . $campus_info['button']['button_image'] . '">';

      if(!empty($campus_info['button']['button_link'])){
        echo '</a>';
      }

    }

    ?></div>
  <?php }

  if ( get_field( 'national_recognition' ) ){ ?>
    <div class="national-recognition"><?php

      foreach (get_field( 'national_recognition' ) as $key => $value) {
        echo sprintf('<div><img src="%s"><span class="tagline">%s<span class="citation">%s</span></span></div>',
          $value['image']['url'],
          $value['title'],
          $value['source']
        );
      }

    ?></div>
  <?php }

}
genesis();
