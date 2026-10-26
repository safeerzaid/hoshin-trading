<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Hoshin_About_Editorial_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'hoshin_about_editorial';
    }

    public function get_title() {
        return esc_html__( 'Hoshin About Company Profile', 'hoshin-trading' );
    }

    public function get_icon() {
        return 'eicon-text';
    }

    public function get_categories() {
        return [ 'hoshin-elements' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'editorial_section',
            [
                'label' => esc_html__( 'Profile Content', 'hoshin-trading' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'eyebrow',
            [
                'label' => esc_html__( 'Eyebrow', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'COMPANY PROFILE', 'hoshin-trading' ),
            ]
        );

        $this->add_control(
            'lead_text',
            [
                'label' => esc_html__( 'Lead Statement', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Hoshin Trading provides a wide range of engineering components for construction, MEP projects, maintenance, repair, replacement, and facility management requirements.', 'hoshin-trading' ),
            ]
        );

        $this->add_control(
            'sub_text',
            [
                'label' => esc_html__( 'Supporting Paragraph', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'The name Hoshin signifies strategic direction. We believe every technical requirement needs clear direction—from identifying a single replacement spare part to coordinating complex multi-category material lists.', 'hoshin-trading' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $s = $this->get_settings_for_display();
        ?>
        <section class="about-editorial-section section-wrap">
          <div class="about-overview-grid">
            <!-- Left Side: Subtitle / Eyebrow -->
            <div class="about-label-col">
              <span class="about-editorial-eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></span>
            </div>

            <!-- Right Side: Statement Paragraphs -->
            <div class="about-statement-col">
              <p class="about-statement-lead">
                <?php echo esc_html( $s['lead_text'] ); ?>
              </p>
              <p class="about-statement-sub">
                <?php echo esc_html( $s['sub_text'] ); ?>
              </p>
            </div>
          </div>
        </section>
        <?php
    }
}
