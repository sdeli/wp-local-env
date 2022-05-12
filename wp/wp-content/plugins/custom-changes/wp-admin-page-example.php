<?php

const OPTIONS_GROUP = 'my-cool-plugin-settings-group';
const CUSTOM_OPTION_NAME = 'my-cool-custom-sett';

add_action('admin_menu', 'my_cool_plugin_create_menu');

function my_cool_plugin_create_menu() {

	//create new top-level menu
	add_menu_page(
    'My Cool Plugin Settings', 
    'Cool Settings', 
    'administrator', 
    __FILE__, 
    'my_cool_plugin_settings_page' , 
    plugins_url('/images/icon.png', __FILE__) 
  );

  $echo_settings_section = function () { 
    ?>
      <p>section description</p>
    <?php
  };

  add_settings_section(
    'section-id-1', 
    'section title', 
    $echo_settings_section,
    OPTIONS_GROUP
  );
	//call register settings function
	add_action( 'admin_init', 'register_my_cool_plugin_settings' );
}


function register_my_cool_plugin_settings() {
	//register our settings
	register_setting( OPTIONS_GROUP, 'new_option_name' );
	register_setting( OPTIONS_GROUP, 'some_other_option' );
	register_setting( OPTIONS_GROUP, 'option_etc' );
	register_setting( OPTIONS_GROUP, 'my-cool-custom-sett' );

  for ($i = 1; $i <= 1; $i++) { 
    # code...
    add_settings_field(
      'my-cool-custom-sett-field-' . $i,
      'cus sett field title ' . $i,
      'wp_echo_input_field',
      OPTIONS_GROUP,
      'section-id-1',
      array($i),
    );
  }
}

function wp_echo_input_field($args) {
  $val = '';
  $i = array_pop($args);

  $opts = get_option('my-cool-custom-sett');
  if (empty($opts)) {
    $default_options = get_default_rating_options();
    $val = $default_options[$i];
  } else {
    $val = $opts;
  }
  
  // name="' . SETTING_NAME . '[' . $i . '] " 
  // name="my-cool-' . SETTING_NAME . '-' . $i .'" 
  echo '<input id="' 
  . $i . '" 
  class="widefat" type="text" 
  name="my-cool-custom-sett" 
  value="' .  esc_attr($val) . '"><br>';
};

function my_cool_plugin_settings_page() {
?>
<div class="wrap">
<h1>Your Plugin Name</h1>

<form method="post" action="options.php">
    <?php settings_fields( OPTIONS_GROUP ); ?>
    <?php do_settings_sections( OPTIONS_GROUP ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">New Option Name</th>
        <td><input type="text" name="new_option_name" value="<?php echo esc_attr( get_option('new_option_name') ); ?>" /></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Some Other Option</th>
        <td><input type="text" name="some_other_option" value="<?php echo esc_attr( get_option('some_other_option') ); ?>" /></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Options, Etc.</th>
        <td><input type="text" name="option_etc" value="<?php echo esc_attr( get_option('option_etc') ); ?>" /></td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php } ?>