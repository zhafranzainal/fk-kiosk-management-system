<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KioskParticipant extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $searchableFields = ['*'];

    protected $fillable = [
        'user_id',
        'kiosk_id',
        'bank_id',
        'account_no',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kiosk()
    {
        return $this->belongsTo(Kiosk::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
}
