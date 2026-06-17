@extends('layouts.front-end.app')

@section('title', $estate['title'])

@push('css_or_js')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800;900&display=swap" rel="stylesheet">

<style>
:root {
    --primary:    #0f5bd7;
    --primary-2:  #114b89;
    --primary-3:  #0a3d8f;
    --accent:     #19b36b;
    --danger:     #ef4444;
    --warning:    #f59e0b;
    --card:       #ffffff;
    --text:       #101828;
    --muted:      #667085;
    --line:       #e4e7ec;
    --bg:         #f0f4fa;
    --shadow-lg:  0 24px 60px rgba(16,24,40,.16);
    --shadow-md:  0 10px 28px rgba(16,24,40,.10);
    --shadow-sm:  0 4px 14px rgba(16,24,40,.07);
    --r-xl: 28px;
    --r-lg: 20px;
    --r-md: 14px;
    --r-sm: 10px;
}

*, *::before, *::after { box-sizing: border-box; }

body {
    font-family: 'Tajawal', sans-serif;
    background:
        radial-gradient(ellipse at top right, rgba(17,75,137,.12), transparent 28%),
        radial-gradient(ellipse at bottom left, rgba(15,91,215,.10), transparent 28%),
        var(--bg);
    color: var(--text);
    direction: rtl;
}

/* ──────────────────────────────────────────
   HERO
────────────────────────────────────────── */
.glass-hero {
    position: relative;
    overflow: hidden;
    border-radius: 32px;
    background: linear-gradient(135deg, #0a1628 0%, #0f3a80 55%, #114b89 100%);
    box-shadow: var(--shadow-lg);
    color: #fff;
    padding: 28px 28px 22px;
    margin-bottom: 24px;
}

.glass-hero::before {
    content: "";
    position: absolute;
    inset: 0;
    background:
        radial-gradient(circle at 85% 10%, rgba(255,255,255,.14), transparent 20%),
        radial-gradient(circle at 8%  85%, rgba(255,255,255,.08), transparent 20%);
    pointer-events: none;
}

.glass-hero::after {
    content: "";
    position: absolute;
    bottom: -40px;
    left: -40px;
    width: 220px;
    height: 220px;
    background: rgba(255,255,255,.04);
    border-radius: 50%;
    pointer-events: none;
}

.hero-location {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
    border-radius: 999px;
    background: rgba(255,255,255,.13);
    border: 1px solid rgba(255,255,255,.14);
    font-size: .88rem;
    font-weight: 700;
    backdrop-filter: blur(8px);
    margin-bottom: 14px;
}

.hero-title{
    font-size: clamp(1.6rem, 3vw, 2.5rem);
    font-weight: 800;
    margin: 16px 0 10px;
    line-height: 1.4;
    word-break: break-word;
    color: #fff; /* <--- أضف هذا السطر */
}

.hero-desc {
    color: rgba(255,255,255,.80);
    font-size: .97rem;
    line-height: 2;
    margin-bottom: 18px;
}

.hero-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 20px;
}

.hero-chip {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 9px 14px;
    border-radius: 999px;
    background: rgba(255,255,255,.13);
    border: 1px solid rgba(255,255,255,.16);
    font-size: .88rem;
    font-weight: 700;
    backdrop-filter: blur(6px);
}

.hero-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
}

.hstat {
    background: rgba(255,255,255,.10);
    border: 1px solid rgba(255,255,255,.13);
    border-radius: 18px;
    padding: 14px 12px;
    backdrop-filter: blur(6px);
    min-width: 0;
}

.hstat .k {
    display: block;
    font-size: .78rem;
    color: rgba(255,255,255,.68);
    margin-bottom: 6px;
}

.hstat .v {
    font-size: .97rem;
    font-weight: 800;
    color: #fff;
    word-break: break-word;
    display: flex;
    align-items: center;
    gap: 5px;
    flex-wrap: wrap;
    line-height: 1.5;
}

.hstat .v img { width: 14px; height: 14px; flex-shrink: 0; }

/* ──────────────────────────────────────────
   LAYOUT
────────────────────────────────────────── */
.estate-shell {
    padding: 24px 0 100px;
}

.estate-grid {
    display: grid;
    grid-template-columns: minmax(0, 1.6fr) 340px;
    gap: 22px;
    align-items: start;
}

/* ──────────────────────────────────────────
   CARD
────────────────────────────────────────── */
.cardx {
    background: var(--card);
    border: 1px solid var(--line);
    border-radius: var(--r-xl);
    box-shadow: var(--shadow-md);
    overflow: hidden;
}

.cardx + .cardx { margin-top: 20px; }

.cardx-head {
    padding: 20px 22px 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
}

.cardx-title {
    font-size: 1.06rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0;
}

.cardx-subtitle {
    color: var(--muted);
    font-size: .87rem;
    margin-top: 4px;
}

.section-body { padding: 18px 22px 22px; }

/* ──────────────────────────────────────────
   MEDIA TABS
────────────────────────────────────────── */
.media-layout { padding: 18px 22px 22px; }

.media-tabs {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 16px;
}

.media-tab {
    border: none;
    background: #eef4ff;
    color: #1d4ed8;
    padding: 10px 15px;
    border-radius: 999px;
    font-weight: 800;
    font-size: .88rem;
    font-family: 'Tajawal', sans-serif;
    transition: .2s;
    cursor: pointer;
}

.media-tab.active, .media-tab:hover {
    background: linear-gradient(135deg, var(--primary), var(--primary-2));
    color: #fff;
    box-shadow: 0 8px 22px rgba(15,91,215,.22);
}

/* ──────────────────────────────────────────
   GALLERY
────────────────────────────────────────── */
.gallery-stage {
    display: grid;
    grid-template-columns: 1fr 118px;
    gap: 12px;
    align-items: start;
}

.main-preview {
    position: relative;
    min-height: 520px;
    border-radius: 22px;
    overflow: hidden;
    background: #0f172a;
    box-shadow: var(--shadow-sm);
}

.main-preview img,
.main-preview video,
.main-preview iframe {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    border: none;
    position: absolute;
    inset: 0;
}

.preview-overlay {
    position: absolute;
    inset: auto 0 0;
    padding: 18px 20px;
    background: linear-gradient(to top, rgba(0,0,0,.65), transparent);
    color: #fff;
    pointer-events: none;
    z-index: 2;
}

.preview-overlay .title { font-size: 1rem; font-weight: 800; }
.preview-overlay .meta  { font-size: .86rem; color: rgba(255,255,255,.78); margin-top: 3px; }

.media-rail {
    display: flex;
    flex-direction: column;
    gap: 10px;
    max-height: 520px;
    overflow-y: auto;
    scrollbar-width: none;
}

.media-rail::-webkit-scrollbar { display: none; }

.rail-item {
    position: relative;
    height: 88px;
    border-radius: 16px;
    overflow: hidden;
    background: #e5e7eb;
    cursor: pointer;
    border: 2px solid transparent;
    transition: .2s;
    flex-shrink: 0;
    width: 100%;
}

.rail-item img, .rail-item video {
    width: 100%; height: 100%;
    object-fit: cover; display: block;
}

.rail-item::after {
    content: "";
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,.2), transparent);
}

.rail-item.active {
    border-color: var(--primary);
    box-shadow: 0 6px 20px rgba(15,91,215,.22);
}

.rail-badge {
    position: absolute; bottom: 6px; right: 6px; z-index: 2;
    background: rgba(255,255,255,.9);
    color: #111827; border-radius: 999px;
    padding: 3px 7px; font-size: .72rem; font-weight: 800;
}

.floating-actions {
    position: absolute; top: 14px; left: 14px; z-index: 3;
    display: flex; gap: 9px; flex-wrap: wrap;
    max-width: calc(100% - 28px);
}

.fab-btn {
    width: 44px; height: 44px;
    border: none; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    background: rgba(255,255,255,.18); color: #fff;
    backdrop-filter: blur(12px);
    box-shadow: 0 8px 20px rgba(0,0,0,.14);
    transition: .2s; text-decoration: none; font-size: 1rem;
}

