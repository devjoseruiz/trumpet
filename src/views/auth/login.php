<style>
    .auth-container {
        max-width: 400px;
        margin: 2rem auto;
        padding: 2rem;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .auth-title {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 2rem;
    }

    .auth-form {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .form-label {
        color: #2c3e50;
        font-weight: 500;
    }

    .form-input {
        padding: 0.8rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: #F95428;
    }

    .submit-btn {
        background: #F95428;
        color: white;
        border: none;
        padding: 1rem;
        border-radius: 4px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .submit-btn:hover {
        background: #e64a1f;
    }

    .auth-links {
        margin-top: 1.5rem;
        text-align: center;
        font-size: 0.9rem;
    }

    .auth-link {
        color: #F95428;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .auth-link:hover {
        color: #e64a1f;
    }

    .error-message {
        background: #fee2e2;
        border: 1px solid #ef4444;
        color: #dc2626;
        padding: 0.8rem;
        border-radius: 4px;
        margin-bottom: 1rem;
    }
</style>

<div class="auth-container">
    <h2 class="auth-title">🔐 Welcome</h2>

    <?php if (isset($error)): ?>
        <div class="error-message">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form class="auth-form" method="POST" action="/login">
        <div class="form-group">
            <label class="form-label" for="email">Email</label>
            <input type="email" class="form-input" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <input type="password" class="form-input" id="password" name="password" required>
        </div>

        <button type="submit" class="submit-btn">Login</button>

        <div class="auth-links">
            <p>Don't have an account? <a href="/register" class="auth-link">Register here</a></p>
            <p>Go back to <a href="/" class="auth-link">Homepage</a></p>
        </div>
    </form>
</div>