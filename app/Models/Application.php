<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use HasFactory, SoftDeletes, Searchable;

    protected $searchableFields = ['*'];

    protected $fillable = [
        'transaction_id',
        'kiosk_id',
        'user_id',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function kiosk()
    {
        return $this->belongsTo(Kiosk::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
