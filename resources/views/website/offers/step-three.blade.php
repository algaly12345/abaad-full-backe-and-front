<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>بيانات مزود الخدمة | أبعاد العقارية</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">
    <style>
/* ═══════════════════════════════════════════════════════
   DESIGN TOKENS — متناسق مع صفحة العقارات
═══════════════════════════════════════════════════════ */
:root {
    --primary:         #114b89;
    --primary-dark:    #0d3b6b;
    --primary-light:   #1a65b8;
    --secondary:       #0f5bd7;
    --secondary-light: #3a7de8;
    --accent:          #14b86a;
    --accent-bg:       #e6f9f0;
    --gold:            #f59e0b;
    --gold-bg:         #fffbeb;
    --danger:          #ef4444;
    --danger-bg:       #fef2f2;

    --bg:              #f0f4fb;
    --card:            #ffffff;
    --text:            #0f172a;
    --text-light:      #334155;
    --muted:           #64748b;
    --muted-light:     #94a3b8;
    --border:          #e2e8f0;
    --border-hover:    #cbd5e1;
    --soft:            #f8fafc;
    --soft-blue:       #f1f5ff;
    --soft-blue-2:     #eef3ff;

    --grad-primary:    linear-gradient(135deg, #0f5bd7, #114b89);
    --grad-dark:       linear-gradient(135deg, #0b1220, #114b89);
    --grad-hero:       linear-gradient(140deg, #0b1220 0%, #0d3b6b 55%, #1a65b8 100%);

    --shadow-xs:  0 2px 8px  rgba(15,23,42,.05);
    --shadow-sm:  0 4px 18px rgba(15,23,42,.08);
    --shadow-md:  0 12px 36px rgba(15,23,42,.10);
    --shadow-lg:  0 24px 60px rgba(15,23,42,.13);
    --shadow-xl:  0 40px 80px rgba(15,23,42,.16);
    --shadow-primary: 0 12px 32px rgba(15,91,215,.22);

    --radius-xs: 8px;
    --radius-sm: 14px;
    --radius-md: 18px;
    --radius-lg: 24px;
    --radius-xl: 32px;

    --transition: .22s cubic-bezier(.4,0,.2,1);
    --font: 'Tajawal', 'Segoe UI', sans-serif;
}

/* ═══════════════════════════════════════════════════════
   BASE
═══════════════════════════════════════════════════════ */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

html { scroll-behavior: smooth; }

body {
    font-family: var(--font);
    font-size: 16px;
    line-height: 1.8;
    color: var(--text);
    background: var(--bg);
    min-height: 100vh;
    -webkit-font-smoothing: antialiased;
    background-image:
        radial-gradient(ellipse at top right, rgba(15,91,215,.07) 0%, transparent 50%),
        radial-gradient(ellipse at bottom left, rgba(17,75,137,.06) 0%, transparent 50%);
    background-attachment: fixed;
}

/* ═══════════════════════════════════════════════════════
   TOP BAR
═══════════════════════════════════════════════════════ */
.topbar {
    background: rgba(11,18,32,.96);
    border-bottom: 1px solid rgba(255,255,255,.06);
    position: sticky;
    top: 0;
    z-index: 999;
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    box-shadow: 0 4px 30px rgba(0,0,0,.15);
}

.topbar-inner {
    width: min(94%, 1400px);
    margin: auto;
    min-height: 78px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: wrap;
    padding: 14px 0;
}

.brand { display: flex; align-items: center; gap: 14px; }

.brand-mark {
    width: 52px;
    height: 52px;
    border-radius: 16px;
    background: var(--grad-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-family: var(--font);
    font-weight: 900;
    font-size: 24px;
    box-shadow: 0 8px 24px rgba(15,91,215,.3);
    flex-shrink: 0;
    position: relative;
    overflow: hidden;
}
.brand-mark::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(255,255,255,.2) 0%, transparent 60%);
    pointer-events: none;
}

.brand-text strong {
    display: block;
    color: #fff;
    font-size: 20px;
    font-weight: 800;
    line-height: 1.3;
}
.brand-text span {
    color: rgba(255,255,255,.5);
    font-size: 13px;
    font-weight: 500;
}

.step-pill {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 11px 22px;
    background: rgba(15,91,215,.18);
    border: 1px solid rgba(15,91,215,.35);
    border-radius: 999px;
    color: #93c5fd;
    font-size: 14px;
    font-weight: 700;
}

.step-dot {
    width: 8px;
    height: 8px;
    background: var(--secondary-light);
    border-radius: 50%;
    animation: pulseDot 2s ease-in-out infinite;
}
@keyframes pulseDot {
    0%, 100% { opacity: 1; transform: scale(1); box-shadow: 0 0 0 0 rgba(58,125,232,.5); }
    50% { opacity: .7; transform: scale(1.3); box-shadow: 0 0 0 5px rgba(58,125,232,0); }
}

/* ═══════════════════════════════════════════════════════
   HERO
═══════════════════════════════════════════════════════ */
.hero {
    background: var(--grad-hero);
    color: #fff;
    padding: 60px 0 80px;
    position: relative;
    overflow: hidden;
}

.hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(circle at 85% 25%, rgba(15,91,215,.25) 0%, transparent 42%),
        radial-gradient(circle at 10% 80%, rgba(17,75,137,.22) 0%, transparent 38%);
    pointer-events: none;
}

.hero::after {
    content: '';
    position: absolute;
    top: -80px; right: -80px;
    width: 340px; height: 340px;
    border-radius: 50%;
    background: rgba(255,255,255,.03);
    border: 1px solid rgba(255,255,255,.06);
    pointer-events: none;
}

/* dots grid */
.hero-dots {
    position: absolute;
    inset: 0;
    opacity: .04;
    background-image: radial-gradient(circle, #fff 1px, transparent 1px);
    background-size: 32px 32px;
    pointer-events: none;
}

.hero-inner {
    width: min(94%, 1400px);
    margin: auto;
    position: relative;
    z-index: 1;
    display: grid;
    grid-template-columns: 1.15fr .85fr;
    gap: 50px;
    align-items: center;
}

.hero-left {}

.hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background: rgba(255,255,255,.10);
    border: 1px solid rgba(255,255,255,.14);
    border-radius: 999px;
    backdrop-filter: blur(12px);
    font-size: .82rem;
    font-weight: 800;
    color: #bfdbfe;
    margin-bottom: 20px;
}
.hero-eyebrow span {
    width: 6px; height: 6px;
    background: #60a5fa;
    border-radius: 50%;
}

.hero h1 {
    font-size: clamp(1.9rem, 3.8vw, 3rem);
    font-weight: 900;
    line-height: 1.4;
    margin-bottom: 16px;
    letter-spacing: -.02em;
}

.hero h1 em {
    font-style: normal;
    background: linear-gradient(135deg, #ffffff 0%, #bfdbfe 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero p {
    color: rgba(255,255,255,.78);
    font-size: 1rem;
    line-height: 1.95;
    max-width: 580px;
    margin-bottom: 26px;
}

.hero-badges {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.hero-badge {
    padding: 9px 18px;
    background: rgba(255,255,255,.09);
    border: 1px solid rgba(255,255,255,.13);
    border-radius: 999px;
    font-size: .83rem;
    font-weight: 700;
    color: #dbeafe;
    backdrop-filter: blur(10px);
    transition: var(--transition);
}
.hero-badge:hover { background: rgba(255,255,255,.15); transform: translateY(-1px); }

/* Hero info card */
.hero-card {
    background: rgba(255,255,255,.07);
    border: 1px solid rgba(255,255,255,.11);
    border-radius: var(--radius-lg);
    padding: 30px 28px;
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    box-shadow: 0 20px 50px rgba(0,0,0,.2);
}

.hero-card-title {
    font-size: 1.05rem;
    font-weight: 800;
    color: #fff;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.hero-card-title::before {
    content: '';
    width: 4px; height: 20px;
    background: var(--grad-primary);
    border-radius: 2px;
}

.hero-stat {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 14px 16px;
    background: rgba(255,255,255,.05);
    border: 1px solid rgba(255,255,255,.06);
    border-radius: 14px;
    margin-bottom: 10px;
    transition: var(--transition);
}
.hero-stat:last-child { margin-bottom: 0; }
.hero-stat:hover { background: rgba(255,255,255,.09); }

.hero-stat-label {
    color: rgba(255,255,255,.65);
    font-size: .88rem;
    display: flex;
    align-items: center;
    gap: 8px;
}
.hero-stat-label i { font-size: .9rem; color: rgba(255,255,255,.4); }
.hero-stat-value {
    color: #fff;
    font-weight: 800;
    font-size: .93rem;
    white-space: nowrap;
}

/* ═══════════════════════════════════════════════════════
   CONTAINER & LAYOUT
═══════════════════════════════════════════════════════ */
.page-wrap {
    width: min(94%, 1400px);
    margin: -42px auto 80px;
    position: relative;
    z-index: 2;
}

.layout {
    display: grid;
    grid-template-columns: 380px 1fr;
    gap: 30px;
    align-items: start;
}

/* ═══════════════════════════════════════════════════════
   SIDEBAR SUMMARY
═══════════════════════════════════════════════════════ */
.sticky-aside {
    position: sticky;
    top: 98px;
}

.summary-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    transition: var(--transition);
}
.summary-card:hover { box-shadow: var(--shadow-lg); transform: translateY(-3px); }

.summary-card-head {
    padding: 24px 26px;
    background: linear-gradient(180deg, #fff 0%, var(--soft) 100%);
    border-bottom: 1px solid var(--border);
    position: relative;
    overflow: hidden;
}
.summary-card-head::after {
    content: '';
    position: absolute;
    top: 0; right: 0;
    width: 120px; height: 120px;
    background: radial-gradient(circle, rgba(15,91,215,.06) 0%, transparent 70%);
    pointer-events: none;
}

.summary-card-head h3 {
    font-size: 1.05rem;
    font-weight: 900;
    color: var(--text);
    margin-bottom: 4px;
}
.summary-card-head p { color: var(--muted); font-size: .85rem; margin: 0; }

.summary-card-body { padding: 22px 26px; }

/* Section block */
.summary-section {
    border: 1px solid var(--border);
    border-radius: 18px;
    overflow: hidden;
    margin-bottom: 16px;
    transition: var(--transition);
}
.summary-section:hover { border-color: var(--secondary-light); box-shadow: 0 4px 18px rgba(15,91,215,.08); }

.summary-section-head {
    background: var(--grad-primary);
    padding: 14px 20px;
    font-size: .85rem;
    font-weight: 800;
    color: #fff;
    letter-spacing: .01em;
    position: relative;
    overflow: hidden;
}
.summary-section-head::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(255,255,255,.08) 50%, rgba(255,255,255,0) 100%);
    animation: sheen 3s ease-in-out infinite;
}
@keyframes sheen {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

.summary-section-body { padding: 16px 20px; }

.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 14px;
    padding: 10px 0;
    border-bottom: 1px solid #f1f5f9;
    font-size: .88rem;
}
.summary-row:last-child { border-bottom: none; padding-bottom: 0; }
.summary-row span { color: var(--muted); font-weight: 500; }
.summary-row strong { color: var(--text); font-weight: 800; text-align: left; }

.summary-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.stag {
    padding: 7px 14px;
    border-radius: 999px;
    font-size: .78rem;
    font-weight: 800;
    transition: var(--transition);
}
.stag:hover { transform: scale(1.04); }

.stag-primary {
    background: var(--soft-blue-2);
    color: var(--primary);
    border: 1.5px solid #c7d9f8;
}
.stag-zone {
    background: #eff6ff;
    color: #1e40af;
    border: 1.5px solid #bfdbfe;
}

.summary-note {
    display: flex;
    gap: 12px;
    align-items: flex-start;
    background: var(--gold-bg);
    border: 1px solid #fde68a;
    border-radius: 16px;
    padding: 16px 18px;
    margin-top: 16px;
    font-size: .83rem;
    color: #92400e;
    line-height: 1.75;
}

.summary-note-icon {
    width: 30px; height: 30px;
    background: var(--gold);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-top: 1px;
}
.summary-note-icon::after { content: '⚠'; font-size: .82rem; }

/* ═══════════════════════════════════════════════════════
   MAIN FORM PANEL
═══════════════════════════════════════════════════════ */
.form-panel {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    position: relative;
}

/* top accent bar */
.form-panel::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary), var(--secondary), #60a5fa);
    z-index: 1;
}

