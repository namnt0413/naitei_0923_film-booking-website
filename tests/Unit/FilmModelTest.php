<?php

namespace Tests\Unit;

use App\Models\Film;
use App\Models\Genre;
use App\Models\Media;
use App\Models\Room;
use App\Models\Screening;
use App\Models\Seat;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Unit\ModelTestCase as TestCase;

class FilmModelTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $film;
    protected $itemsCount = 5;

    protected function setUp(): void
    {
        parent::setUp();
        User::factory()->create();
        $this->film = Film::factory()->create();
        $genres = Genre::factory($this->itemsCount)->create();
        foreach ($genres as $genre) {
            $this->film->genres()->attach($genre->id);
        }
        Media::factory($this->itemsCount)->create();
        Room::factory($this->itemsCount)->create();
        Seat::factory($this->itemsCount)->create();
        Screening::factory($this->itemsCount)->create();
        Ticket::factory($this->itemsCount)->create();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
    
    public function testConfigurationAssertion()
    {
        $this->runConfigurationAssertion(Film::class, [], [], [
            'id',
            'created_at',
            'updated_at',
        ], [], [
            'id' => 'int',
        ], [
            'created_at',
            'updated_at'
        ], Collection::class, 'films');
    }

    public function testFilmHasManyGenres()
    {
        $this->assertEquals($this->itemsCount, $this->film->genres->count());
        $this->assertInstanceOf(BelongsToMany::class, $this->film->genres());
        foreach ($this->film->genres as $genre) {
            $this->assertInstanceOf(Genre::class, $genre);
        }
    }

    public function testFilmHasManyMedias()
    {
        $this->assertEquals($this->itemsCount, $this->film->medias->count());
        $this->assertInstanceOf(HasMany::class, $this->film->medias());
        foreach ($this->film->medias as $media) {
            $this->assertInstanceOf(Media::class, $media);
        }
    }

    public function testFilmHasManyTickets()
    {
        $this->assertEquals($this->itemsCount, $this->film->tickets->count());
        $this->assertInstanceOf(HasMany::class, $this->film->tickets());
        foreach ($this->film->tickets as $ticket) {
            $this->assertInstanceOf(Ticket::class, $ticket);
        }
    }

    public function testFilmHasManyScreenings()
    {
        $this->assertEquals($this->itemsCount, $this->film->screenings->count());
        $this->assertInstanceOf(HasMany::class, $this->film->screenings());
        foreach ($this->film->screenings as $screening) {
            $this->assertInstanceOf(Screening::class, $screening);
        }
    }
}
