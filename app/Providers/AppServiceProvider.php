<?php

namespace Social\Providers;

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
  // DB::listen(function ($query) {
  //  // var_dump($query->sql . '<br><br>');
  //  // $query->sql;
  //  // $query->bindings;
  //  // $query->time;
  // });
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
