<div class="users form content">
<?= $this->Flash->render('auth') ?>
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Please enter your username and password') ?></legend>
        <?= $this->Form->input('username') ?>
        <?= $this->Form->input('password') ?>
    </fieldset>
    <?= $this->Html->link('New User', ['controller' => 'Users', 'action'=> 'add']) ?>
    <?= $this->Form->button(__('Login')); ?>
    <?= $this->Form->end() ?>
</div>
