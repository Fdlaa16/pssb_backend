<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Club extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'code',
        'name',
        'status',
        'description',
    ];

    public function clubPlayer()
    {
        return $this->belongsTo(ClubPlayer::class, 'club_id', 'id');
    }

    public function scheduleMatch()
    {
        return $this->hasMany(ScheduleMatch::class);
    }

    public function scheduleTraining()
    {
        return $this->hasMany(ScheduleTraining::class);
    }
}
