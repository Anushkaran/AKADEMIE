<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\ResourceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResourceRequest;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    protected $resource;

    public function __construct(ResourceContract $resource)
    {
        $this->resource = $resource;
    }

    public function index()
    {
        $resources = $this->resource->findByFilter();
        return view('admin.resources.index',compact('resources'));
    }

    public function create(){
        return view('admin.resources.create');
    }

    public function store(ResourceRequest $request): \Illuminate\Http\RedirectResponse
    {

        $this->resource->new($request->validated());
        session()->flash('success',__('messages.create'));
        return redirect()->route('admin.resources.index');
    }


    public function show($id)
    {
        $resource = $this->resource->findOneById($id);
        return view('admin.resources.show',compact('resource'));
    }

    public function edit($id)
    {
        $resource = $this->resource->findOneById($id);
        return view('admin.resources.edit',compact('resource'));
    }

    public function update($id,ResourceRequest $request): \Illuminate\Http\RedirectResponse
    {
        $this->resource->update($id,$request->validated());
        session()->flash('success',__('messages.update'));
        return redirect()->route('admin.resources.index');
    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        $this->resource->delete($id);
        session()->flash('success',__('messages.delete'));
        return redirect()->route('admin.resources.index');
    }

    public function attach($id,Request $request)
    {
        $data = $request->validate([
            'partners'     => 'required|array',
            'partners.*'   => 'required|integer'
        ]);

        $this->resource->attachPartner($id,$data);


        session()->flash('success',__('messages.attach'));
        return redirect()->back();
    }

    public function detach($id,$partner)
    {
        $this->resource->detachPartner($id,$partner);
        session()->flash('success',__('messages.removed'));
        return redirect()->back();
    }
}
