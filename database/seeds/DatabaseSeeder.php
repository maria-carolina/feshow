<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Genero;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Maria',
                'email' => 'maria@gmail.com',
                'password' => Hash::make(123456),
                'tipo_usuario' => 1
            ],
            [
                'name' => 'Diego',
                'email' => 'diego@outlook.com',
                'password' => Hash::make(123456),
                'tipo_usuario' => 1
            ],
        ];

        foreach($users as $user){
            User::create($user);
        }

        //----------------------------------------

        $generos = [
            ['nome' => "pop"],
            ['nome' => "mpb"]
        ];

        foreach($generos as $genero){
            Genero::create($genero);
        }
    }
}
