(() => {
  'use strict';

  const ready = () => {
    document.body.classList.add('app-ready');
    setupReveal();
    setupCounters();
    setupRings();
    setupProgressBars();
    setupRipples();
    setupRanges();
    setupSubmitting();
    setupCopyButtons();
    setupRewardOptions();
    setupBrowserNotifications();
    setupGuidedTour();
    setupServerToasts();
    setupModalStacking();
  };

  window.addEventListener('load', () => setTimeout(ready, 120));
  setTimeout(() => document.body.classList.add('app-ready'), 1600);


  function setupServerToasts() {
    const messages = window.PowerGuardServerMessages || {};
    if (messages.success) showToast(messages.success, 'success');
    if (messages.error) showToast(messages.error, 'danger');
    if (messages.warning) showToast(messages.warning, 'warning');
    if (messages.validation) showToast(messages.validation, 'danger');
  }

  function setupModalStacking() {
    document.querySelectorAll('.modal').forEach(modal => {
      if (modal.parentElement !== document.body) document.body.appendChild(modal);
    });

    document.addEventListener('show.bs.modal', event => {
      const modal = event.target;
      if (modal.parentElement !== document.body) document.body.appendChild(modal);
    });

    document.addEventListener('hidden.bs.modal', () => {
      if (!document.querySelector('.modal.show')) {
        document.querySelectorAll('.modal-backdrop').forEach(item => item.remove());
        document.body.classList.remove('modal-open');
        document.body.style.removeProperty('padding-right');
        document.body.style.removeProperty('overflow');
      }
    });
  }
  function setupReveal() {
    const items = [...document.querySelectorAll('.card-box,.goal-row,.teacher-goal-row,.child-access-row,.teacher-request-banner,.weekly-box,.feedback-item,.past-item')];
    if (!('IntersectionObserver' in window)) {
      items.forEach(el => el.classList.add('is-visible'));
      return;
    }
    items.forEach((el, i) => {
      el.classList.add('reveal-item');
      el.style.transitionDelay = `${Math.min(i % 6, 5) * 55}ms`;
    });
    const observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: .08 });
    items.forEach(el => observer.observe(el));
  }

  function setupCounters() {
    const selector = '.stat-value,.report-number,.big-percent,.weekly-percent,.score-ring strong';
    document.querySelectorAll(selector).forEach(el => {
      const raw = el.textContent.trim();
      const match = raw.match(/^(\d+)(%?)$/);
      if (!match) return;
      const target = Number(match[1]);
      const suffix = match[2];
      const start = performance.now();
      const duration = 850;
      const tick = now => {
        const p = Math.min((now - start) / duration, 1);
        const eased = 1 - Math.pow(1 - p, 3);
        el.textContent = `${Math.round(target * eased)}${suffix}`;
        if (p < 1) requestAnimationFrame(tick);
      };
      requestAnimationFrame(tick);
    });
  }

  function setupRings() {
    document.querySelectorAll('.score-ring').forEach(ring => {
      const target = Number.parseFloat(getComputedStyle(ring).getPropertyValue('--score')) || 0;
      ring.style.setProperty('--score', 0);
      const start = performance.now();
      const duration = 1050;
      const tick = now => {
        const p = Math.min((now - start) / duration, 1);
        const eased = 1 - Math.pow(1 - p, 3);
        ring.style.setProperty('--score', (target * eased).toFixed(1));
        if (p < 1) requestAnimationFrame(tick);
      };
      requestAnimationFrame(tick);
    });
  }

  function setupProgressBars() {
    document.querySelectorAll('.progress-bar').forEach(bar => {
      const target = bar.style.width || getComputedStyle(bar).width;
      bar.dataset.targetWidth = target;
      bar.style.width = '0';
      requestAnimationFrame(() => requestAnimationFrame(() => { bar.style.width = target; }));
    });
  }

  function setupRipples() {
    document.addEventListener('pointerdown', event => {
      const button = event.target.closest('button,.btn,.btn-black,.btn-blue,.btn-signin,.btn-create');
      if (!button || button.disabled) return;
      const rect = button.getBoundingClientRect();
      const size = Math.max(rect.width, rect.height);
      const ripple = document.createElement('span');
      ripple.className = 'pg-ripple';
      ripple.style.width = ripple.style.height = `${size}px`;
      ripple.style.left = `${event.clientX - rect.left - size / 2}px`;
      ripple.style.top = `${event.clientY - rect.top - size / 2}px`;
      button.appendChild(ripple);
      ripple.addEventListener('animationend', () => ripple.remove());
    });
  }

  function setupRanges() {
    document.querySelectorAll('input[type="range"]').forEach(input => {
      const update = () => {
        const min = Number(input.min || 0), max = Number(input.max || 100), value = Number(input.value);
        const pct = ((value - min) / (max - min)) * 100;
        input.style.background = `linear-gradient(90deg,#1f3f93 ${pct}%,#dfe7f2 ${pct}%)`;
      };
      input.addEventListener('input', update);
      update();
    });
  }

  function setupSubmitting() {
    document.querySelectorAll('form').forEach(form => {
      form.addEventListener('submit', () => {
        const button = form.querySelector('button[type="submit"],button:not([type])');
        if (!button || form.classList.contains('goal-progress-form')) return;
        button.classList.add('is-submitting');
        button.disabled = true;
      });
    });
  }

  function setupCopyButtons() {
    document.querySelectorAll('[data-copy-target]').forEach(button => {
      button.addEventListener('click', async () => {
        const target = document.querySelector(button.dataset.copyTarget);
        if (!target) return;
        try {
          await navigator.clipboard.writeText(target.textContent.trim());
          const original = button.textContent;
          button.textContent = 'Copied ✓';
          showToast('Teacher link copied successfully.');
          setTimeout(() => button.textContent = original, 1800);
        } catch (_) {
          showToast('Could not copy automatically. Please copy the link manually.', 'danger');
        }
      });
    });
  }


  function setupRewardOptions() {
    const input = document.getElementById('rewardCategory');
    const name = document.getElementById('rewardName');
    const condition = document.getElementById('rewardCondition');
    const previewTitle = document.getElementById('rewardPreviewTitle');
    const previewCondition = document.getElementById('rewardPreviewCondition');
    const buttons = [...document.querySelectorAll('[data-reward-category]')];
    if (!input || !buttons.length) return;

    const icons = { Food: '🍕', Gaming: '🎮', Experience: '🏆' };
    const refresh = () => {
      const category = input.value || 'Food';
      if (previewTitle) previewTitle.textContent = `${icons[category] || '🎁'} ${name?.value || 'Your reward'}`;
      if (previewCondition) previewCondition.textContent = condition?.value || 'Set a condition to unlock this reward.';
    };

    buttons.forEach(button => button.addEventListener('click', () => {
      buttons.forEach(item => item.classList.remove('active'));
      button.classList.add('active');
      input.value = button.dataset.rewardCategory;
      refresh();
    }));
    name?.addEventListener('input', refresh);
    condition?.addEventListener('input', refresh);
    refresh();
  }

  function setupBrowserNotifications() {
    const config = window.PowerGuardNotifications;
    const enableButton = document.getElementById('enableBrowserNotifications');
    if (!config || !('Notification' in window) || !('serviceWorker' in navigator)) {
      if (enableButton) {
        enableButton.disabled = true;
        enableButton.textContent = 'Browser notifications unsupported';
      }
      return;
    }

    let latestId = Number(localStorage.getItem('powerguard-latest-notification-id') || 0);
    let registration = null;

    navigator.serviceWorker.register('/service-worker.js').then(result => {
      registration = result;
    }).catch(console.error);

    const updateButton = () => {
      if (!enableButton) return;
      if (Notification.permission === 'granted') {
        enableButton.textContent = 'Chrome Notifications Enabled';
        enableButton.classList.add('enabled');
      } else if (Notification.permission === 'denied') {
        enableButton.textContent = 'Notifications Blocked in Chrome';
        enableButton.disabled = true;
      }
    };

    enableButton?.addEventListener('click', async () => {
      const permission = await Notification.requestPermission();
      updateButton();
      if (permission === 'granted') showToast('Chrome notifications enabled.');
    });
    updateButton();

    const renderBadge = count => {
      const badge = document.getElementById('notificationBadge');
      if (!badge) return;
      badge.textContent = count;
      badge.classList.toggle('d-none', count < 1);
    };

    const showSystemNotification = async notice => {
      if (Notification.permission !== 'granted') return;
      const options = {
        body: notice.message || '',
        icon: '/logo.png',
        badge: '/logo.png',
        tag: `powerguard-${notice.id}`,
        data: { url: notice.url || '/dashboard' }
      };
      if (registration) await registration.showNotification(notice.title || 'PowerGuard', options);
      else new Notification(notice.title || 'PowerGuard', options);
    };

    const poll = async () => {
      try {
        const url = `${config.feedUrl}?after=${latestId}`;
        const response = await fetch(url, { headers: { Accept: 'application/json' }, credentials: 'same-origin' });
        if (!response.ok) return;
        const data = await response.json();
        renderBadge(Number(data.unread_count || 0));
        const notices = [...(data.notifications || [])].sort((a, b) => a.id - b.id);
        for (const notice of notices) {
          if (notice.id > latestId) await showSystemNotification(notice);
          latestId = Math.max(latestId, Number(notice.id));
        }
        localStorage.setItem('powerguard-latest-notification-id', String(Math.max(latestId, Number(data.latest_id || 0))));
      } catch (error) {
        console.debug('PowerGuard notification poll skipped.', error);
      }
    };

    poll();
    window.setInterval(poll, 30000);
  }

  window.pgToast = showToast;
  function showToast(message, type = 'success') {
    const container = document.getElementById('appToastContainer');
    if (!container || !window.bootstrap) return;
    const toast = document.createElement('div');
    toast.className = `toast align-items-center text-bg-${type}`;
    toast.setAttribute('role', 'status');
    toast.innerHTML = `<div class="d-flex"><div class="toast-body">${escapeHtml(message)}</div><button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button></div>`;
    container.appendChild(toast);
    const instance = new bootstrap.Toast(toast, { delay: 2600 });
    instance.show();
    toast.addEventListener('hidden.bs.toast', () => toast.remove());
  }

  function escapeHtml(value) {
    const div = document.createElement('div');
    div.textContent = value;
    return div.innerHTML;
  }


  function setupGuidedTour() {
    const config = window.PowerGuardTour;
    if (!config || !config.enabled || !Array.isArray(config.steps) || !config.steps.length) return;

    let index = Math.max(0, Math.min(Number(config.currentStep || 0), config.steps.length - 1));
    let overlay, spotlight, card, resizeTimer;

    const post = async (url, payload = {}) => {
      const response = await fetch(url, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': config.csrf
        },
        body: JSON.stringify(payload)
      });
      if (!response.ok) throw new Error('Tour state could not be saved.');
      return response.json();
    };

    const build = () => {
      overlay = document.createElement('div');
      overlay.className = 'pg-tour-overlay';
      overlay.innerHTML = `
        <div class="pg-tour-spotlight" aria-hidden="true"></div>
        <section class="pg-tour-card" role="dialog" aria-modal="true" aria-labelledby="pgTourTitle">
          <div class="pg-tour-card-top">
            <span class="pg-tour-role"></span>
            <button type="button" class="pg-tour-skip" aria-label="Skip guided tour">Skip tour</button>
          </div>
          <div class="pg-tour-progress"><span></span></div>
          <div class="pg-tour-count"></div>
          <h2 id="pgTourTitle"></h2>
          <p class="pg-tour-text"></p>
          <div class="pg-tour-actions">
            <button type="button" class="pg-tour-back">Back</button>
            <button type="button" class="pg-tour-next">Next</button>
          </div>
        </section>`;
      document.body.appendChild(overlay);
      spotlight = overlay.querySelector('.pg-tour-spotlight');
      card = overlay.querySelector('.pg-tour-card');
      overlay.querySelector('.pg-tour-role').textContent = `${config.role.charAt(0).toUpperCase() + config.role.slice(1)} tour`;
      overlay.querySelector('.pg-tour-next').addEventListener('click', next);
      overlay.querySelector('.pg-tour-back').addEventListener('click', back);
      overlay.querySelector('.pg-tour-skip').addEventListener('click', finish);
      document.addEventListener('keydown', keyHandler);
      window.addEventListener('resize', reposition);
      window.addEventListener('scroll', reposition, true);
    };

    const keyHandler = event => {
      if (event.key === 'Escape') finish();
      if (event.key === 'ArrowRight' || event.key === 'Enter') next();
      if (event.key === 'ArrowLeft') back();
    };

    const currentTarget = () => {
      const step = config.steps[index];
      return document.querySelector(step.selector) || document.querySelector('[data-tour="page-title"]') || document.body;
    };

    const reposition = () => {
      clearTimeout(resizeTimer);
      resizeTimer = setTimeout(() => {
        if (!overlay || !overlay.classList.contains('show')) return;
        const target = currentTarget();
        const rect = target.getBoundingClientRect();
        const pad = 9;
        spotlight.style.left = `${Math.max(6, rect.left - pad)}px`;
        spotlight.style.top = `${Math.max(6, rect.top - pad)}px`;
        spotlight.style.width = `${Math.min(window.innerWidth - 12, rect.width + pad * 2)}px`;
        spotlight.style.height = `${Math.min(window.innerHeight - 12, rect.height + pad * 2)}px`;

        const cardRect = card.getBoundingClientRect();
        const gap = 18;
        let left = rect.right + gap;
        let top = rect.top;
        if (left + cardRect.width > window.innerWidth - 18) left = rect.left - cardRect.width - gap;
        if (left < 18) left = Math.max(18, Math.min(rect.left, window.innerWidth - cardRect.width - 18));
        if (top + cardRect.height > window.innerHeight - 18) top = window.innerHeight - cardRect.height - 18;
        if (top < 18) top = 18;
        card.style.left = `${left}px`;
        card.style.top = `${top}px`;
      }, 10);
    };

    const render = () => {
      const step = config.steps[index];
      const expected = new URL(step.url, window.location.origin);
      const here = new URL(window.location.href);
      if (expected.pathname !== here.pathname) {
        window.location.assign(expected.href);
        return;
      }

      const target = currentTarget();
      target.scrollIntoView({ behavior: 'smooth', block: 'center', inline: 'nearest' });
      overlay.querySelector('.pg-tour-count').textContent = `Step ${index + 1} of ${config.steps.length}`;
      overlay.querySelector('.pg-tour-progress span').style.width = `${((index + 1) / config.steps.length) * 100}%`;
      overlay.querySelector('h2').textContent = step.title;
      overlay.querySelector('.pg-tour-text').textContent = step.text;
      overlay.querySelector('.pg-tour-back').disabled = index === 0;
      overlay.querySelector('.pg-tour-next').textContent = index === config.steps.length - 1 ? 'Finish' : 'Next';
      document.querySelectorAll('.pg-tour-active').forEach(el => el.classList.remove('pg-tour-active'));
      target.classList.add('pg-tour-active');
      setTimeout(reposition, 350);
    };

    const moveTo = async nextIndex => {
      index = Math.max(0, Math.min(nextIndex, config.steps.length - 1));
      try { await post(config.progressUrl, { step: index }); } catch (error) { console.error(error); }
      render();
    };

    async function next() {
      if (index >= config.steps.length - 1) return finish();
      await moveTo(index + 1);
    }

    async function back() {
      if (index <= 0) return;
      await moveTo(index - 1);
    }

    async function finish() {
      try { await post(config.completeUrl); } catch (error) { console.error(error); }
      document.querySelectorAll('.pg-tour-active').forEach(el => el.classList.remove('pg-tour-active'));
      overlay?.classList.remove('show');
      setTimeout(() => overlay?.remove(), 250);
      document.removeEventListener('keydown', keyHandler);
      window.removeEventListener('resize', reposition);
      window.removeEventListener('scroll', reposition, true);
      showToast('Guided tour completed. You can restart it from the sidebar anytime.');
    }

    build();
    requestAnimationFrame(() => {
      overlay.classList.add('show');
      render();
    });
  }

})();
