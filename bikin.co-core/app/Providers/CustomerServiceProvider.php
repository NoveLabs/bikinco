<?php

    namespace App\Providers;

    use Illuminate\Support\ServiceProvider;

    class CustomerServiceProvider extends ServiceProvider
    {
        /**
         * Register services.
         *
         * @return void
         */
        public function register()
        {
            /** @var TYPE_NAME $this */
//            return $this->app->bind('App/Repositories_old/Customer/CustomerInterface',
//                'App/Repositories_old/Customer/Customer');
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
