<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Hoshin_CTA_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'hoshin_cta';
    }

    public function get_title() {
        return esc_html__( 'Hoshin Call To Action Band', 'hoshin-trading' );
    }

    public function get_icon() {
        return 'eicon-call-to-action';
    }

    public function get_categories() {
        return [ 'hoshin-elements' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'CTA Content', 'hoshin-trading' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'eyebrow',
            [
                'label' => esc_html__( 'Eyebrow', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'PRIMARY CALL TO ACTION', 'hoshin-trading' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Need a hard-to-find part or managing a project schedule?', 'hoshin-trading' ),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__( 'Description', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'We help keep your projects, facilities, and maintenance operations moving forward.', 'hoshin-trading' ),
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__( 'Button Text', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Contact Our Sourcing Team', 'hoshin-trading' ),
            ]
        );

        $this->add_control(
            'btn_link',
            [
                'label' => esc_html__( 'Button Link', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '/contact/',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section class="cta-primary-band">
          <div class="section-wrap cta-primary-wrap">
            <div class="cta-primary-card">
              <div class="cta-primary-content">
                <span class="cta-primary-eyebrow"><?php echo esc_html( $settings['eyebrow'] ); ?></span>
                <h2 class="cta-primary-title"><?php echo esc_html( $settings['title'] ); ?></h2>
                <p class="cta-primary-desc">
                  <?php echo esc_html( $settings['description'] ); ?>
                </p>
              </div>
              <div class="cta-primary-action">
                <a href="<?php echo esc_url( $settings['btn_link']['url'] ); ?>" class="cta-primary-btn">
                  <span><?php echo esc_html( $settings['btn_text'] ); ?></span>
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M7 7h10v10"></path>
                    <path d="M7 17 17 7"></path>
                  </svg>
                </a>
              </div>
            </div>
          </div>
        </section>
        <?php
    }
}
