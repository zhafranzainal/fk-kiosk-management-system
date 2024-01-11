<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $searchableFields = ['*'];

    protected $fillable = [
        'kiosk_participant_id',
        'monthly_revenue',
        'cost_of_goods_sold',
        'profit',
        'status',
    ];

    public function kioskParticipant()
    {
        return $this->belongsTo(KioskParticipant::class);
    }
}
