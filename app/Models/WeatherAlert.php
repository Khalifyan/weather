<?php
namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $city
 * @property string $precipitation_threshold
 * @property string $uv_threshold
 * @property User $user
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class WeatherAlert extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'city', 'precipitation_threshold', 'uv_threshold'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
