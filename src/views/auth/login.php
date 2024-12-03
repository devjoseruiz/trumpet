<div class="form-container">
    <h2 class="form-title">🔐 Welcome</h2>

    <form class="form-form" method="POST" action="/login">
        <?php
        use app\core\utils\form\Field;
        use app\core\utils\form\Form;

        $form = Form::begin('', 'post');
        ?>

        <?= $form->field(
            $model,
            'email',
            'Email',
            ['required' => true],
            Field::TYPE_EMAIL
        ) ?>
        <?= $form->field(
            $model,
            'password',
            'Password',
            ['required' => true, 'min_length' => 12, 'max_length' => 64],
            Field::TYPE_PASSWORD
        ) ?>

        <button type="submit" class="submit-btn">Login</button>

        <div class="form-links">
            <p>Don't have an account? <a href="/register" class="form-link">Register here</a></p>
            <p>Go back to <a href="/" class="form-link">Homepage</a></p>
        </div>
    </form>
</div>