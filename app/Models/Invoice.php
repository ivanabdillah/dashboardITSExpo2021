<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'invoices';

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
        'team_id',
        'payment_timestamp',
        'payment_proof',
        'promo_id',
        'approver_id',
        'approved_at'
    ];

    public function approver()
    {
        return $this->belongsTo(InternalProfile::class, 'approver_id', 'id');
    }

    public function promo()
    {
        return $this->belongsTo(Promo::class);
    }

    public function team()
    {
        return $this->belongsTo(TeamProfile::class, 'team_id', 'id');
    }
}
