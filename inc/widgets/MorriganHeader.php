<?php
/**
 * @package  morriganPlugin
 */
namespace Inc\Widgets;
use WP_Widget;
/**
*
*/
class MorriganHeader extends WP_Widget{

	public $widget_ID;
	public $widget_name;
	public $widget_options = array();
	public $control_options = array();

	function __construct() {
		$this->widget_ID = 'morrigan_header';
		$this->widget_name = 'Big header';
		$this->widget_options = array(
			'classname' => $this->widget_ID,
			'description' => $this->widget_name,
			'customize_selective_refresh' => true,
		);
		$this->control_options = array(
			'width' => '100%',
			'height' => 350,
		);
	}

	public function register(){

		parent::__construct( $this->widget_ID, $this->widget_name, $this->widget_options, $this->control_options );
		add_action( 'widgets_init', array( $this, 'widgetsInit' ) );
	}

	public function widgetsInit(){
		register_widget( $this );
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		?>
		<div class="container-fuild">
      <?php if ( ! empty( $instance['title'] ) ) { ?>

        <h1><?php echo esc_attr( $instance['title'] ); ?></h1>

      <?php } ?>
		</div>
		<?php
		echo $args['after_widget'];
	}
 	// For back-end view
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		?>

      <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Big title:' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		return $instance;
	}
}
