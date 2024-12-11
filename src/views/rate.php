<div class="rating-container">
    <?php if (empty($data) || !empty($data['errors'])): ?>
        <h2 class="rating-title">Rate Trumpet Framework</h2>

        <?php if (!empty($data['errors'])): ?>
            <?php foreach ($data['errors'] as $error): ?>
                <div class="error-message">
                    <strong><?= $error['label'] ?>:</strong> <?= $error['errors'][0] ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

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