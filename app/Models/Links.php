<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property array|string name
 * @property array|string link
 * @property array|string email
 * @property array|string sort
 */
class Links extends Model
{
    protected $table = 'links';

    protected $primaryKey = 'id';
}
