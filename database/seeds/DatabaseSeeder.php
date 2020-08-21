<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => "admin",
            'email' => "admin@admin.com",
            'conferences'=>json_encode([1]),
            'password' => "$2y$10$7Xif9Ft/RMfo.p.7N4axZO/hMhtnZ4ErpgiNpR3r4CGBi/VYoINV.",
        ]);
        DB::table('conferences')->insert([
            'title' => 'test',
            'step' => 'RollCall',
            'password' => '123456',
            'votes'=>json_encode([])
        ]);
    }
}
