<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PartnerSheetSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_id',
        'header_image',
        'footer_image',
    ];

    protected $appends = [
        'header_image_url','footer_image_url'
    ];

    public function getHeaderImageUrl()
    {
        if (Str::contains($this->header_image,'http'))
        {
            return $this->header_image;
        }

        return  $this->header_image ? Storage::disk(config('filesystems.default'))->url($this->header_image) : asset('assets/vuexy/app-assets/images/logo/logo.png');
    }

    public function getFooterImageUrl()
    {
        if (Str::contains($this->footer_image,'http'))
        {
            return $this->footer_image;
        }

        return  $this->footer_image
            ? Storage::disk(config('filesystems.default'))->url($this->footer_image)
            : asset('assets/vuexy/app-assets/images/logo/logo.png');
    }
}
