<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define Ethiopian-specific payment methods with their status
        $paymentMethods = [
            ['name' => 'Tele Birr', 'status' => 1],
            ['name' => 'CBE (Commercial Bank of Ethiopia)', 'status' => 1],
            ['name' => 'BOA (Bank of Abyssinia)', 'status' => 1],
            ['name' => 'Awash Bank', 'status' => 1],
            ['name' => 'Nib International Bank', 'status' => 1],
            ['name' => 'Dashen Bank', 'status' => 1],
            ['name' => 'Wegagen Bank', 'status' => 1],
            ['name' => 'Abay Bank', 'status' => 1],
            ['name' => 'Lion International Bank', 'status' => 1],
            ['name' => 'Anbessa Bank', 'status' => 1],
            ['name' => 'Enat Bank', 'status' => 1],
            ['name' => 'Berhan Bank', 'status' => 1],
            ['name' => 'Cooperative Bank of Oromia', 'status' => 1],
            ['name' => 'Zemen Bank', 'status' => 1],
            ['name' => 'Hijra Bank', 'status' => 1],
            ['name' => 'Goh Betoch Bank', 'status' => 1],
            ['name' => 'Yinager Mobile Banking', 'status' => 1],
            ['name' => 'Ethio Pay', 'status' => 1],
            ['name' => 'Amole by Dashen', 'status' => 1],
            ['name' => 'Kacha Digital Financial Service', 'status' => 1],
        ];

        // Insert or update payment methods in the database
        foreach ($paymentMethods as $method) {
            PaymentMethod::updateOrCreate(
                ['name' => $method['name']], // Ensure no duplicates by name
                ['status' => $method['status']]
            );
        }
    }
}
