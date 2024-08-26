<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Permission;
use Illuminate\Support\Facades\Route;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $routes = Route::getRoutes();
            
            foreach ($routes as $route) {

                $routeFullName = $route->getName();
                if($routeFullName){
                    $routeFullNameArray = explode('.', $routeFullName);
                    $permission = [
                        'route_name' => $route->getName(),
                        'method' => implode(',', $route->methods()),
                        'label' => ucfirst(strtolower($routeFullNameArray[0]))
                    ];
                    Permission::updateOrCreate(
                        ['route_name' => $permission['route_name']],
                        $permission
                    );
                }
            }
    }
}
