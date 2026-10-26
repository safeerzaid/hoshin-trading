<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Hoshin_RFQ_Section_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'hoshin_rfq_section';
    }

    public function get_title() {
        return esc_html__( 'Hoshin RFQ Multi-Step Form', 'hoshin-trading' );
    }

    public function get_icon() {
        return 'eicon-form-vertical';
    }

    public function get_categories() {
        return [ 'hoshin-elements' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'RFQ Header', 'hoshin-trading' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Request a Quotation', 'hoshin-trading' ),
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__( 'Subtitle', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Review your selected items, provide project details and delivery schedule, and submit your official RFQ for engineering evaluation.', 'hoshin-trading' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $s = $this->get_settings_for_display();
        ?>
        <section class="page-hero">
          <div class="container">
            <nav class="breadcrumb" aria-label="Breadcrumb">
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
              <span class="breadcrumb-separator">/</span>
              <a href="<?php echo esc_url( home_url( '/products/' ) ); ?>">Products</a>
              <span class="breadcrumb-separator">/</span>
              <span class="breadcrumb-current">Request a Quotation</span>
            </nav>

            <h1 class="page-hero-title"><?php echo esc_html( $s['title'] ); ?></h1>
            <p class="page-hero-sub"><?php echo esc_html( $s['sub_title'] ); ?></p>
          </div>
        </section>

        <section class="section">
          <div class="container">
            <div class="card" style="max-width: 900px; margin: 0 auto; padding: 48px;">
              <form id="rfq-submission-form" novalidate>
                <div class="grid-2" style="gap: 20px;">
                  <div class="form-field">
                    <label class="form-label">Full Name *</label>
                    <input type="text" name="rfq_name" class="form-input" placeholder="e.g. Eng. Khalid Al-Thani" required>
                  </div>
                  <div class="form-field">
                    <label class="form-label">Company / Contractor Name *</label>
                    <input type="text" name="rfq_company" class="form-input" placeholder="e.g. Al Rayyan MEP Contracting" required>
                  </div>
                </div>

                <div class="grid-2" style="gap: 20px;">
                  <div class="form-field">
                    <label class="form-label">Official Email *</label>
                    <input type="email" name="rfq_email" class="form-input" placeholder="procurement@company.com" required>
                  </div>
                  <div class="form-field">
                    <label class="form-label">Phone / WhatsApp *</label>
                    <input type="tel" name="rfq_phone" class="form-input" placeholder="+974 0000 0000" required>
                  </div>
                </div>

                <div class="grid-2" style="gap: 20px;">
                  <div class="form-field">
                    <label class="form-label">Project Name / Location</label>
                    <input type="text" name="rfq_project" class="form-input" placeholder="e.g. Lusail Commercial Tower 3">
                  </div>
                  <div class="form-field">
                    <label class="form-label">Required Delivery Timeline</label>
                    <select name="rfq_timeline" class="form-select">
                      <option value="Urgent">Immediate / Critical Shutdown (1-3 Days)</option>
                      <option value="Within 2 Weeks" selected>Standard Project Delivery (1-2 Weeks)</option>
                      <option value="Scheduled">Scheduled Staggered Supply</option>
                    </select>
                  </div>
                </div>

                <div class="form-field">
                  <label class="form-label">Bill of Quantities / Required Engineering Items *</label>
                  <textarea name="rfq_items" class="form-textarea" placeholder="List item names, part numbers, required quantities, application details..." rows="6" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; height: 56px; font-size: 16px; margin-top: 16px;">
                  Submit Request For Quotation &rarr;
                </button>
              </form>
            </div>
          </div>
        </section>
        <?php
    }
}