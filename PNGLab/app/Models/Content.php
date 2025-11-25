<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model {
    protected $fillable = ['course_id','title','body','media_url','order','teacher_id'];

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function progress() {
        return $this->hasMany(ContentProgress::class);
    }

    public function teacher() {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
