<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Regional;
use App\Models\Society;
use Illuminate\Support\Facades\Hash;
use App\Models\Car;
use App\Models\User;
use App\Models\Validation;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password')
        ]);

        $regional = Regional::create([
            'province' => 'DKI Jakarta',
            'district' => 'Central Jakarta'
        ]);

        $society = Society::create([
            'name' => 'Doni Rianto',
            'id_card_number' => '1234567890',
            'password' => Hash::make('password'),
            'born_date' => '1974-10-22',
            'gender' => 'male',
            'address' => 'Ki. Raya Setiabudhi No. 790',
            'regional_id' => $regional->id
        ]);

        Validation::create([
            'society_id' => $society->id,
            'job' => 'Design Grafis',
            'job_description' => 'Tiga Dimensi',
            'income' => 10000000,
            'reason_accepted' => 'Layak kredit',
            'status' => 'accepted', 
            'validator_id' => $user->id 
        ]);

        Car::insert([
            [
                'brand' => 'Toyota',
                'model' => 'Avanza',
                'price' => 200000000,
                'tenor' => 60
            ],
            [
                'brand' => 'Honda',
                'model' => 'Brio',
                'price' => 180000000,
                'tenor' => 60
            ],
            [
                'brand' => 'Mitsubishi',
                'model' => 'Xpander',
                'price' => 250000000,
                'tenor' => 60
            ]
        ]);
    }
}