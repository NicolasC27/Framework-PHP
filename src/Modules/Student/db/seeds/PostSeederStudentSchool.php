<?php


use Phinx\Seed\AbstractSeed;

class PostSeederStudentSchool extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [];
        $faker =  \Faker\Factory::create('en_US');
        for ($i = 1; $i < 30; ++$i)
        {
            $data[] = [
                'student_id' => $i,
                'school_id' => $faker->numberBetween(1, 10),
            ];
        }
        for ($i = 10; $i < 30; ++$i)
        {
            $data[] = [
                'student_id' => $i,
                'school_id' => $faker->numberBetween(11, 21),
            ];
        }
        $this->table('student_school')
            ->insert($data)
            ->save();
    }
}
