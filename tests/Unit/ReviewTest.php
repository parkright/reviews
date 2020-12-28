<?php

namespace Parkright\Reviews\Tests\Unit;

use App\ParkRight\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Parkright\Reviews\Actions\CreateReviewAction;
use Parkright\Reviews\Models\Review;
use Parkright\Reviews\Tests\Models\DummyModel;
use Parkright\Reviews\Tests\Models\User;

class ReviewTest extends \Parkright\Reviews\Tests\TestCase
{
    use RefreshDatabase;

    public $model;


    public function setUp(): void
    {
        parent::setUp();

        $this->model = DummyModel::factory()->create();

    }

    public function test_a_new_review_can_be_created()
    {
        Review::factory()->create();

        $this->assertCount(1, Review::all());
    }

    public function test_a_model_can_be_reviewed()
    {
        (new CreateReviewAction)->execute(Review::factory()->create(), $this->model);

        $this->assertCount(1, $this->model->reviews);
    }

    public function test_a_review_rating_cannot_be_less_than_1()
    {
        $this->expectException(ValidationException::class);

        (new CreateReviewAction)->execute(Review::factory()->create(['rating' => 0]), $this->model);
    }

    public function test_a_review_rating_cannot_be_greater_than_5()
    {
        $this->expectException(ValidationException::class);

        (new CreateReviewAction)->execute(Review::factory()->create(['rating' => 6]), $this->model);
    }

    public function test_a_review_must_have_a_body()
    {
        $this->expectException(ValidationException::class);

        (new CreateReviewAction)->execute(Review::factory()->make(['body' => null]), $this->model);
    }

    public function test_a_user_can_be_assigned_to_a_review()
    {
        $user = User::factory()->create();

        (new CreateReviewAction)->execute(Review::factory()
            ->create([
                'user_id' => $user->id,
                'author' => $user->name
            ]), $this->model);

        $reviewsForUser = Review::where('user_id', $user->id)->get();

        $this->assertCount(1, $reviewsForUser);
    }

    public function test_a_guest_can_create_a_review()
    {
        (new CreateReviewAction)->execute(Review::factory()->make(['user_id' => null]), $this->model);

        $reviews = Review::all();

        $this->assertCount(1, $reviews);

        $this->assertEquals(null, $reviews[0]->user_id);
    }
}
