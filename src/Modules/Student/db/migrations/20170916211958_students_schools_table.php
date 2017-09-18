<?php


use Phinx\Migration\AbstractMigration;

class StudentsSchoolsTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $this->table('student_school', array('id' => false, 'primary_key' => array('student_id', 'school_id')))
            ->addColumn('student_id', 'integer')
            ->addColumn('school_id', 'integer')
            ->addIndex(['student_id'])
            ->addIndex(['school_id'])

            ->addForeignKey('student_id', 'student', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
            ->addForeignKey('school_id', 'school', 'id', array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))

        ->save();

    }
}
