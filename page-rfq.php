<?php
/**
 * Template Name: RFQ (Request for Quote) Page
 */
get_header(); ?>

<main id="main-content">
    <!-- ==================== PAGE HERO & 3-STEP INDICATOR ==================== -->
    <section class="page-hero">
      <div class="container">
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <a href="<?php echo esc_url( home_url( "/" ) ); ?>">Home</a>
          <span class="breadcrumb-separator">/</span>
          <a href="<?php echo esc_url( home_url( "/products/" ) ); ?>">Products</a>
          <span class="breadcrumb-separator">/</span>
          <span class="breadcrumb-current">Request a Quotation</span>
        </nav>

        <h1 class="page-hero-title">Request a Quotation</h1>
        <p class="page-hero-sub">Review your selected items, provide project details and delivery schedule, and submit your official RFQ for engineering evaluation.</p>

        <!-- 3-Step Indicator -->
        <div class="stepper-nav" style="margin-top: 32px; margin-bottom: 0;">
          <div class="stepper-item active">
            <div class="stepper-dot">1</div>
            <span>Review Items</span>
          </div>
          <div class="stepper-line"></div>
          <div class="stepper-item active">
            <div class="stepper-dot">2</div>
            <span>Project Details</span>
          </div>
          <div class="stepper-line"></div>
          <div class="stepper-item">
            <div class="stepper-dot">3</div>
            <span>Submit RFQ</span>
          </div>
        </div>
      </div>
    </section>

    <!-- ==================== RFQ WORKFLOW SECTION ==================== -->
    <section class="section">
      <div class="container">
        <!-- Empty State Container (Displayed if localStorage is empty) -->
        <div id="rfq-empty-state" class="empty-state" style="display: none;">
          <h2>Your Inquiry List is Empty</h2>
          <p>You have not selected any items yet. Browse our comprehensive catalog to add HVAC parts, cables, valves, or safety gear to your customized RFQ.</p>
          <a href="<?php echo esc_url( home_url( "/products/" ) ); ?>" class="btn btn-primary">Browse Product Catalog</a>
        </div>

        <!-- Populated State: Table + Form + Sticky Sidebar -->
        <div id="rfq-content-layout" class="grid-12" style="align-items: flex-start; gap: 40px;">
          <!-- Left: Table + Project Details Form (8 Cols) -->
          <div style="grid-column: span 8;">
            <!-- Inquiry List Table Header -->
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
              <h2 style="font-size: 24px; margin: 0;">Selected Items (<span id="table-items-count">0</span>)</h2>
              <button type="button" id="btn-clear-inquiry-list" class="clear-filters-btn" style="border: none; background: none; font-size: 14px;">
                Clear list
              </button>
            </div>

            <!-- Table Wrapper -->
            <div class="inquiry-table-wrapper">
              <table class="inquiry-table" id="inquiry-table">
                <thead>
                  <tr>
                    <th style="width: 45%;">Item / Specification</th>
                    <th style="width: 20%;">Quantity</th>
                    <th style="width: 25%;">Item Notes / Tag</th>
                    <th style="width: 10%; text-align: right;">Action</th>
                  </tr>
                </thead>
                <tbody id="inquiry-table-body">
                  <!-- Rendered dynamically by JS -->
                </tbody>
              </table>
            </div>

            <!-- Project Details Form -->
            <div class="card" style="padding: 40px; margin-top: 32px;">
              <span class="eyebrow">Step 2 of 3</span>
              <h2 style="font-size: 26px; margin-bottom: 8px;">Project &amp; Delivery Details</h2>
              <p style="margin-bottom: 24px;">Please provide company context so our commercial engineers can structure volume discounts and verify delivery logistics.</p>

              <form id="rfq-submission-form" novalidate>
                <!-- Anti-Spam Honeypot Field -->
                <div style="display: none;" aria-hidden="true">
                  <label for="website_hp">Leave empty</label>
                  <input type="text" id="website_hp" name="website_hp" tabindex="-1" autocomplete="off">
                </div>

                <div class="grid-2" style="gap: 16px;">
                  <!-- Full Name -->
                  <div class="form-field">
                    <label for="rfq-name" class="form-label">Full Name *</label>
                    <input type="text" id="rfq-name" name="name" class="form-input" placeholder="e.g. Eng. Tariq Mansoor" required>
                    <div class="form-error">Please enter your name.</div>
                  </div>

                  <!-- Company Name -->
                  <div class="form-field">
                    <label for="rfq-company" class="form-label">Company Name *</label>
                    <input type="text" id="rfq-company" name="company" class="form-input" placeholder="e.g. Qatar MEP Solutions Co." required>
                    <div class="form-error">Please enter your company name.</div>
                  </div>
                </div>

                <div class="grid-2" style="gap: 16px;">
                  <!-- Email -->
                  <div class="form-field">
                    <label for="rfq-email" class="form-label">Work Email *</label>
                    <input type="email" id="rfq-email" name="email" class="form-input" placeholder="tariq@qatarmep.com" required>
                    <div class="form-error">Please enter a valid work email address.</div>
                  </div>

                  <!-- Phone / WhatsApp -->
                  <div class="form-field">
                    <label for="rfq-phone" class="form-label">Phone / WhatsApp Number *</label>
                    <input type="tel" id="rfq-phone" name="phone" class="form-input" placeholder="+974 5500 0000" required>
                    <div class="form-error">Please enter your contact phone or WhatsApp.</div>
                  </div>
                </div>

                <div class="grid-2" style="gap: 16px;">
                  <!-- Project Type -->
                  <div class="form-field">
                    <label for="rfq-project-type" class="form-label">Project Type / Sector</label>
                    <select id="rfq-project-type" name="project_type" class="form-select">
                      <option value="Commercial">Commercial Building / Office Tower</option>
                      <option value="Residential">Residential Development / Villa Complex</option>
                      <option value="Industrial">Industrial / Oil &amp; Gas / Petrochemical</option>
                      <option value="MEP Project" selected>MEP Project Subcontract</option>
                      <option value="Civil Site Work">Civil Infrastructure / Site Work</option>
                      <option value="Facilities Maintenance">Facilities Management &amp; Preventive Maintenance</option>
                    </select>
                  </div>

                  <!-- Required Delivery Date -->
                  <div class="form-field">
                    <label for="rfq-delivery-date" class="form-label">Required Delivery Date</label>
                    <input type="date" id="rfq-delivery-date" name="delivery_date" class="form-input">
                  </div>
                </div>

                <!-- Delivery Location in Qatar -->
                <div class="form-field">
                  <label for="rfq-delivery-location" class="form-label">Target Delivery Location in Qatar</label>
                  <input type="text" id="rfq-delivery-location" name="delivery_location" class="form-input" placeholder="e.g. Lusail Marina, Ras Laffan, Doha Industrial Area, West Bay">
                </div>

                <!-- Additional Project Notes -->
                <div class="form-field">
                  <label for="rfq-notes" class="form-label">Additional Instructions / Brand Approvals / Specifications</label>
                  <textarea id="rfq-notes" name="additional_notes" class="form-textarea" placeholder="Specify any consultant-approved manufacturer lists (AML), voltage specifics, certificate requirements (Mill test / CoC), or urgent dispatch requirements..."></textarea>
                </div>

                <!-- Optional BOQ File Upload -->
                <div class="form-field">
                  <label class="form-label">Attach Supporting BOQ or Specification PDF (Optional)</label>
                  <div class="dropzone" id="rfq-dropzone">
                    <input type="file" id="rfq-file-input" name="rfq_file" class="dropzone-input" accept=".pdf,.doc,.docx,.xls,.xlsx">
                    <svg class="dropzone-icon" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                      <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                      <polyline points="17 8 12 3 7 8"></polyline>
                      <line x1="12" y1="3" x2="12" y2="15"></line>
                    </svg>
                    <div class="dropzone-text" id="rfq-filename-label">Click or drop BOQ spreadsheet / drawing here</div>
                    <div class="dropzone-hint">Accepted: PDF, XLSX, DOCX (Max 10MB)</div>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; height: 54px; font-size: 16px;">
                  Submit Request for Quotation &rarr;
                </button>
              </form>
            </div>
          </div>

          <!-- Right: Summary Sidebar (4 Cols Sticky) -->
          <div style="grid-column: span 4;" class="rfq-sidebar">
            <div class="card" style="padding: 32px;">
              <h3 style="font-size: 20px; margin-bottom: 20px;">Quotation Summary</h3>
              
              <div style="display: flex; justify-content: space-between; padding-bottom: 12px; border-bottom: 1px solid var(--grey-200); margin-bottom: 12px;">
                <span style="color: var(--grey-600); font-size: 15px;">Unique Line Items:</span>
                <span id="summary-distinct-count" style="font-weight: 600; color: var(--navy);">0</span>
              </div>

              <div style="display: flex; justify-content: space-between; padding-bottom: 12px; border-bottom: 1px solid var(--grey-200); margin-bottom: 20px;">
                <span style="color: var(--grey-600); font-size: 15px;">Total Quantity Requested:</span>
                <span id="summary-total-qty" style="font-weight: 700; color: var(--navy); font-size: 18px;">0</span>
              </div>

