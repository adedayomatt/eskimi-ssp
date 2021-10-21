<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run()
    {
        $admin = [
            'name' => 'Adedayo Matthews',
            'email' => 'adedayomatthews@eskimi-ssp.test',
            'password' => Hash::make('eskimi'),
            'email_verified_at' => now()
        ];
        
        User::firstOrCreate(['email' => $admin['email']], $admin);
    }
}
