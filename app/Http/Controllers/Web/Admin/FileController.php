<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function show($id){

        $r = Resource::findOrFail($id);

        if (!Storage::disk('private')->exists($r->link))
        {
            abort(404);
        }
        $path = Storage::disk('private')->path(
            $r->link
        );
        return response()->download($path);
    }

    public function test(){
        $url = Storage::disk('private')->path('resources/test.docx');

        if (!auth()->check())
        {
            abort(403);
        }


        return response()->download($url);
    }

}
