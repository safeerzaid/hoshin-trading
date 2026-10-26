<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Hoshin_Products_Overview_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'hoshin_products_overview';
    }

    public function get_title() {
        return esc_html__( 'Hoshin Products Catalog Overview', 'hoshin-trading' );
    }

    public function get_icon() {
        return 'eicon-products';
    }

    public function get_categories() {
        return [ 'hoshin-elements' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'header_section',
            [
                'label' => esc_html__( 'Service Model Header', 'hoshin-trading' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'eyebrow',
            [
                'label' => esc_html__( 'Eyebrow', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'OUR SERVICE MODEL', 'hoshin-trading' ),
            ]
        );

        $this->add_control(
            'heading',
            [
                'label' => esc_html__( 'Heading', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Global Sourcing & Procurement Support', 'hoshin-trading' ),
            ]
        );

        $this->add_control(
            'desc',
            [
                'label' => esc_html__( 'Description', 'hoshin-trading' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'When off-the-shelf options fall short or exact models are obsolete, Hoshin Trading provides tailored sourcing solutions.', 'hoshin-trading' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $s = $this->get_settings_for_display();
        ?>
        <section class="service-model-section section-wrap">
          <div class="service-model-container">
            <div class="service-model-header-grid">
              <div class="service-model-lead-col">
                <span class="service-model-eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></span>
                <h1 class="service-model-title"><?php echo esc_html( $s['heading'] ); ?></h1>
              </div>
              <div class="service-model-statement-col">
                <p class="service-model-statement">
                  <?php echo esc_html( $s['desc'] ); ?>
                </p>
              </div>
            </div>

            <!-- 3 Pillars Cards -->
            <div class="service-model-grid">
              <!-- Pillar 1 -->
              <article class="service-model-card">
                <div class="service-model-card-top">
                  <span class="service-model-num">01</span>
                  <div class="service-model-icon-badge">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                      <polyline points="14 2 14 8 20 8"></polyline>
                      <line x1="16" y1="13" x2="8" y2="13"></line>
                      <line x1="16" y1="17" x2="8" y2="17"></line>
                      <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                  </div>
                </div>
                <div class="service-model-card-body">
                  <h3 class="service-model-card-title">Technical Matching &amp; Sourcing</h3>
                  <p class="service-model-card-desc">Requirement analysis based on spec sheets and project details.</p>
                </div>
              </article>

              <!-- Pillar 2 -->
              <article class="service-model-card">
                <div class="service-model-card-top">
                  <span class="service-model-num">02</span>
                  <div class="service-model-icon-badge">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <polyline points="16 3 21 3 21 8"></polyline>
                      <line x1="4" y1="20" x2="21" y2="3"></line>
                      <polyline points="21 16 21 21 16 21"></polyline>
                      <line x1="15" y1="15" x2="21" y2="21"></line>
                      <line x1="4" y1="4" x2="9" y2="9"></line>
                    </svg>
                  </div>
                </div>
                <div class="service-model-card-body">
                  <h3 class="service-model-card-title">Alternative Brand Proposals</h3>
                  <p class="service-model-card-desc">Equivalent options suggested when specified items are hard to find.</p>
                </div>
              </article>

              <!-- Pillar 3 -->
              <article class="service-model-card">
                <div class="service-model-card-top">
                  <span class="service-model-num">03</span>
                  <div class="service-model-icon-badge">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <circle cx="12" cy="12" r="10"></circle>
                      <line x1="2" y1="12" x2="22" y2="12"></line>
                      <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                    </svg>
                  </div>
                </div>
                <div class="service-model-card-body">
                  <h3 class="service-model-card-title">Direct Import &amp; Supply Coordination</h3>
                  <p class="service-model-card-desc">Sourcing through verified international channels directly into Qatar.</p>
                </div>
              </article>
            </div>
          </div>
        </section>

        <!-- Categories Detailed Rows -->
        <section class="categories-overview-section section-wrap" id="categories-overview">
          <div class="categories-overview-container">
            <!-- Section Header with Real-Time Search & Category Filter Pills -->
            <div class="cat-overview-header" style="margin-bottom: 48px;">
              <div class="cat-header-top-row">
                <div>
                  <span class="cat-overview-eyebrow">PRODUCT PORTFOLIO</span>
                  <h2 class="cat-overview-main-title">Core Product Categories Overview</h2>
                </div>
                
                <!-- Real-Time Interactive Search Bar -->
                <div class="product-catalog-search-wrap">
                  <div class="search-input-box">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <circle cx="11" cy="11" r="8"></circle>
                      <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" id="catalog-live-search" class="catalog-search-field" placeholder="Search by item name, part, or spec (e.g. Compressor, Cable, Valve, PPE)..." autocomplete="off">
                    <button type="button" id="catalog-search-clear" class="search-clear-btn" style="display: none;" aria-label="Clear search">&times;</button>
                  </div>
                </div>
              </div>

              <!-- Quick Category Filter Pills -->
              <div class="category-quick-pills">
                <button type="button" class="cat-pill is-active" data-filter="all">All Disciplines</button>
                <button type="button" class="cat-pill" data-filter="cat-hvac">HVAC &amp; Refrigeration</button>
                <button type="button" class="cat-pill" data-filter="cat-electrical">Electrical &amp; Lighting</button>
                <button type="button" class="cat-pill" data-filter="cat-plumbing">Plumbing &amp; Water Systems</button>
                <button type="button" class="cat-pill" data-filter="cat-building">Building Materials</button>
                <button type="button" class="cat-pill" data-filter="cat-safety">Safety Equipment (PPE)</button>
              </div>

              <!-- Live Search Feedback Notice -->
              <div id="search-feedback-notice" style="display: none; margin-top: 18px; font-size: 14.5px; color: var(--navy); font-weight: 600;">
                Found <span id="search-matches-count">0</span> matching items for "<span id="search-query-display"></span>"
              </div>
            </div>

            <div class="categories-overview-rows">
              <!-- 01: HVAC -->
              <article id="cat-hvac" class="cat-overview-row">
                <div class="cat-overview-left">
                  <span class="cat-overview-index">01 / 05</span>
                  <h3 class="cat-overview-name">HVAC Parts &amp; Air Conditioning</h3>
                  <p class="cat-overview-desc">Comprehensive supply of genuine compressors, specialized refrigerants, air handling components, copper piping, and advanced thermal insulation for commercial and industrial cooling plants.</p>
                  <a href="<?php echo esc_url( home_url( '/rfq/?cat=hvac' ) ); ?>" class="cat-overview-quote-btn"><span>Request a Quote</span><span class="arrow-diagonal">&nearr;</span></a>
                </div>
                <div class="cat-overview-right">
                  <div class="cat-subitem-grid">
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Scroll%20Compressors&cat=hvac" ) ); ?>" class="cat-subitem-cell" title="Request quote for Scroll Compressors">
                      <span class="subitem-label">Scroll Compressors</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Semi-Hermetic%20Reciprocating%20Compressors&cat=hvac" ) ); ?>" class="cat-subitem-cell" title="Request quote for Semi-Hermetic Reciprocating Compressors">
                      <span class="subitem-label">Semi-Hermetic Reciprocating Compressors</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Screw%20Compressors%20%26%20Spares&cat=hvac" ) ); ?>" class="cat-subitem-cell" title="Request quote for Screw Compressors & Spares">
                      <span class="subitem-label">Screw Compressors &amp; Spares</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Rotary%20Compressors%20%26%20Kits&cat=hvac" ) ); ?>" class="cat-subitem-cell" title="Request quote for Rotary Compressors & Kits">
                      <span class="subitem-label">Rotary Compressors &amp; Kits</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=R-134a%2C%20R-410A%2C%20R-404A%2C%20R-32&cat=hvac" ) ); ?>" class="cat-subitem-cell" title="Request quote for R-134a, R-410A, R-404A, R-32">
                      <span class="subitem-label">R-134a, R-410A, R-404A, R-32</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=R-407C%2C%20R-22%20Replacements&cat=hvac" ) ); ?>" class="cat-subitem-cell" title="Request quote for R-407C, R-22 Replacements">
                      <span class="subitem-label">R-407C, R-22 Replacements</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Centrifugal%20%26%20Axial%20Fan%20Motors&cat=hvac" ) ); ?>" class="cat-subitem-cell" title="Request quote for Centrifugal & Axial Fan Motors">
                      <span class="subitem-label">Centrifugal &amp; Axial Fan Motors</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=EC%20%26%20Variable%20Speed%20Motors&cat=hvac" ) ); ?>" class="cat-subitem-cell" title="Request quote for EC & Variable Speed Motors">
                      <span class="subitem-label">EC &amp; Variable Speed Motors</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Blower%20Wheels%20%26%20Impellers&cat=hvac" ) ); ?>" class="cat-subitem-cell" title="Request quote for Blower Wheels & Impellers">
                      <span class="subitem-label">Blower Wheels &amp; Impellers</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Condenser%20Fan%20Blades%20%26%20Hubs&cat=hvac" ) ); ?>" class="cat-subitem-cell" title="Request quote for Condenser Fan Blades & Hubs">
                      <span class="subitem-label">Condenser Fan Blades &amp; Hubs</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Thermostatic%20Expansion%20Valves%20%28TXV%29&cat=hvac" ) ); ?>" class="cat-subitem-cell" title="Request quote for Thermostatic Expansion Valves (TXV)">
                      <span class="subitem-label">Thermostatic Expansion Valves (TXV)</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Electronic%20Expansion%20Valves%20%28EEV%29&cat=hvac" ) ); ?>" class="cat-subitem-cell" title="Request quote for Electronic Expansion Valves (EEV)">
                      <span class="subitem-label">Electronic Expansion Valves (EEV)</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                  </div>
                </div>
              </article>

              <!-- 02: Electrical -->
              <article id="cat-electrical" class="cat-overview-row">
                <div class="cat-overview-left">
                  <span class="cat-overview-index">02 / 05</span>
                  <h3 class="cat-overview-name">Electrical Materials &amp; Power Distribution</h3>
                  <p class="cat-overview-desc">Low and medium voltage circuit breakers, contactors, switchgear components, motor control centres, industrial wiring devices, and containment infrastructure.</p>
                  <a href="<?php echo esc_url( home_url( '/rfq/?cat=electrical' ) ); ?>" class="cat-overview-quote-btn"><span>Request a Quote</span><span class="arrow-diagonal">&nearr;</span></a>
                </div>
                <div class="cat-overview-right">
                  <div class="cat-subitem-grid">
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Miniature%20Circuit%20Breakers%20%28MCB%29&cat=electrical" ) ); ?>" class="cat-subitem-cell" title="Request quote for Miniature Circuit Breakers (MCB)">
                      <span class="subitem-label">Miniature Circuit Breakers (MCB)</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Moulded%20Case%20Breakers%20%28MCCB%29&cat=electrical" ) ); ?>" class="cat-subitem-cell" title="Request quote for Moulded Case Breakers (MCCB)">
                      <span class="subitem-label">Moulded Case Breakers (MCCB)</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Air%20Circuit%20Breakers%20%28ACB%29&cat=electrical" ) ); ?>" class="cat-subitem-cell" title="Request quote for Air Circuit Breakers (ACB)">
                      <span class="subitem-label">Air Circuit Breakers (ACB)</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Residual%20Current%20Devices%20%28RCD/RCCB%29&cat=electrical" ) ); ?>" class="cat-subitem-cell" title="Request quote for Residual Current Devices (RCD/RCCB)">
                      <span class="subitem-label">Residual Current Devices (RCD/RCCB)</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=AC/DC%20Power%20Contactors&cat=electrical" ) ); ?>" class="cat-subitem-cell" title="Request quote for AC/DC Power Contactors">
                      <span class="subitem-label">AC/DC Power Contactors</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Thermal%20Overload%20Relays&cat=electrical" ) ); ?>" class="cat-subitem-cell" title="Request quote for Thermal Overload Relays">
                      <span class="subitem-label">Thermal Overload Relays</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Control%20Relays%20%26%20Timers&cat=electrical" ) ); ?>" class="cat-subitem-cell" title="Request quote for Control Relays & Timers">
                      <span class="subitem-label">Control Relays &amp; Timers</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Variable%20Frequency%20Drives%20%28VFD%29&cat=electrical" ) ); ?>" class="cat-subitem-cell" title="Request quote for Variable Frequency Drives (VFD)">
                      <span class="subitem-label">Variable Frequency Drives (VFD)</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=GI%20%26%20Perforated%20Cable%20Trays&cat=electrical" ) ); ?>" class="cat-subitem-cell" title="Request quote for GI & Perforated Cable Trays">
                      <span class="subitem-label">GI &amp; Perforated Cable Trays</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Cable%20Ladders%20%26%20Unistrut%20Channels&cat=electrical" ) ); ?>" class="cat-subitem-cell" title="Request quote for Cable Ladders & Unistrut Channels">
                      <span class="subitem-label">Cable Ladders &amp; Unistrut Channels</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=GI%20Conduits%20%26%20Fittings%20%28BS%204568%29&cat=electrical" ) ); ?>" class="cat-subitem-cell" title="Request quote for GI Conduits & Fittings (BS 4568)">
                      <span class="subitem-label">GI Conduits &amp; Fittings (BS 4568)</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=PVC%20Conduits%20%26%20Adaptable%20Boxes&cat=electrical" ) ); ?>" class="cat-subitem-cell" title="Request quote for PVC Conduits & Adaptable Boxes">
                      <span class="subitem-label">PVC Conduits &amp; Adaptable Boxes</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                  </div>
                </div>
              </article>

              <!-- 03: Plumbing -->
              <article id="cat-plumbing" class="cat-overview-row">
                <div class="cat-overview-left">
                  <span class="cat-overview-index">03 / 05</span>
                  <h3 class="cat-overview-name">Plumbing Supplies &amp; Piping Systems</h3>
                  <p class="cat-overview-desc">Complete MEP certified piping solutions, pressure-rated fittings, isolation and regulating valves, water boosters, and pump automation accessories.</p>
                  <a href="<?php echo esc_url( home_url( '/rfq/?cat=plumbing' ) ); ?>" class="cat-overview-quote-btn"><span>Request a Quote</span><span class="arrow-diagonal">&nearr;</span></a>
                </div>
                <div class="cat-overview-right">
                  <div class="cat-subitem-grid">
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=PPR%20Pipes%20%26%20PN20/PN25%20Fittings&cat=plumbing" ) ); ?>" class="cat-subitem-cell" title="Request quote for PPR Pipes & PN20/PN25 Fittings">
                      <span class="subitem-label">PPR Pipes &amp; PN20/PN25 Fittings</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=uPVC%20Drainage%20Pipes%20%26%20Fittings&cat=plumbing" ) ); ?>" class="cat-subitem-cell" title="Request quote for uPVC Drainage Pipes & Fittings">
                      <span class="subitem-label">uPVC Drainage Pipes &amp; Fittings</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=CPVC%20Hot/Cold%20Pressure%20Pipes&cat=plumbing" ) ); ?>" class="cat-subitem-cell" title="Request quote for CPVC Hot/Cold Pressure Pipes">
                      <span class="subitem-label">CPVC Hot/Cold Pressure Pipes</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=GI%20%26%20Carbon%20Steel%20Pipes%20%28ASTM%29&cat=plumbing" ) ); ?>" class="cat-subitem-cell" title="Request quote for GI & Carbon Steel Pipes (ASTM)">
                      <span class="subitem-label">GI &amp; Carbon Steel Pipes (ASTM)</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Elbows%2C%20Tees%2C%20Couplings%20%26%20Unions&cat=plumbing" ) ); ?>" class="cat-subitem-cell" title="Request quote for Elbows, Tees, Couplings & Unions">
                      <span class="subitem-label">Elbows, Tees, Couplings &amp; Unions</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Reducers%2C%20Adapters%20%26%20Flanges&cat=plumbing" ) ); ?>" class="cat-subitem-cell" title="Request quote for Reducers, Adapters & Flanges">
                      <span class="subitem-label">Reducers, Adapters &amp; Flanges</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Ball%2C%20Gate%20%26%20Check%20Valves&cat=plumbing" ) ); ?>" class="cat-subitem-cell" title="Request quote for Ball, Gate & Check Valves">
                      <span class="subitem-label">Ball, Gate &amp; Check Valves</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Butterfly%20Valves%20%26%20Strainers&cat=plumbing" ) ); ?>" class="cat-subitem-cell" title="Request quote for Butterfly Valves & Strainers">
                      <span class="subitem-label">Butterfly Valves &amp; Strainers</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Pressure%20Reducing%20Valves%20%28PRVs%29&cat=plumbing" ) ); ?>" class="cat-subitem-cell" title="Request quote for Pressure Reducing Valves (PRVs)">
                      <span class="subitem-label">Pressure Reducing Valves (PRVs)</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Float%20Valves%20%26%20Solenoid%20Valves&cat=plumbing" ) ); ?>" class="cat-subitem-cell" title="Request quote for Float Valves & Solenoid Valves">
                      <span class="subitem-label">Float Valves &amp; Solenoid Valves</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Booster%20Pump%20Sets&cat=plumbing" ) ); ?>" class="cat-subitem-cell" title="Request quote for Booster Pump Sets">
                      <span class="subitem-label">Booster Pump Sets</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Pressure%20Vessels%20%26%20Float%20Switches&cat=plumbing" ) ); ?>" class="cat-subitem-cell" title="Request quote for Pressure Vessels & Float Switches">
                      <span class="subitem-label">Pressure Vessels &amp; Float Switches</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                  </div>
                </div>
              </article>

              <!-- 04: Building Materials -->
              <article id="cat-building" class="cat-overview-row">
                <div class="cat-overview-left">
                  <span class="cat-overview-index">04 / 05</span>
                  <h3 class="cat-overview-name">Building Materials &amp; Civil Hardware</h3>
                  <p class="cat-overview-desc">Civil structural elements, waterproofing chemicals, sealants, heavy construction fasteners, and thermal acoustic insulation.</p>
                  <a href="<?php echo esc_url( home_url( '/rfq/?cat=building' ) ); ?>" class="cat-overview-quote-btn"><span>Request a Quote</span><span class="arrow-diagonal">&nearr;</span></a>
                </div>
                <div class="cat-overview-right">
                  <div class="cat-subitem-grid">
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Steel%20Sections%2C%20Channels%20%26%20Beams&cat=building" ) ); ?>" class="cat-subitem-cell" title="Request quote for Steel Sections, Channels & Beams">
                      <span class="subitem-label">Steel Sections, Channels &amp; Beams</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Reinforcement%20Meshes&cat=building" ) ); ?>" class="cat-subitem-cell" title="Request quote for Reinforcement Meshes">
                      <span class="subitem-label">Reinforcement Meshes</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Timber%2C%20Plywood%20%26%20Formwork&cat=building" ) ); ?>" class="cat-subitem-cell" title="Request quote for Timber, Plywood & Formwork">
                      <span class="subitem-label">Timber, Plywood &amp; Formwork</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Waterproofing%20Membranes&cat=building" ) ); ?>" class="cat-subitem-cell" title="Request quote for Waterproofing Membranes">
                      <span class="subitem-label">Waterproofing Membranes</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Silicones%2C%20PU%20Foams%20%26%20Sealants&cat=building" ) ); ?>" class="cat-subitem-cell" title="Request quote for Silicones, PU Foams & Sealants">
                      <span class="subitem-label">Silicones, PU Foams &amp; Sealants</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Rockwool%20%26%20Glasswool%20Insulation&cat=building" ) ); ?>" class="cat-subitem-cell" title="Request quote for Rockwool & Glasswool Insulation">
                      <span class="subitem-label">Rockwool &amp; Glasswool Insulation</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Extruded%20Polystyrene%20%28XPS%29&cat=building" ) ); ?>" class="cat-subitem-cell" title="Request quote for Extruded Polystyrene (XPS)">
                      <span class="subitem-label">Extruded Polystyrene (XPS)</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Threaded%20Rods%20%26%20Anchor%20Bolts&cat=building" ) ); ?>" class="cat-subitem-cell" title="Request quote for Threaded Rods & Anchor Bolts">
                      <span class="subitem-label">Threaded Rods &amp; Anchor Bolts</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Heavy%20Brackets%20%26%20Clamps&cat=building" ) ); ?>" class="cat-subitem-cell" title="Request quote for Heavy Brackets & Clamps">
                      <span class="subitem-label">Heavy Brackets &amp; Clamps</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Abrasives%20%26%20Cutting%20Discs&cat=building" ) ); ?>" class="cat-subitem-cell" title="Request quote for Abrasives & Cutting Discs">
                      <span class="subitem-label">Abrasives &amp; Cutting Discs</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                  </div>
                </div>
              </article>

              <!-- 05: Safety Gears -->
              <article id="cat-safety" class="cat-overview-row">
                <div class="cat-overview-left">
                  <span class="cat-overview-index">05 / 05</span>
                  <h3 class="cat-overview-name">Safety Gears &amp; Equipment (PPE)</h3>
                  <p class="cat-overview-desc">Standard-compliant head-to-toe personnel safety gear, certified fall arrest systems, flame-retardant uniforms, and site hazard demarcation.</p>
                  <a href="<?php echo esc_url( home_url( '/rfq/?cat=safety' ) ); ?>" class="cat-overview-quote-btn"><span>Request a Quote</span><span class="arrow-diagonal">&nearr;</span></a>
                </div>
                <div class="cat-overview-right">
                  <div class="cat-subitem-grid">
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Safety%20Helmets%20%26%20Face%20Shields&cat=safety" ) ); ?>" class="cat-subitem-cell" title="Request quote for Safety Helmets & Face Shields">
                      <span class="subitem-label">Safety Helmets &amp; Face Shields</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Safety%20Shoes%20%26%20Protective%20Boots&cat=safety" ) ); ?>" class="cat-subitem-cell" title="Request quote for Safety Shoes & Protective Boots">
                      <span class="subitem-label">Safety Shoes &amp; Protective Boots</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Safety%20Glasses%20%26%20Ear%20Defenders&cat=safety" ) ); ?>" class="cat-subitem-cell" title="Request quote for Safety Glasses & Ear Defenders">
                      <span class="subitem-label">Safety Glasses &amp; Ear Defenders</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Dust%20Masks%20%26%20Respirators&cat=safety" ) ); ?>" class="cat-subitem-cell" title="Request quote for Dust Masks & Respirators">
                      <span class="subitem-label">Dust Masks &amp; Respirators</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Reflective%20Vests%20%28High-Vis%29&cat=safety" ) ); ?>" class="cat-subitem-cell" title="Request quote for Reflective Vests (High-Vis)">
                      <span class="subitem-label">Reflective Vests (High-Vis)</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Coveralls%20%26%20Flame-Retardant%20Wear&cat=safety" ) ); ?>" class="cat-subitem-cell" title="Request quote for Coveralls & Flame-Retardant Wear">
                      <span class="subitem-label">Coveralls &amp; Flame-Retardant Wear</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Cut-Resistant%20%26%20Tactical%20Gloves&cat=safety" ) ); ?>" class="cat-subitem-cell" title="Request quote for Cut-Resistant & Tactical Gloves">
                      <span class="subitem-label">Cut-Resistant &amp; Tactical Gloves</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Full-Body%20Safety%20Harnesses&cat=safety" ) ); ?>" class="cat-subitem-cell" title="Request quote for Full-Body Safety Harnesses">
                      <span class="subitem-label">Full-Body Safety Harnesses</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Shock-Absorbing%20Lanyards%20%26%20Lifelines&cat=safety" ) ); ?>" class="cat-subitem-cell" title="Request quote for Shock-Absorbing Lanyards & Lifelines">
                      <span class="subitem-label">Shock-Absorbing Lanyards &amp; Lifelines</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( "/rfq/?item=Safety%20Nets%20%26%20Site%20Barriers&cat=safety" ) ); ?>" class="cat-subitem-cell" title="Request quote for Safety Nets & Site Barriers">
                      <span class="subitem-label">Safety Nets &amp; Site Barriers</span>
                      <span class="subitem-arrow">&nearr;</span>
                    </a>
                  </div>
                </div>
              </article>
            </div>
          </div>
        </section>

        <!-- CTA Primary Band (Architectural Luxury Theme Matched) -->
        <section class="cta-primary-band">
          <div class="section-wrap cta-primary-wrap">
            <div class="cta-primary-card">
              <div class="cta-primary-content">
                <span class="cta-primary-eyebrow">Global Sourcing Specialists</span>
                <h2 class="cta-primary-title">Can't find what you need? We source globally.</h2>
                <p class="cta-primary-desc">
                  From one-off replacement components to multi-container project shipments, send us your bill of materials for rapid evaluation.
                </p>
              </div>
              <div class="cta-primary-action">
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="cta-primary-btn">
                  <span>Submit Material List</span>
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M7 7h10v10"></path>
                    <path d="M7 17 17 7"></path>
                  </svg>
                </a>
              </div>
            </div>
          </div>
        </section>
        
        <script>
        (function() {
          function initCatalogSearch() {
            const searchInput = document.getElementById('catalog-live-search');
            const clearBtn = document.getElementById('catalog-search-clear');
            const feedbackNotice = document.getElementById('search-feedback-notice');
            const countEl = document.getElementById('search-matches-count');
            const queryDisplay = document.getElementById('search-query-display');
            const filterPills = document.querySelectorAll('.cat-pill');
            const categoryRows = document.querySelectorAll('.cat-overview-row');

            if (!searchInput && !filterPills.length) return;

            let activeFilter = 'all';

            function filterCatalog() {
              const q = searchInput ? searchInput.value.trim().toLowerCase() : '';
              let totalMatches = 0;

              if (clearBtn) {
                clearBtn.style.display = q.length > 0 ? 'block' : 'none';
              }

              categoryRows.forEach(row => {
                const rowId = row.id;
                const matchesPill = (activeFilter === 'all' || rowId === activeFilter);
                const cellsInRow = row.querySelectorAll('.cat-subitem-cell');
                let rowHasMatch = false;

                cellsInRow.forEach(cell => {
                  const text = cell.textContent.toLowerCase();
                  const matchesQuery = q === '' || text.includes(q);

                  if (matchesPill && matchesQuery) {
                    cell.style.display = 'flex';
                    rowHasMatch = true;
                    if (q !== '') totalMatches++;
                  } else {
                    cell.style.display = 'none';
                  }
                });

                if (matchesPill && (q === '' || rowHasMatch)) {
                  row.style.display = 'grid';
                } else {
                  row.style.display = 'none';
                }
              });

              if (feedbackNotice) {
                if (q.length > 0) {
                  feedbackNotice.style.display = 'block';
                  countEl.textContent = totalMatches;
                  queryDisplay.textContent = q;
                } else {
                  feedbackNotice.style.display = 'none';
                }
              }
            }

            if (searchInput) {
              searchInput.addEventListener('input', filterCatalog);
            }

            if (clearBtn) {
              clearBtn.addEventListener('click', () => {
                searchInput.value = '';
                filterCatalog();
                searchInput.focus();
              });
            }

            filterPills.forEach(pill => {
              pill.addEventListener('click', () => {
                filterPills.forEach(p => p.classList.remove('is-active'));
                pill.classList.add('is-active');
                activeFilter = pill.getAttribute('data-filter');
                filterCatalog();
              });
            });
          }

          if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initCatalogSearch);
          } else {
            initCatalogSearch();
          }
        })();
        </script>

<?php
    }
}