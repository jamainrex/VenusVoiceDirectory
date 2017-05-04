<?php
// Creating the widget 
class contact_map extends WP_Widget {

function __construct() {
parent::__construct(
			'contact_map', 
			esc_attr__('[Locales] Location MAP', 'locales'),
			array( 'description' => esc_attr__( 'This widget gives you the ability to show the location on the map', 'locales' ), ) 
			);
}

public function widget( $args, $instance ) {

$post_id = get_the_ID();
$options = get_post_meta($post_id, 'slide_options', true);

$title = apply_filters( 'widget_title', $instance['title'] );

@$lat = $options['Location']['map']['lat'] ? $options['Location']['map']['lat'] : '40.7127837'; 
@$long = $options['Location']['map']['long'] ? $options['Location']['map']['long'] : '-74.00594130000002'; 

// before and after widget arguments are defined by themes
print $args['before_widget'];
if ( !empty( $title ) ) print $args['before_title'] . $title . $args['after_title']; 
?>
	

<div class="widget-map" data-options='{
	"marker": "<?php if(has_post_thumbnail( $post_id )) the_post_thumbnail_url();  ?>",
	"marker_coord": {
	  "lat": "<?php tt_print($lat); ?>",
	  "lon": "<?php tt_print($long); ?>"
	},
	"map_center": {
	  "lat": "<?php tt_print($lat); ?>",
	  "lon": "<?php tt_print($long); ?>"
	},
	"zoom": "14",
	"styles": [
		{
			"featureType": "all",
			"elementType": "labels.text.fill",
			"stylers": [
				{
					"saturation": 36
				},
				{
					"color": "#000000"
				},
				{
					"lightness": 40
				}
			]
		},
		{
			"featureType": "all",
			"elementType": "labels.text.stroke",
			"stylers": [
				{
					"visibility": "on"
				},
				{
					"color": "#000000"
				},
				{
					"lightness": 16
				}
			]
		},
		{
			"featureType": "all",
			"elementType": "labels.icon",
			"stylers": [
				{
					"visibility": "off"
				}
			]
		},
		{
			"featureType": "administrative",
			"elementType": "geometry.fill",
			"stylers": [
				{
					"color": "#000000"
				},
				{
					"lightness": 20
				}
			]
		},
		{
			"featureType": "administrative",
			"elementType": "geometry.stroke",
			"stylers": [
				{
					"color": "#000000"
				},
				{
					"lightness": 17
				},
				{
					"weight": 1.2
				}
			]
		},
		{
			"featureType": "landscape",
			"elementType": "geometry",
			"stylers": [
				{
					"color": "#000000"
				},
				{
					"lightness": 20
				}
			]
		},
		{
			"featureType": "poi",
			"elementType": "geometry",
			"stylers": [
				{
					"color": "#000000"
				},
				{
					"lightness": 21
				}
			]
		},
		{
			"featureType": "road.highway",
			"elementType": "geometry.fill",
			"stylers": [
				{
					"color": "#000000"
				},
				{
					"lightness": 17
				}
			]
		},
		{
			"featureType": "road.highway",
			"elementType": "geometry.stroke",
			"stylers": [
				{
					"color": "#000000"
				},
				{
					"lightness": 29
				},
				{
					"weight": 0.2
				}
			]
		},
		{
			"featureType": "road.arterial",
			"elementType": "geometry",
			"stylers": [
				{
					"color": "#000000"
				},
				{
					"lightness": 18
				}
			]
		},
		{
			"featureType": "road.local",
			"elementType": "geometry",
			"stylers": [
				{
					"color": "#000000"
				},
				{
					"lightness": 16
				}
			]
		},
		{
			"featureType": "transit",
			"elementType": "geometry",
			"stylers": [
				{
					"color": "#000000"
				},
				{
					"lightness": 19
				}
			]
		},
		{
			"featureType": "water",
			"elementType": "geometry",
			"stylers": [
				{
					"color": "#000000"
				},
				{
					"lightness": 17
				}
			]
		}
	]
}'></div>



<?php
print $args['after_widget'];
}




	// Widget Backend 
public function form( $instance ){ 
	if ( isset( $instance[ 'title' ] ) ) :
		$title = $instance[ 'title' ];
	else :
		$title = esc_attr__( 'New title', 'locales' );
	endif;
?>  
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_attr_e( 'Title:', 'locales' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}


public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} 

function tt_widget_contact_map_load_widget() {
  register_widget( 'contact_map' );
}
add_action( 'widgets_init', 'tt_widget_contact_map_load_widget' );