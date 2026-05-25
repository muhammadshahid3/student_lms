<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LearnHub LMS</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@400;500&display=swap"
        rel="stylesheet">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #0D0D12;
            color: #fff;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .bg-orbs {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.35;
        }

        .orb-1 {
            width: 500px;
            height: 500px;
            background: #534AB7;
            top: -120px;
            right: -100px;
        }

        .orb-2 {
            width: 400px;
            height: 400px;
            background: #0F6E56;
            bottom: 100px;
            left: -100px;
        }

        .orb-3 {
            width: 300px;
            height: 300px;
            background: #3C3489;
            top: 40%;
            left: 40%;
        }

        nav {
            position: relative;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.5rem 4rem;
            border-bottom: 0.5px solid rgba(255, 255, 255, 0.08);
        }

        .logo {
            font-family: 'Syne', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: #fff;
        }

        .logo span {
            color: #AFA9EC;
        }

        .nav-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.6rem 1.5rem;
            background: #534AB7;
            color: #fff;
            border: none;
            border-radius: 50px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s, transform 0.15s;
        }

        .nav-btn:hover {
            background: #7F77DD;
            transform: translateY(-1px);
        }

        .nav-btn:active {
            transform: scale(0.97);
        }

        .hero {
            position: relative;
            z-index: 5;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 6rem 2rem 4rem;
            max-width: 800px;
            margin: 0 auto;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(83, 74, 183, 0.25);
            border: 0.5px solid rgba(175, 169, 236, 0.4);
            border-radius: 50px;
            padding: 0.35rem 1rem;
            font-size: 0.8rem;
            color: #AFA9EC;
            margin-bottom: 1.5rem;
            letter-spacing: 0.5px;
        }

        .badge-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #7F77DD;
        }

        h1 {
            font-family: 'Syne', sans-serif;
            font-size: clamp(2.8rem, 6vw, 4.5rem);
            font-weight: 800;
            line-height: 1.05;
            letter-spacing: -2px;
            color: #fff;
            margin-bottom: 1.25rem;
        }

        h1 em {
            font-style: normal;
            color: #AFA9EC;
        }

        .subtitle {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.55);
            line-height: 1.65;
            max-width: 520px;
            margin-bottom: 2.5rem;
        }

        .cta-group {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.85rem 2rem;
            background: #534AB7;
            color: #fff;
            border: none;
            border-radius: 50px;
            font-family: 'DM Sans', sans-serif;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s, transform 0.15s;
        }

        .btn-primary:hover {
            background: #7F77DD;
            transform: translateY(-2px);
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.85rem 2rem;
            background: transparent;
            color: rgba(255, 255, 255, 0.7);
            border: 0.5px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            font-family: 'DM Sans', sans-serif;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: border-color 0.2s, color 0.2s, transform 0.15s;
        }

        .btn-outline:hover {
            border-color: rgba(175, 169, 236, 0.6);
            color: #AFA9EC;
            transform: translateY(-2px);
        }

        .stats {
            position: relative;
            z-index: 5;
            display: flex;
            justify-content: center;
            gap: 3rem;
            flex-wrap: wrap;
            padding: 2rem 4rem 4rem;
            border-top: 0.5px solid rgba(255, 255, 255, 0.06);
        }

        .stat-item {
            text-align: center;
        }

        .stat-num {
            font-family: 'Syne', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            color: #fff;
            display: block;
        }

        .stat-label {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.4);
        }

        .features {
            position: relative;
            z-index: 5;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1px;
            margin: 0 4rem 4rem;
            border: 0.5px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            overflow: hidden;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.03);
            padding: 2rem 1.5rem;
            transition: background 0.2s;
        }

        .feature-card:hover {
            background: rgba(83, 74, 183, 0.12);
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(83, 74, 183, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .feature-title {
            font-family: 'Syne', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            color: #fff;
            margin-bottom: 0.4rem;
        }

        .feature-desc {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.4);
            line-height: 1.6;
        }

        footer {
            position: relative;
            z-index: 5;
            text-align: center;
            padding: 2rem;
            border-top: 0.5px solid rgba(255, 255, 255, 0.06);
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.25);
        }

        @media (max-width: 768px) {
            nav {
                padding: 1.25rem 1.5rem;
            }

            .features {
                margin: 0 1.5rem 3rem;
            }

            .stats {
                gap: 1.5rem;
                padding: 2rem 1.5rem 3rem;
            }

            h1 {
                letter-spacing: -1px;
            }
        }
    </style>
</head>

<body>

    <div class="bg-orbs">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>

    <nav>
        <div class="logo">Learn<span>Hub</span></div>
        <a href="{{ route('login') }}" class="nav-btn">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24">
                <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                <polyline points="10 17 15 12 10 7" />
                <line x1="15" y1="12" x2="3" y2="12" />
            </svg>
            Login
        </a>
    </nav>

    <section class="hero">
        <div class="badge">
            <div class="badge-dot"></div>
            Powered by Laravel
        </div>
        <h1>Learn Smarter,<br><em>Grow Faster</em></h1>
        <p class="subtitle">A modern learning management system built for students and educators. Access courses, track
            progress, and achieve your goals — all in one place.</p>
        <div class="cta-group">
            <a href="{{ route('login') }}" class="btn-primary">
                Get Started
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"
                    viewBox="0 0 24 24">
                    <line x1="5" y1="12" x2="19" y2="12" />
                    <polyline points="12 5 19 12 12 19" />
                </svg>
            </a>
            <a href="#features" class="btn-outline">Learn More</a>
        </div>
    </section>

    <div class="stats">
        <div class="stat-item">
            <span class="stat-num">10k+</span>
            <span class="stat-label">Students Enrolled</span>
        </div>
        <div class="stat-item">
            <span class="stat-num">200+</span>
            <span class="stat-label">Courses Available</span>
        </div>
        <div class="stat-item">
            <span class="stat-num">50+</span>
            <span class="stat-label">Expert Instructors</span>
        </div>
        <div class="stat-item">
            <span class="stat-num">98%</span>
            <span class="stat-label">Satisfaction Rate</span>
        </div>
    </div>

    <div class="features" id="features">
        <div class="feature-card">
            <div class="feature-icon">📚</div>
            <div class="feature-title">Rich Courses</div>
            <div class="feature-desc">Video lectures, quizzes, and assignments in one place.</div>
        </div>
        <div class="feature-card">
            <div class="feature-icon">📊</div>
            <div class="feature-title">Progress Tracking</div>
            <div class="feature-desc">Monitor your learning journey with detailed analytics.</div>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🏆</div>
            <div class="feature-title">Certificates</div>
            <div class="feature-desc">Earn verified certificates upon course completion.</div>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🔒</div>
            <div class="feature-title">Secure Access</div>
            <div class="feature-desc">Role-based access for students, teachers, and admins.</div>
        </div>
    </div>

    <footer>
        &copy; 2026 LearnHub. Built with Laravel.
    </footer>

</body>

</html>
