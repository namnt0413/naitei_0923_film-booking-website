<?php

namespace Tests\Unit;

use App\Models\Ticket;
use App\Models\User;
use App\Models\Film;
use App\Models\Screening;
use App\Models\Room;
use App\Models\Seat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Unit\ModelTestCase as TestCase;

class TicketModelTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $ticket;
    protected $itemsCount = 3;

    protected function setUp(): void
    {
        parent::setUp();
        Film::factory($this->itemsCount)->create();
        User::factory($this->itemsCount)->create();
        Room::factory($this->itemsCount)->create();
        Screening::factory($this->itemsCount)->create();
        Seat::factory($this->itemsCount)->create();
        $this->ticket = Ticket::factory()->create();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testModelConfiguration()
    {
        $this->runConfigurationAssertion(Ticket::class, [], [], [
            'id',
            'created_at',
            'updated_at',
        ], [], [
            'id' => 'int',
        ]);
    }

    public function testTicketBelongsToUser()
    {
        $this->assertTrue(User::count() > 0);
        $this->assertInstanceOf(User::class, $this->ticket->user);
    }

    public function testTicketBelongsToFilm()
    {
        $this->assertInstanceOf(Film::class, $this->ticket->film);
    }

    public function testTicketBelongsToScreening()
    {
        $this->assertInstanceOf(Screening::class, $this->ticket->screening);
    }

    public function testTicketBelongsToSeat()
    {
        $this->assertInstanceOf(Seat::class, $this->ticket->seat);
    }
}
