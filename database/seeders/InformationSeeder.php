<?php

namespace Database\Seeders;

use App\Models\Information;
use App\Models\Storage;
use Illuminate\Database\Seeder;

class InformationSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Information::factory()->times(10)->create()
            ->each(function ($info) {
                $info->storages()->attach(Storage::all()->random()->id, ["quantity" => rand(1, 10)]);
            });
    }

}
