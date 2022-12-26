<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Carbon\Carbon;
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
        $this->call(CurrencySeeder::class);
        $this->call(ThemeSeeder::class);
        User::create([
            'email' => 'pro@test.com',
            'password' => \Hash::make(123456),
            'subscribed_until' => Carbon::now()->addMonth()
        ]);
        User::create([
            'email' => 'nepro@test.com',
            'password' => \Hash::make(123456)
        ]);
    }
}
