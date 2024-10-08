<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'order_id';

    use HasFactory;
    protected $quarded = [];
    public function event()
    {
        return $this->belongsTo(Events::class, 'event_id');
    }
}
