<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Information extends Model {

    protected $guarded = [];
    use HasFactory;

    public function storages()
    {
        return $this->belongsToMany(Storage::class)->withPivot("quantity")->withTimestamps();
    }

    public function getQuantity()
    {

        return $this->storages()->first()->pivot->quantity;
    }

    public function getPublishAttribute()
    {
        return Carbon::createFromFormat("Y-m-d", $this->publish_at)->format('d/m/y');
    }

}
