<?php

namespace App\Providers;

use App\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DB::listen(function ($query) {
            // if (
            //     // sql operations that doesn't need to be logged
            //     strpos($query->sql, "create table") === false
            //     && strpos($query->sql, "alter table") === false
            //     && strpos($query->sql, "drop table") === false
            //     && strpos($query->sql, "truncate") === false
            //     && strpos($query->sql, "SET") === false
            //     // tables that doesn't need to be logged
            //      && strpos($query->sql, "`logs`") === false
            //     && strpos($query->sql, "`migrations`") === false
            //     && strpos($query->sql, "`permission_role`") === false
            //     && strpos($query->sql, "`permission_user`") === false
            //     && strpos($query->sql, "`permissions`") === false
            //     && strpos($query->sql, "`role_user`") === false
            //     && strpos($query->sql, "`roles`") === false
            //     // also don't log select opartions
            //      && strpos($query->sql, "select") === false
            // ) {
            //     $log = new Log;
            //     $log->sql = $query->sql . "\n" . json_encode($query->bindings);
            //     $log->save();
            // }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
