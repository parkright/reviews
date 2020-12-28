<?php
namespace Parkright\Reviews\Tests\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Parkright\Reviews\Models\Concerns\Reviewable;
use Parkright\Reviews\Tests\Database\Factories\UserFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return UserFactory::new();
    }



}