/* ── Form Section ── */
.form-section {
    padding: 36px 40px;
    border-bottom: 1px solid var(--border);
}
.form-section:last-child { border-bottom: none; }

.fs-title {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 30px;
}

.fs-num {
    width: 46px; height: 46px;
    border-radius: 14px;
    background: var(--grad-primary);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.15rem;
    font-weight: 900;
    flex-shrink: 0;
    box-shadow: 0 6px 20px rgba(15,91,215,.25);
}

.fs-title-text h2 {
    font-size: 1.2rem;
    font-weight: 900;
    color: var(--text);
    line-height: 1.3;
}
.fs-title-text p {
    color: var(--muted);
    font-size: .85rem;
    margin-top: 2px;
}

/* ── Grid ── */
.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 22px;
}

/* ── Field ── */
.fg {
    display: flex;
    flex-direction: column;
    gap: 7px;
}

.fg.full { grid-column: 1 / -1; }

.fg label {
    font-weight: 800;
    font-size: .9rem;
    color: var(--text-light);
    display: flex;
    align-items: center;
    gap: 6px;
}

.fg label .req { color: var(--danger); font-size: .95rem; }
.fg label .opt { color: var(--muted); font-weight: 500; font-size: .8rem; }

.field-icon { position: relative; }

.field-icon i {
    position: absolute;
    top: 50%; transform: translateY(-50%);
    right: 16px;
    color: var(--muted-light);
    font-size: 1.05rem;
    pointer-events: none;
}

