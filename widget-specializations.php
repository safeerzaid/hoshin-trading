<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Hoshin_Specializations_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'hoshin_specializations';
    }

    public function get_title() {
        return esc_html__( 'Hoshin Core Specializations', 'hoshin-trading' );
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return [ 'hoshin-elements' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__( 'Section Header', 'hoshin-trading' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Section Title', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Core Specializations', 'hoshin-trading' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_cards',
            [
                'label' => esc_html__( 'Specialization Cards', 'hoshin-trading' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'card_title',
            [
                'label' => esc_html__( 'Card Title', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'HVAC Spare Parts & Components', 'hoshin-trading' ),
            ]
        );

        $repeater->add_control(
            'card_desc',
            [
                'label' => esc_html__( 'Description', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Compressors, motors, capacitors, PCBs, thermostats, expansion valves, filters, and service materials.', 'hoshin-trading' ),
            ]
        );

        $repeater->add_control(
            'card_link',
            [
                'label' => esc_html__( 'Link URL', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '/products/',
                ],
            ]
        );

        $this->add_control(
            'cards',
            [
                'label' => esc_html__( 'Cards List', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'card_title' => 'HVAC Spare Parts & Components',
                        'card_desc' => 'Compressors, motors, capacitors, PCBs, thermostats, expansion valves, filters, and service materials.',
                        'card_link' => [ 'url' => '/products/' ],
                    ],
                    [
                        'card_title' => 'Refrigeration & Refrigerant Products',
                        'card_desc' => 'Refrigerant gases, HVAC consumables, copper fittings, and refrigeration accessories.',
                        'card_link' => [ 'url' => '/products/' ],
                    ],
                    [
                        'card_title' => 'Electrical Materials & Accessories',
                        'card_desc' => 'Cables, switchgear, MCBs/MCCBs, conduits, LED lighting, distribution boards, and wiring accessories.',
                        'card_link' => [ 'url' => '/products/' ],
                    ],
                    [
                        'card_title' => 'Plumbing Materials & Components',
                        'card_desc' => 'PPR/PVC/CPVC/GI piping systems, valves, pumps, pressure vessels, and installation accessories.',
                        'card_link' => [ 'url' => '/products/' ],
                    ],
                    [
                        'card_title' => 'Building Materials',
                        'card_desc' => 'Structural steel, civil hardware, waterproofing materials, sealants, fasteners, insulation, and site consumables.',
                        'card_link' => [ 'url' => '/products/' ],
                    ],
                    [
                        'card_title' => 'Safety Gears & Equipment (PPE & Site Safety)',
                        'card_desc' => 'Head-to-toe PPE, fall protection equipment, high-visibility workwear, gas detection, fire safety gear, and site safety signage.',
                        'card_link' => [ 'url' => '/products/' ],
                    ],
                ],
                'title_field' => '{{{ card_title }}}',
            ]
        );

        $this->end_controls_section();
    }

            protected function render() {
        $settings = $this->get_settings_for_display();

        $icons = [
            // HVAC: Fan / Airflow
            '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 12c-2.8 0-5-2.2-5-5 0-1.8 1-3.4 2.5-4.2C11 3.5 12 5 12 7v5z"></path><path d="M12 12c0-2.8 2.2-5 5-5 1.8 0 3.4 1 4.2 2.5C20.5 11 19 12 17 12h-5z"></path><path d="M12 12c2.8 0 5 2.2 5 5 0 1.8-1 3.4-2.5 4.2C13 20.5 12 19 12 17v-5z"></path><path d="M12 12c0 2.8-2.2 5-5 5-1.8 0-3.4-1-4.2-2.5C3.5 13 5 12 7 12h5z"></path><circle cx="12" cy="12" r="2"></circle></svg>',
            // Refrigeration: Snowflake
            '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="2" x2="12" y2="22"></line><line x1="2" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line><line x1="19.07" y1="4.93" x2="4.93" y2="19.07"></line><circle cx="12" cy="12" r="2.5"></circle></svg>',
            // Electrical: Lightning bolt / Flash
            '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>',
            // Plumbing: Water Droplet / Valve
            '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path></svg>',
            // Building Materials: Building / Layers / Bricks
            '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="0"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="3" y1="15" x2="21" y2="15"></line><line x1="9" y1="9" x2="9" y2="15"></line><line x1="15" y1="3" x2="15" y2="9"></line><line x1="15" y1="15" x2="15" y2="21"></line></svg>',
            // Safety: Shield Check
            '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path><polyline points="9 12 11 14 15 10"></polyline></svg>'
        ];
        ?>
        <section id="specializations" class="spec-section section-wrap">
          <div class="spec-header-row">
            <h2 class="spec-section-title"><?php echo esc_html( $settings['title'] ); ?></h2>
          </div>

          <div class="spec-cards-container">
            <?php foreach ( $settings['cards'] as $index => $card ) : 
              $icon_svg = isset( $icons[$index] ) ? $icons[$index] : $icons[0];
            ?>
              <a href="<?php echo esc_url( $card['card_link']['url'] ); ?>" class="spec-ref-card">
                <!-- Top Bar: Golden Icon at Left, Elegant Corner Arrow at Right -->
                <div class="spec-card-topbar">
                  <div class="spec-ref-icon-badge">
                    <?php echo $icon_svg; ?>
                  </div>
                  <div class="spec-card-arrow" aria-hidden="true">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <line x1="7" y1="17" x2="17" y2="7"></line>
                      <polyline points="7 7 17 7 17 17"></polyline>
                    </svg>
                  </div>
                </div>

                <!-- Bottom Content: Title and Description -->
                <div class="spec-card-bottom">
                  <h3 class="spec-ref-card-title"><?php echo esc_html( $card['card_title'] ); ?></h3>
                  <p class="spec-ref-card-desc"><?php echo esc_html( $card['card_desc'] ); ?></p>
                </div>
              </a>
            <?php endforeach; ?>
          </div>
        </section>
        <?php
    }
}