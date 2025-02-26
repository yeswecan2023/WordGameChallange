<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Game</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        h1 { color: #333; }
        .button { padding: 10px 20px; font-size: 16px; margin: 10px; cursor: pointer; }
        .top-scores { margin-top: 20px; }
        table { width: 50%; margin: auto; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h1>Welcome to the Word Game</h1>
    <form action="<?= site_url('wordgame/startGame') ?>" method="post">
        <button class="button">Start New Game</button>
    </form>

    <div class="top-scores">
        <h2>Top Scores</h2>
        <table>
            <tr>
                <th>Rank</th>
                <th>Player</th>
                <th>Score</th>
            </tr>
            <?php if (!empty($topScores)): ?>
                <?php foreach ($topScores as $index => $score): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= esc($score['player_name']) ?></td>
                        <td><?= esc($score['score']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No scores available</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>
