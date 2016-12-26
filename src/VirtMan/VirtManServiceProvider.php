<?php

namespace Ryanvade\VirtMan;

use Illuminate\Support\ServiceProvider;

class VirtManServiceProvider extends ServiceProvider {
  public function boot() {
    // migrations
    $this->loadMigrationsFrom(__DIR__ . '/migrations');
    // config files
    $this->publishes([
      __DIR__ . '/Config/VirtManConfig.php' => config_path('virtman.php')
    ]);
  }

  public function register() {
    // config
  }
}
