<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Functions;

class function_management_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $FunctionManagement= new Functions;
        $FunctionManagement-> function_name = "ATS-Add Asset Type";
        $FunctionManagement-> function_description = "this is a test function";
        $FunctionManagement-> module_id = "1";
        $FunctionManagement-> save();
    }
}