/* ── Input / Select ── */
.fc {
    width: 100%;
    min-height: 54px;
    border: 1.5px solid var(--border);
    border-radius: 14px;
    padding: 0 46px 0 16px;
    background: var(--soft);
    color: var(--text);
    font-family: var(--font);
    font-size: .95rem;
    font-weight: 600;
    outline: none;
    transition: var(--transition);
    line-height: 1.5;
}
.fc:focus {
    border-color: var(--secondary);
    background: #fff;
    box-shadow: 0 0 0 4px rgba(15,91,215,.10);
}
.fc::placeholder { color: var(--muted-light); font-weight: 400; }

select.fc {
    appearance: none;
    -webkit-appearance: none;
    cursor: pointer;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2.2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: left 14px center;
    background-size: 18px;
    padding-left: 42px;
}

.field-hint {
    font-size: .79rem;
    color: var(--muted);
    line-height: 1.6;
    margin-top: 2px;
}

/* ── Divider inside grid ── */
.fg-divider {
    grid-column: 1 / -1;
    height: 1px;
    background: var(--border);
    margin: 4px 0;
}

/* ── Terms toggle card ── */
.terms-card {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    padding: 20px 22px;
    background: var(--soft-blue-2);
    border: 1.5px solid #c7d9f8;
    border-radius: 16px;
    cursor: pointer;
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}
.terms-card::before {
    content: '';
    position: absolute;
    right: 0; top: 0; bottom: 0;
    width: 4px;
    background: var(--grad-primary);
    border-radius: 0 2px 2px 0;
}
.terms-card:hover { border-color: var(--secondary); background: #e8f0ff; }

.terms-checkbox-wrap {
    flex-shrink: 0;
    margin-top: 2px;
}

.terms-checkbox-wrap input[type="checkbox"] {
    width: 22px;
    height: 22px;
    accent-color: var(--secondary);
    cursor: pointer;
    border-radius: 6px;
}

.terms-label strong {
    display: block;
    font-size: .95rem;
    font-weight: 800;
    color: var(--text);
    margin-bottom: 4px;
}
.terms-label p {
    font-size: .83rem;
    color: var(--muted);
    line-height: 1.7;
    margin: 0;
}
.terms-label a {
    color: var(--secondary);
    font-weight: 700;
    text-decoration: none;
}
.terms-label a:hover { text-decoration: underline; }

/* ═══════════════════════════════════════════════════════
   SUBMIT AREA
═══════════════════════════════════════════════════════ */
.submit-section {
    padding: 32px 40px 36px;
    text-align: center;
    background: linear-gradient(180deg, var(--soft) 0%, #fff 100%);
    border-top: 1px solid var(--border);
}

.btn-submit {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    padding: 17px 52px;
    border: none;
    border-radius: 18px;
    background: var(--grad-primary);
    color: #fff;
    font-family: var(--font);
    font-size: 1rem;
    font-weight: 900;
    cursor: pointer;
    min-width: 280px;
    box-shadow: var(--shadow-primary);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}
.btn-submit::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(255,255,255,.15) 0%, transparent 60%);
    pointer-events: none;
}
.btn-submit:hover {
    transform: translateY(-3px);
    box-shadow: 0 20px 50px rgba(15,91,215,.32);
}
.btn-submit:active { transform: translateY(-1px); }

