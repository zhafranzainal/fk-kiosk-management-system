<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complaint extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $searchableFields = ['*'];

    protected $fillable = [
        'kiosk_participant_id',
        'user_id',
        'description',
        'assign_to',
        'status',
    ];

    public function kioskParticipant()
    {
        return $this->belongsTo(KioskParticipant::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
