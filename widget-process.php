<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Hoshin_Process_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'hoshin_process';
    }

    public function get_title() {
        return esc_html__( 'Hoshin Sourcing Process', 'hoshin-trading' );
    }

    public function get_icon() {
        return 'eicon-number-field';
    }

    public function get_categories() {
        return [ 'hoshin-elements' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_header',
            [
                'label' => esc_html__( 'Header', 'hoshin-trading' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'eyebrow',
            [
                'label' => esc_html__( 'Eyebrow', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'HOW WE WORK', 'hoshin-trading' ),
            ]
        );

        $this->add_control(
            'heading_line1',
            [
                'label' => esc_html__( 'Heading Line 1', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'From requirement to delivery,', 'hoshin-trading' ),
            ]
        );

        $this->add_control(
            'heading_line2',
            [
                'label' => esc_html__( 'Heading Sub (Gray)', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'step by step', 'hoshin-trading' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_steps',
            [
                'label' => esc_html__( 'Process Steps', 'hoshin-trading' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'step_num',
            [
                'label' => esc_html__( 'Step Number', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '01.',
            ]
        );

        $repeater->add_control(
            'step_title',
            [
                'label' => esc_html__( 'Step Title', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Understand', 'hoshin-trading' ),
            ]
        );

        $repeater->add_control(
            'step_text',
            [
                'label' => esc_html__( 'Step Text', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Review specifications, equipment, and delivery timelines.', 'hoshin-trading' ),
            ]
        );

        $this->add_control(
            'steps',
            [
                'label' => esc_html__( 'Steps List', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'step_num' => '01.',
                        'step_title' => 'Understand',
                        'step_text' => 'Review specifications, equipment, and delivery timelines.',
                    ],
                    [
                        'step_num' => '02.',
                        'step_title' => 'Identify',
                        'step_text' => 'Find suitable products and supply channels.',
                    ],
                    [
                        'step_num' => '03.',
                        'step_title' => 'Verify',
                        'step_text' => 'Check technical compatibility and specs.',
                    ],
                    [
                        'step_num' => '04.',
                        'step_title' => 'Quote',
                        'step_text' => 'Deliver commercial options.',
                    ],
                    [
                        'step_num' => '05.',
                        'step_title' => 'Procure',
                        'step_text' => 'Manage procurement and logistics.',
                    ],
                    [
                        'step_num' => '06.',
                        'step_title' => 'Deliver',
                        'step_text' => 'Efficient and responsible supply directly to your site or facility.',
                    ],
                ],
                'title_field' => '{{{ step_num }}} {{{ step_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section id="process" class="process-ref-section section-wrap">
          <div class="process-ref-grid">
            <div class="process-ref-left">
              <span class="process-ref-eyebrow"><?php echo esc_html( $settings['eyebrow'] ); ?></span>
              <h2 class="process-ref-heading">
                <?php echo esc_html( $settings['heading_line1'] ); ?><br>
                <span class="heading-gray"><?php echo esc_html( $settings['heading_line2'] ); ?></span>
              </h2>
            </div>

            <div class="process-ref-right">
              <?php foreach ( $settings['steps'] as $item ) : ?>
                <article class="process-ref-item">
                  <span class="process-ref-num"><?php echo esc_html( $item['step_num'] ); ?></span>
                  <div class="process-ref-body">
                    <h3 class="process-ref-title"><?php echo esc_html( $item['step_title'] ); ?></h3>
                    <p class="process-ref-text"><?php echo esc_html( $item['step_text'] ); ?></p>
                  </div>
                </article>
              <?php endforeach; ?>
            </div>
          </div>
        </section>
        <?php
    }
}
