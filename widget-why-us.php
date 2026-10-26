<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Hoshin_Why_Us_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'hoshin_why_us';
    }

    public function get_title() {
        return esc_html__( 'Hoshin Why Choose Us', 'hoshin-trading' );
    }

    public function get_icon() {
        return 'eicon-info-box';
    }

    public function get_categories() {
        return [ 'hoshin-elements' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_header',
            [
                'label' => esc_html__( 'Section Header', 'hoshin-trading' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Why Choose Hoshin Trading?', 'hoshin-trading' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_features',
            [
                'label' => esc_html__( 'Features & Image', 'hoshin-trading' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'feat1_bold',
            [
                'label' => esc_html__( 'Feature 1 Bold Text', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Specialized Engineering Focus:',
            ]
        );
        $this->add_control(
            'feat1_text',
            [
                'label' => esc_html__( 'Feature 1 Text', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Complete material support spanning MEP, building supplies, and site safety standards.',
            ]
        );

        $this->add_control(
            'feat2_bold',
            [
                'label' => esc_html__( 'Feature 2 Bold Text', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Technical Understanding:',
            ]
        );
        $this->add_control(
            'feat2_text',
            [
                'label' => esc_html__( 'Feature 2 Text', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Sourcing led by specifications, compatibility, and performance requirements.',
            ]
        );

        $this->add_control(
            'center_image',
            [
                'label' => esc_html__( 'Center Specialist Image', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => get_template_directory_uri() . '/assets/images/why-specialist.jpg',
                ],
            ]
        );

        $this->add_control(
            'feat3_bold',
            [
                'label' => esc_html__( 'Feature 3 Bold Text', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Global Sourcing Network:',
            ]
        );
        $this->add_control(
            'feat3_text',
            [
                'label' => esc_html__( 'Feature 3 Text', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Looking beyond conventional channels to find hard-to-source parts.',
            ]
        );

        $this->add_control(
            'feat4_bold',
            [
                'label' => esc_html__( 'Feature 4 Bold Text', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Responsive Service:',
            ]
        );
        $this->add_control(
            'feat4_text',
            [
                'label' => esc_html__( 'Feature 4 Text', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Fast quotation turnarounds and proactive communication.',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $img_url = !empty($settings['center_image']['url']) ? $settings['center_image']['url'] : get_template_directory_uri() . '/assets/images/why-specialist.jpg';
        ?>
        <section id="why-us" class="why-choose-section section-wrap">
          <div class="why-choose-header">
            <h2 class="why-choose-title"><?php echo esc_html( $settings['title'] ); ?></h2>
          </div>

          <div class="why-choose-container">
            <div class="why-feature-col">
              <article class="why-feature-card">
                <div class="why-feature-icon-badge">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                  </svg>
                </div>
                <p class="why-feature-text">
                  <strong class="why-feature-bold"><?php echo esc_html( $settings['feat1_bold'] ); ?></strong> <?php echo esc_html( $settings['feat1_text'] ); ?>
                </p>
              </article>

              <article class="why-feature-card">
                <div class="why-feature-icon-badge">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m12 14 4-4"></path>
                    <path d="M3.34 19a10 10 0 1 1 17.32 0"></path>
                  </svg>
                </div>
                <p class="why-feature-text">
                  <strong class="why-feature-bold"><?php echo esc_html( $settings['feat2_bold'] ); ?></strong> <?php echo esc_html( $settings['feat2_text'] ); ?>
                </p>
              </article>
            </div>

            <div class="why-center-photo-card">
              <img src="<?php echo esc_url( $img_url ); ?>" alt="Hoshin Engineering Materials Specialist" class="why-specialist-img" loading="lazy">
            </div>

            <div class="why-feature-col">
              <article class="why-feature-card">
                <div class="why-feature-icon-badge">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="2" y1="12" x2="22" y2="12"></line>
                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                  </svg>
                </div>
                <p class="why-feature-text">
                  <strong class="why-feature-bold"><?php echo esc_html( $settings['feat3_bold'] ); ?></strong> <?php echo esc_html( $settings['feat3_text'] ); ?>
                </p>
              </article>

              <article class="why-feature-card">
                <div class="why-feature-icon-badge">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                  </svg>
                </div>
                <p class="why-feature-text">
                  <strong class="why-feature-bold"><?php echo esc_html( $settings['feat4_bold'] ); ?></strong> <?php echo esc_html( $settings['feat4_text'] ); ?>
                </p>
              </article>
            </div>
          </div>
        </section>
        <?php
    }
}
