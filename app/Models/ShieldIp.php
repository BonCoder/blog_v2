<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * @property array|string remark
 * @property array|string ip
 */
class ShieldIp extends Model
{
    protected $table = 'shield_ip';

    protected $primaryKey = 'id';

}