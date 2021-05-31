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
        $review = ['rating' => 5, 'body' => 'Awesome product'];

        $this->model->addReview($review);

        $this->assertCount(1, $this->model->reviews);
    }

    public function test_a_review_rating_cannot_be_less_than_1()
    {
        $this->expectException(ValidationException::class);

        $this->model->addReview(Review::factory()->create(['rating' => 0]));
    }

    public function test_a_review_rating_cannot_be_greater_than_5()
    {
        $this->expectException(ValidationException::class);

        $this->model->addReview(Review::factory()->create(['rating' => 6]));
    }

    public function test_a_review_must_have_a_body()
    {
        $this->expectException(ValidationException::class);

        $this->model->addReview(Review::factory()->make(['body' => null]));
    }

    public function test_a_user_can_be_assigned_to_a_review()
    {
        $user = User::factory()->create();

       $this->model->addReview(Review::factory()
            ->create([
                'user_id' => $user->id,
                'author' => $user->name
            ]));

        $reviewsForUser = Review::where('user_id', $user->id)->get();

        $this->assertCount(1, $reviewsForUser);
    }

    public function test_a_guest_can_create_a_review()
    {
        $this->model->addReview(Review::factory()->make(['user_id' => null]));

        $reviews = Review::all();

        $this->assertCount(1, $reviews);

        $this->assertEquals(null, $reviews[0]->user_id);
    }

    public function test_a_model_has_an_average_rating()
    {
        $this->model->addReview(Review::factory()->make(['rating' => 5]));
        $this->model->addReview(Review::factory()->make(['rating' => 1]));

        $this->assertEquals(3, $this->model->rating());
    }

    public function test_a_model_has_a_review_count()
    {
        $this->model->addReview(Review::factory()->create());
        $this->model->addReview(Review::factory()->create());
        $this->model->addReview(Review::factory()->create());

        $this->assertEquals(3, $this->model->reviewCount());
    }

    public function test_a_review_is_not_published_by_default()
    {
        $this->model->addReview(['rating' => 1, 'body' => 'Terrible product']);

        $this->assertFalse($this->model->reviews->first()->isPublished());
    }

    public function test_a_review_is_published()
    {
        $this->model->addReview(['rating' => 5, 'body' => 'Awesome product', 'published' => true]);

        $this->assertTrue($this->model->reviews->first()->isPublished());
    }

    public function test_publishing_a_review()
    {
        $this->model->addReview(['rating' => 5, 'body' => 'Awesome product']);

        $review = $this->model->reviews->first();

        $this->assertFalse($review->isPublished());

        $review->publish();

        $this->assertTrue($review->isPublished());
    }
}
