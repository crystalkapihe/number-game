<?php
use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('users', ['id' => false, 'primary_key' => ['id']]);
        $table
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'signed' => false
            ])
            ->addColumn('username', 'string')
            ->addIndex(['username'], [
                'name' => 'UNIQUE_USERNAME',
                'unique' => true,
            ])
            ->addColumn('email', 'string')
            ->addIndex(['email'], [
                'name' => 'UNIQUE_EMAIL',
                'unique' => true,
            ])
            ->addColumn('password', 'string')
            ->addColumn('email_verification', 'string', [
                'null' => true
            ])
            ->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->create();
    }
}
