<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Factor Game
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>
    <?= $this->Html->css('custom.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
<?php if (!is_null($userData)) { ?>
    <nav class="navbar clearfix" role="navigation">
        <div class="left">
            Welcome <?= $this->Html->link($userData['username'], ['controller' => 'Users', 'action' => 'view', $userData['id']]) ?>
            (<?= $this->Html->link('logout', ['controller' => 'Users', 'action' => 'logout']) ?>)
        </div>
        <div class="right">
            <?= $this->Html->link('Home', ['controller' => 'Users', 'action' => 'home']) ?> |
            <?= $this->Html->link('Help', ['controller' => 'Pages', 'action' => 'display', 'help']) ?>
        </div>
    </nav>
<?php } ?>
<?= $this->Flash->render() ?>
<div class="container clearfix">
    <?= $this->fetch('content') ?>
</div>
<footer>
</footer>
</body>
</html>
