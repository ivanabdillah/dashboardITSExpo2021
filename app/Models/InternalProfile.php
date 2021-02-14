<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalProfile extends Model
{
    use HasFactory;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'internal_profiles';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'division'
    ];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function approve()
    {
        return $this->hasMany(Invoice::class, 'approver_id', 'id');
    }
}
