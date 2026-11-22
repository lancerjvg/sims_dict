@extends('layouts.app')

@section('title', 'AI Engineering Portfolio')
@section('page-heading', 'AI Engineering Portfolio')

@section('content')
<div class="portfolio-page">
    <section class="portfolio-hero">
        <div class="portfolio-hero-grid"></div>
        <div class="portfolio-hero-content">
            <span class="portfolio-eyebrow"><span class="portfolio-pulse"></span> AI ENGINEERING PROFILE / 2026</span>
            <div class="portfolio-hero-role"><i class="bi bi-terminal"></i> SOFTWARE DEVELOPER <span>•</span> SYSTEMS ENGINEER</div>
            <h1>Engineering ideas.<br><span>Building intelligence.</span></h1>
            <p class="portfolio-intro">I build practical software solutions, connected systems, and workflow automation—combining software engineering experience with AI-assisted development to turn real-world problems into useful digital tools.</p>
            <div class="portfolio-profile-tags">
                <span><i class="bi bi-code-slash"></i> Application Development</span>
                <span><i class="bi bi-diagram-3"></i> Systems Architecture</span>
                <span><i class="bi bi-stars"></i> AI-Assisted Engineering</span>
            </div>
            <div class="portfolio-hero-actions">
                <a href="#featured-project" class="portfolio-btn-primary">Explore My Work <i class="bi bi-arrow-down-right"></i></a>
                <a href="#engineering" class="portfolio-btn-ghost">How I Engineer <i class="bi bi-arrow-right"></i></a>
            </div>
            <div class="portfolio-hero-meta"><span><i class="bi bi-braces"></i> Laravel / PHP</span><span><i class="bi bi-database"></i> SQL / Data</span><span><i class="bi bi-phone"></i> Mobile & Desktop</span></div>
        </div>
        <div class="portfolio-hero-visual" aria-hidden="true">
            <div class="portfolio-orbit orbit-one"></div><div class="portfolio-orbit orbit-two"></div>
            <div class="portfolio-core"><i class="bi bi-cpu"></i><span>ENGINEERING<br>INTELLIGENCE</span></div>
            <div class="portfolio-float-chip chip-top"><i class="bi bi-braces"></i> CODE / BUILD</div>
            <div class="portfolio-float-chip chip-bottom"><i class="bi bi-database"></i> DATA / SYSTEMS</div>
        </div>
    </section>


    <section class="portfolio-section portfolio-featured" id="featured-project">
        <div class="portfolio-section-heading">
            <div>
                <span class="portfolio-section-kicker">01 / FEATURED PROJECT</span>
                <h2>Student Information<br><span>Management System</span></h2>
                <p>A modular school management application focused on organized academic records and efficient day-to-day workflows.</p>
            </div>
            <span class="portfolio-section-number">PROJECT_001</span>
        </div>


        <article class="portfolio-project-card portfolio-sims-showcase">
            <div class="portfolio-project-visual portfolio-sims-visual">
                <div class="portfolio-sims-visual-heading">
                    <span class="portfolio-project-badge"><i class="bi bi-stars"></i> FEATURED BUILD</span>
                    <span class="portfolio-sims-live"><i></i> DEVELOPMENT</span>
                </div>
                <div class="portfolio-mock-window">
                    <div class="portfolio-mock-top"><span></span><span></span><span></span><b>SIMS / ADMIN DASHBOARD</b></div>
                    <div class="portfolio-mock-body">
                        <div class="portfolio-mock-sidebar"><i class="bi bi-grid-fill"></i><i class="bi bi-people-fill"></i><i class="bi bi-book-fill"></i><i class="bi bi-journal-check"></i><i class="bi bi-gear"></i></div>
                        <div class="portfolio-mock-main">
                            <div class="portfolio-mock-welcome">Dashboard Overview <small>Academic data at a glance</small></div>
                            <div class="portfolio-mock-stats">
                                <span><small>STUDENTS</small><strong>01</strong><em><i class="bi bi-people"></i> Records</em></span>
                                <span><small>SUBJECTS</small><strong>02</strong><em><i class="bi bi-book"></i> Catalog</em></span>
                                <span><small>ENROLLMENTS</small><strong>03</strong><em><i class="bi bi-check2-circle"></i> Workflow</em></span>
                            </div>
                            <div class="portfolio-mock-analytics">
                                <div class="portfolio-mock-chart-label">ACTIVITY / ANALYTICS <span>VISUAL PREVIEW</span></div>
                                <div class="portfolio-mock-chart"><div style="height:35%"></div><div style="height:65%"></div><div style="height:48%"></div><div style="height:88%"></div><div style="height:57%"></div><div style="height:72%"></div><div style="height:45%"></div><div style="height:80%"></div></div>
                            </div>
                            <div class="portfolio-mock-row"><span></span><span></span><span></span></div>
                        </div>
                    </div>
                </div>
                <div class="portfolio-sims-visual-caption"><span>MODULAR APPLICATION</span><span>WEB / RESPONSIVE UI</span><span>DATA-DRIVEN</span></div>
            </div>


            <div class="portfolio-project-info portfolio-sims-info">
                <div class="portfolio-sims-title-row"><div><span class="portfolio-project-badge"><i class="bi bi-stars"></i> PORTFOLIO PROJECT</span><h3>SIMS <span class="portfolio-sims-subtitle">Student Information Management System</span></h3></div><span class="portfolio-sims-project-id">PROJECT / 001</span></div>
                <p class="portfolio-sims-description">A web-based Student Information Management System built to centralize student profiles, academic subjects, courses, enrollment records, and administrative workflows into a unified application.</p>
                <div class="portfolio-sims-highlights">
                    <div><span class="portfolio-sims-highlight-icon"><i class="bi bi-person-vcard"></i></span><div><strong>Student Records</strong><small>Structured student profile management</small></div></div>
                    <div><span class="portfolio-sims-highlight-icon"><i class="bi bi-mortarboard"></i></span><div><strong>Course & Subject Setup</strong><small>Organized academic catalog management</small></div></div>
                    <div><span class="portfolio-sims-highlight-icon"><i class="bi bi-clipboard2-check"></i></span><div><strong>Enrollment Workflow</strong><small>Record and manage student enrollment</small></div></div>
                    <div><span class="portfolio-sims-highlight-icon"><i class="bi bi-bar-chart-line"></i></span><div><strong>Dashboard Overview</strong><small>Quick view of system information</small></div></div>
                </div>
                <div class="portfolio-sims-details-grid">
                    <div class="portfolio-sims-detail"><span class="portfolio-sims-detail-label">ENGINEERING</span><strong>Laravel MVC</strong><small>Controller · Model · View separation</small></div>
                    <div class="portfolio-sims-detail"><span class="portfolio-sims-detail-label">DATA LAYER</span><strong>Relational Database</strong><small>Structured records & relationships</small></div>
                    <div class="portfolio-sims-detail"><span class="portfolio-sims-detail-label">INTERFACE</span><strong>Responsive UI</strong><small>Bootstrap-based design system</small></div>
                </div>
                <div class="portfolio-sims-architecture"><span class="portfolio-sims-detail-label">APPLICATION FLOW</span><div class="portfolio-sims-flow"><span><i class="bi bi-window"></i> UI / Blade</span><b><i class="bi bi-arrow-right"></i></b><span><i class="bi bi-diagram-3"></i> Laravel MVC</span><b><i class="bi bi-arrow-right"></i></b><span><i class="bi bi-database"></i> MySQL</span></div></div>
                <div class="portfolio-project-features portfolio-sims-feature-list"><div><i class="bi bi-check2-circle"></i> Student Management</div><div><i class="bi bi-check2-circle"></i> Course Management</div><div><i class="bi bi-check2-circle"></i> Subject Management</div><div><i class="bi bi-check2-circle"></i> Enrollment Management</div><div><i class="bi bi-check2-circle"></i> Dashboard & Reporting UI</div><div><i class="bi bi-check2-circle"></i> Authentication-ready routes</div></div>
                <div class="portfolio-tech-tags portfolio-sims-tech"><span>Laravel</span><span>PHP</span><span>MySQL</span><span>Bootstrap 5</span><span>Blade</span><span>JavaScript</span><span>MVC</span></div>
                <div class="portfolio-sims-footnote"><i class="bi bi-info-circle"></i> Featured as an evolving build. Features and modules are iteratively developed and refined.</div>
            </div>
        </article>
    </section>

