<?php

namespace Tests\Unit;

use App\Models\Media;
use App\Models\Film;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Unit\ModelTestCase as TestCase;

class MediaModelTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $media;
    protected $itemsCount = 3;

    protected function setUp(): void
    {
        parent::setUp();
        Film::factory($this->itemsCount)->create();
        $this->media = Media::factory()->create();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testModelConfiguration()
    {
        $this->runConfigurationAssertion(Media::class, [], [], [
            'id',
            'created_at',
            'updated_at',
        ], [], [
            'id' => 'int',
        ]);
    }

    public function testMediaBelongsToFilm()
    {
        $this->assertInstanceOf(Film::class, $this->media->film);
    }
}
