<?php
/*
* Plugin Name: TinyMCE Pre code wrapper
* Plugin URI: https://crilleengvall.github.io/Wordpress-tinyMCE-pre-code-wrapper/
* Description: Adds a plugin to tinyMCE to quickly wrap or insert &lt;pre&gt;&lt;code&gt;&lt;/pre&gt;&lt;/code&gt; tags - Plays good with highlight.js
* Version: 0.1
* Author: Christian Engvall
* Author URI: http://www.christianengvall.se
* License: GPL3
* License URI: https://www.gnu.org/licenses/gpl-3.0.html
* Text Domain: pre-code-wrapper
* Domain Path: /languages

TinyMCE Pre code wrapper is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

TinyMCE Pre code wrapper is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with TinyMCE Pre code wrapper.  If not, see <https://www.gnu.org/licenses/gpl-3.0.html>.
*/

class TinyMCEPreCodeWrapper {
  public function __construct() {
    add_action( 'admin_init', array($this, 'setup_tiny_mce_plugin') );
  }

  public function setup_tiny_mce_plugin() {
    if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
      add_filter( 'mce_buttons', array( $this, 'register_tinymce_button' ) );
      add_filter( 'mce_external_plugins', array( $this, 'add_tinymce_button' ) );
      add_filter( 'tiny_mce_before_init', array( $this, 'add_tinymce_settings' ) );
    }
  }

  public function register_tinymce_button( $buttons ) {
    array_push( $buttons, 'button_pre_code_wrapper' );
    return $buttons;
  }

  function add_tinymce_button( $plugin_array ) {
    $plugin_array['pre_code_wrapper_script'] = plugins_url( '/editor/editor_plugin.js', __FILE__ ) ;
    return $plugin_array;
  }

  public function add_tinymce_settings( $settings ) {
    $settings['pre_code_wrapper_menu_name'] = __('Add or wrap selected text with <pre><code>', 'pre-code-wrapper');
    return $settings;
  }
}

$preCodePlugin = new TinyMCEPreCodeWrapper();
