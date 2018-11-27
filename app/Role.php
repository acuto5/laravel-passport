<?php

declare(strict_types = 1);

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @package App
 */
class Role extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'discount',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'discount' => 'float',
    ];
}
