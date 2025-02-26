<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Play Word Game</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .letters { font-size: 24px; margin-bottom: 20px; }
        .message { color: red; font-weight: bold; }
        .score { font-size: 20px; margin-top: 10px; }
    </style>
</head>
<body>
    <h1>Word Game</h1>
    <p class="letters">Available Letters: <strong><?= session()->get('available_letters') ?></strong></p>
    
    <?php if (session()->getFlashdata('message')): ?>
        <p class="message"><?= session()->getFlashdata('message') ?></p>
    <?php endif; ?>

    <form action="<?= site_url('wordgame/submitWord') ?>" method="post">
        <input type="text" name="word" placeholder="Enter a word" required>
        <button type="submit">Submit</button>
    </form>

    <p class="score">Score: <?= session()->get('score') ?></p>

    <a href="<?= site_url('wordgame') ?>">Back to Home</a>
</body>
</html>
