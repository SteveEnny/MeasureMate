<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Measurement;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class MeasurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $cloth_type = ['shirt', 'polo', 'gown', 'trouser',];
        $users = User::all();
        $customers = Customer::all();
        $body_type = ['top_body', 'bottom_body', 'full_body'];
        foreach($users as $user){
            // $measurement = new Measurement();
            
            $customer_id = 1;
          

            

        }
        foreach($customers as $customer) {
                
            $customers_measurement = rand(2, 5);
            for($i = 0;$i < $customers_measurement; $i++) {
                $cloth_type = Arr::random($body_type);
                if($cloth_type === 'top_body') {
                    $chest = fake()->randomFloat(2, 25, 35);
                    $neck = fake()->randomFloat(2, 25, 35);
                    $waist = fake()->randomFloat(2, 25, 35);
                    $shoulder_width = fake()->randomFloat(2, 15, 20);
                    $sleeve_length = fake()->randomFloat(2, 15, 20);
                    $sleeve_opening = fake()->randomFloat(2, 15, 20);
                    $arm_length = fake()->randomFloat(2, 25, 30);
                    $bust = fake()->randomFloat(2, 25, 30);
                    Measurement::factory()->create([
                        // 'user_id' => $user->id, // $users->random()->id,
                        'customer_id' => $customer->id,
                        'chest' => $chest,
                        'neck' => $neck,
                        'bust' => $bust,
                        'waist' => $waist,
                        'shoulder_width' => $shoulder_width,
                        'sleeve_length' => $sleeve_length,
                        'sleeve_opening' => $sleeve_opening,
                        'arm_length' => $arm_length,
                        'body_type' => $cloth_type,
                    ]);
                }
                elseif($body_type === 'botton_body') {
                    $hips = fake()->randomFloat(2, 25, 35);
                    $outseam = fake()->randomFloat(2, 25, 35);
                    $inseam = fake()->randomFloat(2, 25, 35);
                    $length = fake()->randomFloat(2, 15, 20);
                   
                    Measurement::factory()->create([
                        // 'user_id' => $user->id, // $users->random()->id,
                        'customer_id' => $customer->id,
                        'hips' => $hips,
                        'outseam' => $outseam,
                        'inseam' => $inseam,
                        'length' => $length,
                        'body_type' => $cloth_type,
                    ]);
                }

                else {
                    $chest = fake()->randomFloat(2, 25, 35);
                    $neck = fake()->randomFloat(2, 25, 35);
                    $waist = fake()->randomFloat(2, 25, 35);
                    $hips = fake()->randomFloat(2, 35, 45);
                    $shoulder_width = fake()->randomFloat(2, 15, 20);
                    $sleeve_length = fake()->randomFloat(2, 15, 20);
                    $sleeve_opening = fake()->randomFloat(2, 15, 20);
                    $arm_length = fake()->randomFloat(2, 25, 30);
                    $bust = fake()->randomFloat(2, 25, 30);
                    $length = fake()->randomFloat(2, 15, 20);
                    $outseam = fake()->randomFloat(2, 25, 35);
                    $inseam = fake()->randomFloat(2, 25, 35);
                    Measurement::factory()->create([
                        // 'user_id' => $user->id, // $users->random()->id,
                        'customer_id' => $customer->id,
                        'chest' => $chest,
                        'neck' => $neck,
                        'waist' => $waist,
                        'hips' => $hips,
                        'shoulder_width' => $shoulder_width,
                        'bust' => $bust,
                        'sleeve_length' => $sleeve_length,
                        'sleeve_opening' => $sleeve_opening,
                        'arm_length' => $arm_length,
                        'length' => $length,
                        'outseam' => $outseam,
                        'inseam' => $inseam,
                        'body_type' => $cloth_type,
                        ]);
                }
            }
        }
    }
}