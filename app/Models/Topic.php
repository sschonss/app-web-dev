<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['title', 'content', 'finished'];

    protected $casts = [
        'finished' => 'boolean',
    ];

    public static function unfinished()
    {
        return self::where('finished', false);
    }

    public function finished($query): Builder
    {
        return $query->where('finished', true);
    }
}
