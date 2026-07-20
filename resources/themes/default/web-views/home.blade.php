@extends('layouts.front-end.app')

@section('title', (request('filter') && request('filter') == 'top-vendors' ? translate('top_Stores') : "كل العقارات"))

@push('css_or_js')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800;900&display=swap" rel="stylesheet">

<style>
/* ═══════════════════════════════════════════════════════════
   DESIGN TOKENS
═══════════════════════════════════════════════════════════ */
:root {
    --primary:          #114b89;
    --primary-dark:     #0d3b6b;
    --primary-light:    #1a65b8;
    --secondary:        #0f5bd7;
    --secondary-light:  #3a7de8;
    --accent:           #14b86a;
    --accent-light:     #e6f9f0;
    --danger:           #ef4444;
    --warning:          #f59e0b;
    --bg:               #f0f4fb;
    --card:             #ffffff;
    --text:             #0f172a;
    --text-muted:       #64748b;
    --text-light:       #94a3b8;
    --border:           #e2e8f0;
    --border-hover:     #cbd5e1;

    --shadow-xs:  0 2px 8px rgba(15,23,42,.06);
    --shadow-sm:  0 4px 16px rgba(15,23,42,.08);
    --shadow-md:  0 12px 32px rgba(15,23,42,.10);
    --shadow-lg:  0 24px 64px rgba(15,23,42,.13);
    --shadow-xl:  0 40px 80px rgba(15,23,42,.16);

    --grad-primary:  linear-gradient(135deg, #0f5bd7, #114b89);
    --grad-dark:     linear-gradient(135deg, #0b1220, #114b89);
    --grad-card:     linear-gradient(145deg, #ffffff, #f8faff);

    --radius-xs: 10px;
    --radius-sm: 14px;
    --radius-md: 18px;
    --radius-lg: 24px;
    --radius-xl: 32px;

    --transition: .22s cubic-bezier(.4,0,.2,1);
    --font: 'Tajawal', 'Segoe UI', sans-serif;
}

/* ═══════════════════════════════════════════════════════════
   BASE
═══════════════════════════════════════════════════════════ */
*, *::before, *::after { box-sizing: border-box; }

body {
    font-family: var(--font);
    background: var(--bg);
    color: var(--text);
    background-image:
        radial-gradient(ellipse at top right, rgba(15,91,215,.07) 0%, transparent 55%),
        radial-gradient(ellipse at bottom left, rgba(17,75,137,.06) 0%, transparent 55%);
    background-attachment: fixed;
}

/* ═══════════════════════════════════════════════════════════
   PAGE LAYOUT
═══════════════════════════════════════════════════════════ */
.estate-index-page { padding: 28px 0 100px; }

/* ═══════════════════════════════════════════════════════════
   HERO
═══════════════════════════════════════════════════════════ */
.page-hero {
    position: relative;
    overflow: hidden;
    background: var(--grad-dark);
    border-radius: var(--radius-xl);
    padding: 32px 30px;
    margin-bottom: 22px;
    box-shadow: var(--shadow-xl);
    color: #fff;
}

.page-hero::before {
    content: "";
    position: absolute;
    inset: 0;
    background:
        radial-gradient(circle at 88% 18%, rgba(255,255,255,.13) 0%, transparent 28%),
        radial-gradient(circle at 12% 82%, rgba(255,255,255,.09) 0%, transparent 26%),
        radial-gradient(circle at 50% 110%, rgba(15,91,215,.3) 0%, transparent 50%);
    pointer-events: none;
}

.page-hero::after {
    content: "";
    position: absolute;
    top: -60px; right: -60px;
    width: 260px; height: 260px;
    border-radius: 50%;
    background: rgba(255,255,255,.04);
    border: 1px solid rgba(255,255,255,.08);
    pointer-events: none;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    border-radius: 999px;
    background: rgba(255,255,255,.13);
    border: 1px solid rgba(255,255,255,.16);
    backdrop-filter: blur(12px);
    font-size: .82rem;
    font-weight: 800;
    letter-spacing: .02em;
}

.hero-title {
    font-size: clamp(1.55rem, 3.5vw, 2.6rem);
    font-weight: 900;
    margin: 16px 0 8px;
    line-height: 1.45;
}

.hero-desc {
    color: rgba(255,255,255,.78);
    max-width: 720px;
    line-height: 1.9;
    font-size: .97rem;
}

.hero-actions { margin-top: 22px; }

.hero-map-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 22px;
    background: #fff;
    color: var(--primary);
    font-weight: 800;
    border-radius: var(--radius-md);
    text-decoration: none;
    box-shadow: 0 12px 30px rgba(0,0,0,.14);
    transition: var(--transition);
    font-size: .93rem;
}
.hero-map-btn:hover { transform: translateY(-2px); color: var(--primary-dark); box-shadow: 0 18px 38px rgba(0,0,0,.18); }

/* ═══════════════════════════════════════════════════════════
   SEARCH BAR  (inside hero)
═══════════════════════════════════════════════════════════ */
.search-shell {
    margin-top: 24px;
    display: flex;
    gap: 10px;
    background: rgba(255,255,255,.10);
    border: 1px solid rgba(255,255,255,.15);
    border-radius: 22px;
    padding: 10px;
    backdrop-filter: blur(14px);
}

.search-input-wrap { position: relative; flex: 1 1 0; }

.search-input-wrap i {
    position: absolute;
    top: 50%; transform: translateY(-50%);
    right: 16px;
    color: #94a3b8;
    font-size: .95rem;
    pointer-events: none;
}

.search-input {
    width: 100%;
    height: 52px;
    border: 1.5px solid transparent;
    border-radius: 16px;
    padding: 0 46px 0 16px;
    background: #fff;
    color: #111827;
    font-weight: 700;
    font-family: var(--font);
    font-size: .95rem;
    outline: none;
    transition: var(--transition);
}
.search-input:focus { border-color: var(--secondary); box-shadow: 0 0 0 3px rgba(15,91,215,.12); }

.search-open-filter {
    border: none;
    height: 52px;
    border-radius: 16px;
    padding: 0 22px;
    background: var(--grad-primary);
    color: #fff;
    font-weight: 800;
    font-family: var(--font);
    font-size: .92rem;
    display: inline-flex;
    align-items: center;
    gap: 9px;
    box-shadow: 0 8px 24px rgba(15,91,215,.28);
    transition: var(--transition);
    white-space: nowrap;
    cursor: pointer;
}
.search-open-filter:hover { transform: translateY(-1px); box-shadow: 0 12px 32px rgba(15,91,215,.35); }

/* ═══════════════════════════════════════════════════════════
   SECTION CARD
═══════════════════════════════════════════════════════════ */
.section-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow-md);
    overflow: hidden;
}

