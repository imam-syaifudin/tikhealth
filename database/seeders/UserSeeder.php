<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('12345'),
        ]);

        DB::table('artikels')->insert([
            'kategori_id' => 1,
            'user_id' => 1,
            'judul' => 'Tutorial PHP',
            'foto' => 'php.jpg',
            'isi' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ligula sapien, egestas vitae dui at, sodales tristique turpis. Vivamus fringilla risus sed dui blandit, sit amet mattis massa bibendum. Nunc eleifend non lorem eget malesuada. Aenean imperdiet ipsum nec diam fermentum placerat. Curabitur aliquam tempor ipsum vel posuere. Nam non imperdiet felis, at hendrerit tortor. Quisque sit amet blandit orci, vitae ullamcorper diam. Mauris mollis ipsum eget dolor blandit vestibulum. Quisque justo tortor, volutpat nec posuere eu, lobortis sit amet felis. Quisque lacinia sit amet lacus sollicitudin tincidunt. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
            'tanggalArtikel' => date('H-m-Y'),
        ]);

        DB::table('kategoris')->insert([
            'nama' => "Web Programing",
            'slug' => "web-programing",
        ]);
    }
}
