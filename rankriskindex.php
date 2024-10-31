<?php
/*
Plugin Name: RankRiskIndex
Plugin URI: https://www.thewebmaster.com
Description: Display latest Risk Index from RankRanger
Version: 1.3
Author: Jonathan Griffin
Author URI: https://www.thewebmaster.com
License: GPLv2 or later
*/

/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function example_add_dashboard_widgets() {

	wp_add_dashboard_widget(
                 'rankriskindex_dashboard_widget',         // Widget slug.
                 'Rank Ranger Risk Index',         // Title.
                 'rankriskindex_dashboard_widget_function' // Display function.
        );
}
add_action( 'wp_dashboard_setup', 'example_add_dashboard_widgets' );

/**
 * Create the function to output the contents of our Dashboard Widget.
 */
function rankriskindex_dashboard_widget_function() {
	// Display whatever it is you want to show.
	echo '<iframe src="https://www.rankranger.com/serp-fluctuations" frameborder="0" width="450" height="200" style="border: solid 1px #D7D7D7;"></iframe>';
}

// Creating the widget
class rankrisk_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'rankrisk_widget',

// Widget name will appear in UI
__('Rank Ranger Risk Index Widget', 'rankrisk_widget_domain'),

// Widget description
array( 'description' => __( 'Rank Ranger Risk Widget', 'rankrisk_widget_domain' ), )
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
echo __( '<iframe src="https://www.rankranger.com/serp-fluctuations" frameborder="0" width="450" height="200" style="border: solid 1px #D7D7D7;"></iframe>', 'rankrisk_widget_domain' );
echo $args['after_widget'];
}

// Widget Backend
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'New title', 'rankrisk_widget_domain' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php
}

// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} // Class rankrisk_widget ends here

// Register and load the widget
function rankrisk_load_widget() {
	register_widget( 'rankrisk_widget' );
}
add_action( 'widgets_init', 'rankrisk_load_widget' );



// shortcode

function rankrisk_function() {
  return '<iframe src="https://www.rankranger.com/serp-fluctuations" frameborder="0" width="450" height="200" style="border: solid 1px #D7D7D7;"></iframe>';
}
add_shortcode('rankrisk', 'rankrisk_function');
