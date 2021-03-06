<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $id1 = DB::table('businesses')->insertGetID([
            'name' => 'Next Apps',
            'description' => 'We create digital applications with a big focus on the end user.',
            'address' => 'Stationsplein 41',
            'city' => 'Lokeren',
            'zip_code' => '9160',
            'country' => 'Belgium'
        ]);

        $id2 = DB::table('businesses')->insertGetId([
            'name' => 'Next Apps France',
            'description' => 'We create digital applications with a big focus on the end user.',
            'address' => 'Stationsplein 41',
            'city' => 'Lokeren',
            'zip_code' => '9160',
            'country' => 'France'
        ]);

        DB::table('businesses')->insert([
            'name' => 'Next Apps Netherlands',
            'description' => 'We create digital applications with a big focus on the end user.',
            'address' => 'Stationsplein 41',
            'city' => 'Lokeren',
            'zip_code' => '9160',
            'country' => 'Netherlands'
        ]);

        DB::table('businesses')->insert([
            'name' => 'Next Apps2',
            'description' => 'We create digital applications with a big focus on the end user.',
            'address' => 'Stationsplein 41',
            'city' => 'Gent',
            'zip_code' => '9000',
            'country' => 'Belgium'
        ]);

        DB::table('owners')->insert([
            'name' => 'Wim Van Buynder',
            'business_id' => $id1
        ]);

        DB::table('owners')->insert([
            'name' => 'Christophe Todts',
            'business_id' => $id1
        ]);

        DB::table('owners')->insert([
            'name' => 'Sander Versluys',
            'business_id' => $id1
        ]);

        DB::table('owners')->insert([
            'name' => 'Jan Claeys',
            'business_id' => $id2
        ]);
    }
}
