<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ArtisanController extends Controller
{
    public function migrate(Request $request)
    {
        $command = 'migrate';

        if ($request->has('fresh'))
        {
            $command .= ':fresh';
        }

        Artisan::call($command);

        return 'done';
    }

    public function cache()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:cache');
        Artisan::call('route:cache');
        Artisan::call('view:cache');

        return 'done';
    }

    public function storage()
    {
        Artisan::call('storage:link');
        return 'done';
    }

    public function seed()
    {
        Artisan::call('db:seed');
        return 'done';
    }
}
