<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class GuideController extends Controller
{
    /**
     * Display the documentation index.
     */
    public function index(): View
    {
        return view('guides.index');
    }

    /**
     * Display a specific documentation page.
     */
    public function show(string $page): View
    {
        // Whitelist allowed pages for security
        $allowedPages = ['teams', 'tickets', 'portal', 'robots', 'api-reference'];

        if (! in_array($page, $allowedPages)) {
            abort(404);
        }

        return view("guides.{$page}");
    }

    /**
     * Display a specific API reference page.
     */
    public function api(string $endpoint): View
    {
        $allowedEndpoints = [
            'tickets-list',
            'tickets-show',
            'tickets-create',
            'tickets-update',
            'tickets-comments-create',
            'team-members',
        ];

        if (! in_array($endpoint, $allowedEndpoints)) {
            abort(404);
        }

        return view("guides.api.{$endpoint}");
    }
}
