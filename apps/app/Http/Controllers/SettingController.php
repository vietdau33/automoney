<?php

namespace App\Http\Controllers;

use App\Http\Services\SettingService;
use App\Models\BannerModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function profile (): Factory|View|Application
    {
        return view('settings.profile');
    }
    public function changePassword (): Factory|View|Application
    {
        return view('settings.change_password');
    }
    public function wallet (): Factory|View|Application
    {
        return view('settings.wallet');
    }
    public function banner(): View|Factory|Application|RedirectResponse
    {
        session()->flash('menu-active', 'banner');
        $banners = BannerModel::paginate(5);
        if ($banners->currentPage() > 1 && $banners->currentPage() > $banners->lastPage()) {
            return redirect()->to($banners->url(1));
        }
        return view('settings.banner', compact('banners'));
    }

    public function bannerCreate(Request $request): JsonResponse
    {
        return SettingService::bannerCreate($request);
    }

    public function bannerDelete(Request $request): JsonResponse
    {
        return SettingService::deleteBanner($request->id);
    }

    public function bannerChangeStatus(Request $request): JsonResponse
    {
        return SettingService::bannerChangeStatus((int)$request->id, (int)$request->status);
    }
}
