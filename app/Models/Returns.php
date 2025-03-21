<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Returns extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "returns";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = "id";

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public function items(): HasMany {
        return $this->hasMany(ReturnItem::class, 'return_id');
    }

    public function order(): HasOne {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }

    public function statusText(): string {
        if ($this->status == 0)
            return "New";
        else if ($this->status == 1)
            return "Denied";
        else if ($this->status == 2)
            return "Partially Approved";
        else if ($this->status == 3)
            return "Approved";
        else if ($this->status == 4)
            return "Refunded";
        else if ($this->status == 5)
            return "Denied (returned to customer)";
        else
            return "Unknown";
    }
}