.section-head { padding: 24px 24px 0; }

.section-title {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 900;
    color: var(--text);
}

.section-subtitle {
    color: var(--text-muted);
    margin-top: 4px;
    font-size: .88rem;
}

/* ═══════════════════════════════════════════════════════════
   CATEGORIES
═══════════════════════════════════════════════════════════ */
.categories-scroll {
    padding: 18px 24px 22px;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
}
.categories-scroll::-webkit-scrollbar { display: none; }

.categories-row {
    display: flex;
    gap: 10px;
    min-width: max-content;
}

.category-chip {
    border: 1.5px solid var(--border);
    background: var(--card);
    color: var(--primary);
    border-radius: 999px;
    padding: 10px 18px;
    font-size: .88rem;
    font-weight: 800;
    font-family: var(--font);
    transition: var(--transition);
    white-space: nowrap;
    cursor: pointer;
}
.category-chip:hover { background: #eef3ff; border-color: var(--secondary); }
.category-chip.selected-category {
    background: var(--grad-primary);
    color: #fff;
    border-color: transparent;
    box-shadow: 0 8px 22px rgba(15,91,215,.22);
}

/* ═══════════════════════════════════════════════════════════
   RESULTS TOOLBAR
═══════════════════════════════════════════════════════════ */
.results-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    flex-wrap: wrap;
    padding: 22px 24px 0;
}

.results-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 9px 16px;
    border-radius: 999px;
    background: #f1f5ff;
    border: 1.5px solid #dbeafe;
    color: var(--primary);
    font-weight: 800;
    font-size: .88rem;
}

/* ═══════════════════════════════════════════════════════════
   ESTATE GRID & CARDS
═══════════════════════════════════════════════════════════ */
.estate-grid { padding: 20px 24px 24px; }

.estate-card {
    position: relative;
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 24px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: var(--transition);
    height: 100%;
    display: flex;
    flex-direction: column;
    text-decoration: none;
    color: inherit;
}
.estate-card:hover {
    transform: translateY(-7px);
    box-shadow: var(--shadow-lg);
    border-color: var(--border-hover);
    color: inherit;
}

.estate-media { position: relative; height: 250px; background: #e5e7eb; overflow: hidden; }

.estate-swiper {
    display: flex;
    width: 100%; height: 100%;
    overflow: hidden;
    position: relative;
    touch-action: pan-y;
}

.estate-swiper img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
    position: absolute; inset: 0;
    opacity: 0;
    transition: opacity .35s ease;
}
.estate-swiper img.active { opacity: 1; }

.estate-overlay-top {
    position: absolute;
    top: 14px; right: 14px; left: 14px;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 10px;
    z-index: 3;
}

.estate-badges { display: flex; flex-wrap: wrap; gap: 7px; }

.estate-badge {
    background: rgba(255,255,255,.92);
    color: #0f172a;
    padding: 7px 11px;
    border-radius: 999px;
    font-size: .72rem;
    font-weight: 900;
    box-shadow: 0 4px 14px rgba(0,0,0,.09);
    display: inline-flex;
    align-items: center;
    gap: 5px;
    backdrop-filter: blur(12px);
}

.estate-actions { display: flex; gap: 8px; }