.btn-arrow {
    width: 30px; height: 30px;
    background: rgba(255,255,255,.2);
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: .9rem;
    flex-shrink: 0;
    transition: var(--transition);
}
.btn-submit:hover .btn-arrow { transform: translateX(-4px); }

.submit-hint {
    margin-top: 14px;
    color: var(--muted);
    font-size: .84rem;
    line-height: 1.8;
    max-width: 480px;
    margin-left: auto;
    margin-right: auto;
}

/* ── Security badges ── */
.security-badges {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
    margin-top: 20px;
}

.sec-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 8px 14px;
    background: var(--soft);
    border: 1px solid var(--border);
    border-radius: 999px;
    font-size: .78rem;
    font-weight: 700;
    color: var(--text-light);
}
.sec-badge i { color: var(--accent); font-size: .85rem; }

/* ═══════════════════════════════════════════════════════
   ERROR BOX
═══════════════════════════════════════════════════════ */
.error-box {
    display: flex;
    gap: 14px;
    align-items: flex-start;
    background: var(--danger-bg);
    border: 1px solid #fecaca;
    border-radius: 16px;
    padding: 18px 22px;
    margin-bottom: 24px;
    font-size: .9rem;
    color: #991b1b;
}
.error-icon {
    width: 28px; height: 28px;
    background: var(--danger);
    border-radius: 50%;
    flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-size: .85rem;
    color: #fff;
    margin-top: 1px;
}
.error-box ul { margin: 0; padding-right: 18px; }
.error-box ul li { margin-bottom: 6px; }
.error-box ul li:last-child { margin-bottom: 0; }

