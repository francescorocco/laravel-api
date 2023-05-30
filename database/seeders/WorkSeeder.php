<?php

namespace Database\Seeders;

use App\Models\Work;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class WorkSeeder extends Seeder
{ 
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 10; $i++){
            $newWork = new Work();
            $newWork->title = $faker->sentence(5);
            $newWork->description = $faker->words(10,true);
            $newWork->slug = Str::slug($newWork->title, '-');
            $newWork->save();
        }
    }

}
