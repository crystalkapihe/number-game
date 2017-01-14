<div class="users home content">


    <?php if (!empty($user->active_games)): ?>
        <div class="related">
            <h4>Current Games</h4>
            <table cellpadding="0" cellspacing="0">
                <?php
                echo $this->Html->tableHeaders([
                    'Difficulty',
                    'Number of Guesses',
                    'Actions'
                ]);
                foreach ($user->active_games as $game) {
                    echo $this->Html->tableCells(
                        [
                            $game->difficulty,
                            $game->guess_count,
                            $this->Html->link('Continue this game', ['controller' => 'Numbers', 'action' => 'guess', $game->id]),
                        ]);
                }
                ?>
            </table>
        </div>
    <?php endif; ?>


    <form id="new-game"
          action="<?= $this->Url->build(['controller' => 'Numbers', 'action' => 'add']) ?>"
          method="post">
        <?= $this->element('new_game') ?>
    </form>
    <?= $this->element('game_list', ['games' => $user->completed_games, 'title' => 'Recent Games']) ?>
</div>