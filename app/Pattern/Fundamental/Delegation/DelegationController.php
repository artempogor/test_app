<?php

namespace App\Pattern\Fundamental\Delegation;

use App\Http\Controllers\Controller;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Contracts\View\View;

class DelegationController extends Controller
{
    public function __invoke(): View
    {
        $pattern = new DelegationPattern();

        return view('pattern.pattern', compact('pattern'));
    }
}