<section class="portfolio-section portfolio-architecture" id="architecture">

    <div class="portfolio-section-heading">
        <div>
            <span class="portfolio-section-kicker">05 / SYSTEM ARCHITECTURE</span>
            <h2>Engineering <span>Architecture</span></h2>
            <p>
                Understanding how user interfaces, application logic, data,
                and connected services work together to create reliable software systems.
            </p>
        </div>
        <span class="portfolio-section-number">SYSTEM_DESIGN</span>
    </div>

    {{-- ARCHITECTURE OVERVIEW --}}
    <div class="architecture-overview">

        <div class="architecture-overview-header">
            <div>
                <span class="architecture-label">APPLICATION ARCHITECTURE</span>
                <h3>From Interface to Data</h3>
            </div>

            <span class="architecture-status">
                <i></i> MODULAR DESIGN
            </span>
        </div>

        {{-- LAYER 01 --}}
        <div class="architecture-layer">
            <div class="architecture-layer-number">01</div>

            <div class="architecture-layer-content">
                <div class="architecture-layer-heading">
                    <span class="architecture-icon">
                        <i class="bi bi-window-stack"></i>
                    </span>

                    <div>
                        <small>PRESENTATION LAYER</small>
                        <h4>User Interface</h4>
                    </div>
                </div>

                <p>
                    The user-facing layer responsible for displaying information,
                    collecting input, and providing interactive experiences.
                </p>

                <div class="architecture-tags">
                    <span>Blade</span>
                    <span>HTML</span>
                    <span>CSS</span>
                    <span>Bootstrap</span>
                    <span>JavaScript</span>
                </div>
            </div>
        </div>

        <div class="architecture-connector">
            <i class="bi bi-arrow-down"></i>
            <span>REQUEST / USER ACTION</span>
        </div>

        {{-- LAYER 02 --}}
        <div class="architecture-layer">
            <div class="architecture-layer-number">02</div>

            <div class="architecture-layer-content">
                <div class="architecture-layer-heading">
                    <span class="architecture-icon">
                        <i class="bi bi-diagram-3"></i>
                    </span>

                    <div>
                        <small>APPLICATION LAYER</small>
                        <h4>Business Logic & Processing</h4>
                    </div>
                </div>

                <p>
                    Processes requests, applies rules, validates information,
                    coordinates application behavior, and controls workflows.
                </p>

                <div class="architecture-tags">
                    <span>Laravel</span>
                    <span>Routes</span>
                    <span>Controllers</span>
                    <span>Validation</span>
                    <span>Middleware</span>
                </div>
            </div>
        </div>

        <div class="architecture-connector">
            <i class="bi bi-arrow-down"></i>
            <span>QUERY / PROCESS DATA</span>
        </div>

        {{-- LAYER 03 --}}
        <div class="architecture-layer">
            <div class="architecture-layer-number">03</div>

            <div class="architecture-layer-content">
                <div class="architecture-layer-heading">
                    <span class="architecture-icon">
                        <i class="bi bi-database"></i>
                    </span>

                    <div>
                        <small>DATA LAYER</small>
                        <h4>Data Management</h4>
                    </div>
                </div>

                <p>
                    Stores, retrieves, organizes, and maintains application data
                    through structured records and relational database operations.
                </p>

                <div class="architecture-tags">
                    <span>Models</span>
                    <span>Eloquent ORM</span>
                    <span>SQL</span>
                    <span>MySQL</span>
                    <span>Relationships</span>
                </div>
            </div>
        </div>

        <div class="architecture-connector">
            <i class="bi bi-arrow-down"></i>
            <span>DATA RESPONSE</span>
        </div>

        {{-- LAYER 04 --}}
        <div class="architecture-layer architecture-integration">
            <div class="architecture-layer-number">04</div>

            <div class="architecture-layer-content">
                <div class="architecture-layer-heading">
                    <span class="architecture-icon">
                        <i class="bi bi-share"></i>
                    </span>

                    <div>
                        <small>INTEGRATION LAYER</small>
                        <h4>Connected Systems</h4>
                    </div>
                </div>

                <p>
                    Enables communication between applications, external services,
                    mobile clients, and other systems using structured exchanges.
                </p>

                <div class="architecture-tags">
                    <span>REST API</span>
                    <span>HTTP</span>
                    <span>JSON</span>
                    <span>Webhooks</span>
                    <span>MQTT</span>
                </div>
            </div>
        </div>

    </div>

    {{-- ENGINEERING PRINCIPLES --}}
    <div class="architecture-principles">

        <div class="architecture-principles-heading">
            <span class="architecture-label">DESIGN PHILOSOPHY</span>
            <h3>Engineering <span>Principles</span></h3>
        </div>

        <div class="architecture-principles-grid">

            <article class="architecture-principle-card">
                <span class="architecture-principle-icon">
                    <i class="bi bi-boxes"></i>
                </span>

                <h4>Modularity</h4>

                <p>
                    Build systems using organized components and manageable
                    functional modules.
                </p>
            </article>

            <article class="architecture-principle-card">
                <span class="architecture-principle-icon">
                    <i class="bi bi-diagram-2"></i>
                </span>

                <h4>Separation of Concerns</h4>

                <p>
                    Keep presentation, application processing, and data
                    responsibilities organized.
                </p>
            </article>

            <article class="architecture-principle-card">
                <span class="architecture-principle-icon">
                    <i class="bi bi-arrow-repeat"></i>
                </span>

                <h4>Maintainability</h4>

                <p>
                    Design code that can be understood, updated, debugged,
                    and improved over time.
                </p>
            </article>

            <article class="architecture-principle-card">
                <span class="architecture-principle-icon">
                    <i class="bi bi-shield-check"></i>
                </span>

                <h4>Reliability</h4>

                <p>
                    Prioritize predictable application behavior, validation,
                    and dependable system operations.
                </p>
            </article>

        </div>
    </div>

    {{-- ENGINEERING FLOW --}}
    <div class="architecture-flow-panel">

        <span class="architecture-label">ENGINEERING WORKFLOW</span>

        <div class="architecture-workflow">
            <div class="architecture-workflow-step">
                <i class="bi bi-lightbulb"></i>
                <span>Analyze</span>
            </div>

            <b><i class="bi bi-arrow-right"></i></b>

            <div class="architecture-workflow-step">
                <i class="bi bi-diagram-3"></i>
                <span>Design</span>
            </div>

            <b><i class="bi bi-arrow-right"></i></b>

            <div class="architecture-workflow-step">
                <i class="bi bi-code-slash"></i>
                <span>Develop</span>
            </div>

            <b><i class="bi bi-arrow-right"></i></b>

            <div class="architecture-workflow-step">
                <i class="bi bi-bug"></i>
                <span>Test</span>
            </div>

            <b><i class="bi bi-arrow-right"></i></b>

            <div class="architecture-workflow-step">
                <i class="bi bi-arrow-clockwise"></i>
                <span>Improve</span>
            </div>
        </div>

        <p>
            My engineering workflow focuses on understanding the problem,
            designing a practical solution, implementing it, testing its behavior,
            and continuously refining the result.
        </p>

    </div>

</section>