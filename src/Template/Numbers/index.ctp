
<div class="numbers index content">
    <h3><?= __('Numbers') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('value') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('points_awarded') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($numbers as $number): ?>
            <tr>
                <td><?= $this->Number->format($number->id) ?></td>
                <td><?= h($number->created) ?></td>
                <td><?= $this->Number->format($number->value) ?></td>
                <td><?= $number->has('user') ? $this->Html->link($number->user->id, ['controller' => 'Users', 'action' => 'view', $number->user->id]) : '' ?></td>
                <td><?= $this->Number->format($number->points_awarded) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $number->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $number->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $number->id], ['confirm' => __('Are you sure you want to delete # {0}?', $number->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
