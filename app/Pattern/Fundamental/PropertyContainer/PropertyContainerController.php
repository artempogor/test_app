<?php

namespace App\Pattern\Fundamental\PropertyContainer;

use App\Http\Controllers\Controller;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Contracts\View\View;

class PropertyContainerController extends Controller
{
    /**
     * @return View
     * @throws \Exception
     */
    public function __invoke(): View
    {
        $pattern = new PropertyContainerPattern();

        $item = new Article();

        $item->setTitle('Статья заголовок');
        $item->setCategoryId(10);

        $item->addProperty('view_count', 10);

        $item->addProperty('last_update', '2024-29-01');
        $item->editProperty('last_update', '2024-29-02');

        $item->addProperty('published', true);
        $item->deleteProperty('published');

        Debugbar::info($item);

        return view('pattern.pattern', compact('pattern', 'item'));
    }
}