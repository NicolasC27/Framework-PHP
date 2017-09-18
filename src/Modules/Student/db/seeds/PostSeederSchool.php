<?php


use Phinx\Seed\AbstractSeed;

class PostSeederSchool extends AbstractSeed
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
        for ($i = 0; $i < 30; ++$i)
        {
            $date = $faker->unixTime('now');
            $data[] = [
                'name' => $faker->text(10),
                'slug' => $faker->slug
            ];
        }
        $this->table('school')
            ->insert($data)
            ->save();

    }
}
