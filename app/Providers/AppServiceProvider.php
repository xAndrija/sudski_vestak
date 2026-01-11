<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function ($user) {
            $uloga = $user?->uloga?->naziv;

            if ($uloga === 'Administrator') {
                return true;
            }

            return null;
        });

        Gate::define('admin', function ($user): bool {
            return ($user?->uloga?->naziv) === 'Administrator';
        });

        Gate::define('predmet.create', function ($user): bool {
            $uloga = $user?->uloga?->naziv;

            return in_array($uloga, ['Administrator', 'Sudski veštak', 'Sudija'], true);
        });

        Gate::define('predmet.update', function ($user): bool {
            return ($user?->uloga?->naziv) === 'Administrator';
        });

        Gate::define('predmet.delete', function ($user): bool {
            return ($user?->uloga?->naziv) === 'Administrator';
        });

        Gate::define('zahtev.create', function ($user): bool {
            $uloga = $user?->uloga?->naziv;

            return in_array($uloga, ['Administrator'], true);
        });

        Gate::define('zahtev.update', function ($user): bool {
            return ($user?->uloga?->naziv) === 'Administrator';
        });

        Gate::define('zahtev.delete', function ($user): bool {
            return ($user?->uloga?->naziv) === 'Administrator';
        });

        Gate::define('izvestaj.create', function ($user): bool {
            return ($user?->uloga?->naziv) === 'Administrator';
        });

        Gate::define('izvestaj.update', function ($user): bool {
            return ($user?->uloga?->naziv) === 'Administrator';
        });

        Gate::define('izvestaj.delete', function ($user): bool {
            return ($user?->uloga?->naziv) === 'Administrator';
        });

        Gate::define('terenskiPodaci.create', function ($user): bool {
            $uloga = $user?->uloga?->naziv;

            return in_array($uloga, ['Administrator', 'Sudski veštak'], true);
        });

        Gate::define('terenskiPodaci.update', function ($user): bool {
            return ($user?->uloga?->naziv) === 'Administrator';
        });

        Gate::define('terenskiPodaci.delete', function ($user): bool {
            return ($user?->uloga?->naziv) === 'Administrator';
        });
    }
}
