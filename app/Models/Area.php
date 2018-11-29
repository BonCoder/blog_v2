<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * @property array|string name
 * @property array|int value
 */
class Area extends Model
{
    protected $table = 'area';

    protected $primaryKey = 'id';

}