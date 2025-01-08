<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\V1\PageResource;
use App\Models\Page;
use Illuminate\Support\Str;
use App\Http\Requests\V1\PageRequest;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = Page::query()->paginate();

        return PageResource::collection($pages);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function allPageList()
    {
        $pages = Page::query()->select('id', 'slug', 'title')->get();

        return PageResource::collection($pages);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);
        $pages = Page::create($data);
        return PageResource::make($pages);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $page = Page::find($id);
        return PageResource::make($page);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $page = Page::find($id);
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'slug' => 'nullable'
        ]);
        $data['slug'] = Str::slug($data['title']);
        $page->update($data);

        return PageResource::make($page);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $page = Page::findOrFail($id);

        if($page){
            $page->delete();
        }
        return PageResource::make($page);
    }
}
