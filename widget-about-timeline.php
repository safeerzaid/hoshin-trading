<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Hoshin_About_Timeline_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'hoshin_about_timeline';
    }

    public function get_title() {
        return esc_html__( 'Hoshin About Timeline', 'hoshin-trading' );
    }

    public function get_icon() {
        return 'eicon-time-line';
    }

    public function get_categories() {
        return [ 'hoshin-elements' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Timeline Header', 'hoshin-trading' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'eyebrow',
            [
                'label' => esc_html__( 'Eyebrow', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'STRATEGIC WORKFLOW', 'hoshin-trading' ),
            ]
        );

        $this->add_control(
            'heading',
            [
                'label' => esc_html__( 'Heading Line 1', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Our Direction', 'hoshin-trading' ),
            ]
        );

        $this->add_control(
            'heading_sub',
            [
                'label' => esc_html__( 'Heading Line 2', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '& Method', 'hoshin-trading' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $s = $this->get_settings_for_display();
        ?>
        <section class="timeline-ref-section section-wrap" id="methodology">
          <div class="timeline-ref-grid">
            <div class="timeline-sticky-left">
              <span class="timeline-ref-eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></span>
              <h2 class="timeline-ref-heading">
                <?php echo esc_html( $s['heading'] ); ?><br>
                <?php echo esc_html( $s['heading_sub'] ); ?>
              </h2>
            </div>

            <div class="timeline-steps-col">
              <div class="timeline-track-line">
                <div class="timeline-progress-fill" id="timelineProgressFill"></div>
              </div>

              <!-- Step 1 -->
              <div class="timeline-step-item active" data-step="1">
                <div class="timeline-icon-box">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="m9 12 2 2 4-4"></path>
                  </svg>
                </div>
                <div class="timeline-content-card">
                  <span class="timeline-step-pill">01 &bull; Requirement</span>
                  <h3 class="timeline-step-title">Understand Requirement</h3>
                  <p class="timeline-step-desc">
                    Review engineering specifications, equipment datasheets, facility parameters, and project delivery schedules with meticulous precision.
                  </p>
                </div>
              </div>

              <!-- Step 2 -->
              <div class="timeline-step-item" data-step="2">
                <div class="timeline-icon-box">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.35-4.35"></path>
                  </svg>
                </div>
                <div class="timeline-content-card">
                  <span class="timeline-step-pill">02 &bull; Identification</span>
                  <h3 class="timeline-step-title">Find Right Product</h3>
                  <p class="timeline-step-desc">
                    Identify compliant OEM materials or certified technical equivalents that strictly fulfill Qatar project standards and application tolerances.
                  </p>
                </div>
              </div>

              <!-- Step 3 -->
              <div class="timeline-step-item" data-step="3">
                <div class="timeline-icon-box">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="2" y1="12" x2="22" y2="12"></line>
                    <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                  </svg>
                </div>
                <div class="timeline-content-card">
                  <span class="timeline-step-pill">03 &bull; Global Sourcing</span>
                  <h3 class="timeline-step-title">Source Globally</h3>
                  <p class="timeline-step-desc">
                    Tap into audited global manufacturing partners and regional stock channels to overcome supply chain shortages and lead-time constraints.
                  </p>
                </div>
              </div>

              <!-- Step 4 -->
              <div class="timeline-step-item" data-step="4">
                <div class="timeline-icon-box">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="1" y="3" width="15" height="13" rx="2"></rect>
                    <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                    <circle cx="5.5" cy="18.5" r="2.5"></circle>
                    <circle cx="18.5" cy="18.5" r="2.5"></circle>
                  </svg>
                </div>
                <div class="timeline-content-card">
                  <span class="timeline-step-pill">04 &bull; Reliable Logistics</span>
                  <h3 class="timeline-step-title">Supply Reliably</h3>
                  <p class="timeline-step-desc">
                    Coordinate quality assurance inspections, customs clearance, and direct expedited delivery straight to your site or facility.
                  </p>
                </div>
              </div>

              <!-- Step 5 -->
              <div class="timeline-step-item" data-step="5">
                <div class="timeline-icon-box">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                  </svg>
                </div>
                <div class="timeline-content-card">
                  <span class="timeline-step-pill">05 &bull; Long-Term Trust</span>
                  <h3 class="timeline-step-title">Build Partnerships</h3>
                  <p class="timeline-step-desc">
                    Foster enduring commercial partnerships founded on technical trust, proactive follow-through, and dedicated post-supply support.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </section>
        <?php
    }
}