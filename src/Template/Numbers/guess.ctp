<?php $this->start('script');
echo $this->Html->script('jquery-3.1.1.min'); ?>
<script>
    function addGuess() {
        $.post("<?= $this->Url->build(['controller' => 'Guesses', 'action' => 'add', $number->id]) ?>",
            $('#guess-form').serialize(),
            function (data) {
                document.getElementById('value').value = '';
                console.log(data);
                data = JSON.parse(data);
                if (data['result'][0]) {
                    $('#value').value = '';
                    $('#guess-form').remove();
                    document.getElementById('new-game').style.display = 'inherit';
                }
                var newRow = document.getElementById('guesses').insertRow(-1);
                newRow.insertCell(0).innerText = data['value'];
                var newResult = newRow.insertCell(1);
                newResult.innerText = data['result'][1];
                newResult.colSpan = 3;
            }
        )
    }
</script>

<?php $this->end(); ?>
<div class="numbers view content">
    <h3>Guess the Number</h3>
    <h4><?= $number->difficulty ?> (2 to <?= $maxVal ?>)</h4>

    <div class="related">
        The number has <?= $number->factors ?> factors.
        <table cellpadding="0" cellspacing="0" id="guesses">
            <?= $this->Html->tableHeaders(['Guess', ['Response' => ['colspan' => 3]]]) ?>
            <?php foreach ($number->guesses as $guess) {
                echo $this->Html->tableCells([$guess->value, [$guess->result, ['colspan' => 3]]]);
            } ?>
        </table>

    </div>


    <div id="interactive">
        <form id="guess-form" action="javascript:addGuess();" autocomplete="off">
            <?= $this->Form->input('value', [
                'type' => 'number',
                'min' => 2,
                'max' => \Cake\Core\Configure::read('gameLevels')[$number->difficulty]
            ]) ?>
            <?= $this->Form->button('GUESS!') ?>
        </form>
        <form id="new-game"
              action="<?= $this->Url->build(['controller' => 'Numbers', 'action' => 'add']) ?>"
              method="post"
              style="display: none">
            <?= $this->element('new_game') ?>
        </form>
    </div>
</div>
