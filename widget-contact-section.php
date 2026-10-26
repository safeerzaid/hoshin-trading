<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Hoshin_Contact_Section_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'hoshin_contact_section';
    }

    public function get_title() {
        return esc_html__( 'Hoshin Contact & Sourcing Form', 'hoshin-trading' );
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    public function get_categories() {
        return [ 'hoshin-elements' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Contact Details', 'hoshin-trading' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'phone',
            [
                'label' => esc_html__( 'Phone / WhatsApp', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( '+974 6004 2255', 'hoshin-trading' ),
            ]
        );

        $this->add_control(
            'email',
            [
                'label' => esc_html__( 'Email Address', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'info@hoshintrading.com', 'hoshin-trading' ),
            ]
        );

        $this->add_control(
            'address',
            [
                'label' => esc_html__( 'Office Address', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( '950 / Ibn Seena, Al Muntazah St, Doha, Qatar', 'hoshin-trading' ),
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
              <span class="breadcrumb-current">Contact Us</span>
            </nav>
            <h1 class="page-hero-title">Contact &amp; Sourcing Enquiry</h1>
            <p class="page-hero-sub">Get in touch with our engineering and procurement team for quotes, specification verification, or global sourcing assistance.</p>
          </div>
        </section>

        <section class="section" style="padding-top: 48px;">
          <div class="container">
            <div class="grid-12" style="gap: 40px; align-items: start;">
              <!-- Left Column: Details -->
              <div style="grid-column: span 5; display: flex; flex-direction: column; gap: 24px;">
                <div class="card" style="padding: 32px; display: flex; flex-direction: column; gap: 20px;">
                  <h3 style="font-size: 20px;">Hoshin Trading W.L.L.</h3>
                  <p class="text-small">Engineering components, MEP supplies, and global procurement solutions for contractors, operators, and facilities in Qatar and the GCC.</p>

                  <hr style="border: 0; border-top: 1px solid var(--border); margin: 0;">

                  <!-- Address -->
                  <div style="display: flex; gap: 16px;">
                    <div class="service-strip-icon">
                      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                      </svg>
                    </div>
                    <div>
                      <h4 style="font-size: 15px; margin-bottom: 4px;">Head Office</h4>
                      <p class="text-small" style="color: var(--text);">
                        <?php echo esc_html( $s['address'] ); ?><br>
                        Commercial Registration: Verified
                      </p>
                    </div>
                  </div>

                  <!-- Direct Phone -->
                  <div style="display: flex; gap: 16px;">
                    <div class="service-strip-icon">
                      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                      </svg>
                    </div>
                    <div>
                      <h4 style="font-size: 15px; margin-bottom: 4px;">Telephone / WhatsApp</h4>
                      <p class="text-small">
                        <a href="tel:<?php echo esc_attr( preg_replace('/[^0-9+]/', '', $s['phone']) ); ?>" style="color: var(--navy); font-weight: 500;"><?php echo esc_html( $s['phone'] ); ?></a>
                      </p>
                    </div>
                  </div>

                  <!-- Email -->
                  <div style="display: flex; gap: 16px;">
                    <div class="service-strip-icon">
                      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                      </svg>
                    </div>
                    <div>
                      <h4 style="font-size: 15px; margin-bottom: 4px;">Direct Email</h4>
                      <p class="text-small">
                        <a href="mailto:<?php echo esc_attr( $s['email'] ); ?>" style="color: var(--navy); font-weight: 500;"><?php echo esc_html( $s['email'] ); ?></a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Right Column: Sourcing Form -->
              <div style="grid-column: span 7;">
                <div class="card" style="padding: 40px;">
                  <h2 style="font-size: 28px; margin-bottom: 24px;">Inquiry / Quote Request Form</h2>

                  <form id="contact-sourcing-form" enctype="multipart/form-data" novalidate>
                    <div class="grid-2" style="gap: 16px;">
                      <div class="form-field">
                        <label for="contact-name" class="form-label">Full Name *</label>
                        <input type="text" id="contact-name" name="name" class="form-input" required>
                      </div>
                      <div class="form-field">
                        <label for="contact-company" class="form-label">Company Name</label>
                        <input type="text" id="contact-company" name="company" class="form-input">
                      </div>
                    </div>

                    <div class="grid-2" style="gap: 16px;">
                      <div class="form-field">
                        <label for="contact-email" class="form-label">Email Address *</label>
                        <input type="email" id="contact-email" name="email" class="form-input" placeholder="name@company.com" required>
                      </div>
                      <div class="form-field">
                        <label for="contact-phone" class="form-label">Phone / WhatsApp Number *</label>
                        <input type="tel" id="contact-phone" name="phone" class="form-input" placeholder="+974 0000 0000" required>
                      </div>
                    </div>

                    <div class="form-field">
                      <label for="contact-category" class="form-label">Category of Requirement</label>
                      <select id="contact-category" name="category" class="form-select">
                        <option value="HVAC Parts">HVAC Parts</option>
                        <option value="Electrical Materials">Electrical Materials</option>
                        <option value="Plumbing Supplies">Plumbing Supplies</option>
                        <option value="Building Materials">Building Materials</option>
                        <option value="Safety Gears">Safety Gears</option>
                        <option value="General Sourcing" selected>General Sourcing</option>
                      </select>
                    </div>

                    <div class="form-field">
                      <label for="contact-details" class="form-label">Enquiry Details / Material List *</label>
                      <textarea id="contact-details" name="details" class="form-textarea" required></textarea>
                    </div>

                    <div class="form-field">
                      <label for="contact-file-input" class="form-label">Upload Specs / BOQ (PDF)</label>
                      <input type="file" id="contact-file-input" name="spec_file" class="form-file" accept=".pdf,application/pdf">
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%; height: 54px; font-size: 16px;">
                      Send Enquiry &rarr;
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </section>
        <?php
    }
}