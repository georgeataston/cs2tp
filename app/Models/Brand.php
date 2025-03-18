<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Brand extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "brands";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = "bid";

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

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, "brand_id");
    }

    public function categoryCount(): int {
        return Category::where('brand_id', '=', $this->bid)->where('deleted', '=', '0')->get()->count();
    }

    public function stockCount(): int {
        $amt = 0;
        $categories = Category::where('brand_id', '=', $this->bid)->where('deleted', '=', '0')->get();
        foreach ($categories as $category) {
            $amt += Stock::where('category_id', '=', $category->cid)->where('deleted', '=', '0')->get()->count();
        }

        return $amt;
    }
}
