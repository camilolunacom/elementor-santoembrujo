<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Audio Player Widget.
 *
 * Audio player for product application.
 *
 * @since 1.0.0
 */
class Elementor_Audio_Player extends \Elementor\Widget_Base {

	/**
	 * Constructor function.
	 *
	 * @param array $data
	 * @param array $args
	 */
	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
		wp_register_script( 'audio-player-script', plugins_url( '/assets/js/audio-player.js', dirname( __FILE__ ) ), array( 'jquery', 'elementor-frontend' ), '1.0.0', true );
		wp_register_style( 'audio-player-style', plugins_url( '/assets/css/audio-player.css', dirname( __FILE__ ) ) );
	}

	/**
	 * Get scripts for the widget.
	 *
	 * @return array JS handles
	 */
	public function get_script_depends() {
		return array( 'audio-player-script' );
	}

	/**
	 * Get styles for the widget.
	 *
	 * @return array CSS Handles.
	 */
	public function get_style_depends() {
		return array( 'audio-player-style' );

	}

	/**
	 * Get widget name.
	 *
	 * Retrieve Audio Player widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'audio_player';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Audio Player widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Audio Player', 'alunizar' );
	}

		/**
		 * Get widget icon.
		 *
		 * Retrieve currency widget icon.
		 *
		 * @since 1.0.0
		 * @access public
		 * @return string Widget icon.
		 */
	public function get_icon() {
		return 'eicon-play';
	}

		/**
		 * Get widget categories.
		 *
		 * Retrieve the list of categories the Audio Player widget belongs to.
		 *
		 * @since 1.0.0
		 * @access public
		 * @return array Widget categories.
		 */
	public function get_categories() {
		return array( 'basic' );
	}

		/**
		 * Get widget keywords.
		 *
		 * Retrieve the list of keywords the Audio Player widget belongs to.
		 *
		 * @since 1.0.0
		 * @access public
		 * @return array Widget keywords.
		 */
	public function get_keywords() {
		return array( 'alunizar', 'audio', 'player', 'reproductor', 'santo', 'embrujo' );
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		?>

		<audio class="player" controls>
			<source src="#" type="audio/mpeg">
			Your browser does not support the audio element.
		</audio>

		<?php
	}
}
