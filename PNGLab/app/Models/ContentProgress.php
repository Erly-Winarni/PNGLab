<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentProgress extends Model {
    protected $table = 'content_progress';
    protected $fillable = ['content_id','user_id','is_done','done_at'];

    protected $casts = ['is_done' => 'boolean', 'done_at' => 'datetime'];

    public function content() { return $this->belongsTo(Content::class); }
    public function user() { return $this->belongsTo(User::class); }
}
