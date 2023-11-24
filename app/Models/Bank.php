<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $searchableFields = ['*'];

    protected $fillable = [
        'name',
    ];

    public function kioskParticipants()
    {
        return $this->hasMany(KioskParticipant::class);
    }
}
