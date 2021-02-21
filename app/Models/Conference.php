<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    use HasFactory;

    protected $table = 'conferences';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'instansi',
        'phone',
        'twibbon_path',
        'instagram_path',
        'story_path',
        'payment_proof',
        'approver_id',
        'approved_at',
    ];

    public function approver()
    {
        return $this->belongsTo(InternalProfile::class, 'approver_id', 'id');
    }
}
