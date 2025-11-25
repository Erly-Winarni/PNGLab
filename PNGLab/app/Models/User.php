<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
    
    // relations
    public function coursesTeaching() {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    public function coursesEnrolled() {
        return $this->belongsToMany(Course::class)->withTimestamps()->using(\App\Models\CourseUser::class);
    }

    public function contentProgress()
    {
        return $this->hasMany(ContentProgress::class);
    }

    public function courses() {
        return $this->belongsToMany(\App\Models\Course::class, 'course_user')
                    ->withTimestamps();
    }

    // role helpers
    public function isAdmin() { return $this->role === 'admin'; }
    public function isTeacher() { return $this->role === 'teacher'; }
    public function isStudent() { return $this->role === 'student'; }
}