<!-- Sourcing Guarantee -->
              <div style="margin-bottom: 24px;">
                <h4 style="font-size: 14px; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 10px; color: var(--navy);">What happens next?</h4>
                <ul style="font-size: 13px; color: var(--grey-600); display: flex; flex-direction: column; gap: 8px;">
                  <li style="display: flex; gap: 8px;">
                    <span style="color: var(--navy); font-weight: 700;">&bull;</span>
                    <span>Technical compatibility review by our Doha team.</span>
                  </li>
                  <li style="display: flex; gap: 8px;">
                    <span style="color: var(--navy); font-weight: 700;">&bull;</span>
                    <span>Factory lead times &amp; freight coordination calculated.</span>
                  </li>
                  <li style="display: flex; gap: 8px;">
                    <span style="color: var(--navy); font-weight: 700;">&bull;</span>
                    <span>Formal PDF commercial quotation emailed within 24h.</span>
                  </li>
                </ul>
              </div>

              <!-- WhatsApp Quick Contact Shortcut -->
              <div style="border-top: 1px solid var(--grey-200); padding-top: 20px;">
                <p class="text-small" style="margin-bottom: 12px;">Need an urgent verbal confirmation or spare parts inquiry?</p>
                <a href="https://wa.me/97460042255" target="_blank" rel="noopener noreferrer" class="btn btn-secondary" style="width: 100%; border-color: #25d366; color: #166534;">
                  <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/>
                  </svg>
                  WhatsApp: +974 60042255
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

