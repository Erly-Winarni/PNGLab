<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\User;
use App\Models\Content;
use App\Models\Category;
use App\Models\Course;


class User extends Authenticatable {
    use Notifiable;

    protected $fillable = [
        'name','email','password','role','is_active','avatar'
    ];

    protected $hidden = ['password','remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];
    
    public function coursesTeaching() {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    public function courses() {
        return $this->belongsToMany(Course::class, 'course_user', 'user_id', 'course_id')
                    ->withPivot('enrolled_at')
                    ->withTimestamps();
    }

    public function contentProgress()
    {
        return $this->belongsToMany(Content::class, 'content_progress')
            ->withPivot(['is_done', 'done_at'])
            ->withTimestamps();
    }

    public function isAdmin() { return $this->role === 'admin'; }
    public function isTeacher() { return $this->role === 'teacher'; }
    public function isStudent() { return $this->role === 'student'; }
}
