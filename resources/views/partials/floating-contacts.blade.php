<style>
/* ===== FLOATING CONTACTS ===== */
.fc-wrap {
    position: fixed;
    bottom: 28px;
    left: 24px;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 12px;
}

/* Items list */
.fc-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
    pointer-events: none;
}

.fc-item {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    opacity: 0;
    transform: translateY(16px) scale(0.85);
    transition: opacity .35s ease, transform .35s cubic-bezier(.34,1.56,.64,1);
    pointer-events: none;
}

.fc-item.visible {
    opacity: 1;
    transform: translateY(0) scale(1);
    pointer-events: auto;
}

/* stagger */
.fc-item:nth-child(1) { transition-delay: .05s; }
.fc-item:nth-child(2) { transition-delay: .12s; }
.fc-item:nth-child(3) { transition-delay: .19s; }

/* label pill */
.fc-label {
    background: linear-gradient(135deg, #ea580c, #f97316);
    color: #fff;
    font-size: 12px;
    font-weight: 600;
    padding: 5px 12px;
    border-radius: 999px;
    white-space: nowrap;
    box-shadow: 0 4px 14px rgba(234,88,12,0.35);
    transform: translateX(-6px);
    transition: transform .2s ease;
    line-height: 1.4;
}
.fc-label small {
    display: block;
    font-size: 10px;
    font-weight: 400;
    color: rgba(255,255,255,0.75);
    margin-top: 1px;
}
.fc-item:hover .fc-label { transform: translateX(0); }

/* icon circle */
.fc-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 6px 20px rgba(0,0,0,0.2);
    transition: transform .25s cubic-bezier(.34,1.56,.64,1), box-shadow .25s ease;
    position: relative;
}
.fc-item:hover .fc-icon {
    transform: scale(1.12);
    box-shadow: 0 10px 28px rgba(0,0,0,0.28);
}

