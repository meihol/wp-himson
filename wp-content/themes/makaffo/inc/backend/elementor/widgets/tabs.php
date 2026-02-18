<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Tabs
 */
class Makaffo_Tabs extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-tabs';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Tabs', 'makaffo' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-tabs';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_makaffo' ];
	}

	protected function register_controls() {

		//Content Service box
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Tabs', 'makaffo' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tab_title',
			[
				'label' => __( 'Title & Description', 'makaffo' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Tab Title', 'makaffo' ),
				'placeholder' => __( 'Tab Title', 'makaffo' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tab_content',
			[
				'label' => __( 'Content', 'makaffo' ),
				'default' => __( 'Tab Content', 'makaffo' ),
				'placeholder' => __( 'Tab Content', 'makaffo' ),
				'type' => Controls_Manager::WYSIWYG,
				'show_label' => false,
			]
		);
		$repeater->add_control(
			'selected_icon',
			[
				'label' => __( 'Icon', 'makaffo' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'default' => [],
				'fa4compatibility' => 'icon',
			]
		);

		$this->add_control(
			'ot_tabs',
			[
				'label' => __( 'Tabs Items', 'makaffo' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'tab_title' => __( 'Tab #1', 'makaffo' ),
						'tab_content' => __( 'Our clients’ needs are constantly changing, so we continually seek new and better ways to serve them. To do this, we are bringing new talent into the firm, acquiring new companies.', 'makaffo' ),
					],
					[
						'tab_title' => __( 'Tab #2', 'makaffo' ),
						'tab_content' => __( 'Our clients’ needs are constantly changing, so we continually seek new and better ways to serve them. To do this, we are bringing new talent into the firm, acquiring new companies.', 'makaffo' ),
					],
				],
				'title_field' => '{{{ tab_title }}}',
			]
		);

		$this->end_controls_section();

		/* Style */
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Tabs', 'makaffo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		/* Title */
		$this->add_control(
			'style_title',
			[
				'label' => __( 'Title', 'makaffo' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_responsive_control(
			'title_space',
			[
				'label' => __( 'Spacing', 'makaffo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__link' => 'margin-right: {{SIZE}}{{UNIT}};',
					'(mobile){{WRAPPER}} .ot-tabs__link' => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-right: 0;',
				],
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => __( 'Padding', 'makaffo' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .ot-tabs__link',
			]
		);
		
		$this->start_controls_tabs( 'tabs_title_style' );

		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' => __( 'Normal', 'makaffo' ),
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'makaffo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__link' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'title_bgcolor',
			[
				'label' => __( 'Background', 'makaffo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__link' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_title_active',
			[
				'label' => __( 'Active/Hover', 'makaffo' ),
			]
		);

		$this->add_control(
			'title_color_active',
			[
				'label' => __( 'Color', 'makaffo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__item.current .ot-tabs__link, {{WRAPPER}} .ot-tabs__link:hover' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'title_bg_active',
			[
				'label' => __( 'Background', 'makaffo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__item.current .ot-tabs__link, {{WRAPPER}} .ot-tabs__link:hover' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		/* Icon */
		$this->add_control(
			'style_icon',
			[
				'label' => __( 'Icon', 'makaffo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'icon_spacing',
			[
				'label' => __( 'Spacing', 'makaffo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__link i, {{WRAPPER}} .ot-tabs__link svg' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'makaffo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__link i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ot-tabs__link svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		/* Content */
		$this->add_control(
			'style_content',
			[
				'label' => __( 'Content', 'makaffo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'content_space',
			[
				'label' => __( 'Spacing', 'makaffo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__content-wrap' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => __( 'Color', 'makaffo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-tabs__content' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .ot-tabs__content',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( empty( $settings['ot_tabs'] ) ) {
			return;
		}
		$this->add_render_attribute( 'tabs_wrapper', 'class', [ 'ot-tabs', 'tabs-basic' ] );
		
		?>

		<div <?php $this->print_render_attribute_string( 'tabs_wrapper' ); ?>>
			<?php $random = rand(1,1000); ?>
			<ul class="ot-tabs__heading unstyle dflex">
				<?php $i = 1; foreach ( $settings['ot_tabs'] as $index => $tabs ) :
					$migration_allowed = Icons_Manager::is_migration_allowed();
				?>
				<li class="ot-tabs__item" data-tab="tab-<?php echo esc_attr($i.$random); ?>">
					<?php
						$migrated = isset( $tabs['__fa4_migrated']['selected_icon'] );
						$is_new = ! isset( $tabs['icon'] ) && $migration_allowed;
						if ( ! empty( $tabs['icon'] ) || ( ! empty( $tabs['selected_icon']['value'] ) && $is_new ) ) {
					?>
					<a class="ot-tabs__link tabs-icon">
						<?php
							if ( $is_new || $migrated ) {
								Icons_Manager::render_icon( $tabs['selected_icon'], [ 'aria-hidden' => 'true' ] );
							} else { ?>
								<i class="<?php echo esc_attr( $tabs['icon'] ); ?>" aria-hidden="true"></i>
						<?php } ?>
						<span><?php $this->print_unescaped_setting( 'tab_title', 'ot_tabs', $index );?></span>
					</a>
					<?php }else{ ?>

					<a class="ot-tabs__link"><?php $this->print_unescaped_setting( 'tab_title', 'ot_tabs', $index );?></a>

					<?php } ?>
				</li>
				<?php $i++; endforeach; ?>
			</ul>
			<div class="ot-tabs__content-wrap">
				<?php $j = 1; foreach ( $settings['ot_tabs'] as $index => $tabs ) : ?>
				<div id="tab-<?php echo esc_attr($j.$random); ?>" class="ot-tabs__content">
					<?php $this->print_unescaped_setting( 'tab_content', 'ot_tabs', $index );?>
				</div>
				<?php $j++; endforeach; ?>
			</div>
	    </div>

	    <?php
	}

}
// After the Makaffo_Tabs class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Makaffo_Tabs() );