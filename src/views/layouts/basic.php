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
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        .main-content {
            min-height: calc(100vh - 80px);
            padding: 2rem 0;
        }
    </style>
</head>

<body>
    <div class="main-content">
        {{content}}
    </div>
</body>

</html>