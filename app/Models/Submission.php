<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'submissions';

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
        'description',
        'path',
        'team_id',
        'instruction_id',
        'status'
    ];

    public function team()
    {
        return $this->belongsTo(TeamProfile::class, 'team_id', 'id');
    }

    public function instruction()
    {
        return $this->belongsTo(Instruction::class, 'instruction_id', 'id');
    }
}
