<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class Controller
{
    protected function renderAjaxOrView($view, $data = [])
    {
        if (request()->ajax()) {
            // Force a fragment response without the layout
            return response()->json([
                'html' => view($view, $data)->renderSections()['content'] ?? view($view, $data)->render(),
                'title' => $data['title'] ?? config('app.name')
            ]);
        }
        return view($view, $data);
    }
}
