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
        if (!Storage::disk('s3')->exists($r->link))
        {
            abort(404);
        }
        return Storage::disk('s3')->download($r->link);
    }

}
