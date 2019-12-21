<?php

use Illuminate\Database\Seeder;
use App\Hotel;

class HotelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //call in the faker library
        $faker =\Faker\Factory::create();
          Hotel::create([
            'name'=>'Awesome Hotel',
            'address'=>$faker->streetAddress,
            'city'=>$faker->city,
            'state'=>$faker->state,
            'country'=>$faker->country,
            'zip'=>$faker->postcode,
            'phone'=>$faker->e164PhoneNumber,
            'email'=> 'Mail@awesomehotel.com',
            'image'=>$faker->imageUrl($width=400, $height=400, 'city')
          ]);
    }
}