<div id="engineering">
    
</div>


<section class="portfolio-section portfolio-skills" id="skills-matrix">
    <div class="portfolio-section-heading"><div><span class="portfolio-section-kicker">03 / ENGINEERING CAPABILITIES</span><h2>Technical Skills <span>Matrix</span></h2><p>A practical overview of the tools, platforms, and engineering disciplines I work with to design and build applications.</p></div><span class="portfolio-section-number">CAPABILITY_MAP</span></div>
    <div class="portfolio-skills-grid">
        <article class="portfolio-skill-card"><div class="portfolio-skill-head"><span class="portfolio-skill-icon"><i class="bi bi-braces"></i></span><span class="portfolio-skill-index">DOMAIN / 01</span></div><h3>Application & Backend Engineering</h3><p>Building structured applications with server-side logic, reusable components, and maintainable application architecture.</p><div class="portfolio-skill-tags"><span>PHP</span><span>Laravel</span><span>MVC</span><span>VB.NET</span><span>Scriptcase</span></div></article>
        <article class="portfolio-skill-card"><div class="portfolio-skill-head"><span class="portfolio-skill-icon"><i class="bi bi-window-stack"></i></span><span class="portfolio-skill-index">DOMAIN / 02</span></div><h3>Frontend & UI Engineering</h3><p>Creating responsive interfaces, dashboard layouts, interactive forms, and user-focused application experiences.</p><div class="portfolio-skill-tags"><span>HTML</span><span>CSS</span><span>Bootstrap 5</span><span>JavaScript</span><span>Blade</span></div></article>
        <article class="portfolio-skill-card"><div class="portfolio-skill-head"><span class="portfolio-skill-icon"><i class="bi bi-database"></i></span><span class="portfolio-skill-index">DOMAIN / 03</span></div><h3>Database & Data Systems</h3><p>Working with relational databases, queries, records, data structures, and application persistence.</p><div class="portfolio-skill-tags"><span>MySQL</span><span>SQL Server</span><span>SQLite</span><span>SQL</span><span>Data Modeling</span></div></article>
        <article class="portfolio-skill-card"><div class="portfolio-skill-head"><span class="portfolio-skill-icon"><i class="bi bi-phone"></i></span><span class="portfolio-skill-index">DOMAIN / 04</span></div><h3>Mobile & Desktop Development</h3><p>Developing client applications and tools that connect to data services and support practical workflows.</p><div class="portfolio-skill-tags"><span>B4A</span><span>B4XPages</span><span>Android</span><span>VB.NET</span><span>Windows Forms</span></div></article>
        <article class="portfolio-skill-card"><div class="portfolio-skill-head"><span class="portfolio-skill-icon"><i class="bi bi-diagram-3"></i></span><span class="portfolio-skill-index">DOMAIN / 05</span></div><h3>Integration & Automation</h3><p>Connecting applications, exchanging structured data, and automating communication between systems.</p><div class="portfolio-skill-tags"><span>REST / HTTP</span><span>Webhooks</span><span>JSON</span><span>MQTT</span><span>API Integration</span></div></article>
        <article class="portfolio-skill-card"><div class="portfolio-skill-head"><span class="portfolio-skill-icon"><i class="bi bi-stars"></i></span><span class="portfolio-skill-index">DOMAIN / 06</span></div><h3>AI-Assisted Engineering</h3><p>Using AI-assisted workflows for problem exploration, code iteration, documentation, debugging support, and solution refinement.</p><div class="portfolio-skill-tags"><span>Prompting</span><span>AI-Assisted Coding</span><span>Problem Analysis</span><span>Iteration</span></div></article>
        <article class="portfolio-skill-card"><div class="portfolio-skill-head"><span class="portfolio-skill-icon"><i class="bi bi-tools"></i></span><span class="portfolio-skill-index">DOMAIN / 07</span></div><h3>Developer Workflow & Tools</h3><p>Using development environments and debugging workflows to build, test, maintain, and improve software.</p><div class="portfolio-skill-tags"><span>VS Code</span><span>Visual Studio</span><span>Laragon</span><span>Git</span><span>Debugging</span></div></article>
    </div>
