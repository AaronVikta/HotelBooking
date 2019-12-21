<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Room;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        //call in the faker library
        $faker =\Faker\Factory::create();
        for($i =0; $i<10; $i++){
          Room::create([
            'room_name'=>$faker->domainWord,
            'room_type'=>'Economic',
            'hotel_id'=>1,
            'image'=>$faker->imageUrl($width=400, $height=400, 'city')
          ]);
        }
    }
}
