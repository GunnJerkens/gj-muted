<?php
/*
Plugin Name: GJ Muted
Plugin URI: http://gunnjerkens.com
Description: Mutes and disabled all comments across a site.
Version: 0.0.1
Author: Gunn|Jerkens
Author URI: http://gunnjerkens.com
*/

class GJMuted
{
  /**
   * Constructor
   *
   */
  function __construct()
  {
    add_action('init', array(&$this, 'muteComments'), 100);
    add_action('admin_menu', array(&$this, 'removeAdminMenuItem'));
    add_action('wp_before_admin_bar_render', array(&$this, 'removeToolbarMenuItem'));
  }

  /**
   * Mutes comments on all custom post types
   *
   * @return void
   */
  public function muteComments()
  {
    $postTypes = get_post_types();

    foreach ($postTypes as $postType) {
      remove_post_type_support($postType, 'comments');
    }
  }

  /**
   * Removes menu item from wp-admin
   *
   * @return void
   */
  public function removeAdminMenuItem()
  {
    remove_menu_page('edit-comments.php');
  }

  /**
   * Removes menut item from toolbar
   *
   * @return void
   */
  public function removeToolbarMenuItem()
  {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
  }

}
new GJMuted();
