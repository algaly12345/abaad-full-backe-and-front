<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>المعاينة النهائية | أبعاد العقارية</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@400;500;600;700;800;900&family=Tajawal:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0d9488;
            --primary-dark: #0f766e;
            --primary-darker: #115e59;
            --accent: #06b6d4;
            --accent-light: #22d3ee;
            --gold: #f59e0b;
            --gold-light: #fbbf24;
            --bg: #f0f9ff;
            --white: #ffffff;
            --text: #0f172a;
            --text-light: #334155;
            --muted: #64748b;
            --border: #e2e8f0;
            --soft: #f8fafc;
            --danger: #dc2626;
            --success: #059669;
            --shadow: 0 10px 40px rgba(15, 118, 110, 0.12);
            --shadow-lg: 0 25px 50px rgba(15, 118, 110, 0.15);
            --radius: 24px;
            --radius-sm: 16px;
            --font-display: 'Noto Kufi Arabic', 'Tajawal', sans-serif;
            --font-body: 'Tajawal', 'Noto Kufi Arabic', sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            overflow-x: hidden;
            min-height: 100vh;
            font-family: var(--font-body);
            font-size: 17px;
            line-height: 1.8;
            -webkit-font-smoothing: antialiased;
        }

        /* Dynamic Background */
        .bg-canvas {
            position: fixed;
            inset: 0;
            z-index: -1;
            overflow: hidden;
            background: linear-gradient(160deg, #f0fdfa 0%, #e0f2fe 30%, #f0f9ff 60%, #faf5ff 100%);
        }

        .bg-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.6;
            animation: float 20s ease-in-out infinite;
        }

        .bg-orb-1 {
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(6, 182, 212, 0.4) 0%, transparent 70%);
            top: -200px;
            right: -100px;
        }

        .bg-orb-2 {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(15, 118, 110, 0.35) 0%, transparent 70%);
            bottom: -150px;
            left: -100px;
            animation-delay: -7s;
        }

        .bg-orb-3 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.25) 0%, transparent 70%);
            top: 50%;
            left: 30%;
            animation-delay: -14s;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25% { transform: translate(30px, -30px) scale(1.05); }
            50% { transform: translate(-20px, 20px) scale(0.95); }
            75% { transform: translate(20px, 30px) scale(1.02); }
        }

        /* Floating Particles */
        .particle {
            position: absolute;
            width: 6px;
            height: 6px;
            background: var(--primary);
            border-radius: 50%;
            opacity: 0.3;
            animation: particleFloat 15s linear infinite;
        }

        @keyframes particleFloat {
            0% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
            10% { opacity: 0.3; }
            90% { opacity: 0.3; }
            100% { transform: translateY(-100vh) rotate(720deg); opacity: 0; }
        }

        /* Topbar */
        .topbar {
            background: rgba(15, 23, 42, 0.95);
            color: #fff;
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(20px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        .topbar-inner {
            width: min(94%, 1400px);
            margin: auto;
            min-height: 85px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            padding: 14px 0;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .brand-mark {
            width: 58px;
            height: 58px;
            border-radius: 18px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-family: var(--font-display);
            font-weight: 900;
            font-size: 26px;
            box-shadow: 0 8px 20px rgba(6, 182, 212, 0.3);
            position: relative;
            overflow: hidden;
        }

        .brand-mark::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent 40%, rgba(255,255,255,0.3) 50%, transparent 60%);
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0%, 100% { transform: translateX(-100%); }
            50% { transform: translateX(100%); }
        }

        .brand-text strong {
            display: block;
            font-family: var(--font-display);
            font-size: 22px;
            font-weight: 800;
        }

        .brand-text span {
            color: #94a3b8;
            font-size: 15px;
            font-weight: 500;
        }

        .step-pill {
            background: linear-gradient(135deg, rgba(6, 182, 212, 0.2), rgba(15, 118, 110, 0.2));
            border: 1px solid rgba(6, 182, 212, 0.3);
            border-radius: 999px;
            padding: 14px 28px;
            font-size: 16px;
            font-family: var(--font-display);
            color: #a5f3fc;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .step-pill::before {
            content: '';
            width: 10px;
            height: 10px;
            background: var(--accent);
            border-radius: 50%;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.3); }
        }

        /* Hero Section */
        .hero {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #0f172a 0%, #0f766e 50%, #0891b2 100%);
            color: #fff;
            padding: 70px 0 60px;
        }

        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: 
                radial-gradient(circle at 20% 50%, rgba(6, 182, 212, 0.2) 0%, transparent 40%),
                radial-gradient(circle at 80% 80%, rgba(15, 118, 110, 0.2) 0%, transparent 40%);
            pointer-events: none;
        }

        .hero-pattern {
            position: absolute;
            inset: 0;
            opacity: 0.03;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .hero-content {
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .hero h1 {
            margin: 0 0 16px;
            font-family: var(--font-display);
            font-size: 48px;
            line-height: 1.3;
            font-weight: 900;
            letter-spacing: -0.02em;
        }

        .hero h1 span {
            background: linear-gradient(135deg, #fff 0%, #a5f3fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero p {
            margin: 0 0 28px;
            color: rgba(255, 255, 255, 0.85);
            font-size: 19px;
            line-height: 2;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 24px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(255, 255, 255, 0.2);
            animation: iconPulse 2s ease-in-out infinite;
        }

        .hero-icon svg {
            width: 50px;
            height: 50px;
            stroke: #fff;
        }

        @keyframes iconPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        /* Main Content */
        .page-wrap {
            margin-top: -40px;
            padding-bottom: 80px;
            position: relative;
            z-index: 1;
        }

        .container {
            width: min(92%, 1400px);
            margin: auto;
        }

        /* Summary Grid */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 28px;
            margin-bottom: 32px;
        }

        .summary-grid.single {
            grid-template-columns: 1fr;
        }

        /* Cards */
        .card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
        }

        .card:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-4px);
        }

        .card-head {
            padding: 26px 30px;
            border-bottom: 1px solid var(--border);
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            position: relative;
            overflow: hidden;
        }

        .card-head::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(6, 182, 212, 0.08) 0%, transparent 70%);
            pointer-events: none;
        }

        .card-head h2,
        .card-head h3 {
            margin: 0;
            font-family: var(--font-display);
            font-size: 24px;
            font-weight: 800;
            color: var(--text);
            letter-spacing: -0.01em;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .card-head h2 .icon,
        .card-head h3 .icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);
        }

        .card-head h2 .icon svg,
        .card-head h3 .icon svg {
            width: 22px;
            height: 22px;
            stroke: #fff;
        }

        .card-body {
            padding: 28px 30px;
        }

        /* Data Rows */
        .data-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 20px;
            padding: 16px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        .data-row:last-child {
            border-bottom: none;
        }

        .data-label {
            font-family: var(--font-display);
            font-weight: 700;
            font-size: 16px;
            color: var(--muted);
            min-width: 180px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .data-label svg {
            width: 18px;
            height: 18px;
            stroke: var(--muted);
            opacity: 0.6;
        }

        .data-value {
            font-size: 17px;
            color: var(--text);
            text-align: left;
            flex: 1;
            font-weight: 600;
            word-break: break-word;
        }

        .data-value.highlight {
            color: var(--primary);
            font-family: var(--font-display);
            font-weight: 800;
        }

        .data-value.price {
            font-size: 22px;
            color: var(--success);
            font-family: var(--font-display);
            font-weight: 900;
        }

        /* Tags */
        .tags-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .tag {
            background: linear-gradient(135deg, #f0fdfa, #ccfbf1);
            color: var(--primary-dark);
            border: 1px solid #99f6e4;
            border-radius: 999px;
            padding: 10px 18px;
            font-size: 14px;
            font-family: var(--font-display);
            font-weight: 700;
            transition: all 0.3s ease;
        }

        .tag:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(15, 118, 110, 0.15);
        }

        .tag-zone {
            background: linear-gradient(135deg, #eff6ff, #dbeafe);
            color: #1d4ed8;
            border-color: #93c5fd;
        }

        .tag-service {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            color: #92400e;
            border-color: #fcd34d;
        }

        /* Image Preview */
        .image-preview {
            text-align: center;
            padding: 20px;
        }

        .image-preview img {
            max-width: 100%;
            max-height: 350px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.12);
            border: 3px solid #f1f5f9;
            transition: all 0.4s ease;
        }

        .image-preview img:hover {
            transform: scale(1.02);
            box-shadow: 0 15px 40px rgba(15, 23, 42, 0.18);
        }

        /* Description Box */
        .description-box {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 20px 24px;
            font-size: 16px;
            line-height: 2;
            color: var(--text-light);
        }

        /* Action Section */
        .action-section {
            margin-top: 40px;
        }

        .action-card {
            background: linear-gradient(135deg, #f0fdfa, #e0f2fe);
            border: 2px solid var(--primary);
            border-radius: var(--radius);
            padding: 36px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .action-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--accent), var(--gold));
        }

        .action-card h3 {
            margin: 0 0 12px;
            font-family: var(--font-display);
            font-size: 26px;
            font-weight: 900;
            color: var(--text);
        }

        .action-card p {
            margin: 0 0 28px;
            color: var(--muted);
            font-size: 17px;
            line-height: 1.8;
        }

        .action-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            border: none;
            border-radius: 20px;
            padding: 18px 48px;
            font-size: 18px;
            font-family: var(--font-display);
            font-weight: 800;
            cursor: pointer;
            min-width: 200px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .btn svg {
            width: 22px;
            height: 22px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: #fff;
            box-shadow: 0 10px 40px rgba(15, 118, 110, 0.3);
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }

        .btn-primary:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 50px rgba(15, 118, 110, 0.4);
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-secondary {
            background: var(--white);
            color: var(--text);
            border: 2px solid var(--border);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        .btn-secondary:hover {
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-2px);
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger), #ef4444);
            color: #fff;
            box-shadow: 0 10px 40px rgba(220, 38, 38, 0.3);
        }

        .btn-danger:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 50px rgba(220, 38, 38, 0.4);
        }

        /* Warning Box */
        .warning-box {
            background: linear-gradient(135deg, #fffbeb, #fef3c7);
            border: 1px solid #fcd34d;
            color: #92400e;
            border-radius: var(--radius-sm);
            padding: 20px 24px;
            margin-bottom: 24px;
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }

        .warning-box svg {
            width: 28px;
            height: 28px;
            stroke: var(--gold);
            flex-shrink: 0;
            margin-top: 2px;
        }

        .warning-box strong {
            display: block;
            font-family: var(--font-display);
            font-size: 17px;
            margin-bottom: 4px;
        }

        .warning-box span {
            font-size: 15px;
            line-height: 1.7;
        }

        /* Success Animation */
        .success-checkmark {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--success), #10b981);
            display: flex;
            align-items: center;
            justify-content: center;
            animation: scaleIn 0.5s ease;
        }

        .success-checkmark svg {
            width: 40px;
            height: 40px;
            stroke: #fff;
            stroke-width: 3;
        }

        @keyframes scaleIn {
            0% { transform: scale(0); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        /* Footer */
        .footer {
            margin-top: 50px;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #94a3b8;
            padding: 38px 0;
            position: relative;
            overflow: hidden;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--accent), transparent);
        }

        .footer-inner {
            width: min(92%, 1400px);
            margin: auto;
            display: flex;
            justify-content: space-between;
            gap: 24px;
            flex-wrap: wrap;
            align-items: center;
        }

        .footer strong {
            color: #fff;
            font-family: var(--font-display);
            font-weight: 800;
            font-size: 18px;
        }

        .footer-links {
            display: flex;
            gap: 28px;
            flex-wrap: wrap;
        }

        .footer-links span {
            font-size: 15px;
            opacity: 0.85;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-in {
            animation: fadeInUp 0.6s ease forwards;
        }

        .delay-1 { animation-delay: 0.1s; }
        .delay-2 { animation-delay: 0.2s; }
        .delay-3 { animation-delay: 0.3s; }
        .delay-4 { animation-delay: 0.4s; }

        /* Responsive */
        @media (max-width: 1200px) {
            .summary-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            body {
                font-size: 16px;
            }

            .hero h1 {
                font-size: 36px;
            }

            .hero p {
                font-size: 17px;
            }

            .topbar-inner {
                align-items: flex-start;
            }

            .step-pill {
                font-size: 14px;
                padding: 12px 20px;
            }

            .card-body {
                padding: 20px 22px;
            }

            .data-row {
                flex-direction: column;
                gap: 8px;
            }

            .data-label {
                min-width: auto;
            }

            .data-value {
                text-align: right;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                min-width: 100%;
            }

            .brand-text strong {
                font-size: 18px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>
    <!-- Dynamic Background -->
    <div class="bg-canvas">
        <div class="bg-orb bg-orb-1"></div>
        <div class="bg-orb bg-orb-2"></div>
        <div class="bg-orb bg-orb-3"></div>
    </div>

    <!-- Topbar -->
    <header class="topbar">
        <div class="topbar-inner">
            <div class="brand">
                <div class="brand-mark">أ</div>
                <div class="brand-text">
                    <strong>أبعاد العقارية</strong>
                    <span>المعاينة النهائية - الخطوة الرابعة</span>
                </div>
            </div>
            <div class="step-pill">الخطوة 4 من 4 — المعاينة والتأكيد</div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-pattern"></div>
        <div class="container">
            <div class="hero-content animate-in">
                <div class="hero-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h1><span>معاينة طلبك</span></h1>
                <p>راجع جميع البيانات أدناه قبل تأكيد إرسال الطلب. يمكنك التعديل أو التأكيد حسب رغبتك.</p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container page-wrap">
        @if(session('error'))
            <div class="warning-box animate-in">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <div>
                    <strong>تنبيه</strong>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <div class="summary-grid">
            <!-- Package Details -->
            <div class="card animate-in delay-1">
                <div class="card-head">
                    <h3>
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </span>
                        تفاصيل الباقة
                    </h3>
                </div>
                <div class="card-body">
                    <div class="data-row">
                        <div class="data-label">رقم الباقة</div>
                        <div class="data-value highlight">{{ $data['service_plan_id'] ?? '-' }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-label">مدة الاشتراك</div>
                        <div class="data-value">{{ $data['subscription_duration'] ?? '-' }} شهر</div>
                    </div>
                    <div class="data-row">
                        <div class="data-label">الإجمالي</div>
                        <div class="data-value price">{{ $data['package_price'] ?? '-' }} ريال</div>
                    </div>
                    <div class="data-row">
                        <div class="data-label">تاريخ الانتهاء</div>
                        <div class="data-value">{{ $data['expiry_date'] ?? '-' }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-label">عدد الإعلانات</div>
                        <div class="data-value">{{ $data['number_of_ads'] ?? '-' }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-label">أنواع العقار المسموح</div>
                        <div class="data-value">{{ $data['number_of_categories'] ?? '-' }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-label">المناطق المسموح</div>
                        <div class="data-value">{{ $data['number_of_zone'] ?? '-' }}</div>
                    </div>
                </div>
            </div>

            <!-- Service Details -->
            <div class="card animate-in delay-2">
                <div class="card-head">
                    <h3>
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </span>
                        تفاصيل الخدمة
                    </h3>
                </div>
                <div class="card-body">
                    <div class="data-row">
                        <div class="data-label">عنوان الخدمة</div>
                        <div class="data-value highlight">{{ $data['title'] ?? '-' }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-label">نوع الخدمة</div>
                        <div class="data-value">{{ $data['service_type'] ?? '-' }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-label">نوع العرض</div>
                        <div class="data-value">
                            @if(($data['offer_type'] ?? '') == 'price')
                                <span class="tag tag-service">سعر ثابت</span>
                            @elseif(($data['offer_type'] ?? '') == 'discount')
                                <span class="tag tag-service">خصم</span>
                            @else
                                -
                            @endif
                        </div>
                    </div>
                    @if(($data['offer_type'] ?? '') == 'price')
                        <div class="data-row">
                            <div class="data-label">السعر</div>
                            <div class="data-value price">{{ $data['service_price'] ?? '-' }} ريال</div>
                        </div>
                    @endif
                    @if(($data['offer_type'] ?? '') == 'discount')
                        <div class="data-row">
                            <div class="data-label">الخصم</div>
                            <div class="data-value price">{{ $data['discount'] ?? '-' }}%</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Provider Info -->
        <div class="card animate-in delay-3" style="margin-bottom: 28px;">
            <div class="card-head">
                <h3>
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </span>
                    بيانات مزود الخدمة
                </h3>
            </div>
            <div class="card-body">
                <div class="summary-grid">
                    <div>
                        <div class="data-row">
                            <div class="data-label">الاسم الرسمي</div>
                            <div class="data-value highlight">{{ $data['provider_name'] ?? '-' }}</div>
                        </div>
                        <div class="data-row">
                            <div class="data-label">البريد الإلكتروني</div>
                            <div class="data-value">{{ $data['provider_email'] ?? '-' }}</div>
                        </div>
                        <div class="data-row">
                            <div class="data-label">رقم الجوال</div>
                            <div class="data-value">{{ $data['provider_phone'] ?? '-' }}</div>
                        </div>
                    </div>
                    <div>
                        <div class="data-row">
                            <div class="data-label">اسم الشركة</div>
                            <div class="data-value">{{ $data['provider_company'] ?? 'غير محدد' }}</div>
                        </div>
                        <div class="data-row">
                            <div class="data-label">الاسم التجاري</div>
                            <div class="data-value">{{ $data['provider_commercial_name'] ?? 'غير محدد' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories & Zones -->
        <div class="summary-grid">
            <div class="card animate-in delay-3">
                <div class="card-head">
                    <h3>
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </span>
                        أنواع العقار
                    </h3>
                </div>
                <div class="card-body">
                    @if(!empty($data['selected_category_names']))
                        <div class="tags-container">
                            @foreach($data['selected_category_names'] as $cat)
                                <span class="tag">{{ $cat }}</span>
                            @endforeach
                        </div>
                    @else
                        <p style="color: var(--muted); text-align: center; padding: 20px;">لم يتم اختيار أنواع عقار</p>
                    @endif
                </div>
            </div>

            <div class="card animate-in delay-4">
                <div class="card-head">
                    <h3>
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </span>
                        المناطق
                    </h3>
                </div>
                <div class="card-body">
                    @if(!empty($data['selected_zone_names']))
                        <div class="tags-container">
                            @foreach($data['selected_zone_names'] as $zone)
                                <span class="tag tag-zone">{{ $zone }}</span>
                            @endforeach
                        </div>
                    @else
                        <p style="color: var(--muted); text-align: center; padding: 20px;">لم يتم اختيار مناطق</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Description & Image -->
        <div class="summary-grid" style="margin-top: 28px;">
            <div class="card animate-in delay-4">
                <div class="card-head">
                    <h3>
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                        </span>
                        الوصف
                    </h3>
                </div>
                <div class="card-body">
                    <div class="description-box">
                        {{ $data['description'] ?? 'لا يوجد وصف' }}
                    </div>
                </div>
            </div>

            @if(!empty($data['image']))
                <div class="card animate-in delay-4">
                    <div class="card-head">
                        <h3>
                            <span class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </span>
                            صورة الخدمة
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="image-preview">
                            <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($data['image']) }}" alt="صورة الخدمة">
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Action Section -->
        <div class="action-section animate-in delay-4">
            <div class="action-card">
                <div class="success-checkmark">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h3>هل أنت متأكد من البيانات؟</h3>
                <p>بعد التأكيد سيتم إرسال طلبك للمراجعة والمعالجة. يمكنك التعديل إذا لزم الأمر.</p>
                
                <form action="{{ route('website.offers.store') }}" method="POST">
                    @csrf
                    
                    <!-- Hidden fields for all data -->
                    <input type="hidden" name="title" value="{{ $data['title'] ?? '' }}">
                    <input type="hidden" name="service_type" value="{{ $data['service_type'] ?? '' }}">
                    <input type="hidden" name="offer_type" value="{{ $data['offer_type'] ?? '' }}">
                    <input type="hidden" name="service_price" value="{{ $data['service_price'] ?? '' }}">
                    <input type="hidden" name="discount" value="{{ $data['discount'] ?? '' }}">
                    <input type="hidden" name="description" value="{{ $data['description'] ?? '' }}">
                    <input type="hidden" name="expiry_date" value="{{ $data['expiry_date'] ?? '' }}">
                    <input type="hidden" name="service_plan_id" value="{{ $data['service_plan_id'] ?? '' }}">
                    <input type="hidden" name="subscription_duration" value="{{ $data['subscription_duration'] ?? '' }}">
                    <input type="hidden" name="package_price" value="{{ $data['package_price'] ?? '' }}">
                    <input type="hidden" name="number_of_ads" value="{{ $data['number_of_ads'] ?? '' }}">
                    <input type="hidden" name="number_of_categories" value="{{ $data['number_of_categories'] ?? '' }}">
                    <input type="hidden" name="number_of_zone" value="{{ $data['number_of_zone'] ?? '' }}">
                    <input type="hidden" name="provider_name" value="{{ $data['provider_name'] ?? '' }}">
                    <input type="hidden" name="provider_email" value="{{ $data['provider_email'] ?? '' }}">
                    <input type="hidden" name="provider_phone" value="{{ $data['provider_phone'] ?? '' }}">
                    <input type="hidden" name="provider_company" value="{{ $data['provider_company'] ?? '' }}">
                    <input type="hidden" name="provider_commercial_name" value="{{ $data['provider_commercial_name'] ?? '' }}">
                    <input type="hidden" name="image" value="{{ $data['image'] ?? '' }}">
                    
                    @if(!empty($data['selected_category_ids']))
                        @foreach($data['selected_category_ids'] as $catId)
                            <input type="hidden" name="categories[]" value="{{ $catId }}">
                        @endforeach
                    @endif
                    
                    @if(!empty($data['selected_zone_ids']))
                        @foreach($data['selected_zone_ids'] as $zoneId)
                            <input type="hidden" name="zones[]" value="{{ $zoneId }}">
                        @endforeach
                    @endif

                    <div class="action-buttons">
                        <a href="{{ route('website.offers.step-one') }}" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            تعديل البيانات
                        </a>
                        
                        <button type="submit" class="btn btn-primary" id="submitBtn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            تأكيد وإرسال الطلب
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-inner">
            <div><strong>أبعاد العقارية</strong> — منصة متكاملة لخدمات العقارات</div>
            <div class="footer-links">
                <span>مزودي الخدمة</span>
                <span>التجوال الافتراضي</span>
                <span>عرض الشارع</span>
                <span>Sky View</span>
            </div>
        </div>
    </footer>

    <script>
        // Create floating particles
        function createParticles() {
            const canvas = document.querySelector('.bg-canvas');
            if (!canvas) return;

            for (let i = 0; i < 20; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 15 + 's';
                particle.style.animationDuration = (15 + Math.random() * 10) + 's';
                canvas.appendChild(particle);
            }
        }

        createParticles();

        // Intersection Observer for scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.card, .action-card').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });

        // Form submission with loading state
        const submitBtn = document.getElementById('submitBtn');
        const form = submitBtn ? submitBtn.closest('form') : null;
        
        if (form && submitBtn) {
            form.addEventListener('submit', function(e) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <svg class="spinner" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="animation: spin 1s linear infinite; width: 22px; height: 22px;">
                        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none" stroke-dasharray="31.4" stroke-dashoffset="10"></circle>
                    </svg>
                    جاري الإرسال...
                `;
            });
        }

        // Add spin animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes spin {
                from { transform: rotate(0deg); }
                to { transform: rotate(360deg); }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>