<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ReturnItem extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "return_items";

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

    public function return(): HasOne {
        return $this->hasOne(Returns::class, 'id', 'return_id');
    }

    public function orderItem(): HasOne {
        return $this->hasOne(OrderItem::class, 'id', 'order_item_id');
    }

    public function statusText(): string {
        if ($this->status == 0)
            return "New";
        else if ($this->status == 1)
            return "Denied";
        else if ($this->status == 2)
            return "Approved";
        else if ($this->status == 3)
            return "Received";
        else if ($this->status == 4)
            return "Refunded";
        else if ($this->status == 5)
            return "Denied (returned to customer)";
        else
            return "Unknown";
    }

    public function buttonStatusText(): string {
        if ($this->status == 1)
            return "Denial";
        else if ($this->status == 2)
            return "Approval";
        else
            return "Action";
    }
}