.fab-btn:hover { background: rgba(255,255,255,.28); color: #fff; transform: translateY(-2px); }

.thumb-counter {
    position: absolute; top: 14px; right: 14px; z-index: 3;
    background: rgba(0,0,0,.44); color: #fff;
    border-radius: 999px; padding: 8px 13px;
    font-weight: 800; font-size: .84rem;
    backdrop-filter: blur(6px);
}

/* ──────────────────────────────────────────
   QUICK ACTIONS
────────────────────────────────────────── */
.quick-actions {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
}

.quick-action {
    border: none;
    border-radius: 18px;
    padding: 15px 12px;
    background: linear-gradient(180deg, #ffffff, #f5f9ff);
    border: 1px solid #dbe7ff;
    text-align: center;
    font-weight: 800;
    color: #0f172a;
    font-family: 'Tajawal', sans-serif;
    box-shadow: 0 6px 18px rgba(15,91,215,.06);
    transition: .2s;
    cursor: pointer;
    font-size: .9rem;
}

.quick-action i {
    display: block;
    font-size: 1.15rem;
    margin-bottom: 9px;
    color: var(--primary);
}

.quick-action:hover {
    background: linear-gradient(135deg, var(--primary), var(--primary-2));
    color: #fff; transform: translateY(-3px);
    box-shadow: 0 14px 32px rgba(15,91,215,.22);
}

.quick-action:hover i { color: #fff; }

/* ──────────────────────────────────────────
   CHIPS
────────────────────────────────────────── */
.chips { display: flex; flex-wrap: wrap; gap: 10px; }

.chip {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 9px 14px; border-radius: 999px;
    background: linear-gradient(135deg, #ffffff, #f1f7ff);
    border: 1px solid #dce8ff;
    font-size: .88rem; font-weight: 700; color: #0f172a;
    box-shadow: 0 4px 12px rgba(15,23,42,.05);
    transition: .2s;
}

.chip i { font-size: .85rem; color: var(--primary); }
.chip:hover { background: linear-gradient(135deg, var(--primary), var(--primary-2)); color: #fff; transform: translateY(-1px); }
.chip:hover i { color: #fff; }

/* ──────────────────────────────────────────
   DETAIL GRID
────────────────────────────────────────── */
.detail-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
}

.detail-item {
    background: linear-gradient(180deg, #fff, #fafcff);
    border: 1px solid var(--line);
    border-radius: 16px;
    padding: 14px 16px;
    min-width: 0;
    transition: box-shadow .2s;
}

.detail-item:hover { box-shadow: var(--shadow-sm); }

.detail-item .k {
    display: block; color: var(--muted);
    font-size: .82rem; margin-bottom: 7px; font-weight: 600;
}

.detail-item .v {
    font-weight: 800; font-size: .97rem;
    color: #111827; line-height: 1.7;
    word-break: break-word;
}

.detail-item .v.price-value {
    display: flex; align-items: center; gap: 6px; flex-wrap: wrap;
}

.detail-item .v.price-value img { width: 15px; height: 15px; flex-shrink: 0; }

.detail-item.full { grid-column: 1 / -1; }

/* ──────────────────────────────────────────
   SECTION HEADER (inside section-body)
────────────────────────────────────────── */
.sub-head {
    font-size: .96rem;
    font-weight: 800;
    color: #0f172a;
    margin: 20px 0 12px;
    padding-bottom: 8px;
    border-bottom: 2px solid #eef2f7;
    display: flex;
    align-items: center;
    gap: 8px;
}

.sub-head i { color: var(--primary); }

/* ──────────────────────────────────────────
   DESCRIPTION BOX
────────────────────────────────────────── */
.description-box {
    background: #fafcff;
    border: 1px solid var(--line);
    border-radius: 18px;
    padding: 18px;
    line-height: 2;
    color: #334155;
    white-space: pre-line;
    word-break: break-word;
    font-size: .97rem;
}

.moj-box {
    background: linear-gradient(135deg, #fff8f0, #fff);
    border: 1px solid #fed7aa;
    border-radius: 18px;
    padding: 16px 18px;
    margin-top: 14px;
}

.moj-box .moj-label {
    font-size: .84rem;
    font-weight: 800;
    color: #c2410c;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 7px;
}

.moj-box p { color: #334155; line-height: 2; font-size: .94rem; margin: 0; word-break: break-word; }

/* ──────────────────────────────────────────
   MAP
────────────────────────────────────────── */
.nearby-toolbar {
    display: flex; gap: 8px; flex-wrap: wrap;
    padding: 0 22px 16px;
}

.nearby-btn {
    border: none; border-radius: 999px;
    background: #eef4ff; color: #1d4ed8;
    padding: 10px 15px; font-weight: 800;
    font-family: 'Tajawal', sans-serif;
    font-size: .87rem; cursor: pointer; transition: .2s;
}

.nearby-btn.active, .nearby-btn:hover {
    background: linear-gradient(135deg, var(--primary), var(--primary-2));
    color: #fff; box-shadow: 0 8px 22px rgba(15,91,215,.22);
}

.map-shell { border-radius: 0 0 var(--r-xl) var(--r-xl); overflow: hidden; }

#map { height: 420px; width: 100%; }

/* ──────────────────────────────────────────
   SIDEBAR
────────────────────────────────────────── */
.sticky-side { position: sticky; top: 16px; display: grid; gap: 18px; }

.seller-card {
    background: #fff;
    border: 1px solid var(--line);
    border-radius: var(--r-xl);
    box-shadow: var(--shadow-md);
    overflow: hidden;
}

.seller-cover {
    height: 82px;
    background: linear-gradient(135deg, #0f5bd7, #114b89);
    position: relative;
}

.seller-cover::after {
    content: "";
    position: absolute; inset: 0;
    background: radial-gradient(circle at 70% 50%, rgba(255,255,255,.14), transparent 55%);
}

.seller-body { padding: 0 18px 20px; margin-top: -36px; }

.seller-avatar {
    width: 80px; height: 80px;
    border-radius: 50%; object-fit: cover;
    border: 4px solid #fff; box-shadow: var(--shadow-sm);
    background: #fff;
}

.seller-name { font-size: 1.04rem; font-weight: 800; margin: 12px 0 3px; word-break: break-word; }
.seller-phone { color: var(--muted); margin-bottom: 14px; font-size: .9rem; }

.seller-metrics {
    display: grid; grid-template-columns: repeat(2, 1fr);
    gap: 10px; margin-bottom: 14px;
}

.seller-metric {
    background: #f8fafc; border: 1px solid var(--line);
    border-radius: 14px; padding: 12px 10px; text-align: center; min-width: 0;
}

.seller-metric .k { display: block; color: var(--muted); font-size: .76rem; margin-bottom: 5px; }
.seller-metric .v { font-weight: 800; color: var(--primary); word-break: break-word; font-size: .9rem; }

.cta-stack { display: grid; gap: 9px; }

.cta-primary, .cta-secondary {
    border: none; text-decoration: none;
    border-radius: 14px; padding: 13px 16px;
    font-weight: 800; text-align: center;
    display: flex; align-items: center; justify-content: center;
    gap: 9px; transition: .2s; font-family: 'Tajawal', sans-serif;
    font-size: .92rem; cursor: pointer;
}

.cta-primary {
    background: linear-gradient(135deg, var(--primary), var(--primary-2));
    color: #fff; box-shadow: 0 10px 26px rgba(15,91,215,.20);
}

.cta-primary:hover { color: #fff; transform: translateY(-2px); }

.cta-secondary {
    background: #fff; color: #0f172a;
    border: 1px solid var(--line);
}

.cta-secondary:hover { background: #f8fafc; color: #0f172a; }

.cta-whatsapp {
    background: linear-gradient(135deg, #22c55e, #16a34a);
    color: #fff;
}

.cta-whatsapp:hover { color: #fff; transform: translateY(-2px); }

.social-row {
    display: flex; justify-content: center;
    gap: 9px; flex-wrap: wrap; margin-top: 14px;
}

.social-row a {
    width: 40px; height: 40px;
    display: flex; align-items: center; justify-content: center;
    border-radius: 50%;
    background: #f8fafc; border: 1px solid var(--line);
    transition: .2s;
}

.social-row a:hover { background: #eef4ff; transform: translateY(-2px); }
.social-row img { width: 20px; height: 20px; object-fit: contain; }

.side-mini-card {
    background: #fff; border: 1px solid var(--line);
    border-radius: var(--r-xl); box-shadow: var(--shadow-md); padding: 16px;
}

.mini-stat {
    display: flex; align-items: center; gap: 12px;
    padding: 13px; border-radius: 14px;
    background: #f8fafc; border: 1px solid var(--line);
}

.mini-stat + .mini-stat { margin-top: 10px; }
.mini-stat img { width: 22px; height: 22px; }
.mini-stat span { font-size: .92rem; }

.offer-card {
    position: relative; border: 1px solid var(--line);
    border-radius: 20px; overflow: hidden;
    background: #fff; box-shadow: var(--shadow-sm);
}

.offer-card + .offer-card { margin-top: 12px; }

.offer-ribbon {
    position: absolute; top: 12px; right: 12px;
    background: linear-gradient(135deg, #ef4444, #f97316);
    color: #fff; border-radius: 999px;
    padding: 6px 10px; font-size: .76rem; font-weight: 800; z-index: 2;
}

.offer-inner {
    display: grid; grid-template-columns: 100px 1fr;
    gap: 12px; padding: 12px; align-items: center;
}

.offer-thumb {
    width: 100px; height: 100px;
    border-radius: 14px; object-fit: cover; background: #e5e7eb;
}

.offer-name  { font-weight: 800; margin-bottom: 5px; color: #111827; word-break: break-word; font-size: .93rem; }
.offer-price { font-weight: 900; color: var(--primary); margin-bottom: 3px; }
.offer-expiry { color: var(--muted); font-size: .84rem; }

.offer-links { display: flex; gap: 10px; margin-top: 8px; }
.offer-links a { color: #0f172a; font-size: 1rem; }

/* ──────────────────────────────────────────
   EMPTY STATE
────────────────────────────────────────── */
.empty-media {
    min-height: 380px;
    display: flex; align-items: center; justify-content: center;
    flex-direction: column; gap: 12px; color: #94a3b8;
    background: linear-gradient(180deg, #f8fafc, #eef2f7);
    border-radius: 22px; border: 1px dashed #cbd5e1;
    padding: 24px; text-align: center;
    font-size: .96rem;
}

/* ──────────────────────────────────────────
   MOBILE BAR
────────────────────────────────────────── */
.mobile-bar {
    position: fixed; bottom: 10px; left: 10px; right: 10px;
    z-index: 999;
    background: rgba(255,255,255,.95);
    backdrop-filter: blur(18px);
    border: 1px solid rgba(255,255,255,.7);
    box-shadow: var(--shadow-lg);
    border-radius: 22px; padding: 10px;
    display: none;
}

.mobile-bar-grid {
    display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px;
}

.mobile-bar-grid a,
.mobile-bar-grid button {
    border: none; border-radius: 14px; padding: 11px 8px;
    font-weight: 800; font-family: 'Tajawal', sans-serif;
    font-size: .82rem; text-align: center; text-decoration: none;
    transition: .2s; cursor: pointer;
}

.mbar-chat  { background: #eef4ff; color: var(--primary); }
.mbar-call  { background: #f0fdf4; color: #16a34a; }
.mbar-wa    { background: #f0fdf4; color: #16a34a; }

.mbar-chat:hover  { background: var(--primary); color: #fff; }
.mbar-call:hover  { background: #16a34a; color: #fff; }
.mbar-wa:hover    { background: #16a34a; color: #fff; }

/* ──────────────────────────────────────────
   MODAL
────────────────────────────────────────── */
.custom-modal .modal-content {
    border: none; border-radius: 26px;
    overflow: hidden; box-shadow: var(--shadow-lg);
}

.custom-modal .modal-header {
    background: linear-gradient(135deg, #0f5bd7, #114b89);
    color: #fff; border: none; padding: 16px 20px;
}

.custom-modal .btn-close { filter: invert(1); }

.fullscreen-gallery {
    display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px;
}

.fullscreen-gallery img {
    width: 100%; height: 220px;
    object-fit: cover; border-radius: 16px;
}

/* ──────────────────────────────────────────
   RESPONSIVE — TABLET
────────────────────────────────────────── */
@media (max-width: 1100px) {
    .estate-grid { grid-template-columns: 1fr; }
    .sticky-side { position: static; }
    .hero-stats  { grid-template-columns: repeat(2, 1fr); }
}

@media (max-width: 992px) {
    .gallery-stage { grid-template-columns: 1fr; }
    .media-rail    { flex-direction: row; max-height: none; overflow-x: auto; padding-bottom: 4px; }
    .rail-item     { min-width: 100px; width: 100px; height: 82px; flex-shrink: 0; }
    .main-preview  { min-height: 420px; }
    .quick-actions { grid-template-columns: repeat(2, 1fr); }
}

/* ──────────────────────────────────────────
   RESPONSIVE — MOBILE
────────────────────────────────────────── */
@media (max-width: 768px) {

    body { font-size: 15px; }

    .estate-shell { padding: 12px 0 110px; }

    /* hero */
    .glass-hero {
        padding: 16px 16px 14px;
        border-radius: 22px;
        margin-bottom: 16px;
    }

    .hero-location { font-size: .78rem; padding: 7px 12px; }

    .hero-title {
        font-size: 1.2rem;
        line-height: 1.55;
        margin-bottom: 8px;
    }

    .hero-desc { font-size: .88rem; line-height: 1.8; margin-bottom: 12px; }

    .hero-chips { gap: 7px; margin-bottom: 14px; }
    .hero-chip  { font-size: .78rem; padding: 7px 11px; gap: 5px; }

    .hero-stats { grid-template-columns: repeat(2, 1fr); gap: 8px; }

    .hstat {
        padding: 11px 10px;
        border-radius: 14px;
    }

    .hstat .k { font-size: .72rem; margin-bottom: 4px; }

    .hstat .v {
        font-size: .87rem;
        line-height: 1.5;
    }

    /* cards */
    .cardx { border-radius: 20px; }
    .cardx-head { padding: 14px 14px 0; }
    .cardx-title { font-size: .97rem; }
    .cardx-subtitle { font-size: .8rem; }
    .section-body, .media-layout { padding: 14px 14px 16px; }

    /* gallery */
    .main-preview {
        min-height: 0;
        height: 260px;
        border-radius: 16px;
    }

    .floating-actions { top: 10px; left: 10px; gap: 7px; }
    .fab-btn { width: 36px; height: 36px; font-size: .85rem; }
    .thumb-counter { top: 10px; right: 10px; padding: 6px 10px; font-size: .72rem; }
    .preview-overlay { padding: 10px 12px; }
    .preview-overlay .title { font-size: .88rem; }
    .preview-overlay .meta  { font-size: .76rem; }

    /* tabs & buttons */
    .media-tab, .nearby-btn { padding: 9px 12px; font-size: .8rem; }

    /* detail grid */
    .detail-grid { grid-template-columns: 1fr; gap: 10px; }
    .detail-item.full { grid-column: 1; }
    .detail-item { padding: 12px 14px; border-radius: 14px; }
    .detail-item .k { font-size: .78rem; }
    .detail-item .v { font-size: .92rem; }

    /* chips */
    .chip { font-size: .8rem; padding: 8px 12px; }
    .chips { gap: 8px; }

    /* quick actions */
    .quick-actions { grid-template-columns: repeat(2, 1fr); gap: 10px; }
    .quick-action  { padding: 14px 10px; font-size: .84rem; border-radius: 14px; }
    .quick-action i { font-size: 1.05rem; margin-bottom: 7px; }

    /* map */
    #map { height: 300px; }
    .map-shell { border-radius: 0 0 20px 20px; }
    .nearby-toolbar { padding: 0 14px 14px; gap: 7px; }

    /* seller card */
    .seller-card { border-radius: 20px; }
    .seller-cover { height: 72px; }
    .seller-body  { padding: 0 14px 16px; margin-top: -32px; }
    .seller-avatar { width: 70px; height: 70px; }
    .seller-name  { font-size: .97rem; margin: 10px 0 2px; }
    .seller-phone { font-size: .84rem; margin-bottom: 12px; }
    .seller-metrics { grid-template-columns: repeat(2, 1fr); gap: 8px; }
    .seller-metric { padding: 10px 8px; border-radius: 12px; }
    .seller-metric .k { font-size: .72rem; }
    .seller-metric .v { font-size: .84rem; }

    .cta-primary,
    .cta-secondary { padding: 12px 14px; font-size: .88rem; border-radius: 12px; gap: 7px; }

    /* side cards */
    .side-mini-card { border-radius: 20px; padding: 14px; }
    .mini-stat { padding: 11px 12px; border-radius: 12px; }
    .mini-stat img { width: 20px; height: 20px; }
    .mini-stat span { font-size: .86rem; }

    /* offer card */
    .offer-inner { grid-template-columns: 1fr; }
    .offer-thumb { width: 100%; height: 160px; }

    /* gallery modal */
    .fullscreen-gallery { grid-template-columns: repeat(2, 1fr); }
    .fullscreen-gallery img { height: 180px; }

    /* mobile bar */
    .mobile-bar { display: block; }

    /* description */
    .description-box { font-size: .91rem; line-height: 1.9; padding: 14px; }
    .moj-box { padding: 13px 14px; }
    .moj-box p { font-size: .88rem; }

    .sub-head { font-size: .9rem; }
}

@media (max-width: 420px) {

    .glass-hero { padding: 13px 12px 12px; border-radius: 18px; }
    .hero-title { font-size: 1.06rem; }
    .hero-stats { grid-template-columns: repeat(2, 1fr); gap: 7px; }
    .hstat { padding: 9px 8px; border-radius: 12px; }
    .hstat .v { font-size: .78rem; }

    .main-preview { height: 220px; }

    .quick-actions { gap: 8px; }
    .quick-action  { padding: 12px 8px; font-size: .78rem; }

    .fullscreen-gallery { grid-template-columns: 1fr; }
    .fullscreen-gallery img { height: 200px; }

    .mobile-bar-grid a,
    .mobile-bar-grid button { font-size: .76rem; padding: 10px 6px; }
}
</style>
@endpush

@section('meta_tags')
@php
    $estateTitle       = $estate['title'] ?? 'إعلان عقاري';
    $estateType        = $estate['advertisement_type'] ?? 'غير محدد';
    $estateCategory    = $estate['category_name'] ?? 'غير محدد';
    $estateCity        = $estate['city'] ?? '';
    $estateDistrict    = $estate['districts'] ?? '';
    $estateDescription = "{$estateType} - {$estateCategory} في {$estateCity}" . ($estateDistrict ? "، حي {$estateDistrict}" : '');
    $estateImage       = isset($estate['images'][0])
        ? asset('storage/app/public/estate/'.$estate['images'][0])
        : asset('public/assets/images/logo_web.png');
@endphp
<meta property="og:type"        content="website" />
<meta property="og:title"       content="{{ $estateTitle }} | منصة أبعاد" />
<meta property="og:description" content="{{ $estateDescription }}" />
<meta property="og:image"       content="{{ $estateImage }}" />
<meta property="og:url"         content="{{ url()->current() }}" />
<meta property="og:site_name"   content="منصة أبعاد العقارية" />
<meta name="twitter:card"        content="summary_large_image" />
<meta name="twitter:description" content="{{ $estateDescription }}" />
<meta name="twitter:image"       content="{{ $estateImage }}" />
@endsection


@section('content')
<div class="estate-shell">
<div class="container rtl text-align-direction">

{{-- ═══════════════ HERO ═══════════════ --}}
<section class="glass-hero">
    <div class="row g-3 align-items-end">
        <div class="col-lg-8">

            <div class="hero-location">
                <i class="fa-solid fa-location-dot"></i>
                {{ $estate["city"] ?? '—' }}
                @if(!empty($estate["districts"])) &nbsp;-&nbsp; {{ $estate["districts"] }} @endif
            </div>

            <h1 class="hero-title">{{ $estate['title'] ?? 'تفاصيل العقار' }}</h1>

            <div class="hero-desc">
                {{ $estate["short_description"] ?? 'تفاصيل مميزة وتجربة عرض حديثة للعقار.' }}
            </div>

            <div class="hero-chips">
                <div class="hero-chip"><i class="fa-solid fa-building"></i>{{ $estate["category_name"] ?? '-' }}</div>
                @if(!empty($estate["advertisement_type"]))
                    <div class="hero-chip"><i class="fa-solid fa-bullhorn"></i>{{ $estate["advertisement_type"] }}</div>
                @endif
                @if(!empty($estate["space"]))
                    <div class="hero-chip"><i class="fa-solid fa-ruler-combined"></i>{{ $estate["space"] }}</div>
                @endif
            </div>
        </div>

        <div class="col-lg-4">
            <div class="hero-stats">
                <div class="hstat">
                    <span class="k">السعر</span>
                    <div class="v">
                        {{ $estate["price"] ?? '-' }}
                        <img src="{{ asset('public/assets/images/ryal.png') }}" alt="sar">
                    </div>
                </div>
                <div class="hstat">
                    <span class="k">المشاهدات</span>
                    <div class="v"><i class="fa-regular fa-eye" style="font-size:.85rem;"></i>{{ $estate["view"] ?? 0 }}</div>
                </div>
                <div class="hstat">
                    <span class="k">عدد الغرف</span>
                    <div class="v">{{ $estate["numberOfRooms"] ?? '—' }}</div>
                </div>
                <div class="hstat">
                    <span class="k">نوع الملكية</span>
                    <div class="v">{{ $estate["ownership_type"] ?? '—' }}</div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- ═══════════════ END HERO ═══════════════ --}}


<div class="estate-grid">

    {{-- ══════════════ MAIN COLUMN ══════════════ --}}
    <div class="main-col">

        {{-- ── MEDIA ── --}}
        <section class="cardx">
            <div class="cardx-head">
                <div>
                    <h3 class="cardx-title">وسائط العقار</h3>
                    <div class="cardx-subtitle">الصور · الفيديو · الجولة الافتراضية · المخططات · منظور الشارع</div>
                </div>
            </div>

            <div class="media-layout">
                <div class="media-tabs">
                    <button class="media-tab active" data-media-tab="images"><i class="fa-regular fa-images me-1"></i>الصور</button>
                    <button class="media-tab" data-media-tab="videos"><i class="fa-solid fa-circle-play me-1"></i>الفيديو</button>
                    <button class="media-tab" data-media-tab="tour"><i class="fa-solid fa-vr-cardboard me-1"></i>جولة افتراضية</button>
                    <button class="media-tab" data-media-tab="plans"><i class="fa-solid fa-drafting-compass me-1"></i>المخططات</button>
                    <button class="media-tab" data-media-tab="street"><i class="fa-solid fa-road me-1"></i>منظور الشارع</button>
                </div>

                <div id="media-panels">

                    {{-- IMAGES --}}
                    <div class="media-panel" data-panel="images">
                        @php $estateImages = is_array($estate['images'] ?? null) ? $estate['images'] : []; @endphp
                        @if(count($estateImages))
                            <div class="gallery-stage">
                                <div class="main-preview" id="mainImagePreview">
                                    <div class="floating-actions">
                                        <button class="fab-btn" onclick="openMediaGallery('images')" title="فتح المعرض">
                                            <i class="fa-solid fa-expand"></i>
                                        </button>
                                        <a class="fab-btn" target="_blank"
                                           href="https://wa.me/?text={{ urlencode('! تم مشاركة هذا لك من منصة أبعاد العقارية: ' . url('/details/' . $estate['id'])) }}">
                                            <i class="fa-solid fa-share-nodes"></i>
                                        </a>
                                    </div>
                                    <div class="thumb-counter">
                                        <span id="imageCurrentIndex">1</span> / {{ count($estateImages) }}
                                    </div>
                                    <img id="mainGalleryImage"
                                         src="{{ asset('storage/app/public/estate/'.$estateImages[0]) }}"
                                         alt="{{ $estate['title'] }}"
                                         onerror="this.src='{{ asset('storage/app/public/estate/not_found.png') }}'">
                                    <div class="preview-overlay">
                                        <div class="title">{{ $estate['title'] }}</div>
                                        <div class="meta">{{ $estate["address"] ?? ($estate["city"] ?? '') }}</div>
                                    </div>
                                </div>

                                <div class="media-rail" id="imageRail">
                                    @foreach($estateImages as $index => $photo)
                                        <button class="rail-item {{ $index === 0 ? 'active' : '' }}"
                                                data-index="{{ $index }}"
                                                data-src="{{ asset('storage/app/public/estate/'.$photo) }}">
                                            <img src="{{ asset('storage/app/public/estate/'.$photo) }}"
                                                 onerror="this.src='{{ asset('storage/app/public/estate/not_found.png') }}'">
                                            <span class="rail-badge">{{ $index + 1 }}</span>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="empty-media"><i class="fa-regular fa-image fa-2x"></i><div>لا توجد صور متاحة</div></div>
                        @endif
                    </div>

                    {{-- VIDEOS --}}
                    <div class="media-panel d-none" data-panel="videos">
                        @if(!empty($estate['video_url']) || !empty($estate['skyview']))
                            <div class="gallery-stage">
                                <div class="main-preview" id="videoStage">
                                    @php
                                        $firstVideo = !empty($estate['video_url'])
                                            ? asset('storage/app/public/videos/' . $estate['video_url'])
                                            : asset('storage/app/public/videos/' . $estate['skyview']);
                                    @endphp
                                    <video id="mainVideoPlayer" controls playsinline style="object-fit:contain;background:#000;">
                                        <source id="mainVideoSource" src="{{ $firstVideo }}" type="video/mp4">
                                    </video>
                                    <div class="preview-overlay">
                                        <div class="title" id="videoTitleOverlay">
                                            {{ !empty($estate['video_url']) ? 'فيديو العقار' : 'المنظور الجوي' }}
                                        </div>
                                        <div class="meta">عرض مرئي للعقار</div>
                                    </div>
                                </div>

                                <div class="media-rail">
                                    @if(!empty($estate['video_url']))
                                        <button class="rail-item active video-selector"
                                                data-video-src="{{ asset('storage/app/public/videos/' . $estate['video_url']) }}"
                                                data-video-title="فيديو العقار">
                                            <video muted><source src="{{ asset('storage/app/public/videos/' . $estate['video_url']) }}" type="video/mp4"></video>
                                            <span class="rail-badge">فيديو</span>
                                        </button>
                                    @endif
                                    @if(!empty($estate['skyview']))
                                        <button class="rail-item {{ empty($estate['video_url']) ? 'active' : '' }} video-selector"
                                                data-video-src="{{ asset('storage/app/public/videos/' . $estate['skyview']) }}"
                                                data-video-title="المنظور الجوي">
                                            <video muted><source src="{{ asset('storage/app/public/videos/' . $estate['skyview']) }}" type="video/mp4"></video>
                                            <span class="rail-badge">جوي</span>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="empty-media"><i class="fa-solid fa-film fa-2x"></i><div>لا يوجد فيديو لهذا العقار</div></div>
                        @endif
                    </div>

                    {{-- TOUR --}}
                    <div class="media-panel d-none" data-panel="tour">
                        @if(!empty($estate['ar_path']))
                            <div class="main-preview" style="min-height:480px;">
                                <iframe src="{{ $estate['ar_path'] }}" allowfullscreen></iframe>
                                <div class="preview-overlay">
                                    <div class="title">جولة افتراضية</div>
                                    <div class="meta">استكشاف داخلي تفاعلي</div>
                                </div>
                            </div>
                        @else
                            <div class="empty-media"><i class="fa-solid fa-vr-cardboard fa-2x"></i><div>لا توجد جولة افتراضية</div></div>
                        @endif
                    </div>

                    {{-- PLANS --}}
                    <div class="media-panel d-none" data-panel="plans">
                        @php $planned = is_array($estate['planned'] ?? null) ? $estate['planned'] : []; @endphp
                        @if(count($planned))
                            <div class="gallery-stage">
                                <div class="main-preview" id="mainPlanPreview">
                                    <img id="mainPlanImage"
                                         src="{{ asset('storage/app/public/estate/'.$planned[0]) }}"
                                         onerror="this.src='{{ asset('storage/app/public/estate/not_found.png') }}'">
                                    <div class="preview-overlay">
                                        <div class="title">المخطط الرئيسي</div>
                                    </div>
                                </div>
                                <div class="media-rail" id="planRail">
                                    @foreach($planned as $index => $plan)
                                        <button class="rail-item {{ $index === 0 ? 'active' : '' }}"
                                                data-plan-index="{{ $index }}"
                                                data-src="{{ asset('storage/app/public/estate/'.$plan) }}">
                                            <img src="{{ asset('storage/app/public/estate/'.$plan) }}"
                                                 onerror="this.src='{{ asset('storage/app/public/estate/not_found.png') }}'">
                                            <span class="rail-badge">{{ $index + 1 }}</span>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="empty-media"><i class="fa-solid fa-drafting-compass fa-2x"></i><div>لا توجد مخططات</div></div>
                        @endif
                    </div>

                    {{-- STREET --}}
                    <div class="media-panel d-none" data-panel="street">
                        <div class="main-preview" style="min-height:480px;" id="streetViewPanel">
                            <div class="empty-media" style="min-height:480px;">
                                <i class="fa-solid fa-road fa-2x"></i>
                                <div>اضغط لتحميل منظور الشارع</div>
                                <button class="cta-primary" style="margin-top:8px;" type="button" onclick="loadStreetViewInline()">
                                    <i class="fa-solid fa-road"></i> عرض الآن
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        {{-- ── QUICK ACTIONS ── --}}
        <section class="cardx">
            <div class="cardx-head">
                <div>
                    <h3 class="cardx-title">التفاعل السريع</h3>
                    <div class="cardx-subtitle">وصول مباشر للوسائط والوظائف</div>
                </div>
            </div>
            <div class="section-body">
                <div class="quick-actions">
                    <button class="quick-action" onclick="switchMediaTab('images')">
                        <i class="fa-regular fa-images"></i>معرض الصور
                    </button>
                    <button class="quick-action" onclick="switchMediaTab('videos')">
                        <i class="fa-solid fa-circle-play"></i>الفيديو
                    </button>
                    <button class="quick-action" onclick="switchMediaTab('tour')">
                        <i class="fa-solid fa-vr-cardboard"></i>جولة افتراضية
                    </button>
                    <button class="quick-action" onclick="switchMediaTab('street'); loadStreetViewInline();">
                        <i class="fa-solid fa-road"></i>منظور الشارع
                    </button>
                </div>
            </div>
        </section>

        {{-- ── FEATURES / PROPERTY ── --}}
        @if(($estate['category'] ?? null) != "5" && !empty($estate['property']))
        <section class="cardx">
            <div class="cardx-head">
                <div>
                    <h3 class="cardx-title">مميزات العقار</h3>
                    <div class="cardx-subtitle">ملخص الخصائص الأساسية</div>
                </div>
            </div>
            <div class="section-body">
                <div class="chips">
                    @foreach($estate['property'] as $property)
                        <div class="chip">
                            @php
                                $icon = match($property->name) {
                                    'حمام'      => 'fa-shower',
                                    'غرف نوم'   => 'fa-bed',
                                    'مطبخ'      => 'fa-kitchen-set',
                                    'صلات'      => 'fa-couch',
                                    default     => 'fa-check',
                                };
                            @endphp
                            <i class="fa-solid {{ $icon }}"></i>
                            <strong>{{ $property->number }}</strong> {{ $property->name }}
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- ── ALL DETAILS ── --}}
        <section class="cardx">
            <div class="cardx-head">
                <div>
                    <h3 class="cardx-title">تفاصيل العقار الكاملة</h3>
                    <div class="cardx-subtitle">جميع البيانات والمعلومات الخاصة بالإعلان</div>
                </div>
            </div>

            <div class="section-body">

                {{-- ─ الأساسيات ─ --}}
                <div class="sub-head"><i class="fa-solid fa-circle-info"></i> المعلومات الأساسية</div>
                <div class="detail-grid">

                    @if($estate["advertisement_type"] ?? null)
                        <div class="detail-item"><span class="k">الغرض من الإعلان</span><div class="v">{{ $estate["advertisement_type"] }}</div></div>
                    @endif

                    @if($estate["category_name"] ?? null)
                        <div class="detail-item"><span class="k">نوع العقار</span><div class="v">{{ $estate["category_name"] }}</div></div>
                    @endif

                    @if($estate["city"] ?? null)
                        <div class="detail-item"><span class="k">المدينة</span><div class="v">{{ $estate["city"] }}</div></div>
                    @endif

                    @if($estate["districts"] ?? null)
                        <div class="detail-item"><span class="k">الحي</span><div class="v">{{ $estate["districts"] }}</div></div>
                    @endif

                    @if(($estate["zone_name_ar"] ?? null) || ($estate["zone_name"] ?? null))
                        <div class="detail-item">
                            <span class="k">المنطقة</span>
                            <div class="v">{{ app()->getLocale() == 'ar' ? ($estate["zone_name_ar"] ?? '') : ($estate["zone_name"] ?? '') }}</div>
                        </div>
                    @endif

                    @if($estate["address"] ?? null)
                        <div class="detail-item full"><span class="k">العنوان</span><div class="v">{{ $estate["address"] }}</div></div>
                    @endif

                </div>

                {{-- ─ المساحة والأسعار ─ --}}
                <div class="sub-head"><i class="fa-solid fa-tag"></i> المساحة والأسعار</div>
                <div class="detail-grid">

                    @if($estate["space"] ?? null)
                        <div class="detail-item"><span class="k">المساحة الإجمالية</span><div class="v">{{ $estate["space"] }}</div></div>
                    @endif

                    @if(!empty($estate["build_space"]) && $estate["build_space"] != "undefined")
                        <div class="detail-item"><span class="k">مساحة البناء</span><div class="v">{{ $estate["build_space"] }}</div></div>
                    @endif

                    @if(!empty($estate["age_estate"]) && $estate["age_estate"] != "undefined" && $estate["age_estate"] != "null")
                        <div class="detail-item"><span class="k">عمر العقار</span><div class="v">{{ $estate["age_estate"] }}</div></div>
                    @endif

                    @if($estate["price"] ?? null)
                        <div class="detail-item">
                            <span class="k">@if(($estate["category_name"] ?? '') == "ارض") سعر المتر @else السعر @endif</span>
                            <div class="v price-value">
                                <span>{{ $estate["price"] }}</span>
                                <img src="{{ asset('public/assets/images/ryal.png') }}" alt="sar">
                            </div>
                        </div>
                    @endif

                    @if(($estate["category_name"] ?? '') == "ارض" && ($estate["total_price"] ?? null))
                        <div class="detail-item">
                            <span class="k">إجمالي السعر</span>
                            <div class="v price-value">
                                <span>{{ $estate["total_price"] }}</span>
                                <img src="{{ asset('public/assets/images/ryal.png') }}" alt="sar">
                            </div>
                        </div>
                    @endif

                    @if($estate["price_negotiation"] ?? null)
                        <div class="detail-item"><span class="k">تفاوض السعر</span><div class="v">{{ $estate["price_negotiation"] }}</div></div>
                    @endif

                </div>

                {{-- ─ تفاصيل الملكية ─ --}}
                <div class="sub-head"><i class="fa-solid fa-file-contract"></i> تفاصيل الملكية والتسجيل</div>
                <div class="detail-grid">

                    @if($estate["ownership_type"] ?? null)
                        <div class="detail-item"><span class="k">نوع الملكية</span><div class="v">{{ $estate["ownership_type"] }}</div></div>
                    @endif

                    @if($estate["property_type"] ?? null)
                        <div class="detail-item">
                            <span class="k">نوع المعلن</span>
                            <div class="v">{{ $estate["property_type"] == 1 ? translate('owner') : translate('commissioner') }}</div>
                        </div>
                    @endif

                    @if($estate["titleDeedTypeName"] ?? null)
                        <div class="detail-item"><span class="k">نوع وثيقة الملكية</span><div class="v">{{ $estate["titleDeedTypeName"] }}</div></div>
                    @endif

                    @if($estate["deed_number"] ?? null)
                        <div class="detail-item"><span class="k">رقم وثيقة الملكية</span><div class="v">{{ $estate["deed_number"] }}</div></div>
                    @endif
                    
                    
                    
                    
                    {{-- خانة الكيو ار كود --}}
@if(!empty($estate["adLicenseUrl"]))
    <div class="detail-item">
        <span class="k">الكيو ار كود</span>
        <div class="v text-center pt-1">
            <a href="{{ $estate['adLicenseUrl'] }}" target="_blank" title="اضغط للذهاب للرابط">
                {{-- توليد صورة QR Code من الرابط مباشرة --}}
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{ urlencode($estate['adLicenseUrl']) }}" 
                     alt="QR Code" 
                     style="width: 80px; height: 80px; border-radius: 10px; cursor: pointer; margin-bottom: 5px;">
                
                <div style="font-size: 0.8rem; color: var(--primary); margin-top: 5px;">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i> اضغط للفتح
                </div>
            </a>
        </div>
    </div>
@endif

                    @if($estate["national_address"] ?? null)
                        <div class="detail-item"><span class="k">الرمز الوطني المختصر</span><div class="v">{{ $estate["national_address"] }}</div></div>
                    @endif

                    @if($estate["propertyUsages"] ?? null)
                        <div class="detail-item"><span class="k">استخدام العقار</span><div class="v">{{ $estate["propertyUsages"] }}</div></div>
                    @endif

                    @if($estate["mainLandUseTypeName"] ?? null)
                        <div class="detail-item"><span class="k">استخدام الأرض الرئيسي</span><div class="v">{{ $estate["mainLandUseTypeName"] }}</div></div>
                    @endif

                    @if(($estate["category_name"] ?? '') != 'ارض' && ($estate["numberOfRooms"] ?? null))
                        <div class="detail-item"><span class="k">عدد الغرف</span><div class="v">{{ $estate["numberOfRooms"] }}</div></div>
                    @endif

                    @if($estate["landNumber"] ?? null)
                        <div class="detail-item"><span class="k">رقم القطعة</span><div class="v">{{ $estate["landNumber"] }}</div></div>
                    @endif

                    @if($estate["plan_number"] ?? null)
                        <div class="detail-item"><span class="k">رقم المخطط</span><div class="v">{{ $estate["plan_number"] }}</div></div>
                    @endif

                    @if($estate["property_face"] ?? null)
                        <div class="detail-item"><span class="k">واجهة العقار</span><div class="v">{{ $estate["property_face"] }}</div></div>
                    @endif

                    @if($estate["street_space"] ?? null)
                        <div class="detail-item"><span class="k">عرض الشارع</span><div class="v">{{ $estate["street_space"] }}</div></div>
                    @endif

                    @if($estate["obligationsOnTheProperty"] ?? null)
                        <div class="detail-item"><span class="k">الالتزامات على العقار</span><div class="v">{{ $estate["obligationsOnTheProperty"] }}</div></div>
                    @endif

                    @if($estate["guaranteesAndTheirDuration"] ?? null)
                        <div class="detail-item"><span class="k">الضمانات ومدتها</span><div class="v">{{ $estate["guaranteesAndTheirDuration"] }}</div></div>
                    @endif

                </div>

                {{-- ─ بيانات الرخصة ─ --}}
                <div class="sub-head"><i class="fa-solid fa-id-card"></i> بيانات الرخصة والتراخيص</div>
                <div class="detail-grid">

                    @if($estate["ad_license_number"] ?? null)
                        <div class="detail-item"><span class="k">رقم رخصة الإعلان</span><div class="v">{{ $estate["ad_license_number"] }}</div></div>
                    @endif

                    @if($estate["brokerageAndMarketingLicenseNumber"] ?? null)
                        <div class="detail-item"><span class="k">رقم رخصة فال</span><div class="v">{{ $estate["brokerageAndMarketingLicenseNumber"] }}</div></div>
                    @endif

                    @if($estate["creation_date"] ?? null)
                        <div class="detail-item"><span class="k">تاريخ إصدار رخصة الإعلان</span><div class="v">{{ $estate["creation_date"] }}</div></div>
                    @endif

                    @if($estate["end_date"] ?? null)
                        <div class="detail-item"><span class="k">تاريخ انتهاء رخصة الإعلان</span><div class="v">{{ $estate["end_date"] }}</div></div>
                    @endif

                    @if($estate["authorization_number"] ?? null)
                        <div class="detail-item"><span class="k">{{ translate('authorization_number') }}</span><div class="v">{{ $estate["authorization_number"] }}</div></div>
                    @endif

                </div>

                {{-- ─ خدمات مع العقار ─ --}}
                @if(!empty($estate["propertyUtilities"]) && is_array($estate["propertyUtilities"]))
                    <div class="sub-head"><i class="fa-solid fa-plug"></i> خدمات مع العقار</div>
                    <div class="chips">
                        @foreach($estate["propertyUtilities"] as $utility)
                            <div class="chip"><i class="fa-solid fa-check-circle"></i>{{ $utility }}</div>
                        @endforeach
                    </div>
                @endif

                {{-- ─ الحدود الأربعة ─ --}}
                @if(($estate["north_limit"] ?? null) || ($estate["east_limit"] ?? null) || ($estate["west_limit"] ?? null) || ($estate["south_limit"] ?? null))
                    <div class="sub-head"><i class="fa-solid fa-compass"></i> حدود العقار</div>
                    <div class="detail-grid">
                        @if(!empty($estate["north_limit"]) && $estate["north_limit"] != "- -")
                            <div class="detail-item"><span class="k">🧭 الحد الشمالي</span><div class="v">{{ $estate["north_limit"] }}</div></div>
                        @endif
                        @if($estate["south_limit"] ?? null)
                            <div class="detail-item"><span class="k">🧭 الحد الجنوبي</span><div class="v">{{ $estate["south_limit"] }}</div></div>
                        @endif
                        @if($estate["east_limit"] ?? null)
                            <div class="detail-item"><span class="k">🧭 الحد الشرقي</span><div class="v">{{ $estate["east_limit"] }}</div></div>
                        @endif
                        @if($estate["west_limit"] ?? null)
                            <div class="detail-item"><span class="k">🧭 الحد الغربي</span><div class="v">{{ $estate["west_limit"] }}</div></div>
                        @endif
                    </div>
                @endif




                {{-- ─ الواجهات ─ --}}
                @if(!empty($estate['interface']) && is_array($estate['interface']) && count($estate['interface']) > 0)
                    <div class="sub-head"><i class="fa-solid fa-border-all"></i> {{ translate('interface') }}</div>
                    <div class="chips">
                        @foreach($estate['interface'] as $interf)
                            <div class="chip">
                                <i class="fa-solid fa-arrows-alt-h"></i>
                                {{ $interf->name }} &nbsp; {{ $interf->space }}
                            </div>
                        @endforeach
                    </div>
                @endif

                {{-- ─ المزايا الأخرى ─ --}}
                @if(!empty($estate['other_advantages']) && is_array($estate['other_advantages']) && count($estate['other_advantages']) > 0)
                    <div class="sub-head"><i class="fa-solid fa-star"></i> {{ translate('Other Advantages') }}</div>
                    <div class="chips">
                        @foreach($estate['other_advantages'] as $advantage)
                            <div class="chip"><i class="fa-solid fa-star"></i>{{ $advantage['name'] }}</div>
                        @endforeach
                    </div>
                @endif

                {{-- ─ أنواع الشبكات ─ --}}
                @if(!empty($estate['network_type']) && count($estate['network_type']) > 0)
                    <div class="sub-head"><i class="fa-solid fa-wifi"></i> {{ translate('Network Types') }}</div>
                    <div class="chips">
                        @foreach($estate['network_type'] as $network)
                            <div class="chip"><i class="fa-solid fa-wifi"></i>{{ $network->name }}</div>
                        @endforeach
                    </div>
                @endif

                {{-- ─ وصف صك وزارة العدل ─ --}}
                @if(!empty($estate["locationDescriptionOnMOJDeed"]))
                    <div class="moj-box">
                        <div class="moj-label">
                            <i class="fa-solid fa-gavel"></i>
                            وصف الموقع حسب صك وزارة العدل
                        </div>
                        <p>{{ $estate["locationDescriptionOnMOJDeed"] }}</p>
                    </div>
                @endif

            </div>
        </section>

        {{-- ── DESCRIPTION ── --}}
        <section class="cardx">
            <div class="cardx-head">
                <div>
                    <h3 class="cardx-title">الوصف التفصيلي</h3>
                </div>
            </div>
            <div class="section-body">
                <div class="description-box">{{ $estate["long_description"] ?? '' }}</div>
            </div>
        </section>

        {{-- ── MAP ── --}}
        <section class="cardx">
            <div class="cardx-head" style="padding-bottom:16px;">
                <div>
                    <h3 class="cardx-title">الموقع والخدمات القريبة</h3>
                    <div class="cardx-subtitle">
                        <i class="fa-solid fa-triangle-exclamation" style="color:#f59e0b;"></i>
                        &nbsp;نأمل مطابقة الموقع مع عنوان العقار المذكور أعلاه
                    </div>
                </div>
            </div>

            <div class="nearby-toolbar">
                <button class="nearby-btn" onclick="setNearbyActive(this); searchNearby('school')">🏫 المدارس</button>
                <button class="nearby-btn" onclick="setNearbyActive(this); searchNearby('hospital')">🏥 المستشفيات</button>
                <button class="nearby-btn" onclick="setNearbyActive(this); searchNearby('pharmacy')">💊 الصيدليات</button>
                <button class="nearby-btn" onclick="setNearbyActive(this); searchNearby('mosque')">🕌 المساجد</button>
                <button class="nearby-btn" onclick="setNearbyActive(this); searchNearby('restaurant')">🍽️ المطاعم</button>
            </div>

            <div class="map-shell">
                <div id="map"></div>
            </div>
        </section>

    </div>
    {{-- ══════════════ END MAIN ══════════════ --}}


    {{-- ══════════════ SIDEBAR ══════════════ --}}
    <aside class="sticky-side">

        {{-- SELLER CARD --}}
        <section class="seller-card">
            <div class="seller-cover"></div>
            <div class="seller-body text-center">
                <img class="seller-avatar"
                     src="{{ $estate['users']['image'] ? asset('storage/app/public/profile/' . $estate['users']['image']) : asset('storage/app/public/profile/default_avatar.png') }}"
                     onerror="this.src='{{ asset('storage/app/public/profile/default_avatar.png') }}'">

                <div class="seller-name">{{ $estate['users']['name'] ?? '-' }}</div>
                <div class="seller-phone">{{ $estate['users']['phone'] ?? '-' }}</div>

                <div class="seller-metrics">
                    <div class="seller-metric">
                        <span class="k">رخصة فال</span>
                        <div class="v">{{ $estate['license_number'] ?? '0' }}</div>
                    </div>
                    <div class="seller-metric">
                        <span class="k">العضوية</span>
                        <div class="v">{{ $estate['users']['membership_type'] ?? '0' }}</div>
                    </div>
                </div>

                <div class="cta-stack">
                    @if(auth('customer')->id())
                        <button class="cta-primary" data-bs-toggle="modal" data-bs-target="#chatting_modal">
                            <i class="fa-solid fa-comments"></i>{{ translate('chat_with_advertiser') }}
                        </button>
                    @endif

                    <a class="cta-secondary" href="tel:{{ $estate['users']['phone'] }}">
                        <i class="fa-solid fa-phone"></i> اتصال مباشر
                    </a>

                    <a class="cta-secondary cta-whatsapp" target="_blank"
                       href="https://wa.me/{{ $estate['users']['phone'] }}?text={{ urlencode('السلام عليكم أرغب في التواصل بخصوص العرض العقاري من منصة أبعاد. رابط العقار: ' . url()->current()) }}">
                        <i class="fa-brands fa-whatsapp"></i> واتساب
                    </a>

                    @if(auth('customer')->id())
                        <button class="cta-secondary" data-bs-toggle="modal" data-bs-target="#reportModal">
                            <i class="fa-regular fa-flag"></i>{{ translate('Report Property') }}
                        </button>
                    @endif
                </div>

                <div class="social-row">
                    @if(!empty($userInfo->snapchat))
                        <a href="{{ $userInfo->snapchat }}" target="_blank"><img src="{{ asset('public/assets/images/snap.png') }}" alt="snap"></a>
                    @endif
                    @if(!empty($userInfo->twitter))
                        <a href="{{ $userInfo->twitter }}" target="_blank"><img src="{{ asset('public/assets/images/twiter.png') }}" alt="twitter"></a>
                    @endif
                    @if(!empty($userInfo->instagram))
                        <a href="{{ $userInfo->instagram }}" target="_blank"><img src="{{ asset('public/assets/images/instgram.png') }}" alt="instagram"></a>
                    @endif
                    @if(!empty($userInfo->youtube))
                        <a href="{{ $userInfo->youtube }}" target="_blank"><img src="{{ asset('public/assets/images/youtube.png') }}" alt="youtube"></a>
                    @endif
                    @if(!empty($userInfo->tiktok))
                        <a href="{{ $userInfo->tiktok }}" target="_blank"><img src="{{ asset('public/assets/images/tiktok.png') }}" alt="tiktok"></a>
                    @endif
                </div>
            </div>
        </section>

  {{-- STATS CARD UPGRADED --}}
<section class="side-mini-card" style="padding: 0; overflow: hidden;">
    
    {{-- صف المشاهدات (بيان ثابت) --}}
    <div style="padding: 18px; display: flex; align-items: center; gap: 14px;">
        <div style="width: 50px; height: 50px; background: #f8fafc; border: 1px solid var(--line); border-radius: 14px; display: flex; align-items: center; justify-content: center;">
            <img src="{{ asset('public/assets/images/view.png') }}" alt="views" style="width: 22px; height: 22px; opacity: 0.7;">
        </div>
        <div style="flex: 1;">
            <span style="font-size: 13px; color: var(--muted); font-weight: 600; display: block; margin-bottom: 2px;">عدد المشاهدات</span>
            <strong style="font-size: 20px; color: var(--text); font-weight: 900;">{{ $estate["view"] ?? 0 }}</strong>
        </div>
    </div>

    {{-- فاصل --}}
    <div style="height: 1px; background: var(--line); width: 88%; margin: 0 auto;"></div>

    {{-- زر مقدمي الخدمة (تفاعلي) --}}
    <div data-bs-toggle="modal" data-bs-target="#servicesModal" onclick="loadServiceOffers()"
         style="padding: 18px; display: flex; align-items: center; gap: 14px; cursor: pointer; transition: 0.3s ease-in-out;"
         onmouseover="this.style.background='linear-gradient(135deg, #f0fdfa, #e0f2fe)'" 
         onmouseout="this.style.background='transparent'">
        
        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #ccfbf1, #99f6e4); border-radius: 14px; display: flex; align-items: center; justify-content: center;">
            <img src="{{ asset('public/assets/images/offer_icon.png') }}" alt="offers" style="width: 24px; height: 24px;">
        </div>
        
        <div style="flex: 1;">
            <span style="font-size: 13px; color: var(--muted); font-weight: 600; display: block; margin-bottom: 2px;">مقدمو الخدمة</span>
            <div style="display: flex; align-items: center; gap: 8px;">
            
                <span style="background: #dcfce7; color: #16a34a; font-size: 10px; font-weight: 800; padding: 3px 8px; border-radius: 20px;">متاح الآن</span>
            </div>
        </div>

        {{-- سهم للإشارة للنقر --}}
        <div style="width: 34px; height: 34px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #fff; box-shadow: 0 4px 12px rgba(15,91,215,.25);">
            <i class="fa-solid fa-chevron-left" style="font-size: 12px;"></i>
        </div>
    </div>

</section>

        {{-- SERVICE OFFERS --}}
        @if(!empty($estate['service_offers']))
        <section class="side-mini-card">
            <h3 class="cardx-title" style="margin-bottom:14px;">{{ translate('Service provider offers') }}</h3>

            @foreach($estate['service_offers'] as $offer)
                <div class="offer-card">
                    <div class="offer-ribbon">
                        @if($offer['offer_type'] === 'discount') -{{ $offer['discount'] }}%
                        @elseif($offer['offer_type'] === 'price') -{{ $offer['service_price'] }} SAR
                        @endif
                    </div>
                    <div class="offer-inner">
                        <img class="offer-thumb" src="{{ asset('storage/app/public/'.$offer['image']) }}" alt="{{ $offer['title'] }}">
                        <div>
                            <div class="offer-name">{{ $offer['title'] }}</div>
                            <div class="offer-price">{{ $offer['service_price'] }} SAR</div>
                            <div class="offer-expiry">{{ translate('Expiry Date') }}: {{ $offer['expiry_date'] }}</div>
                            <div class="offer-links">
                                <a href="tel:{{ $offer['phone_provider'] }}"><i class="fa-solid fa-phone"></i></a>
                                <a target="_blank"
                                   href="https://wa.me/{{ $offer['phone_provider'] }}?text={{ urlencode('مرحباً، تم التواصل عبر منصة أبعاد. رابط الإعلان: ' . url()->current()) }}">
                                    <i class="fa-brands fa-whatsapp" style="color:#25d366;font-size:1.1rem;"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </section>
        @endif

    </aside>
    {{-- ══════════════ END SIDEBAR ══════════════ --}}

</div>
</div>
</div>
{{-- ══════════════ END SHELL ══════════════ --}}


{{-- ══════════════ MOBILE BOTTOM BAR ══════════════ --}}

<div class="mobile-bar">
    
           @if(auth('customer')->id())
    <div class="mobile-bar-grid">
 
            <!--<button class="mbar-chat" data-bs-toggle="modal" data-bs-target="#chatting_modal">-->
            <!--    <i class="fa-solid fa-comments d-block mb-1" style="font-size:1.1rem;"></i>دردشة-->
            <!--</button>-->
            
             <a href="tel:{{ $estate['users']['phone'] }}" class="mbar-call">
                <i class="fa-solid fa-phone d-block mb-1" style="font-size:1.1rem;"></i>اتصال
            </a>
            
            
            
             <a class="mbar-wa" target="_blank"
           href="https://wa.me/{{ $estate['users']['phone'] }}?text={{ urlencode('السلام عليكم أرغب في التواصل بخصوص العرض العقاري من منصة أبعاد. رابط العقار: ' . url()->current()) }}">
            <i class="fa-brands fa-whatsapp d-block mb-1" style="font-size:1.1rem;"></i>واتساب
        </a>
        
        <!--<a class="mbar-call" href="tel:{{ $estate['users']['phone'] }}">-->
        <!--    <i class="fa-solid fa-phone d-block mb-1" style="font-size:1.1rem;"></i>اتصال-->
        <!--</a>-->
        <!--<a class="mbar-wa" target="_blank"-->
        <!--   href="https://wa.me/{{ $estate['users']['phone'] }}?text={{ urlencode('السلام عليكم أرغب في التواصل بخصوص العرض العقاري من منصة أبعاد. رابط العقار: ' . url()->current()) }}">-->
        <!--    <i class="fa-brands fa-whatsapp d-block mb-1" style="font-size:1.1rem;"></i>واتساب-->
        <!--</a>-->
    </div>
    @else
    
    <a href="{{ route('customer.auth.login') }}" 
   style="
       background: linear-gradient(135deg, #0f766e, #0d9488); 
       color: #fff; 
       flex: 1; 
       display: flex; 
       flex-direction: column; 
       align-items: center; 
       justify-content: center; 
       border-radius: 16px; 
       text-decoration: none; 
       font-family: 'Cairo', sans-serif; 
       font-weight: 700; 
       box-shadow: 0 8px 20px rgba(13, 148, 136, 0.25); 
       padding: 12px;
       transition: transform 0.2s;
   ">
    <i class="fa-solid fa-lock" style="font-size: 1.2rem; margin-bottom: 6px; opacity: 0.9;"></i>
    <span style="font-size: 14px;">للتواصل مع المعلن</span>
    <small style="font-size: 11px; margin-top: 2px; opacity: 0.8; font-weight: 600;">اضغط لتسجيل الدخول</small>
</a>
        @endif
</div>





        



{{-- ══════════════ MODALS ══════════════ --}}

{{-- Media Gallery Modal --}}
<div class="modal fade custom-modal" id="mediaGalleryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">معرض الصور</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-3" id="mediaGalleryModalBody"></div>
        </div>
    </div>
</div>

{{-- Report Modal --}}
<div class="modal fade custom-modal" id="reportModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ translate("Report Property") }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form id="reportForm">
                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ translate("Reason for Report") }}</label>
                        <select class="form-control" id="reportReason" name="title" required>
                            <option value="" disabled selected>{{ translate("Select a reason") }}</option>
                            <option value="Fraud">{{ translate("Fraud") }}</option>
                            <option value="Misleading Information">{{ translate("Misleading Information") }}</option>
                            <option value="Spam">{{ translate("Spam") }}</option>
                            <option value="Other">سبب آخر</option>
                        </select>
                    </div>
                    <input type="hidden" value="{{ $estate['id'] }}" name="estate_id">
                    <div class="mb-3">
                        <label class="form-label fw-bold">{{ translate("Report Description") }}</label>
                        <textarea name="description" class="form-control" rows="4" required placeholder="{{ translate("Enter your report here") }}"></textarea>
                    </div>
                    <div class="d-flex gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">{{ translate("Submit Report") }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Success Modal --}}
<div class="modal fade custom-modal" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background:linear-gradient(135deg,#16a34a,#22c55e);">
                <h5 class="modal-title">{{ translate("Success") }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-4">
                <p class="mb-0">تم إرسال البلاغ بنجاح، شكراً لتعاونك معنا.</p>
            </div>
        </div>
    </div>
</div>












{{-- Services Modal --}}
<div class="modal fade custom-modal" id="servicesModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header" style="background: linear-gradient(135deg, #0f5bd7, #114b89);">
                <h5 class="modal-title"><i class="fa-solid fa-users-viewfinder me-2"></i>مقدمو الخدمات</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-3" id="servicesModalBody">
                {{-- هنا سيتم تحميل المحتوى ديناميكيًا --}}
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <div class="mt-3 text-muted">جاري البحث عن خدمات مطابقة...</div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.front-end.partials.modal._chatting',['seller'=> $estate['users'], 'user_type'=>$estate['user_id']])
@endsection


@push('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFuZIjGVfo57sJk3EmCSV0SpP7qVgg7n4&libraries=places&callback=initMap" async defer></script>

<script>
/* ── DATA ── */
const estateImages = @json(is_array($estate['images'] ?? null) ? $estate['images'] : []);
const estatePlans  = @json(is_array($estate['planned'] ?? null) ? $estate['planned'] : []);

/* ── INIT ── */
document.addEventListener('DOMContentLoaded', function () {
    initMediaTabs();
    initImageGallery();
    initPlanGallery();
    initVideoSelector();
});

/* ── MEDIA TABS ── */
function initMediaTabs() {
    const tabs   = document.querySelectorAll('.media-tab');
    const panels = document.querySelectorAll('.media-panel');

    tabs.forEach(tab => {
        tab.addEventListener('click', function () {
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            const target = this.dataset.mediaTab;
            panels.forEach(panel => {
                panel.classList.toggle('d-none', panel.dataset.panel !== target);
            });
        });
    });
}

function switchMediaTab(tabName) {
    const tab = document.querySelector(`.media-tab[data-media-tab="${tabName}"]`);
    if (tab) tab.click();
}

/* ── IMAGE GALLERY ── */
function initImageGallery() {
    const railItems = document.querySelectorAll('#imageRail .rail-item');
    const mainImage = document.getElementById('mainGalleryImage');
    const counter   = document.getElementById('imageCurrentIndex');

    if (!railItems.length || !mainImage) return;

    railItems.forEach(item => {
        item.addEventListener('click', function () {
            railItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');
            mainImage.src = this.dataset.src;
            if (counter) counter.textContent = parseInt(this.dataset.index, 10) + 1;
        });
    });
}

/* ── PLAN GALLERY ── */
function initPlanGallery() {
    const railItems = document.querySelectorAll('#planRail .rail-item');
    const mainImage = document.getElementById('mainPlanImage');

    if (!railItems.length || !mainImage) return;

    railItems.forEach(item => {
        item.addEventListener('click', function () {
            railItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');
            mainImage.src = this.dataset.src;
        });
    });
}

/* ── VIDEO SELECTOR ── */
function initVideoSelector() {
    const selectors = document.querySelectorAll('.video-selector');
    const mainSource = document.getElementById('mainVideoSource');
    const mainPlayer = document.getElementById('mainVideoPlayer');
    const titleEl   = document.getElementById('videoTitleOverlay');

    if (!selectors.length || !mainSource || !mainPlayer) return;

    selectors.forEach(btn => {
        btn.addEventListener('click', function () {
            selectors.forEach(s => s.classList.remove('active'));
            this.classList.add('active');
            mainSource.src = this.dataset.videoSrc;
            if (titleEl) titleEl.textContent = this.dataset.videoTitle || 'فيديو';
            mainPlayer.load();
            mainPlayer.play().catch(() => {});
        });
    });
}

/* ── OPEN GALLERY MODAL ── */
function openMediaGallery(type) {
    const body = document.getElementById('mediaGalleryModalBody');
    let html = '';

    if (type === 'images') {
        if (!estateImages.length) {
            html = '<div class="text-center text-muted py-4">لا توجد صور</div>';
        } else {
            html = '<div class="fullscreen-gallery">';
            estateImages.forEach(img => {
                html += `<img src="{{ asset('storage/app/public/estate') }}/${img}"
                              onerror="this.src='{{ asset('storage/app/public/estate/not_found.png') }}'"
                              alt="gallery">`;
            });
            html += '</div>';
        }
    }

    body.innerHTML = html;
    new bootstrap.Modal(document.getElementById('mediaGalleryModal')).show();
}

/* ── STREET VIEW INLINE ── */
function loadStreetViewInline() {
    const lat    = Number("{{ $estate['latitude']  ?? 0 }}");
    const lon    = Number("{{ $estate['longitude'] ?? 0 }}");
    const panel  = document.getElementById('streetViewPanel');

    if (!isNaN(lat) && !isNaN(lon) && lat !== 0 && lon !== 0) {
        const apiKey = "AIzaSyAFuZIjGVfo57sJk3EmCSV0SpP7qVgg7n4";
        const url    = `https://www.google.com/maps/embed/v1/streetview?key=${apiKey}&location=${lat},${lon}&heading=210&pitch=10&fov=35`;

        panel.innerHTML = `
            <iframe width="100%" height="100%" style="border:0;display:block;" src="${url}" allowfullscreen loading="lazy"></iframe>
            <div class="preview-overlay">
                <div class="title">منظور الشارع</div>
                <div class="meta">استكشاف محيط العقار</div>
            </div>`;
    } else {
        panel.innerHTML = `
            <div class="empty-media" style="min-height:420px;">
                <i class="fa-solid fa-triangle-exclamation fa-2x"></i>
                <div>الإحداثيات غير صالحة لعرض منظور الشارع</div>
            </div>`;
    }
}

/* ── NEARBY ── */
function setNearbyActive(button) {
    document.querySelectorAll('.nearby-btn').forEach(b => b.classList.remove('active'));
    button.classList.add('active');
}

/* ── REPORT FORM ── */
document.getElementById("reportForm")?.addEventListener("submit", function (e) {
    e.preventDefault();
    let formData = new FormData(this);

    fetch("{{ route('report') }}", {
        method: "POST",
        headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}", "Accept": "application/json" },
        body: formData
    })
    .then(r => { if (!r.ok) return r.text().then(t => { throw new Error(t); }); return r.json(); })
    .then(() => {
        bootstrap.Modal.getInstance(document.getElementById('reportModal'))?.hide();
        new bootstrap.Modal(document.getElementById('successModal')).show();
        this.reset();
    })
    .catch(err => console.error("Error:", err));
});

/* ── GOOGLE MAPS ── */
let map, service, infowindow, userLocation;
window.placeMarkers = [];

function initMap() {
    userLocation = new google.maps.LatLng(
        {{ $estate['latitude']  ?? 24.7136 }},
        {{ $estate['longitude'] ?? 46.6753 }}
    );

    map = new google.maps.Map(document.getElementById('map'), {
        center: userLocation, zoom: 15,
        mapTypeControl: false, streetViewControl: false, fullscreenControl: true
    });

    new google.maps.Marker({
        position: userLocation, map,
        title: "موقع العقار",
        icon: { url: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png" }
    });

    infowindow = new google.maps.InfoWindow();
}

function searchNearby(type) {
    if (!userLocation || !map) return;

    service = new google.maps.places.PlacesService(map);
    service.nearbySearch({ location: userLocation, radius: 5000, type }, (results, status) => {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
            window.placeMarkers.forEach(m => m.setMap(null));
            window.placeMarkers = [];
            results.forEach(place => createMarker(place));
        }
    });
}

function createMarker(place) {
    if (!place.geometry?.location) return;
    const types = place.types || [];
    let iconUrl = null;
    for (const t of types) { iconUrl = getIconForPlaceType(t); if (iconUrl) break; }

    const marker = new google.maps.Marker({
        map, position: place.geometry.location,
        icon: iconUrl ? { url: iconUrl, scaledSize: new google.maps.Size(32, 50) } : undefined
    });

    window.placeMarkers.push(marker);
    google.maps.event.addListener(marker, 'click', () => {
        infowindow.setContent(place.name || "");
        infowindow.open(map, marker);
    });
}

function getIconForPlaceType(type) {
    const base = "{{ asset('public/assets/images/') }}/";
    return { school: base+'mark_school.png', pharmacy: base+'mark_pharmcy.png',
             hospital: base+'mark_hosiptal.png', restaurant: base+'mark_restaurant.png' }[type] || null;
}

/* ── AD VALIDATION ── */
$(document).ready(function () {
    const adLicenseNumber = "{{ $estate['ad_number'] ?? '' }}";
    const idType          = "{{ $estate['estate_type'] ?? 0 }}";
    const identity        = "{{ $estate['identityـorـunified'] ?? 0 }}";
    
    
    
    console.log("رقم الترخيص"+adLicenseNumber);
console.log("النوع"+idType);
console.log("الهويه"+identity);

    $.ajax({
        url: "https://app.abaadapp.sa/api/v1/banners/advertisement/validate",
        type: "POST",
        data: { adLicenseNumber, advertiserId: identity, idType },
        success: function (res) {
            if (res.success === false || res.message === "رقم إعلان غير صحيح")
                showFullScreenMessage("الإعلان غير صالح أو منتهي");
        },
        error: function (xhr) {
            const msg = xhr.responseJSON?.message;
            if (msg === "رقم إعلان غير صحيح" || msg)
                showFullScreenMessage(msg || "الإعلان غير صالح أو منتهي");
        }
    });

    function showFullScreenMessage(msg) {
        $("body").children().hide();
        $("body").append(`
            <div id="full-screen-error" style="
                position:fixed;inset:0;
                background:linear-gradient(135deg,#f5f7fa,#c3cfe2);
                display:flex;align-items:center;justify-content:center;
                text-align:center;padding:20px;z-index:999999;
                font-family:'Tajawal',sans-serif;">
              <div style="background:#fff;border-radius:24px;padding:40px;box-shadow:0 10px 40px rgba(0,0,0,.12);max-width:520px;width:90%;">
                <div style="font-size:72px;margin-bottom:16px;">⚠️</div>
                <h2 style="color:#1e293b;font-size:1.6rem;margin-bottom:12px;font-weight:800;">تنبيه</h2>
                <p style="color:#475569;font-size:1.1rem;margin-bottom:28px;line-height:1.7;">${msg}</p>
                <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
                  <button id="go-back-btn" style="padding:12px 26px;font-size:1rem;font-weight:800;background:#3b82f6;color:#fff;border:none;border-radius:12px;cursor:pointer;">⬅ رجوع</button>
                  <button id="refresh-btn"  style="padding:12px 26px;font-size:1rem;font-weight:800;background:#22c55e;color:#fff;border:none;border-radius:12px;cursor:pointer;">🔄 تحديث</button>
                </div>
              </div>
            </div>`);

        $("#go-back-btn").on("click", () => { $("#full-screen-error").remove(); history.back(); });
        $("#refresh-btn").on("click", () => location.reload());
    }
});











/* ── SERVICE OFFERS LOGIC ── */
// تعريف المتغيرات اللازمة من بيانات العقار
const currentCategoryId = "{{ $estate['category_id'] ?? $estate['category'] ?? '' }}";
const currentZoneId = "{{ $estate['zone_id'] ?? '' }}";

function loadServiceOffers() {
    const body = document.getElementById('servicesModalBody');
    
    // عرض حالة التحميل
    body.innerHTML = `
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status"></div>
            <div class="mt-3 text-muted">جاري تحميل الخدمات...</div>
        </div>`;

    // التحقق من وجود البيانات
    if (!currentCategoryId || !currentZoneId) {
        body.innerHTML = `<div class="alert alert-warning text-center">لم يتم تحديد القسم أو المنطقة بشكل صحيح.</div>`;
        return;
    }

    // طلب البيانات من الـ API
    const apiUrl = `https://app.abaadapp.sa/api/v1/estate/get-services?category_id=${currentCategoryId}&zone_id=${currentZoneId}`;

    fetch(apiUrl)
        .then(response => response.json())
        .then(res => {
            if (res.status && res.data && res.data.length > 0) {
                renderServiceOffers(res.data);
            } else {
                body.innerHTML = `
                    <div class="empty-media" style="min-height:200px; box-shadow:none; border:none;">
                        <i class="fa-solid fa-box-open fa-2x"></i>
                        <div>لا توجد خدمات متاحة في هذه المنطقة حالياً</div>
                    </div>`;
            }
        })
        .catch(error => {
            console.error('Error loading services:', error);
            body.innerHTML = `<div class="alert alert-danger text-center">حدث خطأ أثناء جلب البيانات.</div>`;
        });
}

function renderServiceOffers(offers) {
    const body = document.getElementById('servicesModalBody');
    let html = '<div class="row g-3">';

    offers.forEach(offer => {
        const imageUrl = offer.image 
            ? `https://app.abaadapp.sa/storage/${offer.image}` 
            : '{{ asset("public/assets/images/default-estate.jpg") }}';
        
        const priceLabel = offer.offer_type === 'discount' 
            ? `<span style="color:#ef4444; font-weight:900;">خصم ${offer.discount}%</span>` 
            : `<span style="color:#16a34a; font-weight:900;">${offer.service_price} ريال</span>`;

        html += `
        <div class="col-md-6">
            <div class="offer-card" style="margin:0; height:100%;">
                <div class="offer-inner" style="display:block; text-align:center;">
                    <img class="offer-thumb" src="${imageUrl}" alt="${offer.title}" 
                         style="width:100%; height:160px; object-fit:cover; border-radius:12px; margin-bottom:12px;"
                         onerror="this.src='{{ asset("storage/app/public/estate/not_found.png") }}'">
                    
                    <div class="offer-name" style="font-size:1.1rem;">${offer.title}</div>
                    <div class="mb-2">${priceLabel}</div>
                    
                    <p class="text-muted small" style="line-height:1.6;">${offer.description || ''}</p>
                    
                    <div class="offer-links" style="justify-content:center; margin-top:12px;">
                        <a href="tel:${offer.phone_provider}" class="cta-secondary btn-sm" style="padding:8px 16px; font-size:12px;">
                            <i class="fa-solid fa-phone"></i> اتصال
                        </a>
                        <a href="https://wa.me/${offer.phone_provider}?text=${encodeURIComponent('مرحباً، رأيت عرضك في منصة أبعاد: ' + offer.title)}" 
                           target="_blank" class="cta-whatsapp btn-sm" style="padding:8px 16px; font-size:12px;">
                            <i class="fa-brands fa-whatsapp"></i> واتساب
                        </a>
                    </div>
                </div>
            </div>
        </div>`;
    });

    html += '</div>';
    body.innerHTML = html;
}
</script>
@endpush