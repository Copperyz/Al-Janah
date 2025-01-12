<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ReportTemplate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['type', 'template', 'is_visible'];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
