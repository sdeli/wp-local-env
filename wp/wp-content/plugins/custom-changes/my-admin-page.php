<?php

const PAGE_TITLE = 'custom settings paage';
const ADMIN_BAR_MENU_TITLE = 'custom settings';
const REQUIRED_CAPABILITY = 'edit_posts';
const ADMIN_BAR_MENU_SLUG = 'cus-sett';
const SECTION_ID = 'cust-sett-id';

const SETTINGS_GROUP = 'custom options';
const SETTING_NAME = 'custom-option-name-b';

add_action('admin_menu', 'add_admin_settings');
$test_var = 0;
function add_admin_settings() {
  add_action( 'admin_init', 'register_my_settings' );

  $echo_settings_page_title = function () { 
    ?>
      <div class="wrap">
        <h1>Page Title</h1>
        <?php 
          $trigger = 0;

          for ($i = 0; $i < 10; $i++) {
            $trigger++;
            echo "ez egy szar oldal: $trigger<br>";
            echo '<br>';
          }
        ?>
        <form method="post" action="options.php">
          <?php 
            settings_fields( SETTINGS_GROUP );
            do_settings_sections( SETTINGS_GROUP );
            submit_button(); 
          ?>
        </form>
      </div>
    <?php
  };

  $echo_settings_section = function () { 
    ?>
      <p>section description</p>
    <?php
  };

  // add_submenu_page();
  add_menu_page( 
    PAGE_TITLE, 
    ADMIN_BAR_MENU_TITLE, 
    REQUIRED_CAPABILITY, 
    ADMIN_BAR_MENU_SLUG, 
    $echo_settings_page_title, 
    'dashicons-dashboard', 
    2 
  );

  add_settings_section(
    SECTION_ID, 
    'section title', 
    $echo_settings_section,
    SETTINGS_GROUP
  );

  for ($i = 1; $i <= 10; $i++) { 
    add_settings_field(
      'custom-sett-field-' . $i,
      'cus sett field title ' . $i,
      'echo_input_field',
      SETTINGS_GROUP,
      SECTION_ID,
      array($i),
    );
  }
}

function echo_input_field($args) {
  $val = '';
  $i = array_pop($args);

  $opts = get_option(SETTING_NAME);
  if (empty($opts)) {
    $default_options = get_default_rating_options();
    $val = $default_options[$i];
  } else {
    $val = $opts[$i];
  }
  
  // name="' . SETTING_NAME . '[' . $i . '] " 
  echo '<input id="' 
  . $i . '" 
  class="widefat" type="text" 
  name="' . SETTING_NAME . '['. $i .']" 
  value="' .  esc_attr($val) . '"><br>';
};

function register_my_settings() {
  register_setting(
    SETTINGS_GROUP,
    SETTING_NAME,
    'sanitize_options'
  );
}

function get_default_rating_options() {
  return array(
    1  => __('I walked out. And I was home!'),
    2  => __('I will never get those hours back'),
    3  => __('Not recommended'),
    4  => __('Might stay awake on an airplane for it'),
    5  => __('As they say on the internet: meh'),
    6  => __('Totally decent'),
    7  => __('Quite good. Recommended.'),
    8  => __('One of my favorites of the last X years'),
    9  => __('Loved it, and you probably will too.'),
    10 => __("Life changing! Mine, yours, everyone's!"),
  );
}

function format_rating_options($options) {
  $formatted = array(
    '' => __('TBR (To be rated)')
  );

  foreach ($options as $key => $val) {
    $formatted[$key] = $key . ' - ' . __($val);
  }

  return $formatted;
}

function sanitize_options($otps) {
  return array_map('sanitize_text_field', $otps);
}