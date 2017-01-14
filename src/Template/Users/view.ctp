<div class="users view content">
    <h3><?= h($user->username) ?></h3>
        <table class="vertical-table">
        <tr>
            <th scope="row">Games Played</th>
            <td><?= $stats->count ?></td>
        </tr>
        <tr>
            <th scope="row">Total Points Earned</th>
            <td><?= number_format($stats->sum, 1) ?></td>
        </tr>
        <tr>
            <th scope="row">Average Game Score</th>
            <td><?= $stats->count ? number_format($stats->sum / $stats->count, 1) :0 ?></td>
        </tr>
    </table>
        <?= $this->element('game_list', ['games' => $user->completed_games, 'title' => 'Completed Games']) ?>
</div>
