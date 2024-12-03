<div class="form-container">
    <h2 class="form-title">✅ Register</h2>

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
    <?= $form->field(
        $model,
        'passwordConfirm',
        'Password Confirm',
        ['required' => true, 'min_length' => 12, 'max_length' => 64],
        Field::TYPE_PASSWORD
    ) ?>

    <button type="submit" class="submit-btn">Register</button>

    <div class="form-links">
        <p>Already have an account? <a href="/login" class="form-link">Login here</a></p>
        <p>Go back to <a href="/" class="form-link">Homepage</a></p>
    </div>
    <?= Form::end() ?>
</div>