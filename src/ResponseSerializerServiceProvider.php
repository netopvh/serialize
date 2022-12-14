<?php

namespace NetoPvh\ResponseSerialize;

use Illuminate\Support\ServiceProvider;

class ResponseSerializerServiceProvider extends ServiceProvider
{
  /**
   * Boot the service provider.
   *
   * @return void
   */
  public function boot()
  {
    $src = realpath($raw = __DIR__ . '/../config/serialize.php') ?: $raw;

    if ($this->app->runningInConsole()) {
      $this->publishes([
        $src => config_path('serialize.php')
      ], 'config');
    }

    $this->mergeConfigFrom($src, 'serialize');
  }

  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register()
  {
    $this->commands('NetoPvh\ResponseSerialize\Generators\Commands\SerializeCommand');
  }

  /**
   * Get the services provided by the provider.
   *
   * @return array
   */
  public function provides()
  {
    return [];
  }
}
