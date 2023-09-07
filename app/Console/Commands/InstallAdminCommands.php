<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallAdminCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shark:admin:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Shark admin';

    /**
     * Composer packages
     * @var array
     */
    protected $composerPackages = [
        'laravel/nova' => '~3.0',
        'kabbouchi/nova-impersonate' => '^1.3',
        'epartment/nova-dependency-container' => '^1.2',
        'niveshsaharan/novalinkresource' => '^1.0',
        'spatie/nova-backup-tool' => '^4.0',
        'kabbouchi/nova-logs-tool' => '^0.3.0',
        'kreitje/nova-horizon-stats' => '^0.3.0',
    ];

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->installComposerDependencies();
        $this->installNova();

        $this->info('Shark admin is installed and can be viewed at '.url(config('nova.path')));
    }

    /**
     * install dependencies
     */
    protected function installComposerDependencies()
    {
        $this->comment('Adding Laravel Nova and other dependencies in composer.json...');
        $composerContent = json_decode(file_get_contents(base_path().'/composer.json'), true);

        foreach ($this->composerPackages as $package => $version) {
            $composerContent['require'][$package] = $version;
        }

        if (! isset($composerContent['repositories']) || collect($composerContent['repositories'])->every(function ($repository) {
            return $repository['url'] !== 'https://nova.laravel.com';
        })) {
            $composerContent['repositories'][] = [
                'type' => 'composer',
                'url' => 'https://nova.laravel.com',
            ];
        }

        if (! in_array('@php artisan nova:publish', $composerContent['scripts']['post-install-cmd'])) {
            $composerContent['scripts']['post-install-cmd'][] = '@php artisan nova:publish --ansi';
        }

        if (! in_array('@php artisan nova:publish', $composerContent['scripts']['post-update-cmd'])) {
            $composerContent['scripts']['post-update-cmd'][] = '@php artisan nova:publish --ansi';
        }

        file_put_contents(base_path().'/composer.json', json_encode($composerContent, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));

        $this->comment('Running `composer update`...');
        shell_exec('php -d memory_limit=-1 /usr/local/bin/composer update');
    }

    /**
     * Install nova
     */
    protected function installNova()
    {
        $this->comment('Installing Laravel Nova...');

        // Remove all NovaServiceProvider from config, because Nova takes care of that and even duplicates them
        $namespace = app()->getNamespace();
        file_put_contents(config_path('app.php'), str_replace("        {$namespace}Providers\NovaServiceProvider::class,".PHP_EOL, '', file_get_contents(config_path('app.php'))));

        File::moveDirectory(app_path('/Nova'), app_path('/Nova_Backup'), true);
        shell_exec('php artisan nova:install');
        File::moveDirectory(app_path('/Nova_Backup'), app_path('/Nova'), true);
    }
}
