<?php

    namespace App\Providers;

    use Illuminate\Support\ServiceProvider;

    class SizepackServiceProvider extends ServiceProvider
    {
        /**
         * Register services.
         *
         * @return void
         */
        public function register()
        {
            /** @var TYPE_NAME $this */
//            return $this->app->bind('App/Repositories_old/SizepackRepo/SizepackInterface',
//                'App/Repositories_old/SizepackRepo/SizepackRepo');
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
