<?php
class Elementor_Banow_Portfolio_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'banow_portfolio_widget';
	}

	public function get_title() {
		return esc_html__( 'Banow Portfolio', 'banow-addon' );
	}

	public function get_icon() {
		return 'eicon-code';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_keywords() {
		return [ 'banow', 'portfolio', 'masonry' ];
	}

	protected function register_controls() {

		// Content Tab Start

		$this->start_controls_section(
			'portfolio_section_title',
			[
				'label' => esc_html__( 'Top content/Title', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Our Portfolio', 'elementor-addon' ),
				'placeholder' => esc_html__( 'Our Portfolio', 'elementor-addon' ),
			]
		);

		$this->add_control(
			'sub_title',
			[
				'label' => esc_html__( 'Sub Title', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'A few samples of our work.', 'elementor-addon' ),
				'placeholder' => esc_html__( 'A few samples of our work.', 'elementor-addon' ),
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'portfolio_section_title_2',
			[
				'label' => esc_html__( 'Portfolio Filter Section', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		// Filter tab item
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'filter_tab_label', [
				'label' => __( 'Filter Tab Label', 'banow' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Web Design' , 'banow' ),
				'placeholder' => __( 'Web Design' , 'banow' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'filter_tab_class', [
				'label' => __( 'Filter Tab Class', 'banow' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'web-design' , 'banow' ),
				'placeholder' => __( 'web-design' , 'banow' ),
				'label_block' => true,
			]
		);


		$this->add_control(
			'tab_list',
			[
				'label' => __( 'Filter Tab', 'banow' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'filter_tab_label' => __( 'Filter #1', 'banow' ),
						'filter_tab_class' => __( 'Filter Tab Class', 'banow' ),
					]
				],
				'title_field' => '{{{ filter_tab_label }}}',
			]
		);
		// End Filter tab item


		// // Filter tab Content item
		// $repeater2 = new \Elementor\Repeater();
		// $repeater2->add_control(
		// 	'filter_content_image',
		// 	[
		// 		'label' => __( 'Choose Filter Image', 'banow' ),
		// 		'type' => \Elementor\Controls_Manager::MEDIA,
		// 		'default' => [
		// 			'url' => \Elementor\Utils::get_placeholder_image_src(),
		// 		],
		// 	]
		// );
		// $repeater2->add_control(
		// 	'filter_content_title', [
		// 		'label' => __( 'Filter Content Title', 'banow' ),
		// 		'type' => \Elementor\Controls_Manager::TEXT,
		// 		'default' => __( 'Web Design' , 'banow' ),
		// 		'placeholder' => __( 'Web Design' , 'banow' ),
		// 		'label_block' => true,
		// 	]
		// );

		// $repeater2->add_control(
		// 	'filter_content_sub_title', [
		// 		'label' => __( 'Filter Content Sub Title', 'banow' ),
		// 		'type' => \Elementor\Controls_Manager::TEXT,
		// 		'default' => __( 'WordPress Website Design' , 'banow' ),
		// 		'placeholder' => __( 'WordPress Website Design' , 'banow' ),
		// 		'label_block' => true,
		// 	]
		// );


		// $this->add_control(
		// 	'filter_content_item',
		// 	[
		// 		'label' => __( 'Filter Content', 'banow' ),
		// 		'type' => \Elementor\Controls_Manager::REPEATER,
		// 		'fields' => $repeater2->get_controls(),
		// 		'default' => [
		// 			[
		// 				'filter_content_title' => __( 'Filter Title #1', 'banow' ),
		// 				'filter_content_sub_title' => __( 'Filter Sub Title', 'banow' ),
		// 			]
		// 		],
		// 		'title_field' => '{{{ filter_content_title }}}',
		// 	]
		// );

		$this->end_controls_section();

		// End Filter item
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		?>

		<div class="portfolio-filter">

			<!-- Filter item tab -->
			<div class="data-tab button-group filters-button-group">
			  <button class="data-tab-button button is-checked" data-filter="*">All</button>
				<?php 
					if ( $settings['tab_list'] ) {
						foreach (  $settings['tab_list'] as $filter_tab_item ) {
							echo '<button class="data-tab-button" data-filter=".'.str_replace(' ', '_', strtolower($filter_tab_item['filter_tab_label'])).'">'.$filter_tab_item['filter_tab_label'].'</button>';
						}
					}
				?>
			</div>
			<!-- End Filter item tab -->

			<!-- Filter item content -->
			<div class="portfolio-filter-content filter-grid">
			<?php
				if ( $settings['filter_content_item'] ) {
						foreach (  $settings['filter_content_item'] as $filter_content_item ) {
						  echo '<div class="portfolio-filter-item website_design graphic_design" data-category="website_design">
						  	<figure>'
						  	.wp_get_attachment_image($filter_content_item["filter_content_image"]["id"], "full", false, [] ).
						  	'<figcaption>
						  			<h4>'.$filter_content_item['filter_content_title'].'</h4>
						  			<h3>'.$filter_content_item['filter_content_sub_title'].'</h3>
						  		</figcaption>
						  	</figure>
						  </div>
						</div>';
					}
				}
			?>
			<!-- End Filter item content -->

		</div>

		<?php
	}
}