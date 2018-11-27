<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * @property string  latitude
 * @property string  address
 * @property string  url
 * @property string longitude
 * @property  string ip
 * @property string name
 */
class VisitLog extends Model
{
    protected $table = 'visit_log';

    protected $primaryKey = 'id';

}