.fc-icon--phone { background: linear-gradient(135deg,#22c55e,#16a34a); }
.fc-icon--zalo  { background: linear-gradient(135deg,#0068FF,#004dc2); }
.fc-icon--fb    { background: linear-gradient(135deg,#1877F2,#0c5ecf); }

.fc-icon svg { width: 24px; height: 24px; color: #fff; }

/* ripple on icon */
.fc-icon::after {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 50%;
    animation: fc-ripple 2.4s ease-out infinite;
    opacity: 0;
}
.fc-icon--phone::after { background: rgba(34,197,94,.45); }
.fc-icon--zalo::after  { background: rgba(0,104,255,.4); }
.fc-icon--fb::after    { background: rgba(24,119,242,.4); }

@keyframes fc-ripple {
    0%   { transform: scale(1);   opacity: .7; }
    100% { transform: scale(2.2); opacity: 0;  }
}

/* ===== TOGGLE BUTTON ===== */
.fc-toggle {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: linear-gradient(135deg,#ea580c,#f97316);
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 8px 28px rgba(234,88,12,.45);
    transition: transform .3s cubic-bezier(.34,1.56,.64,1), box-shadow .3s ease;
    position: relative;
    outline: none;
    flex-shrink: 0;
}
.fc-toggle:hover { transform: scale(1.1); box-shadow: 0 12px 36px rgba(234,88,12,.55); }
.fc-toggle.open  { transform: rotate(135deg); background: linear-gradient(135deg,#dc2626,#ef4444); }

.fc-toggle svg { width: 26px; height: 26px; color: #fff; transition: transform .3s; }

/* pulse ring */
.fc-toggle::before {
    content: '';
    position: absolute;
    inset: -4px;
    border-radius: 50%;
    border: 2px solid rgba(249,115,22,.55);
    animation: fc-pulse 2s ease-out infinite;
}
@keyframes fc-pulse {
    0%   { transform: scale(1);   opacity: 1; }
    100% { transform: scale(1.55);opacity: 0; }
}

/* ===== SCROLL TO TOP ===== */
.fc-top {
    position: fixed;
    bottom: 28px;
    right: 24px;
    z-index: 9998;
    width: 46px;
    height: 46px;
    border-radius: 50%;
    background: #fff;
    border: 2px solid #e5e7eb;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 18px rgba(0,0,0,0.12);
    transition: opacity .3s ease, transform .3s ease, box-shadow .3s ease;
    opacity: 0;
    transform: translateY(16px);
    pointer-events: none;
    outline: none;
}
.fc-top.show { opacity: 1; transform: translateY(0); pointer-events: auto; }
.fc-top:hover { box-shadow: 0 8px 24px rgba(0,0,0,.18); transform: translateY(-2px); }
.fc-top svg { width: 20px; height: 20px; color: #ea580c; }

/* notification dot */
.fc-dot {
    position: absolute;
    top: -2px; right: -2px;
    width: 14px; height: 14px;
    background: #ef4444;
    border-radius: 50%;
    border: 2px solid #fff;
    animation: fc-dot-blink 1.5s ease-in-out infinite;
}
@keyframes fc-dot-blink {
    0%,100% { opacity: 1; } 50% { opacity: .3; }
}

@media (max-width: 480px) {
    .fc-label { display: none; }
    .fc-icon  { width: 46px; height: 46px; }
    .fc-toggle { width: 52px; height: 52px; }
}
</style>

<!-- ===== Floating Contacts ===== -->
<div class="fc-wrap" id="fcWrap" aria-label="Liên hệ nhanh">

    <!-- Items (rendered bottom → top because flex-col-reverse via JS order) -->
    <div class="fc-list" id="fcList">
        <!-- Phone -->
        <a href="tel:0961549241" class="fc-item" id="fcPhone" aria-label="Gọi điện thoại">
            <div class="fc-label">Hotline<small>0961549241</small></div>
            <div class="fc-icon fc-icon--phone">
                <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498A1 1 0 0121 16.72V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                </svg>
            </div>
        </a>

        <!-- Zalo -->
        <a href="https://zalo.me/0961549241" target="_blank" rel="noopener" class="fc-item" id="fcZalo" aria-label="Chat Zalo">
            <div class="fc-label">Chat Zalo<small>Nhắn tin miễn phí</small></div>
            <div class="fc-icon fc-icon--zalo">
                <svg viewBox="0 0 48 48" fill="currentColor">
                    <path d="M24 4C12.95 4 4 12.95 4 24c0 3.83 1.07 7.41 2.92 10.45L4 44l9.87-2.87A19.88 19.88 0 0024 44c11.05 0 20-8.95 20-20S35.05 4 24 4zm8.25 27.25c-.37.37-1.12.75-2.25.75-1.5 0-3.75-.87-6.75-3.38-2.87-2.37-4.87-5.37-5.25-6-.37-.62-.5-1.25-.25-1.75.12-.25.37-.62.62-.87.5-.5 1.5-.75 1.75-.37.25.25.87 1.37 1.25 2 .37.62.25 1-.25 1.5-.25.25-.5.5-.37.87.25.5 1.5 2 2.75 3.12 1.5 1.37 2.87 2 3.5 2.25.5.12.87-.12 1.12-.5.25-.37.5-.87.87-1.25.37-.5.87-.5 1.37-.25.5.12 2.12 1 2.12 1.62.12.5.12 1.12-.23 1.24z"/>
                </svg>
            </div>
        </a>

        <!-- Facebook -->
        <a href="https://www.facebook.com/share/1Hqe9XVr9t/" target="_blank" rel="noopener" class="fc-item" id="fcFb" aria-label="Chat Facebook">
            <div class="fc-label">Facebook<small>Messenger</small></div>
            <div class="fc-icon fc-icon--fb">
                <svg viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2C6.477 2 2 6.145 2 11.243c0 2.908 1.438 5.504 3.688 7.205V22l3.379-1.854c.903.25 1.859.385 2.843.385 5.523 0 10-4.145 10-9.243S17.523 2 12 2zm1.03 12.437l-2.548-2.718-4.974 2.718 5.474-5.808 2.61 2.718 4.912-2.718-5.474 5.808z"/>
                </svg>
            </div>
        </a>
    </div>

    <!-- Toggle -->
    <button class="fc-toggle" id="fcToggle" aria-expanded="false" aria-controls="fcList" title="Liên hệ với chúng tôi">
        <!-- Chat icon (default) -->
        <svg id="fcIconChat" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
        </svg>
        <!-- Close icon (when open) -->
        <svg id="fcIconClose" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="display:none;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
        </svg>
        <span class="fc-dot" id="fcDot"></span>
    </button>
</div>

<!-- Scroll to top -->
<button class="fc-top" id="fcTop" aria-label="Lên đầu trang" title="Lên đầu trang">
    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/>
    </svg>
</button>

<script>
(function () {
    'use strict';

    const toggle   = document.getElementById('fcToggle');
    const list     = document.getElementById('fcList');
    const items    = list.querySelectorAll('.fc-item');
    const iconChat = document.getElementById('fcIconChat');
    const iconClose= document.getElementById('fcIconClose');
    const dot      = document.getElementById('fcDot');
    const btnTop   = document.getElementById('fcTop');

    let isOpen = false;
    let userInteracted = false;
    let autoTimer = null;

    // ── open / close ──────────────────────────────────────
    function open() {
        isOpen = true;
        toggle.classList.add('open');
        toggle.setAttribute('aria-expanded', 'true');
        iconChat.style.display  = 'none';
        iconClose.style.display = '';
        dot.style.display       = 'none';
        list.style.pointerEvents = 'auto';
        items.forEach(el => el.classList.add('visible'));
    }

    function close() {
        isOpen = false;
        toggle.classList.remove('open');
        toggle.setAttribute('aria-expanded', 'false');
        iconChat.style.display  = '';
        iconClose.style.display = 'none';
        list.style.pointerEvents = 'none';
        items.forEach(el => el.classList.remove('visible'));
    }

    function doToggle() {
        isOpen ? close() : open();
    }

    // ── toggle click ──────────────────────────────────────
    toggle.addEventListener('click', function (e) {
        e.stopPropagation();
        userInteracted = true;
        clearTimeout(autoTimer);
        doToggle();
    });

    // ── close on outside click ────────────────────────────
    document.addEventListener('click', function (e) {
        if (isOpen && !document.getElementById('fcWrap').contains(e.target)) {
            close();
        }
    });

    // ── close when a contact link is clicked ─────────────
    items.forEach(function (el) {
        el.addEventListener('click', function () {
            userInteracted = true;
            clearTimeout(autoTimer);
            setTimeout(close, 300);
        });
    });

    // ── auto open every 20s to entice customers ─────────
    function scheduleAutoOpen() {
        autoTimer = setTimeout(function () {
            if (!isOpen) {
                open();
                // auto close after 6s if user hasn't interacted
                autoTimer = setTimeout(function () {
                    if (isOpen && !userInteracted) {
                        close();
                    }
                    // schedule next cycle
                    scheduleAutoOpen();
                }, 6000);
            } else {
                // already open, try again later
                scheduleAutoOpen();
            }
        }, 20000);
    }
    scheduleAutoOpen();

    // ── keyboard: Escape closes ───────────────────────────
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && isOpen) close();
    });

    // ── scroll to top button ──────────────────────────────
    window.addEventListener('scroll', function () {
        if (window.scrollY > 320) {
            btnTop.classList.add('show');
        } else {
            btnTop.classList.remove('show');
        }
    }, { passive: true });

    btnTop.addEventListener('click', function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // ── phone ripple stagger ──────────────────────────────
    document.querySelectorAll('.fc-icon').forEach(function (icon, i) {
        icon.style.animationDelay = (i * 0.8) + 's';
    });
})();
</script>
