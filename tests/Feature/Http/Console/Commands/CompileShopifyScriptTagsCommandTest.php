<?php

namespace Tests\Feature\Http\Console\Commands;

use App\Console\Commands\CompileShopifyScriptTagsCommand;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class CompileShopifyScriptTagsCommandTest extends TestCase
{

    /** @test */
    public function it_can_compile_script_file_and_save_to_target_directory()
    {
        File::delete(resource_path('shopify/app_compiled.js'));

        $this->artisan(CompileShopifyScriptTagsCommand::class)
            ->expectsOutput('1/1 file(s) compiled successfully.')
            ->assertExitCode(0);

        $this->assertFileExists(resource_path('shopify/app_compiled.js'));

        File::delete(resource_path('shopify/app_compiled.js'));
        File::delete(resource_path('views/script-tags/app_compiled.blade.php'));
    }

    /** @test */
    public function it_compiles_only_the_files_with_correct_extension()
    {
        File::put(resource_path('views/script-tags/file.js'), "some-test-code");
        File::put(resource_path('views/script-tags/test-file.php'), "some-test-code");

        $this->artisan(CompileShopifyScriptTagsCommand::class)
            ->expectsOutput('1/1 file(s) compiled successfully.')
            ->assertExitCode(0);

        $this->assertFileExists(resource_path('shopify/app_compiled.js'));
        $this->assertFileNotExists(resource_path('shopify/file.js'));
        $this->assertFileNotExists(resource_path('shopify/test-file.js'));

        File::delete(resource_path('shopify/app_compiled.js'));
        File::delete(resource_path('views/script-tags/app_compiled.blade.php'));

        File::delete(resource_path('views/script-tags/file.js'));
        File::delete(resource_path('views/script-tags/test-file.php'));
    }

    /** @test */
    public function it_can_compile_multiple_script_files_and_save_to_target_directory()
    {
        File::delete(resource_path('shopify/app_compiled.js'));
        File::put(resource_path('views/script-tags/some-other-file.script-tag.js'), "some-test-code");

        $this->artisan(CompileShopifyScriptTagsCommand::class)
            ->expectsOutput('2/2 file(s) compiled successfully.')
            ->assertExitCode(0);

        $this->assertFileExists(resource_path('shopify/app_compiled.js'));
        $this->assertFileExists(resource_path('shopify/some-other-file_compiled.js'));

        File::delete(resource_path('shopify/app_compiled.js'));
        File::delete(resource_path('shopify/some-other-file_compiled.js'));
        File::delete(resource_path('views/script-tags/app_compiled.blade.php'));
        File::delete(resource_path('views/script-tags/some-other-file_compiled.blade.php'));

        File::delete(resource_path('views/script-tags/some-other-file.script-tag.js'));
    }
}
