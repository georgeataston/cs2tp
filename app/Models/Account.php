<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "accounts";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = "aid";

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

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function resets(): HasMany
    {
        return $this->hasMany(PasswordReset::class);
    }

    public function orders(): HasMany {
        return $this->hasMany(Order::class);
    }

    public function orderCount(): int {
        return Order::where('user_id', '=', $this->aid)->get()->count();
    }
}
