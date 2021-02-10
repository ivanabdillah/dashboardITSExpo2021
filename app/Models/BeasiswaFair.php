<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeasiswaFair extends Model
{
    use HasFactory;
    protected $fillable=['name','email','instansi','phone','twibbon_path','instagram_path','story_path'];
}
