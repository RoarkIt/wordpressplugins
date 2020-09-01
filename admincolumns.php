<?php
/*
Plugin Name: Aubreys Awesome Admin Adjustments
Description: This plugin changes the columns for the sports post type
Version:     1.0
Author:      Aubrey Roark


*/

add_filter( 'manage_sport_posts_columns', 'roarka_sports_columns' );
function roarka_sports_columns( $columns ) {
  
  
    $columns = array(
      'cb' => $columns['cb'],
      
      'title' => 'Frontend Title',
		'test_title' =>  'Rec Title',
		  'author' => 'Author',
		'date' => 'Date',
		'categories' => 'Cats'

    );
  
  
  return $columns;
}

 
add_action( 'manage_sport_posts_custom_column', 'roarka_sports_column', 10, 2);
function roarka_sports_column( $column, $post_id ) {
  if ( 'test_title' === $column ) {
    $test_title = get_post_meta( $post_id, 'test_title', true );

    if ( ! $test_title ) {
      _e( 'n/a' );
    } else {
      _e( $test_title);
    }
  }
}

add_filter( 'manage_edit-sport_sortable_columns', 'roarka_sport_sortable_columns');
function roarka_sport_sortable_columns( $columns ) {
  $columns['test_title'] = 'test_title';
  return $columns;
}



add_action( 'pre_get_posts', 'roarka_posts_orderby' );
function roarka_posts_orderby( $query ) {
  if( ! is_admin() || ! $query->is_main_query() ) {
    return;
  }

  if ( 'test_title' === $query->get( 'orderby') ) {
    $query->set( 'orderby', 'meta_value' );
    $query->set( 'meta_key', 'test_title' );
  }
}
  
?>