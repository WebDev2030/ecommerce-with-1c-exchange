<?php

namespace App\Catalog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Catalog\Models\PriceType
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string $code
 * @property string $external_id
 * @property int $catalog_currency_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Catalog\Models\Currency[] $currency
 * @property-read int|null $currency_count
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType query()
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType whereCatalogCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType whereExternalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $active
 * @method static \Illuminate\Database\Eloquent\Builder|PriceType whereActive($value)
 */
class PriceType extends Model
{
    use HasFactory;

    protected $table = 'catalog_price_types';

    protected $fillable = [
        'active',
        'name',
        'external_id'
    ];

    public function currency(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Currency::class, 'catalog_currency_id');
    }
}
