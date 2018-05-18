<?php
/**
 * Template Name: Future Students
 */

// Queue styles
add_action( 'wp_enqueue_scripts', 'fc_register_styles' );
add_action( 'wp_enqueue_scripts', 'fc_enqueue_styles' );
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

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

  // Add header background image to page
  if ( get_field( 'header_image' ) ){
    $img = get_field( 'header_image' );
    $custom_css = "
      .entry-header {
          background-image: url({$img});
      }";
    wp_add_inline_style( 'future-student-styles', $custom_css );
  }

  // Add campus info background image to page
  $campus_info = get_field( 'campus_info' );

  if( !empty($campus_info['background_image']) ){
    $img = $campus_info['background_image'];
    $custom_css = "
      .entry-content .campus-info {
          background-image: url({$img});
      }";
    wp_add_inline_style( 'future-student-styles', $custom_css );
  }

}

add_filter( 'genesis_post_title_text', function( $title ){

  if ( get_field( 'header_image' ) ){

    $title = sprintf( '<span>%s</span>',
      $title );

  }

  return $title;

});

// Display content
add_action( 'genesis_entry_content', 'ag_fust_content' );

function ag_fust_content()
{

  ?>
    <div class="student-status"><div><a class="button" href="#">Freshman</a></div><div><a class="button" href="#">Graduate</a></div><div><a class="button" href="#">Online</a></div><div><a class="button" href="#">Transfer</a></div></div><?php

  if ( get_field( 'summary_1' ) || get_field( 'summary_2' ) ){ ?>
    <div class="summaries"><?php
    if ( get_field( 'summary_1' ) ){
      ?><div class="one-of-two"><?php the_field('summary_1'); ?></div><?php
    }

    if ( get_field( 'summary_2' ) ){
      ?><div class="one-of-two"><?php the_field('summary_2'); ?></div><?php
    }
    ?></div><?php
  }

  if ( get_field( 'course_info' ) ){ ?>
    <div class="course-buttons"><?php
      $course_buttons = get_field('course_info');

      foreach ($course_buttons as $key => $value) {
        echo sprintf('<a class="button" href="%s">%s</a>',
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
      <div class="actions"><?php

    foreach ($campus_info['actions'] as $key => $value) {

      echo sprintf('<a class="button" href="%s">%s</a>',
        $value['link'],
        $value['label']
      );

    }

      ?></div><?php

    if(!empty($campus_info['button']['button_image'])){

      if(!empty($campus_info['button']['button_link'])){
        ?><a class="button" href="<?php echo $campus_info['button']['button_link']; ?>"><?php
      }

      echo sprintf('<img src="%s" alt="%s">',
        $campus_info['button']['button_image']['url'],
        $campus_info['button']['button_image']['title']
      );

      if(!empty($campus_info['button']['button_link'])){
        ?></a><?php
      }

    }

    ?></div>
  <?php }

  if ( get_field( 'national_recognition' ) ){ ?>
    <div class="national-recognition"><h2>National Recognition</h2><div class="item-row"><?php

      $items = get_field( 'national_recognition' );
      foreach ( $items as $key => $value) {

        if($key == 0){
          echo '<div class="left-side">';
        } else if($key == 1){
          echo '<div class="right-side">';
        }

        $class = $key > 0 ? "item-{$key} item-row" : "item-{$key}";

        echo sprintf('<div class="%s"><div class="item-cell"><img src="%s"></div><div class="item-cell"><span class="tagline">%s <span class="citation">%s</span></span></div></div>',
          $class,
          $value['image']['url'],
          $value['title'],
          $value['source']
        );

        if($key == 0){
          echo '</div>';
        }

      }

      if( count($items) > 1 ){

        echo '</div>';

      }

    ?></div></div>
  <?php }

}
genesis();
