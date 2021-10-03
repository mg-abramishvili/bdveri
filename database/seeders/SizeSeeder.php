<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SizeSeeder extends Seeder
{
    public function run()
    {
        DB::table('sizes')->insert([
            [
                'name' => '600×2000',
            ],
            [
                'name' => '700×2000',
            ],
            [
                'name' => '800×2000',
            ],
            [
                'name' => '900×2000',
            ],
            [
                'name' => 'нестандарт',
            ],
        ]);
    }
}
