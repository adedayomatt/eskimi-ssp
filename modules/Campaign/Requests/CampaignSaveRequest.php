<?php


namespace Modules\Campaign\Requests;

use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Http\FormRequest;

class CampaignSaveRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required'],
            'from' => ['required', 'date'],
            'to' => ['required', 'date', 'after:from'],
            'daily_budget' => ['required'],
            'total_budget' => ['required', 'numeric', 'gt:daily_budget'],
            'new_creative_images' => ['nullable', 'array'],
            'new_creative_images.*' => ['mimes:jpg,jpeg,png,bmp,gif'],
        ];

    }

    public function messages() {
        return [
            'new_creative_images.*.mimes' => 'Only jpg,jpeg,png, gif and bmp images are allowed',
        ];
    }

    public function validated(){

        $old_images = collect($this->creatives);
        $new_images = collect();

        if($this->file('new_creative_images')){
            $new_images = collect($this->file('new_creative_images'))
            ->map(function($file) {
                return asset(Storage::url($file->storePublicly('campaigns', ['disk' => 'public'])));
            });
        }
        
        return $this->merge([
            'creatives' => $old_images->merge($new_images)->toArray(),
        ])->only([
            'name',
            'from',
            'to',
            'daily_budget',
            'total_budget',
            'creatives',
        ]);
    }

}
