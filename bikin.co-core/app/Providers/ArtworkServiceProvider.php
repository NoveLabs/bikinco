<?php

    namespace App\Providers;

    use Illuminate\Support\ServiceProvider;

    class ArtworkServiceProvider extends ServiceProvider
    {
        /**
         * Register services.
         *
         * @return void
         */
        public function register()
        {
            /** @var TYPE_NAME $this */
//            return $this->app->bind('App/Repositories_old/ArtworkRepo/ArtworkInterface',
//                'App/Repositories_old/ArtworkRepo/ArtworkRepo');
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
