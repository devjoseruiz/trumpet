<style>
    .rating-container {
        max-width: 600px;
        margin: 2rem auto;
        padding: 2rem;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .rating-title {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 2rem;
    }

    .rating-form {
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
        font-weight: 500;
        color: #34495e;
    }

    .form-input,
    .form-textarea {
        padding: 0.8rem;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 1rem;
        transition: border-color 0.3s ease;
    }

    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        border-color: #3498db;
    }

    .form-textarea {
        min-height: 120px;
        resize: vertical;
    }

    .star-rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: left;
        gap: 0.5rem;
        padding: 0.5rem 0;
    }

    .star-rating input[type="radio"] {
        display: none;
    }

    .star-rating label {
        cursor: pointer;
        font-size: 2rem;
        color: #ddd;
        transition: color 0.2s ease;
    }

    .star-rating label:hover,
    .star-rating label:hover~label,
    .star-rating input[type="radio"]:checked~label {
        color: #f1c40f;
    }

    .submit-btn {
        background-color: #3498db;
        color: white;
        border: none;
        padding: 1rem;
        border-radius: 4px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .submit-btn:hover {
        background-color: #2980b9;
    }

    .error-message {
        color: #e74c3c;
        font-size: 0.9rem;
        margin-top: 0.3rem;
    }

    .twitter-share-button {
        display: inline-block;
        margin-top: 1rem;
        padding: 0.8rem 1.5rem;
        background-color: #1da1f2;
        color: white;
        text-decoration: none;
        border-radius: 25px;
        transition: background-color 0.3s ease;
    }

    .twitter-share-button:hover {
        background-color: #1991da;
    }

    .github-issues-button {
        display: inline-block;
        margin-top: 1rem;
        padding: 0.8rem 1.5rem;
        background-color: #333;
        color: white;
        text-decoration: none;
        border-radius: 25px;
        transition: background-color 0.3s ease;
    }

    .github-issues-button:hover {
        background-color: #222;
    }

    .quote-container {
        margin: 2rem 0;
        padding: 1.5rem;
        background-color: #f8f9fa;
        border-left: 4px solid #F95428;
        border-radius: 0 8px 8px 0;
    }

    .quote-text {
        color: #555;
        font-style: italic;
        line-height: 1.6;
        margin: 0;
    }

    .quote-text::before {
        content: '"';
        font-size: 1.5em;
        color: #F95428;
        margin-right: 0.2rem;
    }

    .quote-text::after {
        content: '"';
        font-size: 1.5em;
        color: #F95428;
        margin-left: 0.2rem;
    }
</style>

<div class="rating-container">
    <?php if (empty($data)): ?>
        <h2 class="rating-title">Rate Trumpet Framework</h2>

        <form class="rating-form" method="POST" action="/rate">
            <div class="form-group">
                <label class="form-label">Rating</label>
                <div class="star-rating">
                    <?php for ($i = 5; $i >= 1; $i--): ?>
                        <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>" required>
                        <label for="star<?= $i ?>">★</label>
                    <?php endfor; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">What features did you like the most?</label>
                <textarea name="liked_features" class="form-textarea" maxlength="140" required></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">What could be improved?</label>
                <textarea name="improvements" class="form-textarea" maxlength="500" required></textarea>
            </div>

            <?php if (isset($error)): ?>
                <div class="error-message"><?= $error ?></div>
            <?php endif; ?>

            <button type="submit" class="submit-btn">Submit Rating</button>
        </form>

    <?php else: ?>
        <h2 class="rating-title">You rated Trumpet Framework with <?= $data['rating'] ?>/5 ⭐!</h2>

        <?php
        $tweetText = "I've rated 🎺 Trumpet Framework with {$data['rating']}/5 ⭐! {$data['liked_features']}";
        $encodedText = urlencode($tweetText);
        $tweetUrl = "https://twitter.com/intent/tweet?text={$encodedText}&url=https://github.com/devjoseruiz/trumpet-mvc-framework";
        ?>

        <div class="quote-container">
            <h3>What features you liked the most</h3>
            <p class="quote-text"><?= $tweetText ?></p>
        </div>

        <a href="<?= $tweetUrl ?>" class="twitter-share-button" target="_blank" rel="noopener noreferrer">
            📢 Share on X
        </a>

        <div class="quote-container">
            <h3>What could be improved</h3>
            <p class="quote-text"><?= $data['improvements'] ?></p>
        </div>

        <a href="https://github.com/devjoseruiz/trumpet-mvc-framework/issues" class="github-issues-button" target="_blank"
            rel="noopener noreferrer">
            ⚠️ Open issue
        </a>
    <?php endif; ?>
</div>