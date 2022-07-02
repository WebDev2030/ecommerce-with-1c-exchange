<?php

namespace App\Catalog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Catalog\Models\Currency
 *
 * @mixin \Eloquent
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property int $base
 * @property float $rate
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereBase($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency query()
 * @property string $code
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCode($value)
 * @property string $external_id
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereExternalId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Catalog\Models\PriceType[] $priceTypes
 * @property-read int|null $price_types_count
 */
class Currency extends Model
{
    use HasFactory;

    protected $table = 'catalog_currencies';

    protected $fillable = [
        'name',
        'base' ,
        'rate'
    ];

    public function priceTypes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(PriceType::class);
    }
}
