<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissoesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        
              
        
        $admin=Role::create(['name' =>'admin']);
        
   
        $prestador=Role::create(['name' =>'prestador']);
                $gestor=Role::create(['name' =>'gestor']);
        
    }
}
