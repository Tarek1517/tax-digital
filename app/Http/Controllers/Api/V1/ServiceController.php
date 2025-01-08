<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\ServiceRequest;
use App\Http\Resources\V1\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends Controller
{

    public function index()
    {
       $service = Service::query()->with('serviceCat')->get();
       return ServiceResource::collection($service);
    }

    public function store(ServiceRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);
		if($request->hasFile('image')){
			$data['image'] = '/storage/'.$request->file('image')->store('uploads', 'public');
		}
        $service = Service::query()->create($data);
        return ServiceResource::make($service);
    }


    public function show(string $id)
    {
        $service = Service::query()->with('serviceCat')->findOrFail($id);

		return ServiceResource::make($service);
    }

    public function update(ServiceRequest $request, string $id)
    {
        $service = Service::query()->findOrFail($id);
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);
        if($request->hasFile('image')){
			$data['image'] = '/storage/'.$request->file('image')->store('uploads', 'public');
		}
        $service->update($data);

        return ServiceResource::make($service);
    }

    public function destroy(string $id)
    {
        $service = Service::query()->findOrFail($id);
        $service->delete();

        return Response::HTTP_OK;
    }
}
