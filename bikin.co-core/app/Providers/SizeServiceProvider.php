<?php

    namespace App\Providers;

    use Illuminate\Support\ServiceProvider;

    class SizeServiceProvider extends ServiceProvider
    {
        /**
         * Register services.
         *
         * @return void
         */
        public function register()
        {
            /** @var TYPE_NAME $this */
//            return $this->app->bind('App/Repositories_old/Size/SizeInterface',
//                'App/Repositories_old/Size/Size');
        }

        /**
         * Bootstrap services.
         *
         * @return void
         */
        public function boot()
        {
            //
        }
    }
