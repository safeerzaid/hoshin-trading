<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Hoshin_Overview_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'hoshin_overview';
    }

    public function get_title() {
        return esc_html__( 'Hoshin Overview Split', 'hoshin-trading' );
    }

    public function get_icon() {
        return 'eicon-columns';
    }

    public function get_categories() {
        return [ 'hoshin-elements' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Overview Content', 'hoshin-trading' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'lead_title',
            [
                'label' => esc_html__( 'Heading Title', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Connecting Requirements with the Right Direction', 'hoshin-trading' ),
            ]
        );

        $this->add_control(
            'statement_text',
            [
                'label' => esc_html__( 'Statement Text', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Hoshin Trading is a specialized engineering materials trading and sourcing company serving the growing needs of Qatar\'s construction, MEP, facility management, and maintenance sectors. We go beyond simply supplying off-the-shelf items—we analyze your technical requirements, identify compatible products, and leverage global supply chains to deliver reliable procurement solutions.', 'hoshin-trading' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <section id="about" class="about-overview-section section-wrap">
          <div class="about-overview-grid">
            <div class="about-label-col">
              <h2 class="about-lead-title"><?php 
      $lt = $settings['lead_title'];
      if ( $lt === 'Connecting Requirements with the Right Direction' ) {
          echo 'Connecting Requirements<br>with the Right Direction';
      } else {
          echo nl2br( esc_html( $lt ) );
      }
    ?></h2>
            </div>
            <div class="about-statement-col">
              <p class="about-statement-text">
                <?php echo esc_html( $settings['statement_text'] ); ?>
              </p>
            </div>
          </div>
        </section>
        <?php
    }
}
