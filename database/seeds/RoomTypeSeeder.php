<?php

use Illuminate\Database\Seeder;
use App\RoomType;
class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker =\Faker\Factory::create();
          DB::table('room_types')->insert ([
            [
              'id'=>1,
              'type'=>'Deluxe'
            ],
            [
              'id'=>2,
              'type'=>'Standard'
            ],
            [
              'id'=>3,
              'type'=>'Business'
            ],
            [
              'id'=>4,
              'type'=>'Suite'
            ],
            [
              'id'=>5,
              'type'=>'Economic'
            ]
          ]);
    }
}
