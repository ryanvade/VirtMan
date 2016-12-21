<?php

namespace Ryanvade\VirtMan;

use Illuminate\Support\ServiceProvider;

class VirtManServiceProvider extends ServiceProvider {
  public function boot() {
    // migrations
    $this->loadMigrationsFrom(__DIR__ . '/migrations');
  }

  public function register() {
    // config
  }
}
