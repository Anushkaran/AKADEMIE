<?php

namespace App\Http\Controllers\Web\Partner;

use App\Http\Controllers\Controller;
use App\Models\PartnerSheetSetting;
use App\Traits\UploadAble;
use Illuminate\Http\Request;

class SettingSheetController extends Controller
{
    use UploadAble;

    public function index()
    {
        $setting = auth('partner')->user()->settingSheet;
        return view('partner.settings.index',compact('setting'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'header_image' => 'required_without:footer_image|file|image|max:2000',
            'footer_image' => 'required_without:header_image|file|image|max:2000',
        ]);

        if ($request->hasFile('header_image'))
        {
            $data['header_image'] = $this->uploadOne($request->file('header_image'),'partner/absence/sheets/','s3');
        }

        if ($request->hasFile('footer_image'))
        {
            $data['footer_image'] = $this->uploadOne($request->file('footer_image'),'partner/absence/sheets/','s3');
        }
        $data['partner_id'] = auth('partner')->id();
        PartnerSheetSetting::updateOrCreate(
            [
                'partner_id' => auth('partner')->id()
            ],
            $data
        );
        session()->flash(__('actions.update'));
        return redirect()->back();
    }
}
