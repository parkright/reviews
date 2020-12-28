<?php
namespace Parkright\Reviews\Tests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Parkright\Reviews\Tests\Database\Factories\DummyModelFactory;
use Parkright\Reviews\Models\Concerns\Reviewable;

class DummyModel extends \Illuminate\Database\Eloquent\Model
{
    use Reviewable, HasFactory;

    protected $table = 'dummy_model';

    protected $guarded = [];

    protected static function newFactory()
    {
        return DummyModelFactory::new();
    }


}
