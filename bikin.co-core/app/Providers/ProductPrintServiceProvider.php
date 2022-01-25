<?php

    namespace App\Providers;

    use Illuminate\Support\ServiceProvider;

    class ProductPrintServiceProvider extends ServiceProvider
    {
        /**
         * Register services.
         *
         * @return void
         */
        public function register()
        {
            /** @var TYPE_NAME $this */
//            return $this->app->bind('App/Repositories_old/ProductPrint/ProductPrintInterface',
//                'App/Repositories_old/ProductPrint/ProductPrint');
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
