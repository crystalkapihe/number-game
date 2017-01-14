
<div class="numbers view content">
    <h3><?= h($number->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $number->has('user') ? $this->Html->link($number->user->id, ['controller' => 'Users', 'action' => 'view', $number->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($number->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Value') ?></th>
            <td><?= $this->Number->format($number->value) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Points Awarded') ?></th>
            <td><?= $this->Number->format($number->points_awarded) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($number->created) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Guesses') ?></h4>
        <?php if (!empty($number->guesses)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Value') ?></th>
                <th scope="col"><?= __('Number Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($number->guesses as $guesses): ?>
            <tr>
                <td><?= h($guesses->id) ?></td>
                <td><?= h($guesses->created) ?></td>
                <td><?= h($guesses->value) ?></td>
                <td><?= h($guesses->number_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Guesses', 'action' => 'view', $guesses->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Guesses', 'action' => 'edit', $guesses->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Guesses', 'action' => 'delete', $guesses->id], ['confirm' => __('Are you sure you want to delete # {0}?', $guesses->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
