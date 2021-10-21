<?php

namespace Modules\Campaign\Models;

use Database\Factories\CampaignFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campaign extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'from',
        'to',
        'total_budget',
        'daily_budget',
        'creatives'
    ];

     /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'creatives' => 'array',
    ];

    protected static function newFactory()
    {
        return CampaignFactory::new();
    }

} 
