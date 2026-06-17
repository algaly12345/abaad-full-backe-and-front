<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title>منصة أبعاد العقارية | مزودي الخدمة</title>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
<style>
:root{
  --primary:#0a5c55;
  --primary-mid:#0f766e;
  --accent:#06b6d4;
  --gold:#f59e0b;
  --bg:#eef1f6;
  --white:#fff;
  --text:#0d1b2a;
  --muted:#64748b;
  --border:#d8e2ed;
  --danger:#dc2626;
  --success:#059669;
  --shadow:0 4px 24px rgba(10,30,50,0.07);
  --shadow-h:0 12px 36px rgba(10,30,50,0.13);
}
*{box-sizing:border-box;font-family:'Cairo',sans-serif;margin:0;padding:0;}
html{scroll-behavior:smooth;}
body{background:var(--bg);color:var(--text);}
a{text-decoration:none;color:inherit;}
.cart-bar{
  position:sticky;top:0;z-index:1000;
  background:rgba(8,18,36,0.97);
  backdrop-filter:blur(16px);
  border-bottom:1px solid rgba(255,255,255,0.06);
}
.cart-inner{
  width:min(96%,1400px);margin:auto;
  min-height:70px;display:flex;align-items:center;
  justify-content:space-between;gap:14px;padding:11px 0;flex-wrap:wrap;
}
.cart-brand{display:flex;align-items:center;gap:10px;flex-shrink:0;}
.cart-mark{
  width:40px;height:40px;border-radius:11px;
  background:linear-gradient(135deg,#0f766e,#06b6d4);
  display:flex;align-items:center;justify-content:center;
  font-size:18px;font-weight:900;color:#fff;
}
.cart-brand-txt strong{display:block;font-size:14px;color:#fff;line-height:1.2;}
.cart-brand-txt small{color:#64748b;font-size:11px;}
.cart-items-row{
  display:flex;gap:5px;align-items:center;
  flex:1;overflow-x:auto;padding:2px 0;
  scrollbar-width:none;min-width:0;
}
.cart-items-row::-webkit-scrollbar{display:none;}
.cart-empty-msg{color:#94a3b8;font-size:12px;font-style:italic;white-space:nowrap;}
.cart-chip{
  display:flex;align-items:center;gap:5px;
  border-radius:999px;padding:5px 9px 5px 5px;
  font-size:11px;white-space:nowrap;transition:.15s;flex-shrink:0;
}
.cart-chip.zone-chip{background:rgba(14,165,233,0.15);border:1px solid rgba(14,165,233,0.3);color:#bae6fd;}
.cart-chip.zone-chip.extra{background:rgba(245,158,11,0.15);border:1px solid rgba(245,158,11,0.35);color:#fde68a;}
.cart-chip.cat-chip{background:rgba(34,197,94,0.12);border:1px solid rgba(34,197,94,0.3);color:#bbf7d0;}
.chip-dot{width:18px;height:18px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:10px;flex-shrink:0;}
.zone-chip .chip-dot{background:#0ea5e9;color:#fff;}
.zone-chip.extra .chip-dot{background:#f59e0b;color:#fff;}
.cat-chip .chip-dot{background:#22c55e;color:#fff;}
.chip-rm{
  width:14px;height:14px;border-radius:50%;
  background:rgba(255,255,255,0.1);display:flex;align-items:center;
  justify-content:center;cursor:pointer;font-size:8px;color:#94a3b8;transition:.12s;
}
.chip-rm:hover{background:rgba(239,68,68,0.5);color:#fff;}
.cart-right{display:flex;align-items:center;gap:8px;flex-shrink:0;}
.cart-plan-pill{
  background:rgba(255,255,255,0.06);border:1px solid rgba(255,255,255,0.09);
  border-radius:999px;padding:6px 12px;font-size:11px;color:#94a3b8;white-space:nowrap;
}
.cart-plan-pill strong{color:#67e8f9;font-size:12px;}
.cart-total-pill{
  background:linear-gradient(135deg,#d97706,#f97316);
  border-radius:999px;padding:8px 14px;
  display:flex;align-items:baseline;gap:4px;
  box-shadow:0 6px 18px rgba(249,115,22,0.28);flex-shrink:0;
}
.cart-total-pill .amt{font-size:18px;font-weight:900;color:#fff;line-height:1;}
.cart-total-pill .cur{font-size:11px;color:rgba(255,255,255,0.8);}
@keyframes pop{0%{transform:scale(1);}50%{transform:scale(1.07);}100%{transform:scale(1);}}
.cart-total-pill.popped{animation:pop .32s ease;}
.site-header{background:#fff;border-bottom:1px solid var(--border);}
.header-inner{width:min(92%,1280px);margin:auto;min-height:74px;display:flex;align-items:center;justify-content:space-between;gap:18px;}
.logo{display:flex;align-items:center;gap:11px;}
.logo-box{width:44px;height:44px;border-radius:13px;background:linear-gradient(135deg,#0f766e,#06b6d4);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:900;font-size:18px;}
.logo-text h2{font-size:17px;font-weight:900;}
.logo-text p{font-size:11px;color:var(--muted);}
.nav{display:flex;gap:20px;align-items:center;font-weight:700;font-size:13px;color:#334155;}
.nav a:hover{color:var(--primary-mid);}
.hdr-cta{background:linear-gradient(135deg,#0f766e,#06b6d4);color:#fff;padding:9px 15px;border-radius:11px;font-weight:800;font-size:13px;}
.container{width:min(92%,1280px);margin:auto;}
.hero{
  position:relative;overflow:hidden;
  background:linear-gradient(150deg,#041e1b 0%,#0a1628 60%,#062235 100%);
  color:#fff;padding:78px 0 62px;
}
.hero::before{
  content:'';
  position:absolute;inset:0;pointer-events:none;
  background:
    radial-gradient(ellipse 65% 55% at 85% -5%,rgba(6,182,212,0.16),transparent),
    radial-gradient(ellipse 45% 45% at 5% 105%,rgba(15,118,110,0.18),transparent);
}
.hero-g{display:grid;grid-template-columns:1.1fr .9fr;gap:34px;align-items:center;}
.hero h1{font-size:42px;line-height:1.22;font-weight:900;margin-bottom:15px;}
.hero h1 em{font-style:normal;color:#67e8f9;}
.hero-l p{font-size:16px;color:#bfdbfe;line-height:2;margin-bottom:18px;}
.htags{display:flex;flex-wrap:wrap;gap:8px;margin-bottom:24px;}
.htag{background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.1);border-radius:999px;padding:7px 12px;font-size:13px;font-weight:700;color:#e0f2fe;}
.hbtns{display:flex;gap:12px;flex-wrap:wrap;}
.btn-gold{background:linear-gradient(135deg,#f59e0b,#f97316);color:#fff;border:none;border-radius:12px;padding:12px 20px;font-weight:800;font-size:14px;cursor:pointer;box-shadow:0 8px 20px rgba(249,115,22,0.22);transition:.2s;display:inline-block;}
.btn-gold:hover{transform:translateY(-2px);}
.btn-ghost{background:rgba(255,255,255,0.07);color:#e0f2fe;border:1px solid rgba(255,255,255,0.13);border-radius:12px;padding:12px 18px;font-weight:800;font-size:14px;cursor:pointer;display:inline-block;}
.hero-card{background:rgba(255,255,255,0.07);border:1px solid rgba(255,255,255,0.1);border-radius:24px;padding:22px;backdrop-filter:blur(10px);}
.hc-t{font-size:18px;font-weight:900;margin-bottom:14px;color:#e0f2fe;}
.hci{display:flex;align-items:flex-start;gap:12px;background:rgba(255,255,255,0.05);border-radius:14px;padding:12px;margin-bottom:9px;}
.hci-ico{min-width:42px;width:42px;height:42px;border-radius:11px;background:linear-gradient(135deg,#0f766e,#06b6d4);display:flex;align-items:center;justify-content:center;font-size:18px;}
.hci h4{font-size:13px;font-weight:800;margin-bottom:2px;}
.hci p{font-size:12px;color:#bfdbfe;line-height:1.8;}
.block{padding:62px 0 0;}
.sec-head{text-align:center;margin-bottom:28px;}
.eyebrow{display:inline-block;background:#d1fae5;color:#065f46;border-radius:999px;padding:6px 12px;font-size:12px;font-weight:800;margin-bottom:9px;}
.sec-head h2{font-size:29px;font-weight:900;margin-bottom:7px;}
.sec-head p{max-width:720px;margin:auto;color:var(--muted);line-height:1.9;font-size:14px;}
.svc-g{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;}
.svc-c{background:#fff;border:1px solid var(--border);border-radius:18px;padding:18px;box-shadow:var(--shadow);transition:.2s;}
.svc-c:hover{transform:translateY(-4px);box-shadow:var(--shadow-h);}
.svc-ico{width:48px;height:48px;border-radius:13px;background:linear-gradient(135deg,#d1fae5,#ccfbf1);display:flex;align-items:center;justify-content:center;font-size:21px;margin-bottom:12px;}
.svc-c h3{font-size:16px;font-weight:900;margin-bottom:6px;}
.svc-c p{color:var(--muted);line-height:1.9;font-size:12px;}
.prov-wrap{margin-top:44px;background:#fff;border:1px solid var(--border);border-radius:28px;box-shadow:var(--shadow);overflow:hidden;}
.prov-top{padding:30px;display:grid;grid-template-columns:1.15fr .85fr;gap:24px;align-items:center;border-bottom:1px solid var(--border);}
.prov-content h2{font-size:30px;font-weight:900;margin-bottom:11px;}
.prov-content p{color:var(--muted);line-height:2;font-size:14px;margin-bottom:14px;}
.prov-feats{display:grid;grid-template-columns:1fr 1fr;gap:10px;}
.pf{background:#f8fafc;border:1px solid var(--border);border-radius:12px;padding:12px 14px;}
.pf strong{display:block;font-size:13px;margin-bottom:3px;}
.pf span{font-size:12px;color:var(--muted);line-height:1.8;}
.prov-side{background:linear-gradient(145deg,#0a5c55,#0e4d64);color:#fff;border-radius:20px;padding:22px;}
.prov-side h3{font-size:20px;font-weight:900;margin-bottom:9px;}
.prov-side p{color:#bae6fd;line-height:1.9;font-size:13px;margin-bottom:14px;}
.stats-g{display:grid;grid-template-columns:1fr 1fr;gap:9px;}
.sb{background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.12);border-radius:12px;padding:12px;}
.sb strong{font-size:20px;display:block;margin-bottom:2px;}
.sb span{color:#cffafe;font-size:11px;}
.wizard-sec{padding:62px 0 88px;}
.wizard-g{display:grid;grid-template-columns:.88fr 1.12fr;gap:22px;align-items:start;}
.sticky-col{position:sticky;top:82px;}
.sum-panel{background:#fff;border:1px solid var(--border);border-radius:22px;box-shadow:var(--shadow);overflow:hidden;}
.sum-head{padding:18px 20px 14px;background:linear-gradient(145deg,#041e1b,#0a2840);color:#fff;}
.sum-head h3{font-size:18px;font-weight:900;margin-bottom:3px;}
.sum-head p{font-size:11px;color:#cbd5e1;line-height:1.6;}
.sum-body{padding:16px 18px;}
.sum-plan-box{border-radius:12px;border:1px solid var(--border);overflow:hidden;margin-bottom:12px;}
.sum-plan-top{background:linear-gradient(135deg,#0f766e,#0369a1);color:#fff;padding:11px 14px;display:flex;justify-content:space-between;align-items:center;}
.sum-plan-top .pn{font-size:14px;font-weight:900;}
.sum-plan-top .pp{font-size:16px;font-weight:900;}
.sum-plan-dur{background:#f8fafc;padding:9px 14px;display:flex;justify-content:space-between;font-size:12px;}
.sum-plan-dur span{color:var(--muted);}
.sum-plan-dur strong{color:#0d1b2a;}
.basket-sec{margin-bottom:11px;}
.basket-sec-title{display:flex;align-items:center;justify-content:space-between;font-size:11px;font-weight:800;margin-bottom:7px;padding:0 1px;}
.basket-sec-title .bst-label{display:flex;align-items:center;gap:5px;}
.bst-count{background:#e2e8f0;color:#475569;border-radius:999px;padding:2px 7px;font-size:10px;font-weight:700;}
.basket-empty{background:#f8fafc;border:1px dashed #cbd5e1;border-radius:10px;padding:10px;text-align:center;color:#94a3b8;font-size:12px;}
.basket-tags{display:flex;flex-wrap:wrap;gap:5px;}
.btag{display:inline-flex;align-items:center;gap:4px;border-radius:999px;padding:4px 9px;font-size:11px;font-weight:700;}
.btag.zone-free{background:#0ea5e9;color:#fff;}
.btag.zone-extra{background:#f59e0b;color:#fff;}
.btag.cat-tag{background:#22c55e;color:#fff;}
.btag .brm{width:13px;height:13px;border-radius:50%;background:rgba(255,255,255,0.25);display:flex;align-items:center;justify-content:center;font-size:7px;cursor:pointer;font-weight:900;transition:.12s;}
.btag .brm:hover{background:rgba(0,0,0,0.2);}
.extra-note{display:flex;align-items:center;gap:5px;background:#fef3c7;border:1px solid #fde68a;border-radius:9px;padding:7px 9px;font-size:11px;color:#92400e;font-weight:700;margin-top:7px;}
.breakdown{background:#f8fafc;border:1px solid var(--border);border-radius:12px;padding:12px 14px;margin-bottom:11px;font-size:12px;}
.bdr{display:flex;justify-content:space-between;padding:3px 0;color:var(--muted);}
.bdr strong{color:#0d1b2a;}
.bdr.extra{color:#d97706;}
.bdr.total{border-top:1px dashed var(--border);margin-top:7px;padding-top:9px;font-weight:900;font-size:13px;color:#0d1b2a;}
.sum-total{background:linear-gradient(135deg,#041e1b,#0a1628);color:#fff;border-radius:16px;padding:14px 16px;display:flex;align-items:center;justify-content:space-between;}
.sum-total .stl{font-size:11px;color:#cbd5e1;}
.sum-total .sta{font-size:24px;font-weight:900;color:#67e8f9;line-height:1;}
.sum-total .stc{font-size:12px;color:#cbd5e1;}
.form-panel{background:#fff;border:1px solid var(--border);border-radius:22px;box-shadow:var(--shadow);overflow:hidden;}
.form-sec{padding:22px;border-bottom:1px solid var(--border);}
.form-sec:last-child{border-bottom:none;}
.fsec-head{display:flex;align-items:center;gap:10px;margin-bottom:16px;}
.fsec-num{width:30px;height:30px;border-radius:8px;background:linear-gradient(135deg,#0f766e,#06b6d4);color:#fff;display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:900;flex-shrink:0;}
.fsec-head h3{font-size:18px;font-weight:900;}
.fsec-sub{font-size:12px;color:var(--muted);margin-top:1px;}
.pick-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(120px,1fr));gap:9px;}
.pick-card{
  position:relative;border:2px solid var(--border);border-radius:14px;
  padding:13px 8px;text-align:center;cursor:pointer;
  background:#fff;transition:.18s ease;user-select:none;
}
.pick-card:hover{border-color:#0f766e;background:#f0fdfa;transform:translateY(-2px);}
.pick-card.sel{border-color:#0f766e;background:linear-gradient(135deg,#f0fdfa,#e0f7fa);box-shadow:0 3px 14px rgba(15,118,110,0.14);}
.pick-card.sel-extra{border-color:#f59e0b;background:linear-gradient(135deg,#fffbeb,#fef3c7);box-shadow:0 3px 14px rgba(245,158,11,0.14);}
.pick-card.disabled-card{opacity:.38;pointer-events:none;}
.pc-ico{font-size:24px;margin-bottom:7px;display:block;}
.pc-name{font-size:12px;font-weight:800;color:#0d1b2a;line-height:1.3;}
.pc-sub{font-size:10px;color:var(--muted);margin-top:2px;}
.pc-check{position:absolute;top:5px;right:5px;width:17px;height:17px;border-radius:50%;background:#0f766e;color:#fff;display:none;align-items:center;justify-content:center;font-size:9px;font-weight:900;}
.pick-card.sel .pc-check,.pick-card.sel-extra .pc-check{display:flex;}
.pick-card.sel-extra .pc-check{background:#f59e0b;}
.pc-extra-badge{position:absolute;bottom:4px;left:50%;transform:translateX(-50%);background:#f59e0b;color:#fff;border-radius:999px;padding:1px 6px;font-size:9px;font-weight:800;white-space:nowrap;display:none;}
.pick-card.sel-extra .pc-extra-badge{display:block;}
.limit-bar{display:flex;align-items:center;justify-content:space-between;background:#f0fdfa;border:1px solid #99f6e4;border-radius:10px;padding:7px 11px;margin-bottom:11px;font-size:12px;transition:.2s;}
.limit-bar .lb-used{font-weight:800;color:#0f766e;}
.limit-bar .lb-msg{color:var(--muted);}
.limit-bar.warn{background:#fffbeb;border-color:#fde68a;}
.limit-bar.warn .lb-used{color:#d97706;}
.limit-bar.blocked{background:#fef2f2;border-color:#fecaca;}
.limit-bar.blocked .lb-msg{color:#dc2626;}
.plans-g{display:grid;grid-template-columns:repeat(auto-fill,minmax(190px,1fr));gap:12px;}
.plan-c{border:2px solid transparent;border-radius:18px;overflow:hidden;cursor:pointer;background:#fff;transition:.2s;position:relative;box-shadow:0 2px 10px rgba(10,30,50,0.05);}
.plan-c:hover{transform:translateY(-4px);box-shadow:0 10px 26px rgba(10,30,50,0.1);}
.plan-c.sel{border-color:#0f766e;box-shadow:0 5px 22px rgba(15,118,110,0.18);}
.plan-badge{position:absolute;top:8px;right:8px;background:#059669;color:#fff;padding:3px 8px;border-radius:999px;font-size:10px;font-weight:800;display:none;}
.plan-c.sel .plan-badge{display:block;}
.plan-top{background:linear-gradient(135deg,#0f766e,#0369a1);color:#fff;text-align:center;padding:16px 10px;}
.plan-price{font-size:24px;font-weight:900;}
.plan-plabel{font-size:10px;color:rgba(255,255,255,0.7);margin-top:1px;}
.plan-body{padding:12px;}
.plan-name{text-align:center;font-size:16px;font-weight:900;margin-bottom:4px;}
.plan-desc{text-align:center;color:var(--muted);font-size:12px;min-height:34px;margin-bottom:9px;line-height:1.7;}
.plan-feat{display:flex;justify-content:space-between;background:#f8fafc;border-radius:9px;padding:7px 9px;margin-bottom:6px;font-size:12px;}
.plan-feat span{color:var(--muted);}
.dur-g{display:grid;grid-template-columns:repeat(4,1fr);gap:9px;}
.dur-btn{border:2px solid var(--border);border-radius:12px;padding:12px 5px;text-align:center;cursor:pointer;background:#fff;transition:.15s;}
.dur-btn:hover{border-color:#0f766e;background:#f0fdfa;}
.dur-btn.sel{border-color:#0f766e;background:linear-gradient(135deg,#f0fdfa,#e0f7fa);}
.dur-n{font-size:20px;font-weight:900;color:#0f766e;}
.dur-l{font-size:11px;color:var(--muted);margin-top:1px;}
.dur-btn.sel .dur-l{color:#0f766e;}
.expiry-box{background:#f8fafc;border:1px solid var(--border);border-radius:12px;padding:12px 14px;display:flex;align-items:center;gap:9px;margin-top:12px;}
.expiry-date{font-size:14px;font-weight:800;}
.expiry-sub{font-size:11px;color:var(--muted);}
.sub-area{text-align:center;padding-top:9px;}
.btn-submit{border:none;border-radius:14px;background:linear-gradient(135deg,#0f766e,#06b6d4);color:#fff;padding:14px 30px;font-size:15px;font-weight:900;cursor:pointer;min-width:220px;box-shadow:0 9px 24px rgba(15,118,110,0.2);transition:.2s;}
.btn-submit:hover:not(:disabled){transform:translateY(-2px);box-shadow:0 13px 28px rgba(15,118,110,0.28);}
.btn-submit:disabled{background:#94a3b8;box-shadow:none;cursor:not-allowed;}
.sub-note{margin-top:9px;color:var(--muted);font-size:12px;line-height:1.7;}
.error-box{background:#fef2f2;color:var(--danger);border:1px solid #fecaca;border-radius:18px;padding:16px 18px;margin-bottom:20px;}
.footer{background:#0a1628;color:#64748b;padding:22px 0;margin-top:48px;}
.footer-in{display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap;align-items:center;}
.footer-in strong{color:#e2e8f0;}








.showcase-section{
  padding:70px 0 30px;
}

.showcase-box{
  position:relative;
  overflow:hidden;
  background:linear-gradient(135deg,#061c1a 0%, #0b2c3a 55%, #12324a 100%);
  border-radius:34px;
  padding:50px 40px;
  display:grid;
  grid-template-columns:1.05fr .95fr;
  gap:30px;
  align-items:center;
  box-shadow:0 20px 60px rgba(2,8,23,0.12);
}

.showcase-box::before{
  content:'';
  position:absolute;
  inset:0;
  background:
    radial-gradient(circle at 15% 20%, rgba(6,182,212,0.18), transparent 30%),
    radial-gradient(circle at 85% 80%, rgba(15,118,110,0.22), transparent 30%);
  pointer-events:none;
}

.showcase-text{
  position:relative;
  z-index:2;
  color:#fff;
}

.showcase-badge{
  display:inline-block;
  background:rgba(255,255,255,0.12);
  border:1px solid rgba(255,255,255,0.15);
  color:#cffafe;
  padding:8px 14px;
  border-radius:999px;
  font-size:12px;
  font-weight:800;
  margin-bottom:16px;
}

.showcase-text h2{
  font-size:34px;
  line-height:1.4;
  font-weight:900;
  margin-bottom:14px;
}

.showcase-text p{
  color:#dbeafe;
  font-size:15px;
  line-height:2;
  margin-bottom:24px;
  max-width:560px;
}

.showcase-points{
  display:flex;
  flex-direction:column;
  gap:12px;
}

.showcase-point{
  display:flex;
  align-items:flex-start;
  gap:12px;
  background:rgba(255,255,255,0.08);
  border:1px solid rgba(255,255,255,0.1);
  border-radius:18px;
  padding:14px 16px;
  backdrop-filter:blur(10px);
}

.showcase-point span{
  width:28px;
  height:28px;
  border-radius:50%;
  background:linear-gradient(135deg,#06b6d4,#14b8a6);
  color:#fff;
  display:flex;
  align-items:center;
  justify-content:center;
  font-size:13px;
  font-weight:900;
  flex-shrink:0;
  margin-top:2px;
}

.showcase-point strong{
  display:block;
  font-size:14px;
  margin-bottom:3px;
  color:#fff;
}

.showcase-point small{
  color:#cbd5e1;
  font-size:12px;
  line-height:1.8;
}

.showcase-phone-wrap{
  position:relative;
  display:flex;
  justify-content:center;
  align-items:center;
  min-height:620px;
  z-index:2;
}

.phone-glow{
  position:absolute;
  width:360px;
  height:360px;
  border-radius:50%;
  background:radial-gradient(circle, rgba(34,211,238,0.28) 0%, rgba(34,211,238,0.08) 45%, transparent 72%);
  filter:blur(12px);
}

.modern-phone{
  width:300px;
  height:610px;
  background:linear-gradient(180deg,#0f172a,#111827);
  border:8px solid #0b1120;
  border-radius:42px;
  padding:10px;
  position:relative;
  box-shadow:
    0 25px 70px rgba(0,0,0,0.35),
    inset 0 0 0 1px rgba(255,255,255,0.06);
}

.phone-notch{
  position:absolute;
  top:10px;
  left:50%;
  transform:translateX(-50%);
  width:96px;
  height:20px;
  background:#020617;
  border-radius:0 0 16px 16px;
  z-index:3;
}

.modern-phone video{
  width:100%;
  height:100%;
  object-fit:cover;
  border-radius:32px;
  display:block;
  background:#000;
}


.cart-mark img {
  width: 32px;   /* غيّر الرقم حسب الحجم المناسب */
  height: 32px;
  object-fit: contain;
}

@media(max-width:1100px){
  .showcase-box{
    grid-template-columns:1fr;
    text-align:center;
    padding:38px 24px;
  }

  .showcase-text p{
    margin-right:auto;
    margin-left:auto;
  }

  .showcase-point{
    text-align:right;
  }

  .showcase-phone-wrap{
    min-height:auto;
    padding-top:10px;
  }
}

@media(max-width:640px){
  .showcase-text h2{
    font-size:26px;
  }

  .modern-phone{
    width:260px;
    height:530px;
  }

  .phone-glow{
    width:280px;
    height:280px;
  }
}



@media(max-width:1100px){
  .hero-g,.prov-top,.wizard-g{grid-template-columns:1fr;}
  .sticky-col{position:relative;top:0;}
  .svc-g{grid-template-columns:repeat(2,1fr);}
}
@media(max-width:768px){
  .nav{display:none;}
  .svc-g,.prov-feats{grid-template-columns:1fr 1fr;}
  .hero h1{font-size:28px;}
  .plans-g,.dur-g{grid-template-columns:repeat(2,1fr);}
}
@media(max-width:480px){
  .pick-grid{grid-template-columns:repeat(3,1fr);}
  .dur-g{grid-template-columns:repeat(2,1fr);}
}
</style>
</head>
<body>

<div class="cart-bar">
  <div class="cart-inner">
    <div class="cart-brand">
      <div class="cart-mark">


            <img src="{{ asset('public/assets/images/logo_web.png') }}" alt="logo">
      </div>
      <div class="cart-brand-txt">
        <strong>سلة الطلب</strong>
        <small>أبعاد العقارية</small>
      </div>
    </div>

    <div class="cart-items-row" id="cart-chips-row">
      <span class="cart-empty-msg">لم يتم إضافة أي عنصر بعد — ابدأ باختيار الباقة</span>
    </div>

    <div class="cart-right">
      <div class="cart-plan-pill">الباقة: <strong id="cp-plan">—</strong></div>
      <div class="cart-total-pill" id="cart-total-pill">
        <span class="amt" id="cp-total">0.00</span>
        <span class="cur">ريال</span>
      </div>
    </div>
  </div>
</div>

<header class="site-header">
  <div class="header-inner">
    <div class="logo">
      <div class="logo-box">أ</div>
      <div class="logo-text">
        <h2>أبعاد العقارية</h2>
        <p>منصة الحلول والخدمات العقارية الذكية</p>
      </div>
    </div>
    <nav class="nav">
      <a href="#about">عن المنصة</a>
      <a href="#services">الخدمات</a>
      <a href="#provider-service">مزودي الخدمة</a>
      <a href="#packages">الباقات</a>
    </nav>
    <a href="#packages" class="hdr-cta">ابدأ الآن ←</a>
  </div>
</header>

<section class="showcase-section" id="provider-service">
  <div class="container">
    <div class="showcase-box">

      <div class="showcase-text">
        <span class="showcase-badge">تجربة الجوال</span>
        <h2>عرض مزودي الخدمة بشكل احترافي على  داخل العروض العقارية داخل التطبيق </h2>
        <p>
           تجربة الاستخدام الفعلية داخل العروض العقارية داخل  التطبيق من خلال فيديو توضيحي
          يعكس شكل ظهور مزودي الخدمة بطريقة عصرية وواضحة وجذابة.
        </p>

        <div class="showcase-points">
          <div class="showcase-point">
            <span>✔</span>
            <div>
              <strong>واجهة حقيقية</strong>
              <small>تعرض شكل الخدمة كما يراه العميل داخل الجوال</small>
            </div>
          </div>

          <div class="showcase-point">
            <span>✔</span>
            <div>
              <strong>إبراز بصري أفضل</strong>
              <small>الفيديو يعطي انطباعًا أقوى من الوصف النصي التقليدي</small>
            </div>
          </div>

          <div class="showcase-point">
            <span>✔</span>
            <div>
              <strong>ملائم للتسويق</strong>
              <small>قسم أنيق يساعد على إبراز الخدمة بشكل احترافي</small>
            </div>
          </div>
        </div>
      </div>

      <div class="showcase-phone-wrap">
        <div class="phone-glow"></div>

        <div class="mobile-frame modern-phone">
          <div class="phone-notch"></div>
          <video autoplay muted loop playsinline controls>
            <source src="{{ asset('public/assets/video/a.mp4') }}" type="video/mp4">
            متصفحك لا يدعم تشغيل الفيديو.
          </video>
        </div>
      </div>

    </div>
  </div>
</section>

<section class="block" id="about">
  <div class="container">
    <div class="sec-head">
      <span class="eyebrow">عن المنصة</span>
      <h2>منصة خدمات عقارية متخصصة</h2>
      <p>شريكك الذكي في التسويق العقاري بأدوات احترافية تضمن ظهورك المميز أمام العملاء الصحيحين.</p>
    </div>
    <div class="svc-g" id="services">
      <div class="svc-c"><div class="svc-ico">🧩</div><h3>مزودي الخدمة</h3><p>إتاحة خدمات الشركات مع استهداف دقيق للفئات والمناطق.</p></div>
      <div class="svc-c"><div class="svc-ico">🏠</div><h3>التجوال الافتراضي</h3><p>جولات افتراضية لإظهار تفاصيل العقار بشكل تفاعلي.</p></div>
      <div class="svc-c"><div class="svc-ico">🛰️</div><h3>عرض الشارع</h3><p>ربط العقار بالمشهد المحيط عبر الأقمار الصناعية.</p></div>
      <div class="svc-c"><div class="svc-ico">🚁</div><h3>Sky View</h3><p>تصوير علوي يبرز الموقع والامتداد البصري.</p></div>
    </div>
  </div>
</section>

<section class="block" id="provider-service">
  <div class="container">
    <div class="prov-wrap">
      <div class="prov-top">
        <div class="prov-content">
          <h2>خدمة مزودي الخدمة داخل أبعاد العقارية</h2>
          <p>اختر الباقة المناسبة، حدد أنواع العقار والمناطق المستهدفة، وابدأ حضورك الاحترافي داخل المنصة.</p>
          <div class="prov-feats">
            <div class="pf"><strong>استهداف أنواع العقار</strong><span>حدد الشقق والفلل والأراضي حسب الباقة.</span></div>
            <div class="pf"><strong>استهداف جغرافي</strong><span>اختر المدن والمناطق التي تريد الظهور فيها.</span></div>
            <div class="pf"><strong>خطط متنوعة</strong><span>باقات بحدود مختلفة للأقسام والمناطق.</span></div>
            <div class="pf"><strong>تكامل شامل</strong><span>يمكن ربط الخدمة بالتجوال الافتراضي لاحقًا.</span></div>
          </div>
        </div>
        <div class="prov-side">
          <h3>لماذا هذه الخدمة مهمة؟</h3>
          <p>تحوّل ظهورك من إعلان ثابت إلى حضور احترافي مع استهداف مرن يصل للعميل الصحيح.</p>
          <div class="stats-g">
            <div class="sb"><strong>4+</strong><span>خدمات متكاملة</span></div>
            <div class="sb"><strong>مرن</strong><span>في الاستهداف</span></div>
            <div class="sb"><strong>ذكي</strong><span>في العرض</span></div>
            <div class="sb"><strong>احترافي</strong><span>في التسويق</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="wizard-sec" id="packages">
  <div class="container">

    @if(session('error'))
      <div class="error-box">{{ session('error') }}</div>
    @endif

    @if($errors->any())
      <div class="error-box">
        <ul style="padding-right:18px;">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <div class="wizard-g">
      <aside class="sticky-col">
        <div class="sum-panel">
          <div class="sum-head">
            <h3>🛒 سلة الطلب</h3>
            <p>يتحدث الملخص فور اختيارك لكل عنصر</p>
          </div>
          <div class="sum-body">

            <div class="sum-plan-box" id="s-plan-box" style="display:none">
              <div class="sum-plan-top">
                <span class="pn" id="s-plan-name">—</span>
                <span class="pp"><span id="s-plan-price">0</span> ريال/شهر</span>
              </div>
              <div class="sum-plan-dur">
                <span>مدة الاشتراك</span>
                <strong id="s-dur-txt">—</strong>
              </div>
            </div>
            <div class="basket-empty" id="s-plan-empty">لم يتم اختيار الباقة بعد</div>

            <div class="basket-sec">
              <div class="basket-sec-title">
                <span class="bst-label" style="color:#166534">🏢 أنواع العقار</span>
                <span class="bst-count" id="s-cat-count">0</span>
              </div>
              <div id="s-cat-area"><div class="basket-empty">اختر أنواع العقار من القائمة أدناه</div></div>
            </div>

            <div class="basket-sec">
              <div class="basket-sec-title">
                <span class="bst-label" style="color:#0369a1">📍 المناطق الجغرافية</span>
                <span class="bst-count" id="s-zone-count">0</span>
              </div>
              <div id="s-zone-area"><div class="basket-empty">اختر المناطق من القائمة أدناه</div></div>
              <div class="extra-note" id="s-extra-note" style="display:none">
                ⚡ <span id="s-extra-zones">0</span> منطقة إضافية × 50 ريال = <strong id="s-extra-total">0</strong> ريال/شهر
              </div>
            </div>

            <div class="basket-sec" id="s-exp-sec" style="display:none">
              <div class="basket-sec-title"><span class="bst-label" style="color:#7c3aed">📅 تاريخ الانتهاء</span></div>
              <div style="background:#f5f3ff;border:1px solid #ddd6fe;border-radius:10px;padding:9px 12px;font-size:12px;font-weight:800;color:#4c1d95;" id="s-exp-date">—</div>
            </div>

            <div class="breakdown" id="s-breakdown" style="display:none">
              <div class="bdr"><span>سعر الباقة</span><strong id="bd-base">—</strong></div>
              <div class="bdr extra" id="bd-extra-row" style="display:none">
                <span>مناطق إضافية (<span id="bd-ec">0</span> × 50 ر)</span>
                <strong id="bd-ea">—</strong>
              </div>
              <div class="bdr"><span>× مدة الاشتراك</span><strong id="bd-dur">—</strong></div>
              <div class="bdr total"><span>الإجمالي</span><strong id="bd-total">—</strong></div>
            </div>

            <div class="sum-total">
              <div>
                <div class="stl">المبلغ الإجمالي</div>
                <div class="sta" id="s-total">0.00</div>
              </div>
              <div class="stc">ريال</div>
            </div>
          </div>
        </div>
      </aside>

      <div class="form-panel">
        <form action="{{ route('website.offers.step-one.store') }}" method="POST">
          @csrf

          <div class="form-sec">
            <div class="fsec-head">
              <div class="fsec-num">١</div>
              <div><h3>اختر الباقة المناسبة</h3><div class="fsec-sub">الباقة تحدد الحد المجاني للمناطق وأنواع العقار</div></div>
            </div>

            <div class="plans-g">
       @foreach($servicePlans as $plan)
    <div class="plan-c"
         data-id="{{ $plan->id }}"
         data-name="{{ $plan->name }}"
         data-price="{{ $plan->price }}"
         data-ads="{{ $plan->number_of_ads ?? 0 }}"
         data-cats="{{ $plan->number_of_categories ?? 0 }}"
         data-zones="{{ $plan->number_of_zone ?? 0 }}">
      <span class="plan-badge">✓ مختارة</span>
      <div class="plan-top">
        <div class="plan-price">{{ number_format($plan->price, 2) }} ريال</div>
        <div class="plan-plabel">شهرياً</div>
      </div>
      <div class="plan-body">
        <div class="plan-name">{{ $plan->name }}</div>
        <div class="plan-desc">{{ $plan->description }}</div>

        {{-- الميزات الأساسية --}}
        <div class="plan-feat"><span>الإعلانات</span><strong>{{ $plan->number_of_ads ?? 0 }}</strong></div>
        <div class="plan-feat"><span>أنواع العقار</span><strong>{{ $plan->number_of_categories ?? 0 }}</strong></div>
        <div class="plan-feat"><span>مناطق مجانية</span><strong>{{ $plan->number_of_zone ?? 0 }}</strong></div>

        {{-- الميزات الإضافية (تظهر فقط إذا كانت القيمة 1) --}}

        @if($plan->distinctive_appearance == 1)
        <div class="plan-feat">
            <span>ظهور مميز</span>
            <strong style="color: var(--success);">
                <svg fill="currentColor" viewBox="0 0 20 20" style="width:16px; height:16px; vertical-align: middle; margin-left: 4px;"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                متاح
            </strong>
        </div>
        @endif

        @if($plan->interactive_reports == 1)
        <div class="plan-feat">
            <span>تقارير تفاعلية</span>
            <strong style="color: var(--success);">
                <svg fill="currentColor" viewBox="0 0 20 20" style="width:16px; height:16px; vertical-align: middle; margin-left: 4px;"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                متاح
            </strong>
        </div>
        @endif

        @if($plan->crm == 1)
        <div class="plan-feat">
            <span>نظام CRM</span>
            <strong style="color: var(--success);">
                <svg fill="currentColor" viewBox="0 0 20 20" style="width:16px; height:16px; vertical-align: middle; margin-left: 4px;"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                متاح
            </strong>
        </div>
        @endif

      </div>
    </div>
@endforeach
            </div>
          </div>

          <div class="form-sec">
            <div class="fsec-head">
              <div class="fsec-num">٢</div>
              <div><h3>أنواع العقار</h3><div class="fsec-sub">اضغط على النوع لإضافته للسلة — الاختيار محدود بعدد الباقة</div></div>
            </div>

            <div class="limit-bar" id="cat-limit-bar">
              <span class="lb-msg">اختر الباقة أولاً لمعرفة الحد المتاح</span>
              <span class="lb-used" id="cat-used">0 / 0</span>
            </div>

            <div class="pick-grid">
   @foreach($categories as $category)
  <div class="pick-card"
       data-type="cat"
       data-id="{{ $category->id }}"
       data-name="{{ $category->name_ar }}">

    <span class="pc-ico">
        @if($category->image)
            <img src="{{ asset('storage/app/public/categories/' . $category->image) }}"
                 alt="{{ $category->name_ar }}"
                 style="width:28px;height:28px;object-fit:contain;">
        @else
            🏢
        @endif
    </span>

    <div class="pc-name">{{ $category->name_ar }}</div>
    <div class="pc-check">✓</div>
  </div>
@endforeach
            </div>
          </div>

          <div class="form-sec">
            <div class="fsec-head">
              <div class="fsec-num">٣</div>
              <div><h3>المناطق الجغرافية</h3><div class="fsec-sub">المناطق الإضافية بعد الحد المجاني = +50 ريال / منطقة / شهر</div></div>
            </div>

            <div class="limit-bar" id="zone-limit-bar">
              <span class="lb-msg">اختر الباقة أولاً لمعرفة الحد المجاني</span>
              <span class="lb-used" id="zone-used">0 / 0</span>
            </div>

            <div class="pick-grid">
     @php
    $zoneIcons = [
        'الرياض' => '🏙️',
        'مكة' => '🕋',
        'مكة المكرمة' => '🕋',
        'المدينة المنورة' => '🕌',
        'المدينة' => '🕌',
        'القصيم' => '🌾',
        'الشرقية' => '🌊',
        'المنطقة الشرقية' => '🌊',
        'تبوك' => '⛰️',
        'عسير' => '🌄',
        'حائل' => '🏜️',
        'الحدود الشمالية' => '🧭',
        'جازان' => '🌴',
        'نجران' => '🌵',
        'الباحة' => '🌳',
        'الجوف' => '🍃',
    ];
@endphp

@foreach($zones as $zone)
    @php
        $zoneName = trim($zone->name_ar);
        $zoneIcon = $zoneIcons[$zoneName] ?? '📍';
    @endphp

    <div class="pick-card"
         data-type="zone"
         data-id="{{ $zone->id }}"
         data-name="{{ $zoneName }}">

        <span class="pc-ico zone-ico">{{ $zoneIcon }}</span>

        <div class="pc-name">{{ $zoneName }}</div>
        <div class="pc-sub">منطقة</div>
        <div class="pc-check">✓</div>
        <div class="pc-extra-badge">+50 ر</div>
    </div>
@endforeach
            </div>
          </div>

          <div class="form-sec">
            <div class="fsec-head">
              <div class="fsec-num">٤</div>
              <div><h3>مدة الاشتراك</h3><div class="fsec-sub">اختر المدة المناسبة لاشتراكك</div></div>
            </div>

            <div class="dur-g">
              <div class="dur-btn sel" data-months="1"><div class="dur-n">1</div><div class="dur-l">شهر</div></div>
              <div class="dur-btn" data-months="3"><div class="dur-n">3</div><div class="dur-l">أشهر</div></div>
              <div class="dur-btn" data-months="6"><div class="dur-n">6</div><div class="dur-l">أشهر</div></div>
              <div class="dur-btn" data-months="12"><div class="dur-n">12</div><div class="dur-l">شهر / سنة</div></div>
            </div>

            <div class="expiry-box" id="expiry-box" style="display:none">
              <span style="font-size:21px">📅</span>
              <div>
                <div class="expiry-date" id="expiry-display">—</div>
                <div class="expiry-sub">تاريخ انتهاء الاشتراك</div>
              </div>
            </div>

            <input type="hidden" name="subscription_duration" id="h-duration" value="1">
            <input type="hidden" name="expiry_date" id="h-expiry">
            <input type="hidden" name="service_plan_id" id="h-plan-id">
            <input type="hidden" name="package_price" id="h-price">
            <input type="hidden" name="number_of_ads" id="h-ads">
            <input type="hidden" name="number_of_categories" id="h-cats">
            <input type="hidden" name="number_of_zone" id="h-zones">

            <div id="categories-hidden-wrapper"></div>
            <div id="zones-hidden-wrapper"></div>

            <input type="hidden" name="selected_category_ids" id="selected_category_ids">
            <input type="hidden" name="selected_category_names" id="selected_category_names">
            <input type="hidden" name="selected_zone_ids" id="selected_zone_ids">
            <input type="hidden" name="selected_zone_names" id="selected_zone_names">

            <div class="sub-area">
              <button type="submit" id="submit-btn" class="btn-submit" disabled>متابعة إلى تفاصيل الخدمة ←</button>
              <div class="sub-note">بعد الضغط ستنتقل إلى الخطوة التالية لإدخال تفاصيل الخدمة والصورة والوصف.</div>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</section>

<footer class="footer">
  <div class="container footer-in">
    <div><strong>أبعاد العقارية</strong> — منصة خدمات عقارية متكاملة</div>
    <div>مزودي الخدمة • التجوال الافتراضي • عرض الشارع • Sky View</div>
  </div>
</footer>

<script>
const EXTRA = 50;
const state = { plan:null, duration:1, selCats:[], selZones:[] };

function calcExpiry(m){
  const d = new Date();
  d.setMonth(d.getMonth() + m);
  return d.toISOString().split('T')[0];
}

function fmtDate(iso){
  if(!iso) return '—';
  const [y,m,d] = iso.split('-');
  const mn = ['يناير','فبراير','مارس','أبريل','مايو','يونيو','يوليو','أغسطس','سبتمبر','أكتوبر','نوفمبر','ديسمبر'];
  return `${d} ${mn[+m-1]} ${y}`;
}

function extraZones(){
  return !state.plan ? 0 : Math.max(0, state.selZones.length - state.plan.zones);
}

function monthlyTotal(){
  return !state.plan ? 0 : state.plan.price + (extraZones() * EXTRA);
}

function grandTotal(){
  return monthlyTotal() * state.duration;
}

function syncHiddenArrays(){
  const catWrap = document.getElementById('categories-hidden-wrapper');
  const zoneWrap = document.getElementById('zones-hidden-wrapper');

  catWrap.innerHTML = '';
  zoneWrap.innerHTML = '';

  state.selCats.forEach(cat => {
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'categories[]';
    input.value = cat.id;
    catWrap.appendChild(input);
  });

  state.selZones.forEach(zone => {
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'zones[]';
    input.value = zone.id;
    zoneWrap.appendChild(input);
  });

  document.getElementById('selected_category_ids').value = JSON.stringify(
    state.selCats.map(cat => cat.id)
  );

  document.getElementById('selected_category_names').value = JSON.stringify(
    state.selCats.map(cat => cat.name)
  );

  document.getElementById('selected_zone_ids').value = JSON.stringify(
    state.selZones.map(zone => zone.id)
  );

  document.getElementById('selected_zone_names').value = JSON.stringify(
    state.selZones.map(zone => zone.name)
  );
}

function render(){
  const p = state.plan, ez = extraZones(), gt = grandTotal();
  const expIso = p ? calcExpiry(state.duration) : null;
  const expFmt = fmtDate(expIso);

  const row = document.getElementById('cart-chips-row');
  let chips = [];

  state.selCats.forEach(c => {
    chips.push(`<div class="cart-chip cat-chip"><span class="chip-dot">🏢</span>${c.name}<span class="chip-rm" onclick="removeCat('${c.id}')">✕</span></div>`);
  });

  state.selZones.forEach((z,i) => {
    const isX = p && i >= p.zones;
    chips.push(`<div class="cart-chip zone-chip${isX ? ' extra' : ''}"><span class="chip-dot">📍</span>${z.name}${isX ? '<span style="font-size:9px;margin-right:2px">+50ر</span>' : ''}<span class="chip-rm" onclick="removeZone('${z.id}')">✕</span></div>`);
  });

  row.innerHTML = chips.length ? chips.join('') : '<span class="cart-empty-msg">لم يتم إضافة أي عنصر — ابدأ باختيار الباقة</span>';

  document.getElementById('cp-plan').textContent = p ? p.name : '—';
  document.getElementById('cp-total').textContent = gt.toFixed(2);

  const pill = document.getElementById('cart-total-pill');
  pill.classList.remove('popped');
  void pill.offsetWidth;
  pill.classList.add('popped');

  const pb = document.getElementById('s-plan-box');
  const pe = document.getElementById('s-plan-empty');

  if(p){
    pb.style.display = '';
    pe.style.display = 'none';
    document.getElementById('s-plan-name').textContent = p.name;
    document.getElementById('s-plan-price').textContent = p.price.toLocaleString();
    document.getElementById('s-dur-txt').textContent = state.duration + (state.duration === 1 ? ' شهر' : ' أشهر');
  }else{
    pb.style.display = 'none';
    pe.style.display = '';
  }

  document.getElementById('s-cat-count').textContent = state.selCats.length;
  const ca = document.getElementById('s-cat-area');
  ca.innerHTML = state.selCats.length
    ? '<div class="basket-tags">' + state.selCats.map(c => `<span class="btag cat-tag">${c.name}<span class="brm" onclick="removeCat('${c.id}')">✕</span></span>`).join('') + '</div>'
    : '<div class="basket-empty">اختر أنواع العقار من القائمة أدناه</div>';

  document.getElementById('s-zone-count').textContent = state.selZones.length;
  const za = document.getElementById('s-zone-area');
  za.innerHTML = state.selZones.length
    ? '<div class="basket-tags">' + state.selZones.map((z,i) => {
        const isX = p && i >= p.zones;
        return `<span class="btag ${isX ? 'zone-extra' : 'zone-free'}">${z.name}${isX ? '<span style="font-size:9px;margin-right:3px">+50ر</span>' : ''}<span class="brm" onclick="removeZone('${z.id}')">✕</span></span>`;
      }).join('') + '</div>'
    : '<div class="basket-empty">اختر المناطق من القائمة أدناه</div>';

  const xn = document.getElementById('s-extra-note');
  if(ez > 0){
    xn.style.display = 'flex';
    document.getElementById('s-extra-zones').textContent = ez;
    document.getElementById('s-extra-total').textContent = (ez * EXTRA).toLocaleString();
  }else{
    xn.style.display = 'none';
  }

  const es = document.getElementById('s-exp-sec');
  if(p){
    es.style.display = '';
    document.getElementById('s-exp-date').textContent = expFmt;
    document.getElementById('expiry-box').style.display = 'flex';
    document.getElementById('expiry-display').textContent = expFmt;
    if(expIso) document.getElementById('h-expiry').value = expIso;
  }else{
    es.style.display = 'none';
    document.getElementById('expiry-box').style.display = 'none';
  }

  const bd = document.getElementById('s-breakdown');
  if(p){
    bd.style.display = '';
    document.getElementById('bd-base').textContent = p.price.toLocaleString() + ' ريال';
    document.getElementById('bd-dur').textContent = '× ' + state.duration + (state.duration === 1 ? ' شهر' : ' أشهر');
    document.getElementById('bd-total').textContent = gt.toLocaleString() + ' ريال';

    const bdr = document.getElementById('bd-extra-row');
    if(ez > 0){
      bdr.style.display = 'flex';
      document.getElementById('bd-ec').textContent = ez;
      document.getElementById('bd-ea').textContent = (ez * EXTRA).toLocaleString() + ' ريال';
    }else{
      bdr.style.display = 'none';
    }
  }else{
    bd.style.display = 'none';
  }

  document.getElementById('s-total').textContent = gt.toFixed(2);

  document.querySelectorAll('.pick-card[data-type="cat"]').forEach(card => {
    const id = card.dataset.id;
    const isSel = state.selCats.some(c => c.id === id);
    card.classList.toggle('sel', isSel);
    const atLimit = p && state.selCats.length >= p.cats && !isSel;
    card.classList.toggle('disabled-card', atLimit);
  });

  document.querySelectorAll('.pick-card[data-type="zone"]').forEach(card => {
    const id = card.dataset.id;
    const idx = state.selZones.findIndex(z => z.id === id);
    const isSel = idx !== -1;
    const isX = p && isSel && idx >= p.zones;
    card.classList.toggle('sel', isSel && !isX);
    card.classList.toggle('sel-extra', isSel && isX);
    card.classList.remove('disabled-card');
  });

  const cu = document.getElementById('cat-used');
  const cb = document.getElementById('cat-limit-bar');
  const zu = document.getElementById('zone-used');
  const zb = document.getElementById('zone-limit-bar');

  if(p){
    cu.textContent = state.selCats.length + ' / ' + p.cats;
    cb.querySelector('.lb-msg').textContent = state.selCats.length >= p.cats ? 'وصلت للحد الأقصى لأنواع العقار' : 'اختر حتى ' + p.cats + ' أنواع مجاناً';
    cb.classList.toggle('blocked', state.selCats.length >= p.cats);
    cb.classList.toggle('warn', state.selCats.length > 0 && state.selCats.length < p.cats);

    zu.textContent = state.selZones.length + ' منطقة';
    zb.querySelector('.lb-msg').textContent = ez > 0 ? `${state.selZones.length - p.zones} إضافية مدفوعة (${p.zones} مجاناً)` : `اختر حتى ${p.zones} مناطق مجاناً — إضافي بـ 50 ريال/منطقة`;
    zb.classList.toggle('warn', ez > 0);
    zb.classList.remove('blocked');
  }else{
    cu.textContent = '0 / 0';
    cb.querySelector('.lb-msg').textContent = 'اختر الباقة أولاً لمعرفة الحد المتاح';
    cb.classList.remove('warn','blocked');

    zu.textContent = '0 / 0';
    zb.querySelector('.lb-msg').textContent = 'اختر الباقة أولاً لمعرفة الحد المجاني';
    zb.classList.remove('warn','blocked');
  }

  document.getElementById('h-duration').value = state.duration;
  document.getElementById('h-price').value = gt.toFixed(2);

  if(p){
    document.getElementById('h-plan-id').value = p.id;
    document.getElementById('h-ads').value = p.ads;
    document.getElementById('h-cats').value = p.cats;
    document.getElementById('h-zones').value = p.zones;
  }else{
    document.getElementById('h-plan-id').value = '';
    document.getElementById('h-ads').value = '';
    document.getElementById('h-cats').value = '';
    document.getElementById('h-zones').value = '';
  }

  syncHiddenArrays();
  document.getElementById('submit-btn').disabled = !p;
}

document.querySelectorAll('.plan-c').forEach(card => {
  card.addEventListener('click', function(){
    document.querySelectorAll('.plan-c').forEach(c => c.classList.remove('sel'));
    this.classList.add('sel');

    state.plan = {
      id: this.dataset.id,
      name: this.dataset.name,
      price: parseFloat(this.dataset.price),
      ads: parseInt(this.dataset.ads),
      cats: parseInt(this.dataset.cats),
      zones: parseInt(this.dataset.zones)
    };

    state.selCats = [];
    state.selZones = [];
    render();
  });
});

document.querySelectorAll('.pick-card').forEach(card => {
  card.addEventListener('click', function(){
    const type = this.dataset.type;
    const id = this.dataset.id;
    const name = this.dataset.name;

    if(!state.plan){
      const bar = type === 'cat' ? document.getElementById('cat-limit-bar') : document.getElementById('zone-limit-bar');
      bar.style.outline = '2px solid #f59e0b';
      setTimeout(() => bar.style.outline = '', 900);
      return;
    }

    if(type === 'cat'){
      const idx = state.selCats.findIndex(c => c.id === id);
      if(idx === -1){
        if(state.selCats.length >= state.plan.cats) return;
        state.selCats.push({id, name});
      }else{
        state.selCats.splice(idx, 1);
      }
    }else{
      const idx = state.selZones.findIndex(z => z.id === id);
      if(idx === -1){
        state.selZones.push({id, name});
      }else{
        state.selZones.splice(idx, 1);
      }
    }

    render();
  });
});

document.querySelectorAll('.dur-btn').forEach(btn => {
  btn.addEventListener('click', function(){
    document.querySelectorAll('.dur-btn').forEach(b => b.classList.remove('sel'));
    this.classList.add('sel');
    state.duration = parseInt(this.dataset.months);
    render();
  });
});

window.removeCat = id => {
  state.selCats = state.selCats.filter(c => c.id !== id);
  render();
};

window.removeZone = id => {
  state.selZones = state.selZones.filter(z => z.id !== id);
  render();
};

render();
</script>
</body>
</html>
