<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'details',
        'title',
        'user_id'
    ];

    public function author()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function tasks(){
        return $this->hasMany(Tasks::class,'project_id');
    }
}
