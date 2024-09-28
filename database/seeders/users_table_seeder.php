<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class users_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        db::table('users')->insert( [
            [
                'designation' => 'developer',
            ],
            [
                'designation' => 'designer',
            ],
        ]);
    }
}
