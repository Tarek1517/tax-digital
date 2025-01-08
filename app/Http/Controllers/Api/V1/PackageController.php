<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\PackageRequest;
use App\Http\Resources\V1\PackageResource;
use App\Models\Package;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class PackageController extends Controller
{
    public function index()
    {
        $package = Package::query()->get();

        return PackageResource::collection($package);
    }
    public function store(PackageRequest $request)
    {

        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);
        if ($request->hasFile('image')) {
            $data['image'] = '/storage/'.$request->file('image')->store('uploads','public');
        }
        $package = Package::query()->create($data);

        return PackageResource::make($package);
    }
    public function show(string $id)
    {
        $packege = Package::query()->findOrFail($id);
		return PackageResource::make($packege);
    }
    public function update(PackageRequest $request, string $id)
    {
        $package = Package::query()->findOrFail($id);
        $data = $request->validated();
        if ($request->hasFile('image')){
            $data['image'] = '/storage/'.$request->file('images')->store('uploads','public');
        }
        $package->update($data);

        return PackageResource::make($package);
    }
    public function destroy(string $id)
    {
        $package = Package::query()->findOrFail($id);
        $package->delete();

        return Response::HTTP_OK;
    }
}
