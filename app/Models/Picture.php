<?php

namespace App\Models;

use App\Models\Model;

/**
 * App\Models\Picture
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $path
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Picture newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Picture newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Picture query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Picture whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Picture whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Picture wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Picture whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Picture extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'path',
    ];
}
