<?php
// The filter callback function.
add_action('admin_menu', 'apply_filter_test');

function apply_filter_test() {
  // add_filter( 'example_filter', 'example_callback', 10, 3 );
  
  $value = apply_filters( 'example_filter', 'filter me', 'test1', 'test2' );
  echo '<br>$value<br>';
  echo $value;
  echo '<br>';
}

function example_callback( $string, $arg1, $arg2 ) {
    // (maybe) modify $string.
    echo '<br>$arg1<br>';
    echo $arg1;
    echo '<br>arg2<br>';
    echo $arg2;
    echo '<br>';
    return $string;
}

/*
 * Apply the filters by calling the 'example_callback()' function
 * that's hooked onto `example_filter` above.
 *
 * - 'example_filter' is the filter hook.
 * - 'filter me' is the value being filtered.
 * - $arg1 and $arg2 are the additional arguments passed to the callback.
*/