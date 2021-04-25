<?php

namespace App\Models;

use App\Http\Livewire\Admin\Information\Sales;
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

    public function sales()
    {
        return $this->belongsToMany(Storage::class,"information_sales")->withPivot("quantity","total","offer")->withTimestamps();
    }


    public function scopeStorageAdd($query)
    {
        return $query->whereType("add");
    }

    public function scopeStorageRemove($query)
    {
        return $query->whereType("remove");
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
