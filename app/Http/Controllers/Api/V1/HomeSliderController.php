<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\V1\HomerSliderRequest;
use App\Http\Resources\V1\HomeSliderResource;
use App\Models\HomeSlider;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class HomeSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $HeroSlider = HomeSlider::query()->orderBy('order_level')->paginate(10);

        return HomeSliderResource::collection($HeroSlider);
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
    public function store(HomerSliderRequest $request)
    {

        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = '/storage/' . $request->file('image')->store('uploads', 'public');
        }
        $heroSection = HomeSlider::query()->create($data);
        return HomeSliderResource::make($heroSection);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $heroSection = HomeSlider::query()->findOrFail($id);

        return HomeSliderResource::make($heroSection);
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
    public function update(HomerSliderRequest $request, string $id)
    {
        $data = $request->validated();
        $HeroSection = HomeSlider::findOrFail($id);

        if ($request->hasFile('image')) {
            $data['image'] = '/storage/' . $request->file('image')->store('uploads', 'public');
        }
        $HeroSection->update($data);

        return HomeSliderResource::make($HeroSection);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $section = HomeSlider::query()->findOrFail($id);
        $section->delete();

        return Response::HTTP_OK;
    }

    public function inActiveStatus($id)
    {
        HomeSlider::where('id', $id)->update(['status' => '0']);
        $heroSection = HomeSlider::find($id); // Retrieve the updated model

        return HomeSliderResource::make($heroSection);
    }

    public function activeStatus($id)
    {
        HomeSlider::where('status', '1')->update(['status' => '0']);
        HomeSlider::where('id', $id)->update(['status' => '1']);
        $heroSection = HomeSlider::find($id); // Retrieve the updated model

        return HomeSliderResource::make($heroSection);
    }

}
