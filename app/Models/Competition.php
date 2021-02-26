<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'competitions';

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
    protected $fillable = ['name'];

    public function team()
    {
        return $this->hasMany(TeamProfile::class, 'competition_id', 'id');
    }

    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'competition_id', 'id');
    }

    public function instructions()
    {
        return $this->hasMany(Instruction::class, 'competition_id', 'id');
    }
}
