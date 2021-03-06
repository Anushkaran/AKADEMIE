<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{

    /**
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request) : Renderable
    {
        $query = Resource::whereHas('partners',function ($q){
            $q->where('partners.id',auth()->user()->partner_id);
        })->newQuery();

        if ($request->has('search') && !empty($request->input('search')))
        {
            $query->where('name','like','%'.$request->input('search').'%');
        }

        $resources = $query->paginate(20)->withQueryString();

        return view('user.dashboard',compact('resources'));
    }

    public function preview($id)
    {
        $resource = Resource::whereHas('partners',function ($q){
            $q->where('partners.id',auth()->user()->partner_id);
        })->findOrFail($id);

        if (!$resource->access === 1)
        {
            abort(403);
        }

        return view('user.preview',compact('resource'));
    }

    public function fileDownload($id)
    {
        $resource = Resource::whereHas('partners',function ($q){
            $q->where('partners.id',auth()->user()->partner_id);
        })->findOrFail($id);

        if (!$resource->access === 2)
        {
            abort(403);
        }


        if (!Storage::disk('s3')->exists($resource->link))
        {
            abort(404);
        }


        return  Storage::disk('s3')->download(
            $resource->link
        );
    }

    public function getFile($id)
    {
        $resource = Resource::whereHas('partners',function ($q){
            $q->where('partners.id',auth()->user()->partner_id);
        })->findOrFail($id);

        if (!Storage::disk('s3')->exists($resource->link))
        {
            abort(404);
        }

        return Storage::disk('s3')->download($resource->link);
    }
}
