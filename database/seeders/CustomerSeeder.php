<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        for ($i = 0;$i <10; $i++) {
            $user = $users->random();
            Customer::factory()->create([
                'user_id' => $user->id,
            ]);
        }
    }
}