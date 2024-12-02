<style>
    .home-container {
        text-align: center;
        padding: 3rem 1rem;
        max-width: 800px;
        margin: 0 auto;
    }

    .logo-container {
        margin-bottom: 2rem;
    }

    .logo-svg {
        width: 120px;
        height: 120px;
        fill: #2c3e50;
    }

    .project-title {
        font-size: 2.5rem;
        color: #2c3e50;
        margin-bottom: 1rem;
    }

    .project-subtitle {
        font-size: 1.2rem;
        color: #7f8c8d;
        margin-bottom: 2rem;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
        text-align: left;
    }

    .feature-item {
        padding: 1.5rem;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .feature-title {
        font-size: 1.2rem;
        color: #2c3e50;
        margin-bottom: 0.5rem;
    }

    .feature-description {
        color: #666;
        line-height: 1.6;
    }
</style>

<div class="home-container">
    <div class="logo-container">
        <img class="logo-svg" src="/assets/img/favicon.svg" alt="Trumpet Logo">
    </div>

    <h1 class="project-title">Trumpet MVC Framework</h1>
    <p class="project-subtitle">A lightweight, modern PHP MVC framework for building elegant web applications.</p>

    <div class="features-grid">
        <div class="feature-item">
            <h3 class="feature-title">🚀 Modern Architecture</h3>
            <p class="feature-description">Built with PHP 8.2+ and following modern development practices and design
                patterns.</p>
        </div>

        <div class="feature-item">
            <h3 class="feature-title">🎯 Simple & Intuitive</h3>
            <p class="feature-description">Clean and intuitive API design makes development fast and enjoyable.</p>
        </div>

        <div class="feature-item">
            <h3 class="feature-title">🔧 Easily Customizable</h3>
            <p class="feature-description">Customize the framework to suit your needs with a flexible configuration.</p>
        </div>

        <div class="feature-item">
            <h3 class="feature-title">🐳 Docker Ready</h3>
            <p class="feature-description">Comes with a pre-configured Docker environment for easy development.</p>
        </div>
    </div>
</div>