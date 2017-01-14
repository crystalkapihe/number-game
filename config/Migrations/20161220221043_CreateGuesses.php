<?php
use Migrations\AbstractMigration;

class CreateGuesses extends AbstractMigration
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
        $table = $this->table('guesses', ['id' => false, 'primary_key' => ['id']]);
        $table
            ->addColumn('id', 'integer', [
                'autoIncrement' => true,
                'signed' => false
            ])
            ->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('value', 'integer', [
                'signed' => false
            ])
            ->addColumn('number_id', 'integer', [
                'null' => false,
                'signed' => false
            ])
            ->addForeignKey('number_id', 'numbers', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->create();
    }
}
