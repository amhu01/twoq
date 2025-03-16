<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Company extends Model
{
    use SoftDeletes;
    protected $table = 'companies';

    protected $primaryKey = 'id';

    const UPDATED_AT = 'updated_at';

    const CREATED_AT = 'created_at';

    const DELETED_AT = 'deleted_at';

    protected $fillable = [
        'comp_name',
        'comp_email',
        'comp_logo',
        'comp_website',
        'update_by',
        'created_by',
        'deleted_by',
    ];


}