</section>


<section class="portfolio-section" id="technology">
    <div class="portfolio-section-heading"><div><span class="portfolio-section-kicker">04 / TECHNOLOGY</span><h2>Tools & <span>Technologies</span></h2><p>Technologies and development tools used across my application and systems work.</p></div></div>
    <div class="portfolio-tech-grid">
        <article><i class="bi bi-code-square"></i><h3>Backend</h3><p>Laravel · PHP · MVC</p></article>
        <article><i class="bi bi-window"></i><h3>Frontend</h3><p>Blade · Bootstrap 5 · JavaScript · HTML · CSS</p></article>
        <article><i class="bi bi-database"></i><h3>Database</h3><p>MySQL · SQL · Relational Data Design</p></article>
        <article><i class="bi bi-git"></i><h3>Workflow</h3><p>Git · VS Code · Laragon · Debugging</p></article>
        <article><i class="bi bi-cpu"></i><h3>AI-Assisted</h3><p>Prompting · Code Review Assistance · Problem Analysis</p></article>
        <article><i class="bi bi-phone"></i><h3>Other Development</h3><p>B4X / B4A · VB.NET · SQL Server · Automation</p></article>
    </div>
</section>

<section class="portfolio-section portfolio-next" id="next-builds"><div class="portfolio-next-panel"><span class="portfolio-section-kicker">05 / CONTINUOUS DEVELOPMENT</span><h2>Always learning.<br><span>Always building.</span></h2><p>Every project is an opportunity to improve architecture, simplify workflows, strengthen reliability, and explore useful technologies—including AI where it adds real value.</p><a href="#portfolio-top" class="portfolio-back-top">BACK TO TOP <i class="bi bi-arrow-up-right"></i></a></div></section>
<footer class="portfolio-footer"><span>AI ENGINEERING PORTFOLIO</span><span>Built with curiosity, logic & continuous iteration.</span></footer>
</div>
@endsection

