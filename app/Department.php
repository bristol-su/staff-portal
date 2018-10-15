<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Department extends Model
{
    use SoftDeletes;
    public function users() {
        return $this->belongsToMany('\App\User');
    }

    public function shortcuts() {
        return $this->belongsToMany('\App\DepartmentShortcut');
    }
}
