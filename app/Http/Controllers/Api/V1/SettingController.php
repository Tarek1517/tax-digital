<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Footer;
use App\Models\Page;
use App\Http\Resources\V1\SettingResource;


class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $footerColumns = Footer::query()->orderBy('order_number')->get();
        foreach ($footerColumns as $column) {
            $footerPageIds = json_decode($column->pages);
            $footerPages = Page::query()->whereIn('id', $footerPageIds)->select('slug', 'title')->get();
            $column['pages'] = $footerPages;
        }

        $settings = [
            'footer_columns' => $footerColumns,
            'currency_symbol' => getSetting('currency_symbol'),
            'address' => getSetting('address'),
            'email' => getSetting('email'),
            'phone_number' => getSetting('phone_number'),
            'facebook_link' => getSetting('facebook_link'),
            'youtube_link' => getSetting('youtube_link'),
            'instagram_link' => getSetting('instagram_link'),
            'linkedin_link' => getSetting('linkedin_link'),
            'Skype_link' => getSetting('Skype_link'),
            'twitter_link' => getSetting('twitter_link'),
            'homePage_video_link' => getSetting('homePage_video_link'),
        ];

        return response()->json($settings);
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
    public function store(Request $request)
    {
        $data = $request->all();
        $updatedSettings = [];

        foreach ($data as $type => $value) {
            $settings = Setting::where('key', $type)->first();

            if ($settings != null) {
                // Update existing setting
                if ($value != null) {
                    $settings->value = is_array($value) ? json_encode($value) : $value;
                    $settings->save();
                    $updatedSettings[] = $settings;
                }
            } else {
                // Create new setting
                if ($value != null) {
                    $settings = new Setting();
                    $settings->key = $type;
                    $settings->value = is_array($value) ? json_encode($value) : $value;
                    $settings->save();
                    $updatedSettings[] = $settings;
                }
            }
        }


        return SettingResource::collection($updatedSettings);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
