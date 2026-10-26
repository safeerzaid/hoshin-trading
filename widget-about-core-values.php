<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Hoshin_About_Core_Values_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'hoshin_about_core_values';
    }

    public function get_title() {
        return esc_html__( 'Hoshin Core Values', 'hoshin-trading' );
    }

    public function get_icon() {
        return 'eicon-star-o';
    }

    public function get_categories() {
        return [ 'hoshin-elements' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
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
                'default' => esc_html__( 'Our Core Values', 'hoshin-trading' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $s = $this->get_settings_for_display();
        ?>
        <section class="core-values-section section-wrap">
          <div class="core-values-container">
            <div class="core-values-header-row">
              <h2 class="core-values-title"><?php echo esc_html( $s['title'] ); ?></h2>
            </div>

            <div class="core-values-grid">
              <article class="core-value-card">
                <div class="core-value-top-row">
                  <span class="core-value-num">01</span>
                  <div class="core-value-icon-badge">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                  </div>
                </div>
                <div class="core-value-body">
                  <h3 class="core-value-heading">Quality</h3>
                  <p class="core-value-text">Sourcing products strictly matched to application requirements and safety compliance standards.</p>
                </div>
              </article>

              <article class="core-value-card">
                <div class="core-value-top-row">
                  <span class="core-value-num">02</span>
                  <div class="core-value-icon-badge">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                  </div>
                </div>
                <div class="core-value-body">
                  <h3 class="core-value-heading">Reliability</h3>
                  <p class="core-value-text">Responsible sourcing, transparent communication, and consistent fulfillment.</p>
                </div>
              </article>

              <article class="core-value-card">
                <div class="core-value-top-row">
                  <span class="core-value-num">03</span>
                  <div class="core-value-icon-badge">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                  </div>
                </div>
                <div class="core-value-body">
                  <h3 class="core-value-heading">Technical Understanding</h3>
                  <p class="core-value-text">Analyzing specifications, compatibility, and system performance.</p>
                </div>
              </article>

              <article class="core-value-card">
                <div class="core-value-top-row">
                  <span class="core-value-num">04</span>
                  <div class="core-value-icon-badge">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                  </div>
                </div>
                <div class="core-value-body">
                  <h3 class="core-value-heading">Global Sourcing</h3>
                  <p class="core-value-text">Accessing global supply networks to solve local material challenges.</p>
                </div>
              </article>

              <article class="core-value-card">
                <div class="core-value-top-row">
                  <span class="core-value-num">05</span>
                  <div class="core-value-icon-badge">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                  </div>
                </div>
                <div class="core-value-body">
                  <h3 class="core-value-heading">Responsiveness</h3>
                  <p class="core-value-text">Timely support on enquiries, product details, and logistics coordination.</p>
                </div>
              </article>

              <article class="core-value-card">
                <div class="core-value-top-row">
                  <span class="core-value-num">06</span>
                  <div class="core-value-icon-badge">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                  </div>
                </div>
                <div class="core-value-body">
                  <h3 class="core-value-heading">Partnership</h3>
                  <p class="core-value-text">Long-term collaborative relationships built on trust and mutual growth.</p>
                </div>
              </article>
            </div>
          </div>
        </section>
        <?php
    }
}