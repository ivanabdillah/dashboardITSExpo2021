<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    use HasFactory;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'instructions';

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
        'title',
        'content',
        'competition_id',
        'dependency_id'
    ];

    public function competition()
    {
        return $this->belongsTo(Competition::class, 'competition_id', 'id');
    }

    public function dependency()
    {
        return $this->hasOne(Instruction::class, 'dependency_id', 'id');
    }
}
