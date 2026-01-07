<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FooterBranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = [
            [
                'name' => 'Satkhira Campus',
                'emis_no' => '20807041',
                'address' => 'Kharibila, Bypass Road, Satkhira Sadar, Satkhira-9400',
                'phone' => '01919888316',
                'email' => 'info@bliss.edu.bd',
                'school_code' => '480675',
            ],
            [
                'name' => 'Debhata Campus',
                'emis_no' => '208050212',
                'address' => 'Sekendra, Debhata, Satkhira',
                'phone' => '01926261818',
                'email' => 'blimia bd@gmail.com',
                'school_code' => '463289',
            ],
        ];

        foreach ($branches as $branch) {
            \App\Models\FooterBranch::create($branch);
        }
    }
}
