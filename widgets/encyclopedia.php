<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor Encyclopedia Widget.
 *
 * Widget for showing an encylopedia.
 *
 * @since 1.0.0
 */
class Elementor_Encyclopedia extends \Elementor\Widget_Base {

	/**
	 * Constructor function.
	 *
	 * @param array $data
	 * @param array $args
	 */
	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
		wp_register_script( 'encyclopedia-script', plugins_url( '/assets/js/encyclopedia.js', dirname( __FILE__ ) ), array( 'jquery', 'elementor-frontend' ), '1.0.0', true );
		wp_register_style( 'encyclopedia-style', plugins_url( '/assets/css/encyclopedia.css', dirname( __FILE__ ) ) );
	}

	/**
	 * Get scripts for the widget.
	 *
	 * @return array JS handles
	 */
	public function get_script_depends() {
		return array( 'encyclopedia-script' );
	}

	/**
	 * Get styles for the widget.
	 *
	 * @return array CSS Handles.
	 */
	public function get_style_depends() {
		return array( 'encyclopedia-style' );

	}

	/**
	 * Get widget name.
	 *
	 * Retrieve Encyclopedia widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'encyclopedia';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Encyclopedia widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Encyclopedia', 'alunizar' );
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
		return 'eicon-columns';
	}

		/**
		 * Get widget categories.
		 *
		 * Retrieve the list of categories the Encyclopedia widget belongs to.
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
		 * Retrieve the list of keywords the Encyclopedia widget belongs to.
		 *
		 * @since 1.0.0
		 * @access public
		 * @return array Widget keywords.
		 */
	public function get_keywords() {
		return array( 'encyclopedia', 'alunizar', 'encyclopedia', 'santo', 'embrujo' );
	}

		/**
		 * Register widget controls.
		 *
		 * Add input fields to allow the user to customize the widget settings.
		 *
		 * @since 1.0.0
		 * @access protected
		 */
	protected function register_controls() {

		$this->start_controls_section(
			'contents',
			array(
				'label' => esc_html__( 'Contents', 'alunizar' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'section_title',
			array(
				'label'       => esc_html__( 'Section Title', 'alunizar' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Section Title', 'alunizar' ),
				'placeholder' => esc_html__( 'Section Title', 'alunizar' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'section_description',
			array(
				'label'       => esc_html__( 'Section Description', 'alunizar' ),
				'type'        => \Elementor\Controls_Manager::WYSIWYG,
				'default'     => esc_html__( 'Section Description', 'alunizar' ),
				'placeholder' => esc_html__( 'Section Description', 'alunizar' ),
			)
		);
		
		$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Term icon', 'alunizar' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-search',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'default_image',
			array(
				'label'   => esc_html__( 'Default Image', 'plugin-name' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'default_title',
			array(
				'label'       => esc_html__( 'Default Title', 'alunizar' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Default Title', 'alunizar' ),
				'placeholder' => esc_html__( 'Default Title', 'alunizar' ),
				'label_block' => true,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			array(
				'label'       => esc_html__( 'Title', 'alunizar' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Title', 'alunizar' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'description',
			array(
				'label'       => esc_html__( 'Description', 'alunizar' ),
				'type'        => \Elementor\Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'Description', 'alunizar' ),
			)
		);

		$repeater->add_control(
			'image',
			array(
				'label'   => esc_html__( 'Image', 'plugin-name' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$repeater->add_control(
			'how_to_bewitch_it',
			array(
				'label'       => esc_html__( 'How to bewitch it', 'alunizar' ),
				'type'        => \Elementor\Controls_Manager::WYSIWYG,
				'placeholder' => esc_html__( 'How to bewitch it', 'alunizar' ),
			)
		);

		$this->add_control(
			'terms',
			array(
				'label'       => esc_html__( 'Encyclopedia terms', 'alunizar' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ title }}}',
			)
		);

		$this->end_controls_section();
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
		$settings = $this->get_settings_for_display();
		?>

		<div class="encyclopedia">
			<div class="encyclopedia__col encyclopedia__col--1">

				<h2 class="encyclopedia__title encyclopedia__title--h1"><?php echo $settings['section_title']; ?></h2>

				<div class="encyclopedia__description"><?php echo $settings['section_description']; ?></div>

				<div class="encyclopedia__terms">

					<?php foreach ( $settings['terms'] as $index => $term ) : ?>

						<a class="encyclopedia__term" href="#" data-index=<?php echo $index + 1; ?>>
							<span class="encyclopedia__icon"><?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?></span><?php echo $term['title']; ?>
						</a>

					<?php endforeach; ?>

				</div>

			</div>
			<div class="encyclopedia__col encyclopedia__col--2">

				<div class="encyclopedia__definition encyclopedia__definition--0">

					<div class="encyclopedia__image">

						<?php echo wp_get_attachment_image( $settings['default_image']['id'], 'full' ); ?>

					</div>

					<h3 class="encyclopedia__title encyclopedia__title--h2"><?php echo $settings['default_title']; ?></h3>

				</div>

				<?php foreach ( $settings['terms'] as $index => $term ) : ?>

					<div class="encyclopedia__definition encyclopedia__definition--<?php echo $index + 1; ?>">

						<?php
						$name              = $term['title'];
						$description       = $term['description'];
						$image             = $term['image'];
						$how_to_bewitch_it = $term['how_to_bewitch_it'];
						?>

						<h3 class="encyclopedia__title encyclopedia__title--h2"><?php echo $name; ?></h3>

						<div class="encyclopedia__description"><?php echo $description; ?></div>

						<div class="encyclopedia__image">

							<?php echo wp_get_attachment_image( $image['id'], 'full' ); ?>

						</div>

						<?php if ( $how_to_bewitch_it) : ?>

							<h4 class="encyclopedia__title encyclopedia__title--h3"><?php esc_html_e( '¿Cómo embrujarlo?', 'alunizar'); ?></h4>

							<div class="encyclopedia__description"><?php echo $how_to_bewitch_it; ?></div>

						<?php endif; ?>

					</div>

				<?php endforeach; ?>

			</div>
		</div>

		<?php
	}

	/**
	 * Render list widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function content_template() {
		?>

			<div class="encyclopedia">
				<div class="encyclopedia__col encyclopedia__col--1">

					<h2 class="encyclopedia__title encyclopedia__title--h1">{{ settings.section_title }}</h2>

					<div class="encyclopedia__description">{{{ settings.section_description }}}</div>

					<div class="encyclopedia__terms">

						<#
						if ( settings.terms ) {
							_.each( settings.terms, function( term, index ) {

							const iconHTML = elementor.helpers.renderIcon( view, settings.icon, { 'aria-hidden': true }, 'i' , 'object' );
							#>


							<a class="encyclopedia__term" href="#" data-index={{ index + 1 }}>
								<span class="encyclopedia__icon">{{{ iconHTML.value }}}</span>{{ term.title }}
							</a>

						<#
						} );
					}
					#>

					</div>

				</div>
				<div class="encyclopedia__col encyclopedia__col--2">

					<div class="encyclopedia__definition encyclopedia__definition--0">

						<div class="encyclopedia__image">

							<img src="{{{ settings.default_image.url }}}">

						</div>

						<h3 class="encyclopedia__title encyclopedia__title--h2">{{ settings.default_title }}</h3>

					</div>

					<#
					if ( settings.terms ) {
						_.each( settings.terms, function( term, index ) {
						#>

							<div class="encyclopedia__definition encyclopedia__definition--{{ index + 1 }}">

								<h3 class="encyclopedia__title encyclopedia__title--h2">{{ term.name}}</h3>

								<div class="encyclopedia__description">{{{ term.description }}}</div>

								<# if ( term.image ) { #>

									<div class="encyclopedia__image">
								
										<img src="{{{ term.image.url }}}">

								</div>

								<# } #>

								<# if ( term.how_to_bewitch_it ) { #>
								
									<h4 class="encyclopedia__title encyclopedia__title--h3">¿Cómo embrujarlo?</h4>
									
									<div class="encyclopedia__description">{{{ term.how_to_bewitch_it }}}</div>

								<# } #>

							</div>

						<#
						} );
					}
					#>

				</div>
				
			</div>

		<?php
	}
}
