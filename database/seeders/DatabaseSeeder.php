<?php

namespace Database\Seeders;

use App\Models\Information;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();

        User::factory()->create([
            "first_name" => "thanos",
            "last_name" => "talaridis",
            "email" => "thanos@gmail.com",
            "profile" => "thanos",
            "password" => Hash::make("password"),
        ]);

        $this->call([StorageSeeder::class,
/*            InformationSeeder::class*/
        ]);
    }

}
