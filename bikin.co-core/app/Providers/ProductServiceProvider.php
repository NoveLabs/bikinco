<?php

    namespace App\Providers;

    use Illuminate\Support\ServiceProvider;

    class ProductServiceProvider extends ServiceProvider
    {
        /**
         * Register services.
         *
         * @return void
         */
        public function register()
        {
            /** @var TYPE_NAME $this */
//            return $this->app->bind('App/Repositories_old/Product/ProductInterface',
//                'App/Repositories_old/Product/Product');
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
