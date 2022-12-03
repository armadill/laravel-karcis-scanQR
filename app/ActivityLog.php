<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
class ActivityLog extends Model
{
    use LogsActivity;
    protected $table =  'activity_log';
    protected $dates = [
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'causer_id');
    }
}
