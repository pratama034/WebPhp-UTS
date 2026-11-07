(function initKosModal() {
      const studentName = document.getElementById('studentName');
      const studentOrigin = document.getElementById('studentOrigin');
      const moveInDate = document.getElementById('moveInDate');
      const surveySlot = document.getElementById('surveySlot');
      const surveyCheckbox = document.getElementById('surveyCheckbox');
      const previewEl = document.getElementById('waMessagePreview');
      const copyBtn = document.getElementById('copyMessageBtn');
      const copyTextSpan = document.getElementById('copyBtnText');
      const waSendLink = document.getElementById('waSendLink');
      const modalWrapper = document.getElementById('surveyModalWrapper');
      const openBtn = document.getElementById('openSurveyModalBtn');
      const closeBtn = document.getElementById('closeModalBtn');
      const cancelBtn = document.getElementById('cancelModalBtn');
      const propertyName = modalWrapper ? modalWrapper.dataset.kosName : '';
      const ownerName = modalWrapper ? modalWrapper.dataset.ownerName : 'Pengelola';
      const roomName = modalWrapper ? modalWrapper.dataset.roomName : '';
      const roomCode = modalWrapper ? modalWrapper.dataset.roomCode : '';
      const roomPrice = modalWrapper ? modalWrapper.dataset.roomPrice : '';
      const phone = modalWrapper ? modalWrapper.dataset.phone : '';

      function formatDate(dateStr) {
        if (!dateStr) return '';
        try {
          const [y, m, d] = dateStr.split('-');
          return `${d}/${m}/${y}`;
        } catch {
          return dateStr;
        }
      }

      function updatePreview() {
        const name = (studentName && studentName.value.trim()) || 'Calon Penghuni';
        const origin = (studentOrigin && studentOrigin.value.trim()) ? ` (${studentOrigin.value.trim()})` : '';
        const dateVal = moveInDate ? formatDate(moveInDate.value) : '';
        const dateText = dateVal ? ` Rencana masuk kos sekitar ${dateVal}.` : '';
        const roomText = roomCode
          ? `Kamar ${roomCode}${roomName ? ` (${roomName})` : ''}${roomPrice ? `, Rp ${roomPrice}/bulan` : ''}`
          : 'kos ini';

        let surveyText = '';
        if (surveyCheckbox && surveyCheckbox.checked && surveySlot) {
          const slot = surveySlot.value;
          if (slot.includes('Tanya')) {
            surveyText = ' Apakah kamar masih tersedia?';
          } else {
            surveyText = ` Saya ingin membuat janji survei langsung pada waktu ${slot}.`;
          }
        } else {
          surveyText = ' Apakah kamar masih tersedia untuk disewa?';
        }

        const msg = `Halo ${ownerName}, saya ${name}${origin}. Saya tertarik dengan ${roomText} di ${propertyName}.${surveyText}${dateText} Terima kasih.`;
        if (previewEl) previewEl.textContent = msg;

        // Update WhatsApp href
        if (waSendLink) {
          if (phone) {
            const encoded = encodeURIComponent(msg);
            waSendLink.href = `https://wa.me/${phone}?text=${encoded}`;
            waSendLink.removeAttribute('aria-disabled');
            waSendLink.textContent = 'Lanjut ke WhatsApp';
          } else {
            waSendLink.href = '#';
            waSendLink.setAttribute('aria-disabled', 'true');
            waSendLink.textContent = 'Kontak belum tersedia';
          }
        }
      }

      // Attach event listeners
      [studentName, studentOrigin, moveInDate, surveySlot, surveyCheckbox].forEach(el => {
        if (el) {
          el.addEventListener('input', updatePreview);
          el.addEventListener('change', updatePreview);
        }
      });

      // Copy text button
      if (copyBtn && previewEl) {
        copyBtn.addEventListener('click', () => {
          const text = previewEl.textContent.trim();
          navigator.clipboard.writeText(text).then(() => {
            if (copyTextSpan) copyTextSpan.textContent = 'Tersalin!';
            setTimeout(() => {
              if (copyTextSpan) copyTextSpan.textContent = 'Salin Teks';
            }, 2000);
          }).catch(() => {
            if (copyTextSpan) copyTextSpan.textContent = 'Gagal Salin';
          });
        });
      }

      function openModal() {
        if (modalWrapper) {
          modalWrapper.hidden = false;
          modalWrapper.setAttribute('aria-hidden', 'false');
          modalWrapper.style.display = 'flex';
          modalWrapper.style.removeProperty('opacity');
          if (closeBtn) closeBtn.focus();
        }
      }

      function closeModal() {
        if (modalWrapper) {
          modalWrapper.style.opacity = '0';
          setTimeout(() => {
            modalWrapper.style.display = 'none';
            modalWrapper.hidden = true;
            modalWrapper.setAttribute('aria-hidden', 'true');
            modalWrapper.style.removeProperty('opacity');
          }, 200);
        }
      }

      if (openBtn) openBtn.addEventListener('click', openModal);
      if (closeBtn) closeBtn.addEventListener('click', closeModal);
      if (cancelBtn) cancelBtn.addEventListener('click', closeModal);
      if (waSendLink && !phone) {
        waSendLink.addEventListener('click', (event) => event.preventDefault());
      }
      if (modalWrapper) {
        modalWrapper.addEventListener('click', (event) => {
          if (event.target === modalWrapper) closeModal();
        });
      }

      // Escape key to dismiss
      window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modalWrapper && !modalWrapper.hidden) closeModal();
      });

      // Initial populate
      updatePreview();
    })();
