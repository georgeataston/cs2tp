<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Feature extends Model
{
    use HasFactory;

    protected $table = 'features';
    protected $primaryKey = 'fid';
    public $incrementing = true;
    public $timestamps = true;

    public function item(): BelongsTo
    {
        return $this->belongsTo(Stock::class, "stock_id", "id");
    }
}
