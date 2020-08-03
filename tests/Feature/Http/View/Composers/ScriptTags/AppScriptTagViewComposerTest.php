<?php

namespace Tests\Feature\Http\View\Composers\ScriptTags;

use App\Console\Commands\CompileShopifyScriptTagsCommand;
use Tests\TestCase;

class AppScriptTagViewComposerTest extends TestCase
{
    /**
     * @test
     */
    public function it_adds_variables_to_the_view()
    {
        $this->artisan(CompileShopifyScriptTagsCommand::class);

        $this->getRoutedView('script-tags.app_compiled')
           ->assertViewHas('now');
    }
}