<script>

    document.addEventListener('DOMContentLoaded', () => {
      const emptyState = document.getElementById('rfq-empty-state');
      const layout = document.getElementById('rfq-content-layout');
      const tbody = document.getElementById('inquiry-table-body');
      const tableCount = document.getElementById('table-items-count');
      const distinctCountEl = document.getElementById('summary-distinct-count');
      const totalQtyEl = document.getElementById('summary-total-qty');
      const clearBtn = document.getElementById('btn-clear-inquiry-list');
      const rfqForm = document.getElementById('rfq-submission-form');
      const fileInput = document.getElementById('rfq-file-input');
      const fileLabel = document.getElementById('rfq-filename-label');

      fileInput.addEventListener('change', () => {
        if (fileInput.files && fileInput.files.length > 0) {
          fileLabel.textContent = `Attached: ${fileInput.files[0].name} (${(fileInput.files[0].size / 1024 / 1024).toFixed(2)} MB)`;
          fileLabel.style.color = 'var(--navy)';
        } else {
          fileLabel.textContent = 'Click or drop BOQ spreadsheet / drawing here';
        }
      });

      // Smart URL Parameter Handling (e.g. ?item=Compressors&cat=hvac)
      const urlParams = new URLSearchParams(window.location.search);
      const paramItem = urlParams.get('item');
      const paramCat = urlParams.get('cat');

      if (paramItem) {
        // Check if item is already in list, if not add it
        const existing = InquiryManager.getItems().find(i => i.name.toLowerCase() === paramItem.toLowerCase());
        if (!existing) {
          InquiryManager.addItem({
            id: 'item-' + Date.now(),
            name: paramItem,
            partNo: 'HT-' + (paramCat ? paramCat.toUpperCase() : 'SPEC'),
            qty: 1,
            note: 'Added from Product Showcase',
            categorySlug: paramCat || 'general'
          });
        }
      }

      // If category param provided, pre-fill notes or project context
      if (paramCat) {
        const notesField = document.getElementById('rfq-notes');
        if (notesField && !notesField.value) {
          notesField.value = `Enquiry regarding ${paramCat.toUpperCase()} category materials.`;
        }
      }

      function renderInquiryTable() {
        const items = InquiryManager.getItems();

        if (items.length === 0) {
          emptyState.style.display = 'block';
          layout.style.display = 'none';
          return;
        }

        emptyState.style.display = 'none';
        layout.style.display = 'grid';

        tableCount.textContent = items.length;
        distinctCountEl.textContent = items.length;
        totalQtyEl.textContent = InquiryManager.getCount();

        tbody.innerHTML = items.map(item => `
          <tr data-id="${item.id}">
            <td class="inquiry-item-cell-wrapper">
              <div class="inquiry-item-cell">
                <div class="inquiry-item-thumb">
                  <img src="${item.image}" alt="${item.name}">
                </div>
                <div>
                  <div class="inquiry-item-name">
                    <a href="<?php echo esc_url( home_url( "/product/" ) ); ?>?id=${item.id}">${item.name}</a>
                  </div>
                  <div class="inquiry-item-part">Part: ${item.partNo}</div>
                </div>
              </div>
            </td>
            <td>
              <div class="qty-stepper">
                <button type="button" class="qty-btn js-qty-decrease" aria-label="Decrease">&minus;</button>
                <input type="number" class="qty-input js-qty-val" value="${item.qty}" min="1">
                <button type="button" class="qty-btn js-qty-increase" aria-label="Increase">&plus;</button>
              </div>
            </td>
            <td>
              <input type="text" class="form-input js-item-note" style="padding: 8px 12px; font-size: 13px;" placeholder="e.g. 380V / specific brand" value="${item.note || ''}">
            </td>
            <td style="text-align: right;">
              <button type="button" class="btn-remove js-item-remove" aria-label="Remove item">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                  <path d="M3 6h18M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M10 11v6M14 11v6"/>
                </svg>
              </button>
            </td>
          </tr>
        `).join('');

        // Bind Row Handlers
        tbody.querySelectorAll('tr').forEach(row => {
          const id = row.getAttribute('data-id');
          const qtyValInput = row.querySelector('.js-qty-val');
          const btnDec = row.querySelector('.js-qty-decrease');
          const btnInc = row.querySelector('.js-qty-increase');
          const noteInput = row.querySelector('.js-item-note');
          const btnRemove = row.querySelector('.js-item-remove');

          btnDec.addEventListener('click', () => {
            let val = parseInt(qtyValInput.value, 10) || 1;
            if (val > 1) {
              qtyValInput.value = val - 1;
              InquiryManager.updateQty(id, val - 1);
              totalQtyEl.textContent = InquiryManager.getCount();
            }
          });

          btnInc.addEventListener('click', () => {
            let val = parseInt(qtyValInput.value, 10) || 1;
            qtyValInput.value = val + 1;
            InquiryManager.updateQty(id, val + 1);
            totalQtyEl.textContent = InquiryManager.getCount();
          });

          qtyValInput.addEventListener('change', () => {
            let val = Math.max(1, parseInt(qtyValInput.value, 10) || 1);
            qtyValInput.value = val;
            InquiryManager.updateQty(id, val);
            totalQtyEl.textContent = InquiryManager.getCount();
          });

          noteInput.addEventListener('change', () => {
            InquiryManager.updateNote(id, noteInput.value.trim());
          });

          btnRemove.addEventListener('click', () => {
            InquiryManager.removeItem(id);
            renderInquiryTable();
          });
        });
      }

      // Clear list listener
      clearBtn.addEventListener('click', () => {
        if (confirm('Are you sure you want to clear your inquiry list?')) {
          InquiryManager.clearList();
          renderInquiryTable();
        }
      });

      // Listen to storage update events
      window.addEventListener('hoshin:inquiryUpdated', renderInquiryTable);

      // Handle RFQ Submit
      handleFormSubmit(rfqForm, 'thank-you.html', (formData) => {
        const currentItems = InquiryManager.getItems();
        try {
          const rfqPayload = {
            type: 'rfq',
            name: formData.get('name'),
            company: formData.get('company'),
            email: formData.get('email'),
            phone: formData.get('phone'),
            projectType: formData.get('project_type'),
            deliveryDate: formData.get('delivery_date'),
            deliveryLocation: formData.get('delivery_location'),
            additionalNotes: formData.get('additional_notes'),
            items: currentItems,
            submittedAt: new Date().toISOString()
          };
          localStorage.setItem('hoshin_last_rfq', JSON.stringify(rfqPayload));
          // Clear list after successful RFQ submission
          InquiryManager.clearList();
        } catch(e) {}
      });

      // Initial Render
      renderInquiryTable();
    });
  
</script>

<?php get_footer(); ?>
