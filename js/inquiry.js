/**
 * HOSHIN TRADING — INQUIRY LIST MANAGER
 * 
 * Handles client-side Request for Quotation (RFQ) inquiry list persistence via localStorage.
 * Key: "hoshin_inquiry"
 */

const InquiryManager = (function () {
  const STORAGE_KEY = 'hoshin_inquiry';

  // Safe localStorage helper
  function getRawList() {
    try {
      const data = localStorage.getItem(STORAGE_KEY);
      return data ? JSON.parse(data) : [];
    } catch (e) {
      console.warn('Could not read inquiry list from localStorage', e);
      return [];
    }
  }

  function saveRawList(list) {
    try {
      localStorage.setItem(STORAGE_KEY, JSON.stringify(list));
      dispatchUpdate();
      return true;
    } catch (e) {
      console.warn('Could not save inquiry list to localStorage', e);
      return false;
    }
  }

  function dispatchUpdate() {
    updateBadges();
    window.dispatchEvent(new CustomEvent('hoshin:inquiryUpdated', { detail: { items: getRawList() } }));
  }

  // Public Methods
  function getItems() {
    return getRawList();
  }

  function getCount() {
    const list = getRawList();
    return list.reduce((total, item) => total + (parseInt(item.qty, 10) || 1), 0);
  }

  function getItemCountDistinct() {
    return getRawList().length;
  }

  function addItem(item) {
    if (!item || !item.id) return false;
    const list = getRawList();
    const existingIndex = list.findIndex(i => i.id === item.id);

    const qtyToAdd = parseInt(item.qty, 10) || 1;

    if (existingIndex > -1) {
      list[existingIndex].qty = (parseInt(list[existingIndex].qty, 10) || 1) + qtyToAdd;
      if (item.note) {
        list[existingIndex].note = item.note;
      }
    } else {
      list.push({
        id: item.id,
        name: item.name || 'Industrial Engineering Item',
        partNo: item.partNo || 'N/A',
        qty: qtyToAdd,
        note: item.note || '',
        categorySlug: item.categorySlug || '',
        image: item.image || 'assets/images/products-v3/compressors.webp'
      });
    }

    saveRawList(list);
    showToast(`${item.name} added to your Inquiry List`, 'View List', 'rfq.html');
    return true;
  }

  function updateQty(id, qty) {
    const list = getRawList();
    const item = list.find(i => i.id === id);
    if (item) {
      item.qty = Math.max(1, parseInt(qty, 10) || 1);
      saveRawList(list);
    }
  }

  function updateNote(id, note) {
    const list = getRawList();
    const item = list.find(i => i.id === id);
    if (item) {
      item.note = note || '';
      saveRawList(list);
    }
  }

  function removeItem(id) {
    const list = getRawList();
    const filtered = list.filter(i => i.id !== id);
    saveRawList(filtered);
    showToast('Item removed from Inquiry List');
  }

  function clearList() {
    saveRawList([]);
    showToast('Inquiry List cleared');
  }

  // UI: Header Badge and Floating Counter Updates
  function updateBadges() {
    const totalCount = getCount();
    const badges = document.querySelectorAll('.js-inquiry-count');
    badges.forEach(badge => {
      badge.textContent = totalCount;
      badge.setAttribute('aria-label', `${totalCount} items in inquiry list`);
      
      // Trigger subtle scale bump animation
      badge.classList.remove('badge-bump');
      void badge.offsetWidth; // trigger reflow
      badge.classList.add('badge-bump');
    });

    const floatingBtn = document.querySelector('.floating-inquiry-btn');
    if (floatingBtn) {
      if (totalCount > 0) {
        floatingBtn.classList.add('has-items');
      } else {
        floatingBtn.classList.remove('has-items');
      }
    }
  }

  // UI Toast Notification
  function showToast(message, actionLabel, actionUrl) {
    let container = document.getElementById('hoshin-toast-container');
    if (!container) {
      container = document.createElement('div');
      container.id = 'hoshin-toast-container';
      container.className = 'toast-container';
      document.body.appendChild(container);
    }

    const toast = document.createElement('div');
    toast.className = 'toast-item';
    toast.setAttribute('role', 'status');
    toast.setAttribute('aria-live', 'polite');

    let actionHtml = '';
    if (actionLabel && actionUrl) {
      actionHtml = `<a href="${actionUrl}" class="toast-link">${actionLabel} &rarr;</a>`;
    }

    toast.innerHTML = `
      <div class="toast-content">
        <span class="toast-icon">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
        </span>
        <span class="toast-msg">${message}</span>
        ${actionHtml}
      </div>
      <button type="button" class="toast-close" aria-label="Close notification">&times;</button>
    `;

    container.appendChild(toast);

    // Close button
    toast.querySelector('.toast-close').addEventListener('click', () => {
      toast.classList.add('toast-exit');
      setTimeout(() => toast.remove(), 250);
    });

    // Auto dismiss after 4 seconds
    setTimeout(() => {
      if (toast.parentElement) {
        toast.classList.add('toast-exit');
        setTimeout(() => toast.remove(), 250);
      }
    }, 4000);
  }

  // Handle "Add to Inquiry List" button feedback helper
  function setupAddButtonFeedback(button, product) {
    if (!button || !product) return;
    button.addEventListener('click', (e) => {
      e.preventDefault();
      
      const qtyInput = document.getElementById('product-qty-input');
      const qty = qtyInput ? parseInt(qtyInput.value, 10) || 1 : 1;

      addItem({
        id: product.id,
        name: product.name,
        partNo: product.partNo,
        qty: qty,
        image: product.image,
        categorySlug: product.categorySlug
      });

      const originalText = button.innerHTML;
      button.classList.add('btn-added');
      button.innerHTML = `
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="20 6 9 17 4 12"></polyline>
        </svg>
        Added ✓
      `;

      setTimeout(() => {
        button.classList.remove('btn-added');
        button.innerHTML = originalText;
      }, 2000);
    });
  }

  // Run on load
  document.addEventListener('DOMContentLoaded', () => {
    updateBadges();

    // Hide floating counter on rfq.html
    const isRfqPage = window.location.pathname.includes('rfq.html');
    const floatingBtn = document.querySelector('.floating-inquiry-btn');
    if (floatingBtn && isRfqPage) {
      floatingBtn.style.display = 'none';
    }
  });

  return {
    getItems,
    getCount,
    getItemCountDistinct,
    addItem,
    updateQty,
    updateNote,
    removeItem,
    clearList,
    updateBadges,
    showToast,
    setupAddButtonFeedback
  };
})();
