<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamProfile extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'team_profiles';

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
        'team_name',
        'college_name',
        'ketua_id',
        'anggota1_id',
        'anggota2_id',
        'competition_id'
    ];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }

    public function anggotaPertama()
    {
        return $this->belongsTo(TeamMember::class, 'anggota1_id', 'id');
    }

    public function anggotaKedua()
    {
        return $this->belongsTo(TeamMember::class, 'anggota2_id', 'id');
    }

    public function ketua()
    {
        return $this->belongsTo(TeamMember::class, 'ketua_id', 'id');
    }

    public function submission()
    {
        return $this->hasOne(Submission::class, 'team_id', 'id');
    }
}