/* ═══════════════════════════════════════════════════════
   FOOTER
═══════════════════════════════════════════════════════ */
.footer {
    background: linear-gradient(135deg, #0b1220 0%, #0f172a 100%);
    color: rgba(255,255,255,.5);
    padding: 34px 0;
    position: relative;
    overflow: hidden;
}
.footer::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(15,91,215,.5), transparent);
}

.footer-inner {
    width: min(94%, 1400px);
    margin: auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: wrap;
}

.footer-brand strong { color: #fff; font-size: .95rem; font-weight: 800; }
.footer-brand span { font-size: .82rem; margin-right: 6px; }

.footer-links {
    display: flex;
    gap: 22px;
    flex-wrap: wrap;
    font-size: .82rem;
}
.footer-links span { opacity: .7; }

/* ═══════════════════════════════════════════════════════
   ANIMATIONS
═══════════════════════════════════════════════════════ */
@keyframes fadeUp {
    from { opacity: 0; transform: translateY(24px); }
    to   { opacity: 1; transform: translateY(0); }
}
.anim { animation: fadeUp .55s ease both; }
.d1 { animation-delay: .08s; }
.d2 { animation-delay: .16s; }
.d3 { animation-delay: .24s; }

/* ═══════════════════════════════════════════════════════
   RESPONSIVE
═══════════════════════════════════════════════════════ */
@media (max-width: 1200px) {
    .hero-inner { grid-template-columns: 1fr; gap: 32px; }
    .hero-card { max-width: 420px; }
    .layout { grid-template-columns: 1fr; }
    .sticky-aside { position: relative; top: 0; }
}

@media (max-width: 768px) {
    .hero { padding: 44px 0 64px; }
    .hero h1 { font-size: 1.8rem; }
    .form-section { padding: 26px 22px; }
    .submit-section { padding: 24px 22px 28px; }
    .form-grid { grid-template-columns: 1fr; gap: 16px; }
    .btn-submit { min-width: 100%; padding: 16px 28px; }
    .step-pill { font-size: .78rem; padding: 10px 16px; }
    .brand-text strong { font-size: 17px; }
    .brand-mark { width: 44px; height: 44px; font-size: 20px; }
    .summary-card-body { padding: 18px 18px; }
    .page-wrap { margin-top: -30px; }
    .layout { gap: 22px; }
}

@media (prefers-reduced-motion: reduce) {
    *, *::before, *::after {
        animation-duration: .01ms !important;
        transition-duration: .01ms !important;
    }
}
    </style>
</head>
<body>

<!-- ══ TOP BAR ══ -->
<header class="topbar">
    <div class="topbar-inner">
        <div class="brand">
            <div class="brand-mark">أ</div>
            <div class="brand-text">
                <strong>أبعاد العقارية</strong>
                <span>تسجيل مزود الخدمة — الخطوة الثالثة</span>
            </div>
        </div>
        <div class="step-pill">
            <span class="step-dot"></span>
            الخطوة 3 من 4 — بيانات مزود الخدمة
        </div>
    </div>
</header>

<!-- ══ HERO ══ -->
<section class="hero">
    <div class="hero-dots"></div>
    <div class="hero-inner">
        <div class="hero-left anim">
            <div class="hero-eyebrow">
                <span></span>
                بيانات مزود الخدمة
            </div>
            <h1>أكمل بياناتك<br><em>كمزود خدمة محترف</em></h1>
            <p>
                أدخل بياناتك الرسمية التي ستظهر للعملاء في العروض العقارية.
                هذه البيانات ضرورية للتواصل والتحقق وضمان أفضل تجربة.
            </p>
            <div class="hero-badges">
                <span class="hero-badge">بيانات موثوقة</span>
                <span class="hero-badge">تواصل مباشر</span>
                <span class="hero-badge">خصوصية محمية</span>
            </div>
        </div>

        <div class="hero-card anim d2">
            <div class="hero-card-title">معلومات الخطوة</div>
            <div class="hero-stat">
                <span class="hero-stat-label">الحقول المطلوبة</span>
                <span class="hero-stat-value">3 حقول أساسية</span>
            </div>
            <div class="hero-stat">
                <span class="hero-stat-label">الوقت المتوقع</span>
                <span class="hero-stat-value">أقل من دقيقة</span>
            </div>
            <div class="hero-stat">
                <span class="hero-stat-label">الخطوة التالية</span>
                <span class="hero-stat-value">المعاينة النهائية</span>
            </div>
        </div>
    </div>
</section>

<!-- ══ CONTENT ══ -->
<div class="page-wrap">

    {{-- Error messages --}}
    @if(session('error'))
        <div class="error-box anim">
            <div class="error-icon">!</div>
            <div>{{ session('error') }}</div>
        </div>
    @endif

    @if($errors->any())
        <div class="error-box anim">
            <div class="error-icon">!</div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="layout">

        {{-- ══ SIDEBAR ══ --}}
        @if(isset($stepOne) && isset($stepTwo))
        <aside class="sticky-aside anim d1">
            <div class="summary-card">
                <div class="summary-card-head">
                    <h3>ملخص الخطوات السابقة</h3>
                    <p>راجع بياناتك قبل إكمال الخطوة الأخيرة</p>
                </div>
                <div class="summary-card-body">

                    <div class="summary-section">
                        <div class="summary-section-head">بيانات الباقة</div>
                        <div class="summary-section-body">
                            <div class="summary-row">
                                <span>رقم الباقة</span>
                                <strong>{{ $stepOne['service_plan_id'] ?? '-' }}</strong>
                            </div>
                            <div class="summary-row">
                                <span>مدة الاشتراك</span>
                                <strong>{{ $stepOne['subscription_duration'] ?? '-' }} شهر</strong>
                            </div>
                            <div class="summary-row">
                                <span>الإجمالي</span>
                                <strong>{{ $stepOne['package_price'] ?? '-' }} ر.س</strong>
                            </div>
                            <div class="summary-row">
                                <span>تاريخ الانتهاء</span>
                                <strong>{{ $stepOne['expiry_date'] ?? '-' }}</strong>
                            </div>
                        </div>
                    </div>

                    <div class="summary-section">
                        <div class="summary-section-head">تفاصيل الخدمة</div>
                        <div class="summary-section-body">
                            <div class="summary-row">
                                <span>عنوان الخدمة</span>
                                <strong>{{ $stepTwo['title'] ?? '-' }}</strong>
                            </div>
                            <div class="summary-row">
                                <span>نوع العرض</span>
                                <strong>{{ $stepTwo['offer_type'] == 'price' ? 'سعر' : 'خصم' }}</strong>
                            </div>
                            @if($stepTwo['offer_type'] == 'price')
                                <div class="summary-row">
                                    <span>السعر</span>
                                    <strong>{{ $stepTwo['service_price'] ?? '-' }} ر.س</strong>
                                </div>
                            @else
                                <div class="summary-row">
                                    <span>نسبة الخصم</span>
                                    <strong>{{ $stepTwo['discount'] ?? '-' }}%</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if(!empty($stepOne['selected_category_names']))
                        <div class="summary-section">
                            <div class="summary-section-head">أنواع العقار</div>
                            <div class="summary-section-body">
                                <div class="summary-tags">
                                    @foreach($stepOne['selected_category_names'] as $cat)
                                        <span class="stag stag-primary">{{ $cat }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(!empty($stepOne['selected_zone_names']))
                        <div class="summary-section">
                            <div class="summary-section-head">المناطق المختارة</div>
                            <div class="summary-section-body">
                                <div class="summary-tags">
                                    @foreach($stepOne['selected_zone_names'] as $zone)
                                        <span class="stag stag-zone">{{ $zone }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="summary-note">
                        <div class="summary-note-icon"></div>
                        <span>بعد إكمال هذه الخطوة سيتم نقلك لصفحة المعاينة النهائية قبل تأكيد العرض.</span>
                    </div>

                </div>
            </div>
        </aside>
        @endif

        {{-- ══ FORM ══ --}}
        <div class="form-panel anim d2">
            <form action="{{ route('website.offers.step-three.store') }}" method="POST">
                @csrf

                <div class="form-section">
                    <div class="fs-title">
                        <div class="fs-num">3</div>
                        <div class="fs-title-text">
                            <h2>بيانات مزود الخدمة</h2>
                            <p>المعلومات الأساسية التي تظهر للعملاء</p>
                        </div>
                    </div>

                    <div class="form-grid">

                        {{-- الاسم الرسمي --}}
                        <div class="fg">
                            <label for="provider_name">
                                الاسم الرسمي
                                <span class="req">*</span>
                            </label>
                            <div class="field-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position:absolute;top:50%;right:16px;transform:translateY(-50%);color:#94a3b8;pointer-events:none;"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                                <input type="text"
                                       id="provider_name"
                                       name="provider_name"
                                       class="fc"
                                       value="{{ old('provider_name') }}"
                                       placeholder="الاسم الذي سيظهر في العروض العقارية">
                            </div>
                            <div class="field-hint">هذا الاسم سيظهر للعملاء في جميع عروضك العقارية.</div>
                        </div>

                        {{-- اسم الشركة --}}
                        <div class="fg">
                            <label for="provider_company">
                                 رقم السجل التاجاري
                                <span class="opt">(اختياري)</span>
                            </label>
                            <div class="field-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position:absolute;top:50%;right:16px;transform:translateY(-50%);color:#94a3b8;pointer-events:none;"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
                                <input type="text"
                                       id="provider_company"
                                       name="provider_company"
                                       class="fc"
                                       value="{{ old('provider_company') }}"
                                       placeholder=" رقم السجل التجاري ">
                            </div>
                            <div class="field-hint">إذا كنت تعمل باسم شركة أو مؤسسة أدخل اسمها هنا.</div>
                        </div>

                        {{-- البريد الإلكتروني --}}
                        <div class="fg">
                            <label for="provider_email">
                                البريد الإلكتروني
                                <span class="req">*</span>
                            </label>
                            <div class="field-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position:absolute;top:50%;right:16px;transform:translateY(-50%);color:#94a3b8;pointer-events:none;"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                <input type="email"
                                       id="provider_email"
                                       name="provider_email"
                                       class="fc"
                                       value="{{ old('provider_email') }}"
                                       placeholder="example@email.com"
                                       dir="ltr">
                            </div>
                            <div class="field-hint">سنستخدم هذا البريد للتواصل معك وإرسال التحديثات.</div>
                        </div>

                        {{-- رقم الجوال --}}
                        <div class="fg">
                            <label for="provider_phone">
                                رقم الجوال
                                <span class="req">*</span>
                            </label>
                            <div class="field-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position:absolute;top:50%;right:16px;transform:translateY(-50%);color:#94a3b8;pointer-events:none;"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.4 2 2 0 0 1 3.6 1.22h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 8.86a16 16 0 0 0 6.29 6.29l.95-.95a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                <input type="tel"
                                       id="provider_phone"
                                       name="provider_phone"
                                       class="fc"
                                       value="{{ old('provider_phone') }}"
                                       placeholder="05xxxxxxxx"
                                       dir="ltr"
                                       maxlength="10">
                            </div>
                            <div class="field-hint">رقم جوال سعودي للتواصل المباشر مع العملاء.</div>
                        </div>

                        {{-- الاسم التجاري --}}
                        <div class="fg full">
                            <label for="provider_commercial_name">
                                الاسم التجاري
                                <span class="opt">(اختياري)</span>
                            </label>
                            <div class="field-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="position:absolute;top:50%;right:16px;transform:translateY(-50%);color:#94a3b8;pointer-events:none;"><path d="M20 7H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                                <input type="text"
                                       id="provider_commercial_name"
                                       name="provider_commercial_name"
                                       class="fc"
                                       value="{{ old('provider_commercial_name') }}"
                                       placeholder="الاسم التجاري المراد ظهوره للعملاء">
                            </div>
                            <div class="field-hint">اسم تجاري بديل إذا كنت تفضل ظهوره بدلاً من الاسم الرسمي.</div>
                        </div>

                        {{-- Terms --}}
                        <div class="fg full">
                            <label class="terms-card" for="terms_accepted">
                                <div class="terms-checkbox-wrap">
                                    <input type="checkbox"
                                           id="terms_accepted"
                                           name="terms_accepted"
                                           value="1"
                                           {{ old('terms_accepted') ? 'checked' : '' }}>
                                </div>
                                <div class="terms-label">
                                    <strong>الموافقة على الشروط والأحكام</strong>
                                    <p>
                                        أوافق على <a href="#" target="_blank">شروط الاستخدام</a>
                                        و<a href="#" target="_blank">سياسة الخصوصية</a>
                                        وأفوض منصة أبعاد العقارية بنشر عروضي العقارية.
                                    </p>
                                </div>
                            </label>
                        </div>

                    </div>{{-- /form-grid --}}
                </div>{{-- /form-section --}}

                {{-- ── SUBMIT ── --}}
                <div class="submit-section">
                    <button type="submit" class="btn-submit">
                        متابعة للمعاينة النهائية
                        <span class="btn-arrow">←</span>
                    </button>

                    <p class="submit-hint">
                        سيتم حفظ بياناتك ونقلك لصفحة المعاينة النهائية للتأكد من صحة جميع المعلومات قبل التأكيد.
                    </p>

                    <div class="security-badges">
                        <span class="sec-badge">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#14b86a" stroke-width="2.2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            بياناتك محمية
                        </span>
                        <span class="sec-badge">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#14b86a" stroke-width="2.2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            اتصال آمن SSL
                        </span>
                        <span class="sec-badge">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#14b86a" stroke-width="2.2"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                            معلومات سرية
                        </span>
                    </div>
                </div>

            </form>
        </div>{{-- /form-panel --}}

    </div>{{-- /layout --}}
</div>{{-- /page-wrap --}}

<!-- ══ FOOTER ══ -->
<footer class="footer">
    <div class="footer-inner">
        <div class="footer-brand">
            <strong>أبعاد العقارية</strong>
            <span>— منصة متكاملة لخدمات العقارات</span>
        </div>
        <div class="footer-links">
            <span>مزودو الخدمة</span>
            <span>التجوال الافتراضي</span>
            <span>عرض الشارع</span>
            <span>Sky View</span>
        </div>
    </div>
</footer>

<script>
/* Phone - numbers only, max 10 */
document.getElementById('provider_phone').addEventListener('input', function () {
    this.value = this.value.replace(/\D/g, '').slice(0, 10);
});

/* Scroll-reveal */
const observer = new IntersectionObserver(entries => {
    entries.forEach(e => {
        if (e.isIntersecting) {
            e.target.style.opacity = '1';
            e.target.style.transform = 'translateY(0)';
            observer.unobserve(e.target);
        }
    });
}, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

document.querySelectorAll('.summary-section, .form-panel').forEach(el => {
    el.style.opacity    = '0';
    el.style.transform  = 'translateY(18px)';
    el.style.transition = 'opacity .5s ease, transform .5s ease';
    observer.observe(el);
});

/* Terms card active state */
document.getElementById('terms_accepted').addEventListener('change', function () {
    this.closest('.terms-card').style.borderColor = this.checked ? 'var(--secondary)' : '';
    this.closest('.terms-card').style.background  = this.checked ? '#dbeafe' : '';
});
</script>

</body>
</html>