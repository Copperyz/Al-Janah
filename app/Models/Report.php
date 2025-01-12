<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name','description', 'model', 'columns', 'filters','report_template_id'];

    public function reportTemplates()
    {
        return $this->belongsTo(ReportTemplate::class);
    }
}
