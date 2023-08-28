<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('reactions')->insert([
            ['emoji' => '😄'],
            ['emoji' => '😊'],
            ['emoji' => '😢'],
            ['emoji' => '😭'],
            ['emoji' => '😍'],
            ['emoji' => '😡'],
        ]);
    }
}
