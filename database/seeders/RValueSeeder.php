<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sqlFile = public_path('assets/sql/sql_r_table.sql');
        $sql = \File::get($sqlFile);
        DB::unprepared($sql);
    }
}
