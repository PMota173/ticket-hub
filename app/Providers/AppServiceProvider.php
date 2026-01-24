<?php

namespace App\Providers;

use App\Models\TeamInvitation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
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
        Model::unguard();
        Model::preventLazyLoading();

        View::composer('components.global-sidebar', function ($view) {
            $count = 0;

            if (Auth::check()) {
                // Adjust this query based on your database structure
                $count = TeamInvitation::where('email', Auth::user()->email)
                    ->where('accepted_at', null)
                    ->count();

                // OR if you have a relationship set up in your User model:
                // $count = Auth::user()->invitations()->where('status', 'pending')->count();
            }

            $view->with('pendingInvitationsCount', $count);
        });
    }
}
