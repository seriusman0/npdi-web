/**
 * Navigasi mobile — tanpa dependensi eksternal.
 * Tombol & panel ditandai dengan data-nav-toggle / data-nav-panel.
 */
document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('[data-nav-toggle]');
    const panel = document.querySelector('[data-nav-panel]');
    if (!toggle || !panel) return;

    const iconOpen = toggle.querySelector('[data-icon-open]');
    const iconClose = toggle.querySelector('[data-icon-close]');

    const setOpen = (open) => {
        panel.hidden = !open;
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        if (iconOpen) iconOpen.hidden = open;
        if (iconClose) iconClose.hidden = !open;
    };

    toggle.addEventListener('click', () => {
        setOpen(panel.hidden);
    });

    panel.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => setOpen(false));
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !panel.hidden) {
            setOpen(false);
            toggle.focus();
        }
    });

    // Tutup otomatis saat layar diperbesar ke desktop.
    window.addEventListener('resize', () => {
        if (window.matchMedia('(min-width: 768px)').matches && !panel.hidden) {
            setOpen(false);
        }
    });
});
