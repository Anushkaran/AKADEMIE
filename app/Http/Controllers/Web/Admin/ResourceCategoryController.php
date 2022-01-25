<?php

namespace App\Http\Controllers\Web\Admin;

use App\Contracts\ResourceCategoryContract;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ResourceCategoryController extends Controller
{
    protected $category;

    public function __construct(ResourceCategoryContract $category)
    {
        $this->category = $category;
    }

    /**
     *
     */
    public function index(Request $request)
    {
        if ($request->wantsJson())
        {
            return response()->json([
                'success' => true,
                'resource_categories' => $this->category->findByFilter(10,[],['id','name'])
            ]);
        }
        $categories = $this->category->findByFilter();
        return view('admin.resource-categories.index',compact('categories'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->getValidatedDate($request);
        $this->category->new($data);
        session()->flash('success',__('messages.create'));
        return redirect()->route('admin.resource-categories.index');
    }

    /**
     * @param $id
     * @return Renderable
     */
    public function edit($id) : Renderable
    {
        $category = $this->category->findOneById($id);
        return view('admin.resource-categories.edit',compact('category'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update($id, Request $request): RedirectResponse
    {
        $data = $this->getValidatedDate($request);
        $this->category->update($id,$data);
        session()->flash('success',__('messages.update'));
        return redirect()->route('admin.resource-categories.index');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->category->delete($id);
        session()->flash('success',__('messages.delete'));
        return redirect()->route('admin.resource-categories.index');
    }

    private function getValidatedDate(Request $request): array
    {
        $rules = [
            'name' => 'required|string|max:100|unique:resource_categories,name',
        ];

        if ($request->method() === 'PUT')
        {
            $rules['name'] = 'required|string|max:100|unique:resource_categories,name,'.$request->route('resource_category');
        }

        return $request->validate($rules);
    }
}
