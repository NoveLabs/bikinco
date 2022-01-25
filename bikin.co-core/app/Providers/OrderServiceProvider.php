<?php

    namespace App\Providers;

    use Illuminate\Support\ServiceProvider;

    class OrderServiceProvider extends ServiceProvider
    {
        /**
         * Register services.
         *
         * @return void
         */
        public function register()
        {
            /** @var TYPE_NAME $this */
//            return $this->app->bind('App/Repositories_old/Order/OrderInterface',
//                'App/Repositories_old/Order/Order');
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
