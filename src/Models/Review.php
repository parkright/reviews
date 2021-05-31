<?php

namespace Parkright\Reviews\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Parkright\Reviews\Database\Factories\ReviewFactory;

class Review extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = ['published' => 'boolean'];

    public function model()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected static function newFactory()
    {
        return \Parkright\Reviews\Database\Factories\ReviewFactory::new();
    }

    public function publish()
    {
        $this->update(['published' => true]);
    }

    public function isPublished()
    {
        return !!$this->published;
    }




}
