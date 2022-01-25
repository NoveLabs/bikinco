<?php

    namespace App\Providers;

    use Illuminate\Support\ServiceProvider;

    class CategoryServiceProvider extends ServiceProvider
    {
        /**
         * Register services.
         *
         * @return void
         */
        public function register()
        {
            /** @var TYPE_NAME $this */
//            return $this->app->bind('App/Repositories_old/Category/CategoryInterface',
//                'App/Repositories_old/Category/Category');
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
