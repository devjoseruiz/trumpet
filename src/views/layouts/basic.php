<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon.svg">
    <link rel="stylesheet" href="/assets/css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->title ?> | Ttitlet MVC Framework</title>
</head>

<body>
    <div class="basic main-content">
        <?php use app\core\Application; ?>
        <?php if (Application::$app->session->getFlashData('success')): ?>
            <div class="success-message">
                <?= Application::$app->session->getFlashData('success'); ?>
            </div>
        <?php endif; ?>

        <?php if (Application::$app->session->getFlashData('error')): ?>
            <div class="error-message">
                <?= Application::$app->session->getFlashData('error'); ?>
            </div>
        <?php endif; ?>

        {{content}}
    </div>
</body>

</html>