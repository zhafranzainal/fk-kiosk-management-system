<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kiosk extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $searchableFields = ['*'];

    protected $fillable = [
        'business_type_id',
        'name',
        'location',
        'suggested_action',
        'comment',
        'status',
    ];

    public function businessType()
    {
        return $this->belongsTo(BusinessType::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
