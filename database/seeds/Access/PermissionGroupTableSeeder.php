<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PermissionGroupTableSeeder extends Seeder
{

    public function run()
    {

        if (env('DB_DRIVER') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        if (env('DB_DRIVER') == 'mysql') {
            DB::table(config('access.permission_group_table'))->truncate();
        } elseif (env('DB_DRIVER') == 'sqlite') {
            DB::statement("DELETE FROM ".config('access.permission_group_table'));
        } else { //For PostgreSQL or anything else
            DB::statement("TRUNCATE TABLE ".config('access.permission_group_table')." CASCADE");
        }

        /**
         * Create the Access groups
         */

        $group_model = config('access.group');
        $access = new $group_model;
        $access->name = 'Access';
        $access->sort = 1;
        $access->created_at = Carbon::now();
        $access->updated_at = Carbon::now();
        $access->save();

        $group_model = config('access.group');
        $user = new $group_model;
        $user->name = 'User';
        $user->sort = 1;
        $user->parent_id = $access->id;
        $user->created_at = Carbon::now();
        $user->updated_at = Carbon::now();
        $user->save();

        $group_model = config('access.group');
        $role = new $group_model;
        $role->name = 'Role';
        $role->sort = 2;
        $role->parent_id = $access->id;
        $role->created_at = Carbon::now();
        $role->updated_at = Carbon::now();
        $role->save();

        $group_model = config('access.group');
        $permission = new $group_model;
        $permission->name = 'Permission';
        $permission->sort = 3;
        $permission->parent_id = $access->id;
        $permission->created_at = Carbon::now();
        $permission->updated_at = Carbon::now();
        $permission->save();

        $group_model = config('access.group');
        $feature = new $group_model;
        $feature->name = 'Feature';
        $feature->sort = 4;
        $feature->created_at = Carbon::now();
        $feature->updated_at = Carbon::now();
        $feature->save();

        $group_model = config('access.group');
        $geolocation = new $group_model;
        $geolocation->name = 'GeoLocation';
        $geolocation->sort = 5;
        $geolocation->parent_id = $feature->id;
        $geolocation->created_at = Carbon::now();
        $geolocation->updated_at = Carbon::now();
        $geolocation->save();

        $group_model = config('access.group');
        $people = new $group_model;
        $people->name = 'People';
        $people->sort = 6;
        $people->parent_id = $feature->id;
        $people->created_at = Carbon::now();
        $people->updated_at = Carbon::now();
        $people->save();

        $group_model = config('access.group');
        $content = new $group_model;
        $content->name = 'Content';
        $content->sort = 7;
        $content->parent_id = $feature->id;
        $content->created_at = Carbon::now();
        $content->updated_at = Carbon::now();
        $content->save();


        if (env('DB_DRIVER') == 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
