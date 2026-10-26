<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Hoshin_About_Vision_Mission_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'hoshin_about_vision_mission';
    }

    public function get_title() {
        return esc_html__( 'Hoshin Vision & Mission', 'hoshin-trading' );
    }

    public function get_icon() {
        return 'eicon-columns';
    }

    public function get_categories() {
        return [ 'hoshin-elements' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'vision_section',
            [
                'label' => esc_html__( 'Vision Card', 'hoshin-trading' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'vision_title',
            [
                'label' => esc_html__( 'Vision Title', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Our Vision', 'hoshin-trading' ),
            ]
        );

        $this->add_control(
            'vision_text',
            [
                'label' => esc_html__( 'Vision Description', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'To be a trusted and preferred source for engineering materials and building-system components in Qatar and beyond. We aim to build a supply network that makes procurement simpler, faster, and more dependable.', 'hoshin-trading' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'mission_section',
            [
                'label' => esc_html__( 'Mission Card', 'hoshin-trading' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'mission_title',
            [
                'label' => esc_html__( 'Mission Title', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Our Mission', 'hoshin-trading' ),
            ]
        );

        $this->add_control(
            'mission_text',
            [
                'label' => esc_html__( 'Mission Description', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'To connect customers with the right engineering materials through global sourcing, product knowledge, reliable supply, and professional service.', 'hoshin-trading' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $s = $this->get_settings_for_display();
        ?>
        <section class="vision-mission-section section-wrap">
          <div class="vision-mission-grid">
            <!-- Vision Card -->
            <article class="vm-card">
              <div class="vm-card-topbar">
                <div class="vm-icon-badge">
                  <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <circle cx="12" cy="12" r="6"></circle>
                    <circle cx="12" cy="12" r="2"></circle>
                  </svg>
                </div>
                <span class="vm-card-num">01</span>
              </div>
              <div class="vm-card-content">
                <h3 class="vm-card-title"><?php echo esc_html( $s['vision_title'] ); ?></h3>
                <p class="vm-card-desc">
                  <?php echo esc_html( $s['vision_text'] ); ?>
                </p>
              </div>
            </article>

            <!-- Mission Card -->
            <article class="vm-card">
              <div class="vm-card-topbar">
                <div class="vm-icon-badge">
                  <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                  </svg>
                </div>
                <span class="vm-card-num">02</span>
              </div>
              <div class="vm-card-content">
                <h3 class="vm-card-title"><?php echo esc_html( $s['mission_title'] ); ?></h3>
                <p class="vm-card-desc">
                  <?php echo esc_html( $s['mission_text'] ); ?>
                </p>
              </div>
            </article>
          </div>
        </section>
        <?php
    }
}
