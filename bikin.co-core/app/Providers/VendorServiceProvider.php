<?php

    namespace App\Providers;

    use Illuminate\Support\ServiceProvider;

    class VendorServiceProvider extends ServiceProvider
    {
        /**
         * Register services.
         *
         * @return void
         */
        public function register()
        {
            /** @var TYPE_NAME $this */
//            return $this->app->bind('App/Repositories_old/Vendor/VendorInterface',
//                'App/Repositories_old/Vendor/Vendor');
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
