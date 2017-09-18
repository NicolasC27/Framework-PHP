<?php

use Phinx\Migration\AbstractMigration;

class CreateStudentsTable extends AbstractMigration
{
    public function change()
    {
        $this->table('student')
            ->addColumn('name', 'string')
            ->addColumn('email', 'string')
            ->addColumn('slug', 'string')
            ->create();

    }
}
