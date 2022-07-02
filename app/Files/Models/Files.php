<?php

namespace App\Files\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Files\Models\Files
 *
 * @property int $id
 * @property string $name
 * @property string $file_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Files newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Files newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Files query()
 * @method static \Illuminate\Database\Eloquent\Builder|Files whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Files whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Files whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Files whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Files whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Files extends Model
{
}