@push('styles')
<style>
.portfolio-page{--pf-bg:#080b16;--pf-panel:#10172a;--pf-border:rgba(142,156,255,.16);--pf-text:#edf2ff;--pf-muted:#a0accb;--pf-violet:#a78bfa;--pf-blue:#38bdf8;background:var(--pf-bg);color:var(--pf-text);border-radius:22px;overflow:hidden;font-family:inherit}
.portfolio-hero{min-height:530px;position:relative;display:flex;align-items:center;padding:70px 6%;overflow:hidden;background:radial-gradient(ellipse at 75% 45%,rgba(72,65,160,.2),transparent 45%),linear-gradient(120deg,#080b16,#0d1325 65%,#11122b)}
.portfolio-hero-grid{position:absolute;inset:0;background-image:linear-gradient(rgba(124,140,255,.04) 1px,transparent 1px),linear-gradient(90deg,rgba(124,140,255,.04) 1px,transparent 1px);background-size:40px 40px;mask-image:linear-gradient(to right,black,transparent)}
.portfolio-hero-content{position:relative;z-index:2;max-width:680px}
.portfolio-hero-role{display:flex;align-items:center;gap:9px;margin-top:18px;color:#c4b5fd;font:800 10px monospace;letter-spacing:1.5px}
.portfolio-hero-role i{color:#38bdf8;font-size:13px}.portfolio-hero-role span{color:#526181}
.portfolio-profile-tags{display:flex;flex-wrap:wrap;gap:8px;margin-top:20px}
.portfolio-profile-tags span{display:inline-flex;align-items:center;gap:7px;padding:8px 10px;border:1px solid rgba(129,140,248,.17);border-radius:8px;background:rgba(18,27,48,.62);color:#aab8d7;font-size:10px;font-weight:600;backdrop-filter:blur(8px)}
.portfolio-profile-tags i{color:#a78bfa}
.portfolio-eyebrow,.portfolio-section-kicker{font:800 10px/1.4 monospace;letter-spacing:2px;color:#a5b4fc}.portfolio-pulse{display:inline-block;width:7px;height:7px;background:#34d399;border-radius:50%;box-shadow:0 0 12px #34d399;margin-right:8px;animation:pulsePortfolio 1.6s infinite}.portfolio-hero h1{font-size:clamp(40px,6vw,76px);line-height:1.02;letter-spacing:-3px;font-weight:900;margin:22px 0;color:#fff}.portfolio-hero h1 span,.portfolio-section h2 span,.portfolio-next-panel h2 span{background:linear-gradient(90deg,#a78bfa,#38bdf8);color:transparent;background-clip:text;-webkit-background-clip:text}.portfolio-intro{max-width:550px;color:var(--pf-muted);line-height:1.8;font-size:15px}.portfolio-hero-actions{display:flex;gap:12px;flex-wrap:wrap;margin-top:25px}.portfolio-btn-primary,.portfolio-btn-ghost{display:inline-flex;align-items:center;gap:10px;padding:12px 17px;border-radius:9px;text-decoration:none;font-size:12px;font-weight:700;transition:.2s}.portfolio-btn-primary{background:linear-gradient(100deg,#6366f1,#8b5cf6);color:white;box-shadow:0 8px 22px rgba(99,102,241,.2)}.portfolio-btn-primary:hover{transform:translateY(-2px);color:white;box-shadow:0 12px 26px rgba(99,102,241,.3)}.portfolio-btn-ghost{border:1px solid var(--pf-border);color:#dbe4ff;background:rgba(255,255,255,.03)}.portfolio-btn-ghost:hover{background:rgba(139,92,246,.1);color:white}.portfolio-hero-meta{display:flex;gap:20px;flex-wrap:wrap;margin-top:30px;color:#7583a6;font-size:10px}.portfolio-hero-meta i{color:#9d91ff;margin-right:5px}
.portfolio-hero-visual{position:absolute;width:390px;height:390px;right:7%;top:50%;transform:translateY(-50%);display:grid;place-items:center;opacity:.85}.portfolio-orbit{position:absolute;border:1px solid rgba(129,140,248,.2);border-radius:50%;animation:orbitPortfolio 28s linear infinite}.orbit-one{width:310px;height:310px}.orbit-two{width:390px;height:390px;animation-direction:reverse;border-style:dashed}.portfolio-core{width:150px;height:150px;border-radius:35px;display:flex;flex-direction:column;justify-content:center;align-items:center;gap:12px;background:linear-gradient(140deg,rgba(99,102,241,.24),rgba(56,189,248,.1));border:1px solid rgba(167,139,250,.3);box-shadow:0 0 70px rgba(99,102,241,.15),inset 0 0 25px rgba(56,189,248,.06);transform:rotate(-8deg)}.portfolio-core i{font-size:42px;color:#b6a4ff}.portfolio-core span{text-align:center;font:800 9px/1.5 monospace;letter-spacing:1.3px;color:#b8c6e7}.portfolio-float-chip{position:absolute;padding:10px 13px;background:rgba(16,23,42,.8);border:1px solid var(--pf-border);border-radius:9px;color:#b6c3e5;font:700 9px monospace;letter-spacing:1px;box-shadow:0 10px 30px rgba(0,0,0,.2);backdrop-filter:blur(8px)}.portfolio-float-chip i{color:#a78bfa;margin-right:7px}.chip-top{top:42px;right:8px;animation:floatPortfolio 4s ease-in-out infinite}.chip-bottom{bottom:45px;left:5px;animation:floatPortfolio 5s ease-in-out infinite reverse}
.portfolio-section{padding:65px 6%;background:#080b16}.portfolio-section-heading{display:flex;align-items:end;justify-content:space-between;gap:20px;margin-bottom:28px}.portfolio-section h2,.portfolio-next-panel h2{font-size:clamp(28px,4vw,46px);line-height:1.08;letter-spacing:-1.6px;font-weight:850;color:#f7f9ff;margin:12px 0}.portfolio-section-heading p{font-size:13px;color:var(--pf-muted);max-width:580px;margin:0}.portfolio-section-number{color:#64718f;font:700 11px monospace;white-space:nowrap}
.portfolio-project-card{display:grid;grid-template-columns:1.05fr .95fr;border:1px solid var(--pf-border);border-radius:20px;overflow:hidden;background:linear-gradient(120deg,rgba(17,24,45,.95),rgba(12,17,31,.95));box-shadow:0 18px 45px rgba(0,0,0,.18)}.portfolio-project-visual{min-height:330px;display:grid;place-items:center;padding:30px;background:radial-gradient(ellipse,rgba(99,102,241,.15),transparent 65%),#0b1020}.portfolio-mock-window{width:100%;max-width:470px;border:1px solid rgba(148,163,255,.25);border-radius:13px;background:#0e1425;overflow:hidden;transform:perspective(900px) rotateY(5deg) rotateX(2deg);box-shadow:0 20px 50px rgba(0,0,0,.4)}.portfolio-mock-top{height:34px;background:#151d32;border-bottom:1px solid rgba(148,163,255,.12);display:flex;align-items:center;padding:0 10px;gap:5px}.portfolio-mock-top>span{width:6px;height:6px;border-radius:50%;background:#6366f1}.portfolio-mock-top>span:nth-child(2){background:#38bdf8}.portfolio-mock-top>span:nth-child(3){background:#34d399}.portfolio-mock-top b{margin-left:8px;color:#7282a6;font:700 8px monospace;letter-spacing:1px}.portfolio-mock-body{display:flex;min-height:240px}.portfolio-mock-sidebar{width:35px;background:#10182b;display:flex;flex-direction:column;align-items:center;gap:19px;padding:15px 0;color:#7888b0;font-size:12px}.portfolio-mock-main{flex:1;padding:16px}.portfolio-mock-welcome{font-size:12px;color:#dce5ff;font-weight:700;margin-bottom:13px}.portfolio-mock-stats{display:grid;grid-template-columns:repeat(3,1fr);gap:8px}.portfolio-mock-stats span{background:#171f36;border:1px solid rgba(129,140,248,.13);padding:9px;border-radius:7px}.portfolio-mock-stats small{display:block;font:700 7px monospace;color:#7e8db0}.portfolio-mock-stats strong{display:block;color:#b4a4ff;font-size:17px;margin-top:4px}.portfolio-mock-chart{height:90px;display:flex;align-items:end;gap:9px;padding:12px 15px;margin-top:12px;background:#131b30;border-radius:8px}.portfolio-mock-chart div{flex:1;border-radius:3px 3px 0 0;background:linear-gradient(#8b5cf6,#3b82f6);opacity:.8}.portfolio-mock-row{height:12px;background:#19233b;border-radius:4px;margin-top:10px}.portfolio-project-info{padding:32px}.portfolio-project-badge{display:inline-block;color:#a5b4fc;font:800 9px monospace;letter-spacing:1px;padding:8px 10px;background:rgba(99,102,241,.08);border:1px solid rgba(99,102,241,.18);border-radius:6px}.portfolio-project-info h3{font-size:38px;font-weight:900;letter-spacing:-1px;margin:17px 0 10px;color:#fff}.portfolio-project-info>p{color:#a4b0cb;font-size:13px;line-height:1.8}.portfolio-project-features{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin:20px 0;color:#bec9e4;font-size:11px}.portfolio-project-features i{color:#34d399;margin-right:5px}.portfolio-tech-tags{display:flex;flex-wrap:wrap;gap:6px;margin-top:22px}.portfolio-tech-tags span{border:1px solid rgba(129,140,248,.17);border-radius:6px;padding:6px 9px;background:rgba(99,102,241,.06);color:#aab7d6;font:700 9px monospace}
.portfolio-tech-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:13px}.portfolio-tech-grid article{padding:20px;border:1px solid var(--pf-border);border-radius:14px;background:rgba(16,23,42,.65);transition:.25s}.portfolio-tech-grid article:hover{transform:translateY(-3px);border-color:rgba(139,92,246,.4)}.portfolio-tech-grid article>i{font-size:22px;color:#a78bfa}.portfolio-tech-grid h3{font-size:14px;color:#e9eeff;margin:12px 0 7px}.portfolio-tech-grid p{font-size:11px;color:#9aa7c6;line-height:1.7;margin:0}.portfolio-next{padding-top:10px}.portfolio-next-panel{border:1px solid rgba(129,140,248,.18);border-radius:20px;padding:clamp(25px,5vw,55px);background:radial-gradient(ellipse at 85% 10%,rgba(99,102,241,.14),transparent 45%),#10172a}.portfolio-next-panel h2{font-size:clamp(32px,5vw,55px)}.portfolio-next-panel p{max-width:600px;color:#9eaccb;font-size:13px;line-height:1.8}.portfolio-back-top{display:inline-flex;gap:9px;margin-top:18px;color:#a5b4fc;text-decoration:none;font:800 10px monospace;letter-spacing:1.5px}.portfolio-back-top:hover{color:#fff}.portfolio-footer{display:flex;justify-content:space-between;gap:15px;flex-wrap:wrap;padding:25px 6%;border-top:1px solid rgba(129,140,248,.1);color:#65728f;font:700 9px monospace;letter-spacing:1px;background:#080b16}
@keyframes pulsePortfolio{50%{opacity:.3}}@keyframes orbitPortfolio{to{transform:rotate(360deg)}}@keyframes floatPortfolio{50%{transform:translateY(-8px)}}
@media(max-width:1000px){.portfolio-hero-visual{right:-40px;opacity:.35}.portfolio-project-card{grid-template-columns:1fr}.portfolio-project-visual{min-height:290px}.portfolio-project-info{padding:25px}.portfolio-tech-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:600px){.portfolio-hero-role{font-size:9px;letter-spacing:1px}.portfolio-profile-tags{gap:6px}.portfolio-profile-tags span{font-size:9px;padding:7px 8px}}
@media(max-width:600px){.portfolio-page{border-radius:14px}.portfolio-hero{min-height:490px;padding:52px 6%}.portfolio-hero-visual{width:270px;height:270px;right:-70px;top:70%;opacity:.2}.orbit-one{width:210px;height:210px}.orbit-two{width:260px;height:260px}.portfolio-core{width:110px;height:110px}.portfolio-core i{font-size:30px}.portfolio-hero h1{letter-spacing:-1.8px}.portfolio-hero-meta{gap:10px}.portfolio-section{padding:45px 5%}.portfolio-section-heading{align-items:start}.portfolio-section-number{display:none}.portfolio-project-visual{padding:18px;min-height:230px}.portfolio-mock-body{min-height:185px}.portfolio-mock-chart{height:65px}.portfolio-project-features{grid-template-columns:1fr}.portfolio-tech-grid{grid-template-columns:1fr}.portfolio-footer{flex-direction:column}}
@media(prefers-reduced-motion:reduce){.portfolio-page *{animation:none!important;transition:none!important}}

/* PHASE 03 — FEATURED SIMS PROJECT SHOWCASE */
.portfolio-featured .portfolio-section-heading p{margin-top:12px}
.portfolio-sims-showcase{display:grid;grid-template-columns:1fr;overflow:hidden;border:1px solid rgba(142,156,255,.15);border-radius:20px;background:linear-gradient(145deg,rgba(16,23,42,.96),rgba(11,15,29,.98));box-shadow:0 18px 55px rgba(0,0,0,.22)}
.portfolio-sims-visual{position:relative;padding:28px 4%;background:radial-gradient(ellipse at 50% 50%,rgba(99,102,241,.13),transparent 62%),linear-gradient(135deg,#0e162b,#10142a);border-bottom:1px solid rgba(142,156,255,.12);overflow:hidden}
.portfolio-sims-visual:before{content:"";position:absolute;inset:0;background-image:linear-gradient(rgba(124,140,255,.035) 1px,transparent 1px),linear-gradient(90deg,rgba(124,140,255,.035) 1px,transparent 1px);background-size:32px 32px;pointer-events:none}
.portfolio-sims-visual-heading,.portfolio-sims-visual-caption{position:relative;z-index:2;display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap}
.portfolio-sims-live{display:inline-flex;align-items:center;gap:7px;color:#9aa9c9;font:700 9px monospace;letter-spacing:1.2px}.portfolio-sims-live i{width:6px;height:6px;border-radius:50%;background:#fbbf24;box-shadow:0 0 9px rgba(251,191,36,.6)}
.portfolio-sims-visual .portfolio-mock-window{position:relative;z-index:1;margin:24px auto 15px;max-width:760px;border:1px solid rgba(143,157,255,.22);border-radius:12px;background:#0b1222;box-shadow:0 25px 65px rgba(0,0,0,.45);overflow:hidden;transform:perspective(1200px) rotateX(1.5deg)}
.portfolio-mock-top{height:34px;background:#151e33;border-bottom:1px solid rgba(143,157,255,.12);display:flex;align-items:center;gap:5px;padding:0 12px}.portfolio-mock-top>span{width:6px;height:6px;border-radius:50%;background:#475569}.portfolio-mock-top b{margin-left:12px;color:#7483a5;font:700 8px monospace;letter-spacing:1px}
.portfolio-mock-body{display:flex;min-height:275px}.portfolio-mock-sidebar{width:38px;display:flex;flex-direction:column;align-items:center;gap:16px;padding:14px 0;background:#101a2d;border-right:1px solid rgba(143,157,255,.1);color:#64748b;font-size:11px}.portfolio-mock-sidebar i:first-child{color:#a78bfa}.portfolio-mock-main{flex:1;padding:16px;min-width:0}.portfolio-mock-welcome{font-size:11px;font-weight:700;color:#e1e8f8}.portfolio-mock-welcome small{display:block;margin-top:3px;color:#7182a6;font-size:8px;font-weight:400}
.portfolio-mock-stats{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:8px;margin-top:14px}.portfolio-mock-stats span{display:flex;flex-direction:column;padding:9px 10px;border:1px solid rgba(143,157,255,.1);border-radius:8px;background:rgba(30,41,66,.55)}.portfolio-mock-stats small{font:700 7px monospace;letter-spacing:.7px;color:#8090b1}.portfolio-mock-stats strong{font-size:19px;color:#f3f6ff;margin:4px 0}.portfolio-mock-stats em{font-style:normal;font-size:7px;color:#8494b4}.portfolio-mock-stats em i{color:#a78bfa;margin-right:3px}
.portfolio-mock-analytics{margin-top:13px;padding:10px 10px 8px;border:1px solid rgba(143,157,255,.1);border-radius:8px;background:rgba(17,25,44,.7)}.portfolio-mock-chart-label{display:flex;justify-content:space-between;color:#8595b6;font:700 7px monospace;letter-spacing:.7px}.portfolio-mock-chart-label span{color:#536382}.portfolio-mock-chart{display:flex;align-items:end;gap:5px;height:75px;padding-top:8px}.portfolio-mock-chart div{flex:1;min-width:4px;border-radius:3px 3px 0 0;background:linear-gradient(180deg,#8b5cf6,#38bdf8);opacity:.8}.portfolio-mock-row{display:flex;gap:5px;margin-top:9px}.portfolio-mock-row span{height:4px;border-radius:3px;background:rgba(129,140,248,.12);flex:1}.portfolio-sims-visual-caption{justify-content:center;gap:22px;color:#64718f;font:700 8px monospace;letter-spacing:1px}
.portfolio-sims-info{padding:30px 4%}.portfolio-sims-title-row{display:flex;justify-content:space-between;align-items:flex-start;gap:18px;flex-wrap:wrap}.portfolio-sims-title-row h3{font-size:28px;font-weight:850;letter-spacing:-.8px;color:#f4f7ff;margin:12px 0 4px}.portfolio-sims-subtitle{display:block;color:#9eaccb;font-size:13px;font-weight:500;letter-spacing:0}.portfolio-sims-project-id{color:#596988;font:700 9px monospace;letter-spacing:1px;padding-top:8px}.portfolio-sims-description{color:#a0accb;line-height:1.8;font-size:13px;max-width:760px;margin:15px 0 22px}
.portfolio-sims-highlights{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:10px}.portfolio-sims-highlights>div{display:flex;align-items:center;gap:12px;padding:13px;border:1px solid rgba(142,156,255,.11);border-radius:11px;background:rgba(255,255,255,.018)}.portfolio-sims-highlight-icon{width:36px;height:36px;flex:0 0 36px;display:grid;place-items:center;border:1px solid rgba(167,139,250,.18);border-radius:9px;background:rgba(99,102,241,.1);color:#b6a4ff;font-size:15px}.portfolio-sims-highlights strong{display:block;color:#e4ebfc;font-size:11px}.portfolio-sims-highlights small{display:block;color:#7182a4;font-size:9px;margin-top:3px}
.portfolio-sims-details-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:9px;margin-top:17px}.portfolio-sims-detail{padding:13px;border:1px solid rgba(142,156,255,.11);border-radius:10px;background:rgba(10,16,30,.4)}.portfolio-sims-detail-label{display:block;color:#818fb0;font:800 8px monospace;letter-spacing:1.3px;margin-bottom:8px}.portfolio-sims-detail strong{display:block;color:#dce6ff;font-size:11px}.portfolio-sims-detail small{display:block;color:#7182a4;font-size:9px;margin-top:4px}
.portfolio-sims-architecture{margin-top:17px;padding:14px;border:1px solid rgba(142,156,255,.11);border-radius:11px;background:rgba(99,102,241,.035)}.portfolio-sims-flow{display:flex;align-items:center;justify-content:center;gap:10px;flex-wrap:wrap;margin-top:12px}.portfolio-sims-flow span{display:inline-flex;align-items:center;gap:8px;padding:9px 12px;border:1px solid rgba(142,156,255,.13);border-radius:8px;background:#111a2c;color:#aebde0;font-size:9px;font-weight:700}.portfolio-sims-flow span i{color:#a78bfa}.portfolio-sims-flow b{color:#546586;font-size:10px}
.portfolio-sims-feature-list{margin-top:18px;grid-template-columns:repeat(2,minmax(0,1fr))}.portfolio-sims-feature-list>div{font-size:10px;color:#aebde0}.portfolio-sims-feature-list>div i{color:#34d399}.portfolio-sims-tech{margin-top:18px}.portfolio-sims-footnote{margin-top:16px;padding-top:14px;border-top:1px solid rgba(142,156,255,.1);color:#687998;font-size:9px;line-height:1.6}.portfolio-sims-footnote i{color:#8b9ec7;margin-right:6px}
@media(min-width:1100px){.portfolio-sims-showcase{grid-template-columns:minmax(0,1.05fr) minmax(0,1fr)}.portfolio-sims-visual{border-bottom:0;border-right:1px solid rgba(142,156,255,.12);display:flex;flex-direction:column;justify-content:center}.portfolio-sims-info{padding:32px 4%}.portfolio-sims-visual .portfolio-mock-window{margin-top:26px;margin-bottom:18px}}
@media(max-width:700px){.portfolio-sims-visual{padding:20px 4%}.portfolio-mock-body{min-height:220px}.portfolio-mock-main{padding:10px}.portfolio-mock-stats{gap:5px}.portfolio-mock-stats span{padding:7px}.portfolio-mock-stats strong{font-size:16px}.portfolio-mock-chart{height:55px}.portfolio-sims-info{padding:22px 4%}.portfolio-sims-highlights,.portfolio-sims-details-grid,.portfolio-sims-feature-list{grid-template-columns:1fr}.portfolio-sims-flow{gap:7px}.portfolio-sims-flow b{transform:rotate(90deg)}.portfolio-sims-project-id{display:none}.portfolio-sims-visual-caption{gap:9px;font-size:7px}}

/* PHASE 04 — TECHNICAL SKILLS MATRIX */
.portfolio-skills-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:14px}
.portfolio-skill-card{position:relative;overflow:hidden;padding:23px;border:1px solid rgba(142,156,255,.16);border-radius:16px;background:linear-gradient(145deg,rgba(18,27,49,.92),rgba(11,16,30,.96));transition:transform .25s ease,border-color .25s ease,box-shadow .25s ease}
.portfolio-skill-card:before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse at 0 0,rgba(139,92,246,.10),transparent 55%);pointer-events:none}
.portfolio-skill-card:hover{transform:translateY(-4px);border-color:rgba(56,189,248,.38);box-shadow:0 12px 32px rgba(0,0,0,.22)}
.portfolio-skill-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:15px;position:relative}
.portfolio-skill-icon{width:42px;height:42px;display:grid;place-items:center;border:1px solid rgba(167,139,250,.24);border-radius:12px;background:rgba(99,102,241,.12);color:#a78bfa;font-size:18px}
.portfolio-skill-index{font:700 9px monospace;letter-spacing:1px;color:#657394}
.portfolio-skill-card h3{position:relative;color:#eaf0ff;font-size:16px;font-weight:800;margin:0 0 9px}
.portfolio-skill-card p{position:relative;color:#9eaccb;font-size:12px;line-height:1.75;margin:0;min-height:44px}
.portfolio-skill-tags{position:relative;display:flex;flex-wrap:wrap;gap:7px;margin-top:17px}
.portfolio-skill-tags span{padding:6px 9px;border:1px solid rgba(129,140,248,.15);border-radius:6px;background:rgba(99,102,241,.055);color:#b8c6e7;font:700 9px monospace}
@media(max-width:700px){.portfolio-skills-grid{grid-template-columns:1fr}.portfolio-skill-card p{min-height:0}}

</style>
@endpush
