<?php
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Section Progress Bars 
 */
class Makaffo_Progress_Bars extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-progress';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Progress Bars', 'makaffo' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-skill-bar';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_makaffo' ];
	}

	protected function register_controls() {

		//Content Progress Bars
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'makaffo' ),
			]
		);

		$this->add_control(
			'bar_style',
			[
				'label' 	=> __( 'Bar Style', 'makaffo' ),
				'type'  	=> Controls_Manager::SELECT,
				'default' 	=> 'line',
				'options' 	=> [
					'line'    => __( 'Style 1: Line', 'makaffo' ),
					'circle'  => __( 'Style 2: Circle', 'makaffo' ),
				]
			]
		);

		$this->add_control(
			'title',
			[
				'label' => 'Title',
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Advertising', 'makaffo' ),
			]
		);
		$this->add_control(
			'header_size',
			[
				'label' => __( 'Title HTML Tag', 'makaffo' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'p' => 'p',
				],
				'default' => 'h5',
			]
		);
		
		$this->add_control(
			'percent',
			[
				'label'   => esc_html__( 'Percentage', 'makaffo' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 70,
					'unit' => '%',
				],
			]
		);
		$this->add_control(
			'percent_text',
			[
				'label'   => esc_html__( 'Show Percentage', 'makaffo' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		// Style
		$this->start_controls_section(
			'bar_style_section',
			[
				'label' => __( 'Progress Bar', 'makaffo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'progress_space',
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
					'{{WRAPPER}} .ot-progress-line__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'bar_style' => 'line',
				],
			]
		);
		
		$this->add_control(
			'bar_color_line',
			[
				'label' => __( 'Primary Color', 'makaffo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-progress-bar' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'bar_style' => 'line',
				],
			]
		);
		$this->add_control(
			'bar_color_circle',
			[
				'label' => __( 'Primary Color', 'makaffo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#0855f0',
				'condition' => [
					'bar_style' => 'circle',
				],
			]
		);
		$this->add_control(
			'bar_second_color',
			[
				'label' => __( 'Second Color', 'makaffo' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-progress-line__inner' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .ot-progress-circle__inner:after' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'bar_height_line',
			[
				'label' => __( 'Height', 'makaffo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-progress-line__inner' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'bar_style' => 'line',
				]
			]
		);

		$this->add_responsive_control(
			'bar_height',
			[
				'label' => __( 'Progress Border Width', 'makaffo' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 12,
				],
				'condition' => [
					'bar_style' => 'circle',
				]
			]
		);
		$this->add_responsive_control(
			'bar_size',
			[
				'label' => __( 'Circle Size', 'makaffo' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default' => [
					'size' => 230,
				],
				'condition' => [
					'bar_style' => 'circle',
				]
			]
		);

		$this->add_responsive_control(
			'progress_space_circle',
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
					'{{WRAPPER}} .ot-progress-circle__inner:after' => 'width: calc(100% - {{SIZE}}{{UNIT}}); height: calc(100% - {{SIZE}}{{UNIT}}); top: calc({{SIZE}}{{UNIT}} / 2); left: calc({{SIZE}}{{UNIT}} / 2);',
				],
				'condition' => [
					'bar_style' => 'circle',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_text_section',
			[
				'label' => __( 'Text', 'makaffo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//Title
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'makaffo' ),
				'type' => Controls_Manager::HEADING,
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => __( 'Color', 'makaffo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-progress-circle .ot-progress-title,
					 {{WRAPPER}} .ot-progress-line__title .ot-progress-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .ot-progress-circle__content .ot-progress-title, {{WRAPPER}} .ot-progress-line__title .ot-progress-title',
			]
		);

		//Percentage
		$this->add_control(
			'heading_percent',
			[
				'label' => __( 'Percentage', 'makaffo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'per_color',
			[
				'label' => __( 'Color', 'makaffo' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ot-progress-line__title .ot-progress-percent, 
					 {{WRAPPER}} .ot-progress-circle .ot-progress-percent' => 'color: {{VALUE}};',
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'per_typography',
				'selector' => '{{WRAPPER}} .ot-progress-percent',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'heading', 'class', ['ot-progress-title'] );
		$title = $settings['title'];
		$title_html = sprintf( '<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string( 'heading' ), $title );
		?>

		<?php if( $settings['bar_style'] == 'line' ) { ?>
		<div class="ot-progress-line" data-percent="<?php echo esc_attr( $settings['percent']['size'] ); ?>">
			<div class="ot-progress-line__title">
	        	<?php if( $settings['title'] ) { echo $title_html; } ?>
	        	<?php if( $settings['percent_text'] ) echo '<span class="ot-progress-percent f-right"></span>'; ?>
	        </div>
	        <div class="ot-progress-line__inner">
				<div class="ot-progress-bar"></div>
			</div>
	    </div>
		<?php }else{ ?>
		<div class="ot-progress-circle" data-color="<?php echo esc_attr( $settings['bar_color_circle'] ); ?>" data-height="<?php echo esc_attr( $settings['bar_height']['size'] ); ?>" data-size="<?php echo esc_attr( $settings['bar_size']['size'] ); ?>">
			<div class="ot-progress-circle__inner" data-percent="<?php echo esc_attr( $settings['percent']['size'] ); ?>">
				<div class="ot-progress-circle__content">
					<?php if( $settings['percent_text'] ) echo '<span class="ot-progress-percent">' . $settings['percent']['size'] . '</span>'; ?>
				</div>
			</div>
			<?php if( $settings['title'] ) { echo $title_html; } ?>
		</div>
		
	    <?php }
	}

}
// After the Makaffo_Progress_Bars class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Makaffo_Progress_Bars() );