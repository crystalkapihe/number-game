<?php
use Migrations\AbstractMigration;

class CreateNumbers extends AbstractMigration
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
        $table = $this->table('numbers', ['id' => false, 'primary_key' => ['id']]);
        $table
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'signed' => false
            ])
            ->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('value', 'integer', [
                'signed' => false
                ])
            ->addColumn('user_id', 'integer', [
                'null' => false,
                'signed' => false
            ])
            ->addColumn('points_awarded', 'float',[
                'null' => true
            ])
            ->addForeignKey('user_id', 'users', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->addColumn('difficulty', 'enum', [
                'null' => false,
                'values' => [
                    'Easy',
                    'Medium',
                    'Hard'
                ]
            ])
            ->addColumn('guess_count', 'integer', [
                'default' => 0
            ])
            ->create();
    }
}
