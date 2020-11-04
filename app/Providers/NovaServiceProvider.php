<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use NiveshSaharan\NovaLinkResource\NovaLinkResource;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.q
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::createUserUsing(function ($command) {
            return [
                $command->ask('Name'),
                $command->ask('Email Address'),
                $command->secret('Password'),
                $command->choice('Admin type?', ['Admin', 'Super Admin'], 0),
            ];
        }, function ($name, $email, $password, $type) {
            (new Admin())->forceFill([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'email_verified_at' => now(),
                'type' => ($type === 'Super Admin' ? Admin::SUPER_ADMIN_TYPE : Admin::ADMIN_TYPE),
            ])->save();
        });
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return (bool) $user;
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        $cards = [
            (new \App\Nova\Metrics\TrendMetrics())->model(User::class)->column('created_at')->setName('Shops Per Day'),
            (new \App\Nova\Metrics\ValueMetrics())->model(User::class)->dateColumn('created_at')->setName('Shops Per Range'),
            (new \App\Nova\Metrics\Value\PaidShop())->setName('Paid Shops'),
        ];

        if (config('queue.default') == 'redis') {
            $cards = array_merge($cards, [
                new \Kreitje\NovaHorizonStats\JobsPastHour(60),
                new \Kreitje\NovaHorizonStats\FailedJobsPastHour(60),
                new \Kreitje\NovaHorizonStats\Processes(60),
                new \Kreitje\NovaHorizonStats\Workload(60),
            ]);
        }

        return $cards;
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            (new NovaLinkResource())
                ->name('Horizon')
                ->to(url(config('horizon.path')))
                ->icon('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="24" height="24" class="sidebar-icon"><path fill="var(--sidebar-icon)" d="M5.26176342 26.4094389C2.04147988 23.6582233 0 19.5675182 0 15c0-4.1421356 1.67893219-7.89213562 4.39339828-10.60660172C7.10786438 1.67893219 10.8578644 0 15 0c8.2842712 0 15 6.71572875 15 15 0 8.2842712-6.7157288 15-15 15-3.716753 0-7.11777662-1.3517984-9.73823658-3.5905611zM4.03811305 15.9222506C5.70084247 14.4569342 6.87195416 12.5 10 12.5c5 0 5 5 10 5 3.1280454 0 4.2991572-1.9569336 5.961887-3.4222502C25.4934253 8.43417206 20.7645408 4 15 4 8.92486775 4 4 8.92486775 4 15c0 .3105915.01287248.6181765.03811305.9222506z"></path></svg>')
                ->withMeta(['external' => true, 'target' => '_self']),

            (new NovaLinkResource())
                ->name('Telescope')
                ->to(url(config('telescope.path')))
                ->icon('<svg xmlns="http://www.w3.org/2000/svg" class="sidebar-icon" viewBox="0 0 80 80" width="24" height="24"><path fill="var(--sidebar-icon)" d="M0 40a39.87 39.87 0 0 1 11.72-28.28A40 40 0 1 1 0 40zm34 10a4 4 0 0 1-4-4v-2a2 2 0 1 0-4 0v2a4 4 0 0 1-4 4h-2a2 2 0 1 0 0 4h2a4 4 0 0 1 4 4v2a2 2 0 1 0 4 0v-2a4 4 0 0 1 4-4h2a2 2 0 1 0 0-4h-2zm24-24a6 6 0 0 1-6-6v-3a3 3 0 0 0-6 0v3a6 6 0 0 1-6 6h-3a3 3 0 0 0 0 6h3a6 6 0 0 1 6 6v3a3 3 0 0 0 6 0v-3a6 6 0 0 1 6-6h3a3 3 0 0 0 0-6h-3zm-4 36a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM21 28a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path></svg>')
                ->withMeta(['external' => true, 'target' => '_self']),

            new \Spatie\BackupTool\BackupTool(),

            new \KABBOUCHI\LogsTool\LogsTool(),
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
