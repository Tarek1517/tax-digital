<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ServiceCategoryRequest;
use App\Http\Resources\V1\ServiceCategoryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ServiceCategory;
use Symfony\Component\HttpFoundation\Response;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::query()->orderBy('order_level')->paginate(10);

        return ServiceCategoryResource::collection($categories);
    }


    public function store(ServiceCategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);
        if ($request->hasFile('image')) {
            $data['image'] = '/storage/' . $request->file('image')->store('uploads', 'public');
        }
        $category = ServiceCategory::query()->create($data);
        return ServiceCategoryResource::make($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = ServiceCategory::query()->findOrFail($id);

        return ServiceCategoryResource::make($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceCategoryRequest $request, string $id)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);

        $category = ServiceCategory::query()->findOrFail($id);
        
        if ($request->hasFile('image')) {
            $data['image'] = '/storage/' . $request->file('image')->store('uploads', 'public');
        }
        $category->update($data);

        return ServiceCategoryResource::make($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = ServiceCategory::query()->findOrFail($id);
        $category->delete();

        return Response::HTTP_OK;
    }
}
