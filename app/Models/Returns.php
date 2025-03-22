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
            return "Pending";
        else if ($this->status == 2)
            return "Denied";
        else if ($this->status == 3)
            return "Partially Approved";
        else if ($this->status == 4)
            return "Approved";
        else if ($this->status == 5)
            return "Refunded";
        else if ($this->status == 6)
            return "Denied (returned to customer)";
        else if ($this->status == 7)
            return "Partially Refunded";
        else
            return "Unknown";
    }

    public function canSignOff(): bool {
        if ($this->status != 1)
            return false;

        $can = true;
        foreach($this->items as $item) {
            if ($item->status != 1 && $item->status != 4 && $item->status != 5) {
                $can = false;
            }
        }

        return $can;
    }
}
