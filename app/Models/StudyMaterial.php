<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;


#[Fillable(['title', 'subject_id', 'course_id', 'sub_cat_course_id', 'due_date','type', 'target_class', 'description', 'posted_by', 'file_path', 'file_size', 'page_count', 'posted_by'])]

class StudyMaterial extends Model
{
    public function uploader()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    // Relation: Downloader logs tree mapping
    public function downloadLogs()
    {
        return $this->hasMany(DownloadLog::class, 'study_material_id');
    }

    // Relation: Course Entity Node mapping
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // Relation: SubCategory mapping
    public function subCategory()
    {
        return $this->belongsTo(CourseSubCategory::class, 'sub_cat_course_id');
    }
}
