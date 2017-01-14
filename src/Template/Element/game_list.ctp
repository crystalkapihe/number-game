
<?php if (!empty($games)): ?>
<div class="related">
    <h4><?= $title ?></h4>
    <table cellpadding="0" cellspacing="0">
        <?php
        echo $this->Html->tableHeaders([
            'Difficulty',
            'Value',
            'Points Awarded',
            'Number of Guesses'
        ]);
        foreach ($games as $game) {
            echo $this->Html->tableCells($game->points_awarded ?
                [
                    $game->difficulty,
                    $game->value,
                    number_format($game->points_awarded, 1),
                    $game->guess_count
                ] :
                [
                    $game->difficulty,
                    $this->Html->link('Continue this game', ['controller' => 'Numbers', 'action' => 'guess', $number->id]),
                    null,
                    $game->guess_count
                ]);
        }
        ?>
    </table>
</div>
<?php endif; ?>
