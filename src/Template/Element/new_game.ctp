<h3>New Game</h3>
<?= $this->Form->select('difficulty', [
    'Easy' => 'Easy',
    'Medium' => 'Medium',
    'Hard' => 'Hard'
], ['default' => empty($number) ? 'Easy' : $number->difficulty]) ?>
<?= $this->Form->button('new game') ?>