.estate-icon-btn {
    width: 38px; height: 38px;
    border: none;
    border-radius: 50%;
    background: rgba(255,255,255,.92);
    box-shadow: 0 4px 14px rgba(0,0,0,.09);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
    padding: 0;
    backdrop-filter: blur(12px);
    cursor: pointer;
}
.estate-icon-btn:hover { transform: scale(1.08); }
.estate-icon-btn img, .estate-icon-btn i { width: 17px; height: 17px; object-fit: contain; color: #0f172a; }

.estate-counter {
    position: absolute;
    bottom: 14px; left: 14px;
    z-index: 3;
    background: rgba(0,0,0,.52);
    color: #fff;
    font-size: .74rem;
    font-weight: 800;
    border-radius: 999px;
    padding: 7px 10px;
    backdrop-filter: blur(10px);
    display: flex;
    align-items: center;
    gap: 5px;
}

.estate-body {
    padding: 18px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    flex: 1;
}

.estate-price-box {
    display: inline-flex;
    flex-direction: column;
    gap: 4px;
    width: fit-content;
    max-width: 100%;
    background: linear-gradient(135deg, rgba(8,26,51,.97), rgba(12,49,91,.97));
    color: #fff;
    border-radius: 16px;
    padding: 12px 16px;
    box-shadow: 0 10px 22px rgba(8,26,51,.2);
}

.estate-price-main {
    font-size: 1.05rem;
    font-weight: 900;
    line-height: 1.4;
    color: #fff;
    display: flex;
    align-items: center;
    gap: 5px;
}

.estate-price-sub { font-size: .74rem; opacity: .78; color: rgba(255,255,255,.78); }

.estate-title-row {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 10px;
}

.estate-type { font-weight: 900; font-size: 1rem; color: var(--text); line-height: 1.5; }
.estate-zone { color: var(--text-muted); font-size: .86rem; font-weight: 700; margin-top: 2px; }

.estate-address { color: #64748b; font-size: .84rem; line-height: 1.7; min-height: 44px; }

.estate-features { display: flex; flex-wrap: wrap; gap: 7px; margin-top: auto; }

.estate-feature {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 12px;
    background: #f8fafc;
    border: 1.5px solid var(--border);
    border-radius: 999px;
    font-size: .8rem;
    font-weight: 800;
    color: #334155;
}
.estate-feature img { width: 14px; height: 14px; object-fit: contain; }

/* ═══════════════════════════════════════════════════════════
   LOADING
═══════════════════════════════════════════════════════════ */
.loading-wrap {
    display: none;
    position: fixed;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    z-index: 9999;
}

.loading-box {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 20px;
    box-shadow: var(--shadow-lg);
    padding: 18px 24px;
    display: flex;
    align-items: center;
    gap: 12px;
    font-weight: 800;
    color: #334155;
    font-family: var(--font);
}

/* ═══════════════════════════════════════════════════════════
   FILTER MODAL  ← الجزء المُحسَّن بالكامل
═══════════════════════════════════════════════════════════ */
.filter-modal .modal-content {
    border: none;
    border-radius: 28px;
    overflow: hidden;
    box-shadow: var(--shadow-xl);
    background: var(--card);
}

/* Header */
.filter-modal-header {
    background: var(--grad-dark);
    padding: 22px 26px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    position: relative;
    overflow: hidden;
}

.filter-modal-header::before {
    content: "";
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 80% 30%, rgba(255,255,255,.1), transparent 40%);
    pointer-events: none;
}

.filter-modal-header-inner {
    display: flex;
    align-items: center;
    gap: 14px;
    position: relative;
}

.filter-modal-icon {
    width: 46px; height: 46px;
    background: rgba(255,255,255,.14);
    border: 1px solid rgba(255,255,255,.18);
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
    flex-shrink: 0;
}
.filter-modal-icon i { color: #fff; font-size: 1.1rem; }

.filter-modal-title { color: #fff; font-size: 1.15rem; font-weight: 900; margin: 0; line-height: 1.3; }
.filter-modal-subtitle { color: rgba(255,255,255,.72); font-size: .82rem; font-weight: 600; margin-top: 2px; }

.filter-close-btn {
    width: 38px; height: 38px;
    background: rgba(255,255,255,.14);
    border: 1px solid rgba(255,255,255,.18);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: var(--transition);
    position: relative;
    flex-shrink: 0;
}
.filter-close-btn:hover { background: rgba(255,255,255,.24); }
.filter-close-btn i { color: #fff; font-size: .9rem; }

/* Body */
.filter-modal-body { padding: 28px; overflow-y: auto; max-height: calc(100vh - 280px); }

/* Section headers inside filter */
.filter-section-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: .82rem;
    font-weight: 900;
    color: var(--primary);
    text-transform: uppercase;
    letter-spacing: .06em;
    margin-bottom: 16px;
    padding-bottom: 10px;
    border-bottom: 2px solid #eef3ff;
}
.filter-section-label i { font-size: .85rem; }

/* Grid */
.filter-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
    margin-bottom: 26px;
}

/* Field */
.filter-field { display: flex; flex-direction: column; gap: 7px; }

.filter-label {
    font-weight: 800;
    font-size: .88rem;
    color: #334155;
    display: flex;
    align-items: center;
    gap: 7px;
}
.filter-label i { color: var(--secondary); font-size: .85rem; }

/* Inputs & Selects */
.filter-control {
    width: 100%;
    min-height: 50px;
    border: 1.5px solid var(--border);
    border-radius: 14px;
    padding: 0 14px;
    background: #f8fafd;
    color: var(--text);
    font-weight: 700;
    font-family: var(--font);
    font-size: .9rem;
    outline: none;
    transition: var(--transition);
    appearance: none;
    -webkit-appearance: none;
}
.filter-control:focus {
    border-color: var(--secondary);
    background: #fff;
    box-shadow: 0 0 0 4px rgba(15,91,215,.1);
}

/* Select arrow */
.filter-select-wrap { position: relative; }
.filter-select-wrap::after {
    content: "\f107";
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    position: absolute;
    top: 50%; transform: translateY(-50%);
    left: 14px;
    color: var(--text-muted);
    font-size: .85rem;
    pointer-events: none;
}
.filter-control.select { padding-left: 36px; padding-right: 14px; cursor: pointer; }

/* Number input with unit */
.filter-number-wrap { position: relative; }
.filter-number-unit {
    position: absolute;
    top: 50%; transform: translateY(-50%);
    left: 14px;
    font-size: .78rem;
    font-weight: 800;
    color: var(--text-muted);
    background: #eef3ff;
    border-radius: 6px;
    padding: 3px 7px;
}
.filter-control.number { padding-left: 56px; }

/* Toggle switches row */
.filter-toggles-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-bottom: 10px;
}

.filter-toggle-card {
    background: #f8fafd;
    border: 1.5px solid var(--border);
    border-radius: 16px;
    padding: 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    cursor: pointer;
    transition: var(--transition);
}
.filter-toggle-card:hover { border-color: var(--secondary); background: #f0f6ff; }
.filter-toggle-card.active { border-color: var(--secondary); background: #eef4ff; box-shadow: 0 0 0 3px rgba(15,91,215,.08); }

.filter-toggle-info { display: flex; align-items: center; gap: 11px; }

.filter-toggle-icon {
    width: 38px; height: 38px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: .95rem;
}
.filter-toggle-icon.offers  { background: #fef3e2; color: #d97706; }
.filter-toggle-icon.vt      { background: #e0faf0; color: #059669; }

.filter-toggle-text-label { font-size: .88rem; font-weight: 800; color: var(--text); }
.filter-toggle-text-sub   { font-size: .74rem; color: var(--text-muted); font-weight: 600; margin-top: 2px; }

/* Custom switch */
.custom-switch-wrap { position: relative; display: inline-block; width: 46px; height: 26px; }
.custom-switch-wrap input { opacity: 0; width: 0; height: 0; }
.custom-switch-slider {
    position: absolute; inset: 0;
    background: #cbd5e1;
    border-radius: 999px;
    cursor: pointer;
    transition: var(--transition);
}
.custom-switch-slider::before {
    content: "";
    position: absolute;
    width: 20px; height: 20px;
    border-radius: 50%;
    background: #fff;
    top: 3px; right: 3px;
    box-shadow: 0 2px 6px rgba(0,0,0,.18);
    transition: var(--transition);
}
.custom-switch-wrap input:checked + .custom-switch-slider { background: var(--secondary); }
.custom-switch-wrap input:checked + .custom-switch-slider::before { right: 23px; }

/* Footer */
.filter-modal-footer {
    padding: 16px 28px 24px;
    display: flex;
    align-items: center;
    gap: 12px;
    border-top: 1px solid var(--border);
    background: #f8fafd;
}

.filter-btn-reset {
    border: 1.5px solid var(--border);
    background: #fff;
    color: var(--text-muted);
    font-weight: 800;
    font-family: var(--font);
    font-size: .9rem;
    border-radius: 14px;
    padding: 12px 20px;
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    transition: var(--transition);
}
.filter-btn-reset:hover { border-color: var(--danger); color: var(--danger); background: #fff5f5; }

.filter-btn-apply {
    flex: 1;
    border: none;
    background: var(--grad-primary);
    color: #fff;
    font-weight: 900;
    font-family: var(--font);
    font-size: .95rem;
    border-radius: 14px;
    padding: 14px 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 9px;
    cursor: pointer;
    transition: var(--transition);
    box-shadow: 0 8px 22px rgba(15,91,215,.25);
}
.filter-btn-apply:hover { transform: translateY(-1px); box-shadow: 0 12px 28px rgba(15,91,215,.32); }

/* Active filters bar */
.active-filters-bar {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    padding: 14px 24px 0;
    min-height: 0;
    transition: var(--transition);
}
.active-filters-bar:empty { padding: 0; }

.active-filter-tag {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 7px 12px;
    background: #eef4ff;
    border: 1.5px solid #c7d9f8;
    color: var(--primary);
    border-radius: 999px;
    font-size: .78rem;
    font-weight: 800;
    font-family: var(--font);
}
.active-filter-tag button {
    border: none;
    background: none;
    color: var(--primary);
    padding: 0;
    display: flex;
    align-items: center;
    cursor: pointer;
    font-size: .72rem;
    opacity: .7;
    transition: var(--transition);
}
.active-filter-tag button:hover { opacity: 1; color: var(--danger); }

/* ═══════════════════════════════════════════════════════════
   GALLERY MODAL
═══════════════════════════════════════════════════════════ */
.gallery-modal .modal-content {
    border: none;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: var(--shadow-xl);
}

.gallery-modal .modal-header {
    background: var(--grad-dark);
    color: #fff;
    border: none;
    padding: 16px 22px;
}

.gallery-modal .btn-close { filter: invert(1); }

.fullscreen-gallery {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 12px;
}

.fullscreen-gallery img {
    width: 100%;
    height: 230px;
    object-fit: cover;
    border-radius: 16px;
    transition: var(--transition);
}
.fullscreen-gallery img:hover { transform: scale(1.02); }

/* ═══════════════════════════════════════════════════════════
   EMPTY STATE
═══════════════════════════════════════════════════════════ */
.empty-state {
    text-align: center;
    padding: 60px 24px;
    color: var(--text-muted);
    font-weight: 700;
}
.empty-state i { font-size: 2.4rem; margin-bottom: 12px; display: block; color: #c0cfe0; }
.empty-state p { font-size: .95rem; margin: 0; }

/* ═══════════════════════════════════════════════════════════
   MOBILE BOTTOM BAR
═══════════════════════════════════════════════════════════ */
.mobile-actions-bar {
    position: fixed;
    bottom: 12px; left: 12px; right: 12px;
    z-index: 1000;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    background: rgba(255,255,255,.94);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
    border: 1px solid rgba(255,255,255,.85);
    box-shadow: 0 16px 44px rgba(15,23,42,.16);
    border-radius: 22px;
    padding: 10px;
}

.mobile-actions-bar a,
.mobile-actions-bar button {
    border: none;
    background: #f1f5ff;
    border-radius: 14px;
    padding: 12px 8px;
    font-weight: 800;
    font-family: var(--font);
    color: var(--primary);
    text-align: center;
    text-decoration: none;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 5px;
    font-size: .78rem;
    cursor: pointer;
    transition: var(--transition);
}
.mobile-actions-bar a:hover, .mobile-actions-bar button:hover { background: #dbeafe; color: var(--primary-dark); }
.mobile-actions-bar i { font-size: .95rem; }

/* ═══════════════════════════════════════════════════════════
   RESPONSIVE
═══════════════════════════════════════════════════════════ */
@media (max-width: 992px) {
    .search-shell { flex-direction: column; }
    .search-open-filter { width: 100%; justify-content: center; }
}

@media (max-width: 768px) {
    .estate-index-page { padding: 18px 0 112px; }
    .page-hero { border-radius: 22px; padding: 20px 18px; }
    .hero-title { font-size: 1.4rem; }
    .hero-desc { font-size: .88rem; }
    .hero-map-btn { width: 100%; justify-content: center; }

    .search-input { height: 48px; }
    .search-open-filter { height: 48px; }

    .section-card { border-radius: 22px; }
    .section-head,
    .results-toolbar,
    .estate-grid,
    .categories-scroll { padding-left: 16px; padding-right: 16px; }

    .estate-card { border-radius: 20px; }
    .estate-media { height: 210px; }
    .estate-overlay-top { top: 10px; right: 10px; left: 10px; }
    .estate-badge {
        padding: 6px 9px;
        font-size: .69rem;
        background: rgba(15,23,42,.72);
        color: #fff;
        border: 1px solid rgba(255,255,255,.12);
    }
    .estate-icon-btn { width: 35px; height: 35px; background: rgba(15,23,42,.72); }
    .estate-icon-btn i { color: #fff; }
    .estate-body { padding: 14px; gap: 10px; }
    .estate-price-box { width: 100%; }
    .estate-address { min-height: auto; }

    /* Filter modal responsive */
    .filter-grid { grid-template-columns: 1fr; gap: 14px; }
    .filter-toggles-grid { grid-template-columns: 1fr; }
    .filter-modal-body { padding: 20px; max-height: calc(100vh - 240px); }
    .filter-modal-footer { padding: 14px 20px 20px; }
    .filter-modal .modal-dialog { margin: 10px; }

    .fullscreen-gallery { grid-template-columns: 1fr; }

    .mobile-actions-bar { display: grid !important; }
}

@media (min-width: 769px) {
    .mobile-actions-bar { display: none !important; }
}
</style>
@endpush

@section('content')
<div class="estate-index-page">
    <div class="container mb-md-4 {{ Session::get('direction') === 'rtl' ? 'rtl' : '' }} __inline-65">

        {{-- ── HERO ── --}}
        <div class="page-hero">
            <span class="hero-badge">
                <i class="fa-solid fa-city"></i>
                {{ translate('all_properties') ?? 'كل العقارات' }}
            </span>

<h1 class="hero-title" style="color: white;">
    اكتشف العقارات بطريقة أجمل وأكثر احترافية
</h1>

            <p class="hero-desc">
                تصفح العقارات، استخدم الفلاتر الذكية، وابحث في الخريطة أو حسب الفئة والمنطقة والمدينة والحي بسهولة.
            </p>

            <div class="hero-actions">
                <a href="{{ route('map') }}" class="hero-map-btn">
                    <i class="fas fa-map-marker-alt"></i>
                    {{ translate("search in map") }}
                </a>
            </div>

            @if(request('filter'))
                <input type="hidden" name="filter" value="{{ request('filter') }}">
            @endif

            <div class="search-shell">
                <div class="search-input-wrap">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text"
                           id="filterInput"
                           class="search-input"
                           value="{{ request('estate_name') }}"
                           placeholder="{{ translate('Search_property') ?? 'ابحث عن عقار...' }}"
                           name="shop_name"
                           readonly>
                </div>
                <button type="button" class="search-open-filter" id="searchButton">
                    <i class="fa-solid fa-sliders"></i>
                    {{ translate('filter_search') ?? 'بحث وفلترة' }}
                </button>
            </div>
        </div>

        {{-- ── ACTIVE FILTER TAGS ── --}}
        <div id="active-filters-bar" class="active-filters-bar mb-3"></div>

        {{-- ── CATEGORIES ── --}}
        <div class="section-card mb-4">
            <div class="section-head">
                <h3 class="section-title">التصنيفات</h3>
                <div class="section-subtitle">اختيار سريع للتصفية حسب نوع العقار</div>
            </div>
            <div class="categories-scroll">
                <div id="categories-container" class="categories-row"></div>
            </div>
        </div>

        {{-- ── RESULTS ── --}}
        <div class="section-card">
            <div class="results-toolbar">
                <div class="results-badge">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>نتائج العقارات</span>
                </div>
                <div id="error-message" class="text-danger fw-bold" style="font-size:.85rem;"></div>
            </div>

            <div id="estate-cards-container" class="row estate-grid"></div>
        </div>

    </div>
</div>

{{-- ── LOADING ── --}}
<div id="loadingIndicator" class="loading-wrap">
    <div class="loading-box">
        <div class="spinner-border text-primary" role="status" style="width:22px;height:22px;border-width:2.5px;"></div>
        <span>جاري تحميل العقارات...</span>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════════
     FILTER MODAL  ← المُحسَّن
══════════════════════════════════════════════════════════ --}}
<div class="modal fade filter-modal" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            {{-- Header --}}
            <div class="filter-modal-header">
                <div class="filter-modal-header-inner">
                    <div class="filter-modal-icon">
                        <i class="fa-solid fa-sliders"></i>
                    </div>
                    <div>
                        <div class="filter-modal-title">{{ translate('filter_search') ?? 'بحث وفلترة' }}</div>
                        <div class="filter-modal-subtitle">حدد معايير البحث لإيجاد عقارك المثالي</div>
                    </div>
                </div>
                <button type="button" class="filter-close-btn" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            {{-- Body --}}
            <div class="filter-modal-body">

                {{-- Section: Location --}}
                <div class="filter-section-label">
                    <i class="fa-solid fa-location-dot"></i>
                    الموقع الجغرافي
                </div>

                <div class="filter-grid">
                    <div class="filter-field">
                        <label class="filter-label" for="zone">
                            <i class="fa-solid fa-map"></i>
                            {{ translate('zone') ?? 'المنطقة' }}
                        </label>
                        <div class="filter-select-wrap">
                            <select class="filter-control select" id="zone" name="zone">
                                <option value="">{{ translate('اختر المنطقة') ?? 'اختر المنطقة' }}</option>
                                @foreach($zone as $z)
                                    <option value="{{ $z->region_id }}">
                                        {{ app()->getLocale() === 'ar' ? $z->name_ar : $z->name_en }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="filter-field">
                        <label class="filter-label" for="city">
                            <i class="fa-solid fa-city"></i>
                            {{ translate('city') ?? 'المدينة' }}
                        </label>
                        <div class="filter-select-wrap">
                            <select class="filter-control select" id="city" name="city">
                                <option value="">{{ translate('select_city') ?? 'اختر المدينة' }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="filter-field">
                        <label class="filter-label" for="district">
                            <i class="fa-solid fa-house-flag"></i>
                            {{ translate('district') ?? 'الحي' }}
                        </label>
                        <div class="filter-select-wrap">
                            <select class="filter-control select" id="district" name="district">
                                <option value="">{{ translate('select_district') ?? 'اختر الحي' }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="filter-field">
                        <label class="filter-label" for="category">
                            <i class="fa-solid fa-tag"></i>
                            {{ translate('category') ?? 'التصنيف' }}
                        </label>
                        <div class="filter-select-wrap">
                            <select class="filter-control select" id="category" name="category">
                                <option value="">{{ translate('select_category') ?? 'اختر التصنيف' }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Section: Specs --}}
                <div class="filter-section-label">
                    <i class="fa-solid fa-ruler-combined"></i>
                    المواصفات
                </div>

                <div class="filter-grid" style="grid-template-columns: 1fr; margin-bottom: 24px;">
                    <div class="filter-field">
                        <label class="filter-label" for="area_min">
                            <i class="fa-solid fa-vector-square"></i>
                            {{ translate('min_area') ?? 'أقل مساحة' }}
                        </label>
                        <div class="filter-number-wrap">
                            <span class="filter-number-unit">م²</span>
                            <input type="number"
                                   class="filter-control number"
                                   id="area_min"
                                   name="area_min"
                                   placeholder="{{ translate('enter_min_area') ?? 'أدخل أقل مساحة' }}">
                        </div>
                    </div>
                </div>

                {{-- Section: Options --}}
                <div class="filter-section-label">
                    <i class="fa-solid fa-star"></i>
                    خيارات إضافية
                </div>

                <div class="filter-toggles-grid">
                    <label class="filter-toggle-card" id="offersCard" for="customSwitch1">
                        <div class="filter-toggle-info">
                            <div class="filter-toggle-icon offers">
                                <i class="fa-solid fa-tags"></i>
                            </div>
                            <div>
                                <div class="filter-toggle-text-label">{{ translate('property_offers') ?? 'عروض العقارات' }}</div>
                                <div class="filter-toggle-text-sub">عقارات بها عروض خاصة</div>
                            </div>
                        </div>
                        <label class="custom-switch-wrap">
                            <input type="checkbox" id="customSwitch1">
                            <span class="custom-switch-slider"></span>
                        </label>
                    </label>

                    <label class="filter-toggle-card" id="vtCard" for="virtual_tour">
                        <div class="filter-toggle-info">
                            <div class="filter-toggle-icon vt">
                                <i class="fa-solid fa-vr-cardboard"></i>
                            </div>
                            <div>
                                <div class="filter-toggle-text-label">{{ translate('virtual_tour_available') ?? 'جولة افتراضية' }}</div>
                                <div class="filter-toggle-text-sub">عرض ثلاثي الأبعاد للعقار</div>
                            </div>
                        </div>
                        <label class="custom-switch-wrap">
                            <input type="checkbox" id="virtual_tour">
                            <span class="custom-switch-slider"></span>
                        </label>
                    </label>
                </div>

            </div>{{-- /filter-modal-body --}}

            {{-- Footer --}}
            <div class="filter-modal-footer">
                <button type="button" class="filter-btn-reset" id="resetFilter">
                    <i class="fa-solid fa-rotate-right"></i>
                    إعادة تعيين
                </button>
                <button type="button" class="filter-btn-apply" id="applyFilter">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    عرض النتائج
                </button>
            </div>

        </div>
    </div>
</div>

{{-- ── GALLERY MODAL ── --}}
<div class="modal fade gallery-modal" id="mediaGalleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">معرض الصور</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
            </div>
            <div class="modal-body p-4" id="mediaGalleryModalBody"></div>
        </div>
    </div>
</div>

{{-- ── MOBILE BOTTOM BAR ── --}}
<div class="mobile-actions-bar">
    <button type="button" onclick="document.getElementById('searchButton').click()">
        <i class="fa-solid fa-sliders"></i>
        فلترة
    </button>
    <a href="{{ route('map') }}">
        <i class="fa-solid fa-map-location-dot"></i>
        الخريطة
    </a>
    <button type="button" onclick="window.scrollTo({top:0, behavior:'smooth'})">
        <i class="fa-solid fa-arrow-up"></i>
        أعلى
    </button>
</div>
@endsection

@push('script')
<script>
$(document).ready(function () {

    let currentLang   = '{{ app()->getLocale() }}';
    let filterModal   = new bootstrap.Modal(document.getElementById('filterModal'));
    let activeFilters = {};   /* { key: { label, value } } */

    /* ─── Helpers ─── */
    function showLoading() { $('#loadingIndicator').show(); }
    function hideLoading() { $('#loadingIndicator').hide(); }

    function formatLargeNumber(number) {
        number = Number(number || 0);
        if (number >= 1000000) return (number / 1000000).toFixed(1) + " مليون";
        if (number >= 1000)    return (number / 1000).toFixed(1)    + " ألف";
        return number.toLocaleString();
    }

    function getPropertyMeta(property, lang) {
        let iconPath     = '{{ asset("public/assets/images/default.png") }}';
        let propertyName = property.name;

        const map = {
            'حمام':     { ar: 'حمام',       en: 'Bathroom',      icon: 'bathroom.png' },
            'غرف نوم':  { ar: 'غرف نوم',    en: 'Bedrooms',      icon: 'bed.png' },
            'صالات':    { ar: 'صالات',      en: 'Living Rooms',  icon: 'setroom.png' },
            'مطبخ':     { ar: 'مطبخ',       en: 'Kitchen',       icon: 'kitchen.png' },
        };

        if (map[property.name]) {
            propertyName = lang === 'en' ? map[property.name].en : map[property.name].ar;
            iconPath = '{{ asset("public/assets/images/") }}/' + map[property.name].icon;
        }

        return { iconPath, propertyName };
    }

    function buildPriceBox(estate) {
        const ryal = `<img src="{{ asset('public/assets/images/ryal.png') }}" alt="ر.س" style="width:13px;height:13px;filter:brightness(0) invert(1);">`;

        if (estate.category_name === 'ارض') {
            return `
                <div class="estate-price-box">
                    <div class="estate-price-main">${formatLargeNumber((estate.price||0)*(estate.space||0))} ${ryal}</div>
                    <div class="estate-price-sub">الإجمالي</div>
                    <div class="estate-price-main" style="margin-top:8px;">${formatLargeNumber(estate.price)} ${ryal}</div>
                    <div class="estate-price-sub">سعر المتر</div>
                </div>`;
        }

        return `
            <div class="estate-price-box">
                <div class="estate-price-main">${formatLargeNumber(estate.price)} ${ryal}</div>
                <div class="estate-price-sub">السعر الإجمالي</div>
            </div>`;
    }

    function renderEstateCard(estate, colClass, lang, favoriteEstates) {
        const redIcon    = '{{ asset("public/assets/images/favorite-icon-red.png") }}';
        const defaultIcon= '{{ asset("public/assets/images/favorite-icon.png") }}';
        const offerIcon  = '{{ asset("public/assets/images/offer_icon.png") }}';
        const vtIcon     = '{{ asset("public/assets/images/vt_offer.png") }}';
        const zoneName   = (lang === 'ar' && estate.zone_name_ar) ? estate.zone_name_ar : estate.zone_name;
        const isFav      = estate.is_favorited || favoriteEstates.includes(estate.id);
        const iconSrc    = isFav ? redIcon : defaultIcon;

        let images    = Array.isArray(estate.images) && estate.images.length ? estate.images : ['default'];
        let imageUrls = images.map(p => p === 'default'
            ? '{{ asset("public/assets/images/default-estate.jpg") }}'
            : `{{ $r2Base }}/estate/${p}`);

        let imagesHtml = imageUrls.map((src, i) => `
            <img class="${i === 0 ? 'active' : ''}"
                 src="${src}"
                 alt="صورة العقار"
                 onerror="this.src='{{ asset('public/assets/images/default-estate.jpg') }}'">
        `).join('');

        let propertiesHtml = '';
        if (estate.category != "5" && Array.isArray(estate.property)) {
            propertiesHtml = estate.property.map(prop => {
                const meta = getPropertyMeta(prop, lang);
                return `<span class="estate-feature">
                    <img src="${meta.iconPath}" alt="${meta.propertyName}">
                    <span>${prop.number}</span>
                    <span>${meta.propertyName}</span>
                </span>`;
            }).join('');
        }

        return `
        <div class="${colClass} pb-4">
            <a href="/details/${estate.id}" class="estate-card">
                <div class="estate-media">
                    <div class="estate-swiper auto-swiper">
                        ${imagesHtml}
                    </div>

                    <div class="estate-overlay-top">
                        <div class="estate-badges">
                            ${estate.service_offers && estate.service_offers.length > 0
                                ? `<span class="estate-badge"><img src="${offerIcon}" style="width:13px;height:13px;"> عروض</span>`
                                : ''}
                            ${estate.ar_path
                                ? `<span class="estate-badge"><img src="${vtIcon}" style="width:13px;height:13px;"> جولة 360°</span>`
                                : ''}
                        </div>
                        <div class="estate-actions">
                            <button class="estate-icon-btn open-gallery-btn" type="button"
                                    data-images='${JSON.stringify(imageUrls)}'>
                                <i class="fa-solid fa-expand"></i>
                            </button>
                            <button class="estate-icon-btn favorite-btn" type="button"
                                    data-estate-id="${estate.id}" title="المفضلة">
                                <img src="${iconSrc}" alt="مفضلة">
                            </button>
                        </div>
                    </div>

                    <div class="estate-counter">
                        <i class="fa-regular fa-image"></i> ${images.length}
                    </div>
                </div>

                <div class="estate-body">
                    ${buildPriceBox(estate)}

                    <div class="estate-title-row">
                        <div>
                            <div class="estate-type">${estate.category_name || ''}</div>
                            <div class="estate-zone">${zoneName || ''}</div>
                        </div>
                    </div>

                    <div class="estate-address">${estate.address || ''}</div>

                    ${propertiesHtml ? `<div class="estate-features">${propertiesHtml}</div>` : ''}
                </div>
            </a>
        </div>`;
    }

    /* ─── Swipers ─── */
    function initAutoSwipers() {
        $('.auto-swiper').each(function () {
            const $c   = $(this);
            const $imgs = $c.find('img');
            if ($imgs.length <= 1) return;

            let current = 0;
            setInterval(function () {
                if (window.innerWidth <= 768) return;
                $imgs.removeClass('active');
                current = (current + 1) % $imgs.length;
                $imgs.eq(current).addClass('active');
            }, 2600);
        });
    }

    function initTouchSwiper() {
        $('.auto-swiper').each(function () {
            const container = this;
            const imgs      = $(container).find('img');
            if (imgs.length <= 1) return;

            let current = 0, startX = 0;

            container.addEventListener('touchstart', e => { startX = e.changedTouches[0].clientX; }, { passive: true });
            container.addEventListener('touchend',   e => {
                const diff = startX - e.changedTouches[0].clientX;
                if (Math.abs(diff) > 40) {
                    current = diff > 0
                        ? (current + 1) % imgs.length
                        : (current - 1 + imgs.length) % imgs.length;
                    imgs.removeClass('active').eq(current).addClass('active');
                }
            }, { passive: true });
        });
    }

    /* ─── Toggle card active state ─── */
    $('#customSwitch1').on('change', function () {
        $('#offersCard').toggleClass('active', this.checked);
    });
    $('#virtual_tour').on('change', function () {
        $('#vtCard').toggleClass('active', this.checked);
    });

    /* ─── Active filters bar ─── */
    function renderActiveTags() {
        const $bar = $('#active-filters-bar');
        $bar.empty();

        Object.entries(activeFilters).forEach(([key, { label }]) => {
            $bar.append(`
                <span class="active-filter-tag">
                    ${label}
                    <button type="button" data-key="${key}">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </span>`);
        });
    }

    $(document).on('click', '#active-filters-bar .active-filter-tag button', function () {
        const key = $(this).data('key');
        delete activeFilters[key];
        renderActiveTags();

        /* sync UI */
        if (key === 'zone')       { $('#zone').val(''); $('#city').val(''); $('#district').val(''); }
        else if (key === 'city')  { $('#city').val(''); $('#district').val(''); }
        else if (key === 'district') { $('#district').val(''); }
        else if (key === 'category') { $('#category').val(''); }
        else if (key === 'area_min') { $('#area_min').val(''); }
        else if (key === 'offers')   { $('#customSwitch1').prop('checked', false).trigger('change'); }
        else if (key === 'vt')       { $('#virtual_tour').prop('checked', false).trigger('change'); }

        loadEstatesFiltered();
    });

    /* ─── Open / close modal ─── */
    function openFilterModal() { filterModal.show(); }
    $('#searchButton').on('click', e => { e.preventDefault(); openFilterModal(); });
    $('#filterInput').on('click', openFilterModal);

    /* ─── Reset ─── */
    $('#resetFilter').on('click', function () {
        $('#zone, #city, #district, #category').val('');
        $('#area_min').val('');
        $('#customSwitch1, #virtual_tour').prop('checked', false).trigger('change');
        activeFilters = {};
        renderActiveTags();
        $('#filterInput').val('');
    });

    /* ─── Apply ─── */
    $('#applyFilter').on('click', function () {
        const zoneVal    = $('#zone').val();
        const cityVal    = $('#city').val();
        const districtVal= $('#district').val();
        const catVal     = $('#category').val();
        const areaMin    = $('#area_min').val();
        const offers     = $('#customSwitch1').is(':checked');
        const vt         = $('#virtual_tour').is(':checked');

        activeFilters = {};

        if (zoneVal)    activeFilters['zone']     = { label: $('#zone option:selected').text(), value: zoneVal };
        if (cityVal)    activeFilters['city']     = { label: $('#city option:selected').text(), value: cityVal };
        if (districtVal)activeFilters['district'] = { label: $('#district option:selected').text(), value: districtVal };
        if (catVal)     activeFilters['category'] = { label: $('#category option:selected').text(), value: catVal };
        if (areaMin)    activeFilters['area_min'] = { label: `أقل مساحة: ${areaMin} م²`, value: areaMin };
        if (offers)     activeFilters['offers']   = { label: 'عقارات بعروض', value: 1 };
        if (vt)         activeFilters['vt']       = { label: 'جولة افتراضية', value: 1 };

        renderActiveTags();

        /* search bar text */
        const parts = Object.values(activeFilters).map(f => f.label);
        $('#filterInput').val(parts.join(' · '));

        loadEstatesFiltered();
        filterModal.hide();
    });

    /* ─── Cascade selects ─── */
    $.ajax({
        url: '{{ url("/api/v1/estate/categories-by-type") }}',
        type: 'GET',
        success: function (response) {
            const $select = $('#category').empty().append('<option value="">{{ translate("select_category") }}</option>');
            response.forEach(c => {
                const name = currentLang === 'ar' ? c.name_ar : c.name;
                $select.append(`<option value="${c.id}">${name}</option>`);
            });
        }
    });

    $('#zone').on('change', function () {
        $.ajax({
            url: `{{ url("/get-cities/") }}/${$(this).val()}`,
            method: 'GET',
            success: function (data) {
                const field = currentLang === 'ar' ? 'name_ar' : 'name_en';
                $('#city').empty().append('<option value="">اختر المدينة</option>');
                data.forEach(c => $('#city').append(`<option value="${c.city_id}">${c[field]}</option>`));
                $('#district').empty().append('<option value="">اختر الحي</option>');
            }
        });
    });

    $('#city').on('change', function () {
        $.ajax({
            url: `{{ url("/get-districts/") }}/${$(this).val()}`,
            method: 'GET',
            success: function (data) {
                const field = currentLang === 'ar' ? 'name_ar' : 'name_en';
                $('#district').empty().append('<option value="">اختر الحي</option>');
                data.forEach(d => $('#district').append(`<option value="${d.id}">${d[field]}</option>`));
            }
        });
    });

    /* ─── Load functions ─── */
    function renderEstates(data) {
        $('#estate-cards-container').empty();

        if (!data.estate || data.estate.length === 0) {
            $('#estate-cards-container').html(`
                <div class="col-12">
                    <div class="empty-state">
                        <i class="fa-regular fa-building"></i>
                        <p>لا توجد عقارات متاحة حالياً</p>
                    </div>
                </div>`);
            return;
        }

        const lang         = $('html').attr('lang') || 'ar';
        const colClass     = window.innerWidth <= 768
            ? 'col-12'
            : (data.estate.length === 1 ? 'col-12' : 'col-xl-4 col-lg-4 col-md-6 col-sm-12');
        const favEstates   = @json($favoriteEstates);

        data.estate.forEach(e => {
            $('#estate-cards-container').append(renderEstateCard(e, colClass, lang, favEstates));
        });

        initAutoSwipers();
        initTouchSwiper();
    }

    function loadEstatesFiltered() {
        showLoading();
        $.ajax({
            url:    '{{ url("/api/v1/estate/get-estate/all") }}',
            method: 'GET',
            data: {
                category_id:  $('#category').val(),
                zone_id:      $('#zone').val(),
                city_id:      $('#city').val(),
                district_id:  $('#district').val(),
                offers:       $('#customSwitch1').is(':checked') ? 1 : 0,
                virtual_tour: $('#virtual_tour').is(':checked') ? 1 : 0,
                area_min:     $('#area_min').val(),
            },
            success: function (data) { renderEstates(data); hideLoading(); },
            error: function () {
                $('#estate-cards-container').html(`
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="fa-regular fa-face-frown"></i>
                            <p>حدث خطأ أثناء جلب العقارات</p>
                        </div>
                    </div>`);
                hideLoading();
            }
        });
    }

    function loadEstates(categoryId) {
        showLoading();
        const zoneId = '{{ session('zone_id') }}';
        $.ajax({
            url:    `{{ url("/api/v1/estate/get-estate/all") }}?category_id=${categoryId}&zone_id=${zoneId}`,
            method: 'GET',
            success: function (data) { renderEstates(data); hideLoading(); },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#error-message').text('خطأ: ' + textStatus);
                hideLoading();
            }
        });
    }

    function loadCategories() {
        showLoading();
        $.ajax({
            url:    '{{ url("/api/v1/categories") }}',
            method: 'GET',
            success: function (data) {
                const $c = $('#categories-container').empty();
                $c.append(`<button id="show-all" class="category-chip selected-category">{{ translate("All") ?? 'الكل' }}</button>`);

                if (!data || data.length === 0) {
                    $('#error-message').text('لم يتم العثور على أي فئات.');
                    hideLoading(); return;
                }

                data.forEach(function (cat) {
                    const name = currentLang === 'ar' ? cat.name_ar : cat.name;
                    $c.append(`<button class="category-chip category-button" data-id="${cat.id}">${name}</button>`);
                });

                $(document).on('click', '.category-button', function () {
                    $('.category-chip').removeClass('selected-category');
                    $(this).addClass('selected-category');
                    loadEstates($(this).data('id'));
                });

                $('#show-all').on('click', function () {
                    $('.category-chip').removeClass('selected-category');
                    $(this).addClass('selected-category');
                    loadEstates(0);
                });

                loadEstates(0);
                hideLoading();
            },
            error: function (jqXHR, textStatus) {
                $('#error-message').text('خطأ في جلب الفئات: ' + textStatus);
                hideLoading();
            }
        });
    }

    /* ─── Favorite ─── */
    $(document).on('click', '.favorite-btn', function (e) {
        e.stopPropagation(); e.preventDefault();
        const button = $(this);
        $.ajax({
            url:  '{{ route("wishlist") }}',
            type: 'POST',
            data: { estate_id: button.data('estate-id'), _token: '{{ csrf_token() }}' },
            success: function (res) {
                const src = res.status === 'added'
                    ? '{{ asset("public/assets/images/favorite-icon-red.png") }}'
                    : '{{ asset("public/assets/images/favorite-icon.png") }}';
                button.find('img').attr('src', src);
            },
            error: function (xhr) {
                if (xhr.status === 401) {
                    alert("يجب تسجيل الدخول لإضافة العقار إلى المفضلة.");
                    window.location.href = '{{ route("customer.auth.login") }}';
                } else {
                    alert("حدث خطأ غير متوقع.");
                }
            }
        });
    });

    /* ─── Gallery ─── */
    $(document).on('click', '.open-gallery-btn', function (e) {
        e.preventDefault(); e.stopPropagation();
        let images;
        try { images = JSON.parse($(this).attr('data-images')); } catch (err) { images = []; }

        const html = '<div class="fullscreen-gallery">' +
            images.map(src => `<img src="${src}" alt="صورة العقار">`).join('') +
            '</div>';

        $('#mediaGalleryModalBody').html(html);
        new bootstrap.Modal(document.getElementById('mediaGalleryModal')).show();
    });

    /* ─── Boot ─── */
    loadCategories();
});
</script>
@endpush
