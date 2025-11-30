<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Str;

class Course extends Model {
    protected $fillable = [
        'title','slug','description','category_id','teacher_id','start_date','end_date','is_active','max_students'
    ];

    public function teacher() {
        return $this->belongsTo(User::class,'teacher_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id');
    }

    public function contents()
    {
        return $this->hasMany(\App\Models\Content::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function progressFor(User $user) {
        $total = $this->contents()->count();
        if ($total === 0) return 0;
        $done = \DB::table('content_progress')
            ->join('contents','content_progress.content_id','=','contents.id')
            ->where('contents.course_id',$this->id)
            ->where('content_progress.user_id',$user->id)
            ->where('content_progress.is_done',true)
            ->count();

        return intval(($done / $total) * 100);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($course) {
            $slug = Str::slug($course->title);

            // Cek apakah slug sudah ada
            $count = Course::where('slug', 'like', $slug . '%')->count();

            // Jika sudah ada, tambahkan angka di akhir
            $course->slug = $count ? "{$slug}-{$count}" : $slug;
        });
    }
}
