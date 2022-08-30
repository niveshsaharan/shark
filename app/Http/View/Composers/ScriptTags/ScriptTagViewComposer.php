<?php

namespace App\Http\View\Composers\ScriptTags;

use Carbon\Carbon;
use Illuminate\View\View;

/**
 * Class AppScriptTagViewComposer
 *
 * @package \App\Http\View\Composers\ScriptTags
 */
class ScriptTagViewComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('now', Carbon::now());
    }
}
