<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\V1\AboutHeroSectionRequest;
use App\Http\Resources\V1\AboutHeroSectionResource;
use App\Models\AboutHeroSection;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AboutHeroSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aboutHeroContent = AboutHeroSection::query()->orderBy('order_level')->paginate(10);

        return AboutHeroSectionResource::collection($aboutHeroContent);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AboutHeroSectionRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = '/storage/' . $request->file('image')->store('uploads', 'public');
        }
        $aboutheroSection = AboutHeroSection::query()->create($data);
        return AboutHeroSectionResource::make($aboutheroSection);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $aboutheroSection = AboutHeroSection::query()->findOrFail($id);

        return AboutHeroSectionResource::make($aboutheroSection);
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
    public function update(AboutHeroSectionRequest $request, string $id)
    {
        $data = $request->validated();
        $AboutHeroSection = AboutHeroSection::findOrFail($id);

        if ($request->hasFile('image')) {
            $data['image'] = '/storage/' . $request->file('image')->store('uploads', 'public');
        }
        $AboutHeroSection->update($data);

        return AboutHeroSectionResource::make($AboutHeroSection);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $section = AboutHeroSection::query()->findOrFail($id);
        $section->delete();

        return Response::HTTP_OK;
    }

    public function aboutInActiveStatus($id)
    {
        AboutHeroSection::where('id', $id)->update(['status' => '0']);
        $heroSection = AboutHeroSection::find($id); // Retrieve the updated model

        return AboutHeroSectionResource::make($heroSection);
    }

    public function aboutActiveStatus($id)
    {
        AboutHeroSection::where('status', '1')->update(['status' => '0']);
        AboutHeroSection::where('id', $id)->update(['status' => '1']);
        $heroSection = AboutHeroSection::find($id); // Retrieve the updated model

        return AboutHeroSectionResource::make($heroSection);
    }
}
