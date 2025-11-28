<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model {
    protected $fillable = [
    'course_id','title','body','media_url','media_type','media_path','order','teacher_id'];

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function completedBy()
    {
        return $this->belongsToMany(User::class, 'content_progress')
            ->withPivot(['is_done', 'done_at'])
            ->withTimestamps();
    }

    public function getIsCompletedAttribute()
    {
        $user = auth()->user();
        if (!$user) return false;

        return $this->completedBy()
            ->wherePivot('is_done', true)
            ->where('user_id', $user->id)
            ->exists();
    }

    public function teacher() {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function getYoutubeId()
    {
        $url = $this->media_url;

        // youtu.be short link
        if (preg_match('/youtu\.be\/([^\?]+)/', $url, $m)) {
            return $m[1];
        }

        // youtube.com/watch?v=
        if (preg_match('/v=([^&]+)/', $url, $m)) {
            return $m[1];
        }

        // embed links
        if (preg_match('/embed\/([^?]+)/', $url, $m)) {
            return $m[1];
        }

        return null;
    }

}
