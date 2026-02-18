<?php 
namespace Elementor; // Custom widgets must be defined in the Elementor namespace
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly (security measure)

/**
 * Widget Name: Team
 */
class Makaffo_Team extends Widget_Base{

 	// The get_name() method is a simple one, you just need to return a widget name that will be used in the code.
	public function get_name() {
		return 'ot-team';
	}

	// The get_title() method, which again, is a very simple one, you need to return the widget title that will be displayed as the widget label.
	public function get_title() {
		return __( 'OT Team', 'makaffo' );
	}

	// The get_icon() method, is an optional but recommended method, it lets you set the widget icon. you can use any of the eicon or font-awesome icons, simply return the class name as a string.
	public function get_icon() {
		return 'eicon-person';
	}

	// The get_categories method, lets you set the category of the widget, return the category name as a string.
	public function get_categories() {
		return [ 'category_makaffo' ];
	}

	protected function register_controls() {

		/**TAB_CONTENT**/
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Member Team', 'makaffo' ),
			]
		);

		$this->add_control(
			'team_type',
			[
				'label' => __( 'Type', 'makaffo' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-1' => __( 'Style 1', 'makaffo' ),
					'style-2' => __( 'Style 2', 'makaffo' ),
				],
				'default' => 'style-1',
			]
		);

		$this->add_control(
	        'member_image',
	        [
	            'label' => esc_html__( 'Photo', 'makaffo' ),
	            'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
		    ]
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'member_image_size',
				'exclude' => ['1536x1536', '2048x2048'],
				'include' => [],
				'default' => 'full',
			]
		);

	    $this->add_control(
		    'member_name',
	      	[
	          	'label' => esc_html__( 'Name', 'makaffo' ),
	          	'type'  => Controls_Manager::TEXT,
				'default' => esc_html__( 'Peter Perish', 'makaffo' ),
	    	]
	    );

	    $this->add_control(
		    'member_extra',
	      	[
	          	'label' => esc_html__( 'Extra/Job', 'makaffo' ),
	          	'type'  => Controls_Manager::TEXTAREA,
	          	'default' => esc_html__( 'co-founder of company', 'makaffo' ),
	    	]
	    );

	    $this->add_control(
		    'member_desc',
	      	[
	          	'label' => esc_html__( 'Description', 'makaffo' ),
	          	'type'  => Controls_Manager::TEXTAREA,
	          	'default' => '',
	    	]
	    );
	    $repeater = new Repeater();
		$repeater->add_control(
	      	'title',
		    [
		        'label'   => esc_html__( 'Name', 'makaffo' ),
		        'type'    => Controls_Manager::TEXT,
		        'default' => esc_html__( 'Social', 'makaffo' ),
		    ]
	    );

        $repeater->add_control(
            'social_icon',
            [
                'label' => esc_html__( 'Icon', 'makaffo' ),
                'type'  => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fab fa-twitter',
					'library' => 'fa-brand',
				],
            ]
        );
        $repeater->add_control(
			'item_icon_color',
			[
				'label' => esc_html__( 'Color', 'makaffo' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-social {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
				],
			]
		);

        $repeater->add_control(
            'social_link',
            [
                'label' => esc_html__( 'Link', 'makaffo' ),
                'type'  => Controls_Manager::URL,
                'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'your-link.com', 'makaffo' ),
				'default' => [
					'url' => '#', 
				],
            ]
		);

		$this->add_control(
		    'social_share',
		    [
		        'label'       => esc_html__( 'Socials', 'makaffo' ),
		        'type'        => Controls_Manager::REPEATER,
		        'show_label'  => true,
		        'default'     => [
		            [
		             	'title'       => esc_html__( 'Facebook', 'makaffo' ),
		                'social_link' => [
		                	'url' => '#', 
		                ],
		                'social_icon' => [
							'value' => 'fab fa-facebook-f',
							'library' => 'fa-brand',
						],
		 
		            ],
		            [
		             	'title'       => esc_html__( 'Instagram', 'makaffo' ),
		                'social_link' => [
		                	'url' => '#', 
		                ],
		                'social_icon' => [
							'value' => 'fab fa-instagram',
							'library' => 'fa-brand',
						],
		 
		            ],
		            [
		             	'title'       => esc_html__( 'Linkedin', 'makaffo' ),
		                'social_link' => [
		                	'url' => '#', 
		                ],
		                'social_icon' => [
							'value' => 'fab fa-linkedin-in',
							'library' => 'fa-brand',
						],

		            ]
		        ],
		        'fields'      => $repeater->get_controls(),
		        'title_field' => '{{{title}}}',
		    ]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link To Details', 'makaffo' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://', 'makaffo' ),
			]
		);

		$this->end_controls_section();

		/**TAB_STYLE**/

		$this->start_controls_section(
			'photo_style',
			[
				'label' => esc_html__( 'General', 'makaffo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'team_padding',
			[
				'label' => __( 'Info Padding', 'makaffo' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-team__info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'team_border_radius',
			[
				'label' => __( 'Border Radius', 'makaffo' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .ot-team__inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .ot-team__info' => 'border-top-right-radius: {{RIGHT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'team_bgcolor',
			[
				'label'     => esc_html__( 'Background', 'makaffo' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-team__info' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'info_style',
			[
				'label' => esc_html__( 'Info Box', 'makaffo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		/* title */
		$this->add_control(
			'heading_title',
			[
				'label' => __( 'Title', 'makaffo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'title_space',
			[
				'label' => esc_html__( 'Spacing', 'makaffo' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tname' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'makaffo' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tname,
					 {{WRAPPER}} .tname a,
					 {{WRAPPER}} .style-2 .ot-team__info:after' => 'color: {{VALUE}};',
					'{{WRAPPER}} .ot-team__info' => 'border-left-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_hcolor',
			[
				'label'     => esc_html__( 'Hover', 'makaffo' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tname a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'link[url]!'  => ''
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'makaffo' ),
				'selector' => '{{WRAPPER}} .tname',
			]
		);

		/* extra */
		$this->add_control(
			'heading_job',
			[
				'label' => __( 'Extra/Job', 'makaffo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'job_space',
			[
				'label' => esc_html__( 'Spacing', 'makaffo' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tjob' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'job_color',
			[
				'label'     => esc_html__( 'Color', 'makaffo' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tjob' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'job_typography',
				'label'    => esc_html__( 'Typography', 'makaffo' ),
				'selector' => '{{WRAPPER}} .tjob',
			]
		);

		/* description */
		$this->add_control(
			'heading_desc',
			[
				'label' => __( 'Description', 'makaffo' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition'	=> [
					'member_desc!' => ''
				]
			]
		);
		$this->add_responsive_control(
			'desc_space',
			[
				'label' => esc_html__( 'Spacing', 'makaffo' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ot-team__info p' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'	=> [
					'member_desc!' => ''
				]
			]
		);
		$this->add_control(
			'desc_color',
			[
				'label'     => esc_html__( 'Color', 'makaffo' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ot-team__info p' => 'color: {{VALUE}};',
				],
				'condition'	=> [
					'member_desc!' => ''
				]
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'desc_typography',
				'label'    => esc_html__( 'Typography', 'makaffo' ),
				'selector' => '{{WRAPPER}} .ot-team__info p',
				'condition'	=> [
					'member_desc!' => ''
				]
			]
		);

		$this->end_controls_section();

		/* Socials */
		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__( 'Socials', 'makaffo' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_social_space',
			[
				'label' => esc_html__( 'Spacing', 'makaffo' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .team-social a:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_social_size',
			[
				'label' => esc_html__( 'Size', 'makaffo' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 30,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .team-social a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_social_color',
			[
				'label'     => esc_html__( 'Color', 'makaffo' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-social a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .team-social a svg' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_hover_color',
			[
				'label'     => esc_html__( 'Hover', 'makaffo' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .team-social a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .team-social a:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$image_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'member_image_size', 'member_image' );
		$tname = $settings['member_name'];

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'm_link', $settings['link'] );
			$tname = '<a ' .$this->get_render_attribute_string( 'm_link' ). '>' .$tname. '<i class="ot-flaticon-top-right"></i></a>';
		}

		$this->add_render_attribute( 'team-box', 'class', 'ot-team '. $settings['team_type'] );
		?>

		<div <?php $this->print_render_attribute_string( 'team-box' ); ?>>
			<div class="ot-team__inner">
				<?php if( $settings['member_image']['url'] ) { ?>
				<figure class="ot-team__thumb">
					<?php echo wp_kses_post( $image_html ); ?>
				</figure>
				<?php } ?>
				<div class="ot-team__info">
					<h5 class="tname"><?php echo wp_kses_post( $tname ); ?></h5>
					<div class="tjob"><?php $this->print_unescaped_setting( 'member_extra' ) ?></div>
					<?php if ( $settings['member_desc'] ) { echo '<p>' . wp_kses_post( $settings['member_desc'] ) . '</p>'; } ?>

					<?php if ( ! empty( $settings['social_share'] ) ) : ?>
					<div class="team-social">
						<?php foreach ( $settings['social_share'] as $key => $social ) : ?>
							<?php 
								$link_key = 'link_' . $key;
								$this->add_render_attribute( $link_key, 'class', [
									strtolower( $social['title'] ),
									'elementor-repeater-item-' . $social['_id'],
								] );
								$this->add_link_attributes( $link_key, $social['social_link'] );
							?>
							<a <?php $this->print_render_attribute_string( $link_key ); ?>>
								<?php Icons_Manager::render_icon( $social['social_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</a>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	        
	    <?php
	}

}
// After the Makaffo_Team class is defined, I must register the new widget class with Elementor:
Plugin::instance()->widgets_manager->register( new Makaffo_Team() );