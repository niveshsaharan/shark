<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CompileShopifyScriptTagsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shark:compile-script-tags';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compile script tag files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $files = File::glob(resource_path('views/script-tags/*.script-tag.js'));

        if (! $files) {
            $this->alert("Nothing to compile!");

            return false;
        }

        $success = 0;

        $bar = $this->output->createProgressBar(count($files));

        foreach ($files as $file) {
            $fileRawName = str_replace('.script-tag.js', '', basename($file));

            // Target directory to save
            $targetDir = resource_path('shopify');

            // put raw js
            File::put(resource_path('views/script-tags/' . $fileRawName . '_compiled.blade.php'), File::get($file));

            // Create view
            $script = view('script-tags.' . $fileRawName . '_compiled');

            File::put($targetDir . '/' . $fileRawName . '_compiled.js', $script);

            $bar->advance();

            $success++;
        }

        $bar->finish();

        $this->line("");
        $this->comment($success . '/'. count($files) . " file(s) compiled successfully.");
    }
}
