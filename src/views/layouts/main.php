<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trumpet MVC Framework</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            position: sticky;
            top: 0;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .nav-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #2c3e50;
            text-decoration: none;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            margin-top: 1rem;
        }

        .nav-item {
            margin-right: 1.5rem;
        }

        .nav-link {
            color: #666;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #2c3e50;
        }

        .nav-separator {
            border-left: 1px solid #ccc;
        }

        .main-content {
            min-height: calc(100vh - 160px);
            padding: 2rem 0;
        }

        .footer {
            background-color: #fff;
            padding: 1.5rem 0;
            text-align: center;
            border-top: 1px solid #eee;
        }

        .text-center {
            text-align: center;
        }

        /* Media Queries */
        @media (min-width: 768px) {
            .navbar .container {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .nav-menu {
                margin-top: 0;
            }
        }

        @media (max-width: 767px) {
            .nav-menu {
                flex-direction: column;
            }

            .nav-item {
                margin: 0.5rem 0;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <a href="/" class="nav-brand">Trumpet</a>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a class="nav-link" href="/">🏠 Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/rate">⭐ Rate</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://github.com/devjoseruiz/trumpet-mvc-framework" target="_blank">🍴
                        Fork</a>
                </li>
                <li class="nav-item nav-separator"></li>
                <li class="nav-item">
                    <a class="nav-link" href="/login">🔐 Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/register">✅ Register</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            {{content}}
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&#127279; <?php echo date('Y'); ?> <a href="https://github.com/devjoseruiz/trumpet-mvc-framework"
                    target="_blank">Trumpet MVC Framework</a>.</p>
        </div>
    </footer>
</body>

</html>