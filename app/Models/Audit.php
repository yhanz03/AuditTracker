<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Audit extends Model
{
    use HasFactory;

    protected $fillable = [
        'link',
        'type',
        'status',
        'resolution',
        'ninja',
        'start',
        'end',
        'tat',
        'shiftdate',

    ];

    // public function getTruncatedLinkAttribute()
    // {
    //     return substr($this->link, -18);
    // }


    // This method is called when the model is saved (both created and updated)
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->start = Carbon::now();
            $model->user_id = Auth::id();
            $model->shiftdate = Carbon::now();
        });

        static::saving(function ($model) {
            if ($model->status == 'Completed' && empty($model->tat)) {
                $model->end = Carbon::now();
                $model->tat = $model->calculateTAT();
            }
        });
    }

    // This method calculates the TAT
    public function calculateTAT()
    {
        $start = Carbon::parse($this->start);
        $end = Carbon::parse($this->end);

        // Calculate the difference
        $tat = $start->diff($end);

        // Format the difference
        $formattedTAT = sprintf('%02d:%02d', $tat->i, $tat->s);
        return $formattedTAT;
    }
}
