<?php

namespace App\Pattern\PropertyContainer;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class PropertyContainerController extends Controller
{
    /**
     * @return View
     * @throws \Exception
     */
    public function propertyContainer(): View
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

        return view('pattern.pattern', compact('pattern', 'item'));
    }
}