<?php

namespace App\Http\Controllers\Api\Frontend\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\V1\ServiceResource;
use App\Http\Resources\V1\PackageResource;
use App\Http\Resources\V1\PageResource;
use App\Http\Resources\V1\HomeSliderResource;
use App\Models\ServiceCategory;
use App\Models\Package;
use App\Models\Footer;
use App\Models\Page;
use App\Models\HomeSlider;


class HomeController extends Controller
{


    public function getCategories()
    {
        $category = ServiceCategory::query()->with('services')->get();
        return ServiceResource::collection($category);
    }

    public function getPackages()
    {
        $Package = Package::query()->get();
        return PackageResource::collection($Package);
    }

    public function getHeroData()
    {
        $heroData = HomeSlider::where('status', '1')->first();
        return HomeSliderResource::make($heroData);
    }


    public function getCustomPage($slug)
    {
        $page = Page::where('slug', $slug)->first();

        return PageResource::make($page);
    }

    public function getAllSettings()
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
    public function getPackageData($slug)
    {

        $packageData = Package::where('slug', $slug)->first();
        return PackageResource::make($packageData);
    }
}
