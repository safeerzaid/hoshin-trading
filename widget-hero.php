<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Hoshin_Hero_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'hoshin_hero';
    }

    public function get_title() {
        return esc_html__( 'Denmar Architectural Hero', 'hoshin-trading' );
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_categories() {
        return [ 'hoshin-elements' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Hero Content', 'hoshin-trading' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'hero_image',
            [
                'label' => esc_html__( 'Hero Background Image', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => get_template_directory_uri() . '/assets/images/hero-thumb.jpg',
                ],
            ]
        );

        $this->add_control(
            'title_main',
            [
                'label' => esc_html__( 'Main Headline (Line 1)', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Global Sourcing.', 'hoshin-trading' ),
            ]
        );

        $this->add_control(
            'title_sub',
            [
                'label' => esc_html__( 'Main Headline (Line 2)', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'The Way Forward.', 'hoshin-trading' ),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__( 'Lead Description', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Specialized engineering materials and supply solutions for HVAC, Electrical, Plumbing, Building Materials, and Safety Equipment. Sourced Globally. Supplied Reliably.', 'hoshin-trading' ),
            ]
        );

        $this->add_control(
            'btn_primary_text',
            [
                'label' => esc_html__( 'Primary Button Text', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Explore Product Catalog', 'hoshin-trading' ),
            ]
        );

        $this->add_control(
            'btn_primary_link',
            [
                'label' => esc_html__( 'Primary Button Link', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '/products/',
                ],
            ]
        );

        $this->add_control(
            'btn_ghost_text',
            [
                'label' => esc_html__( 'Secondary Button Text', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Submit an Enquiry', 'hoshin-trading' ),
            ]
        );

        $this->add_control(
            'btn_ghost_link',
            [
                'label' => esc_html__( 'Secondary Button Link', 'hoshin-trading' ),
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
        $img_url = !empty($settings['hero_image']['url']) ? $settings['hero_image']['url'] : get_template_directory_uri() . '/assets/images/hero-thumb.jpg';
        ?>
        <section id="home" class="denmar-hero-section">
          <div class="denmar-hero-stage">
            <!-- Main Architectural Image Frame (Rounded Outer Container) -->
            <div class="denmar-hero-canvas">
              <!-- Background Image: Glass Architectural Facade from User's Second Image -->
              <img class="denmar-hero-img" src="<?php echo esc_url( $img_url ); ?>" alt="Hoshin Engineering Supply Architecture" fetchpriority="high" loading="eager">
              <div class="denmar-hero-overlay" aria-hidden="true"></div>

              <!-- Top-Left Large Clean Typography Headline (matching reference) -->
              <div class="denmar-hero-headline-wrap">
                <h1 class="denmar-hero-headline">
                  <?php echo esc_html( $settings['title_main'] ); ?><br>
                  <?php echo esc_html( $settings['title_sub'] ); ?>
                </h1>
              </div>

              <!-- Bottom-Left Minimal Scroll Down Cue -->
              <a href="#about" class="denmar-scroll-down" aria-label="Scroll down to company overview">
                <span class="scroll-icon-circle">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                  </svg>
                </span>
                <span class="scroll-text"><?php echo esc_html__( 'Scroll down', 'hoshin-trading' ); ?></span>
              </a>
            </div>

            <!-- Inset Bottom-Right Blue Content Card (Cut-out matching reference) -->
            <div class="denmar-inset-card">
              <p class="denmar-inset-desc">
                <?php echo esc_html( $settings['description'] ); ?>
              </p>
              
              <div class="denmar-inset-actions">
                <a class="denmar-pill-btn" href="<?php echo esc_url( $settings['btn_primary_link']['url'] ); ?>">
                  <span><?php echo esc_html( $settings['btn_primary_text'] ); ?></span>
                  <span class="pill-arrow-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                      <line x1="5" y1="12" x2="19" y2="12"></line>
                      <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                  </span>
                </a>

                <a class="denmar-ghost-btn" href="<?php echo esc_url( $settings['btn_ghost_link']['url'] ); ?>">
                  <span><?php echo esc_html( $settings['btn_ghost_text'] ); ?></span>
                </a>
              </div>
            </div>
          </div>
        </section>
        <?php
    }
}
