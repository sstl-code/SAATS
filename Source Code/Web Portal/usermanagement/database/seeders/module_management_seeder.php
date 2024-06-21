<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;

class module_management_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ModuleManagement= new Module;
        $ModuleManagement-> module_name = "ATS (Asset Tagging and Tracking)";
        $ModuleManagement-> module_description = "this is a test module";
        $ModuleManagement-> status = 0;
        $ModuleManagement-> save();

        $ModuleManagement= new Module;
        $ModuleManagement-> module_name = "UCP (Unified Customer Portal)";
        $ModuleManagement-> module_description = "this is a test module";
        $ModuleManagement-> status = 0;
        $ModuleManagement-> save();

        $ModuleManagement= new Module;
        $ModuleManagement-> module_name = "OMS (Order Management System)";
        $ModuleManagement-> module_description = "this is a test module";
        $ModuleManagement-> status = 0;
        $ModuleManagement-> save();
    }
}
