<?php

namespace Tests\Unit;

use App\Http\Controllers\SeatController;
use App\Models\Role;
use App\Models\Room;
use App\Models\Seat;
use App\Models\User;
use App\Repositories\SeatRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Request;
use Illuminate\View\View;
use Tests\TestCase;
use Mockery;

class SeatControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $seatController;
    protected $seatRepository;

    protected $user;
    protected $seat;
    protected $room;

    protected function setUp(): void
    {
        parent::setUp();
        Role::insert([['id' => 1, 'name' => 'admin'], ['id' => 2, 'name' => 'user']]);
        $this->user = User::factory()->create(['role_id' => 1]);
        $this->seatRepository = Mockery::mock(SeatRepository::class)->makePartial();
        $this->seatController = new SeatController($this->seatRepository);
        $this->room = Room::factory()->create();
        $this->seat = Seat::factory()->create();
    }

    protected function tearDown(): void
    {
        unset($this->seatController);
        Mockery::close();
        parent::tearDown();
    }
    
    public function testIndexFunction()
    {
        $request = new Request();
        $this->actingAs($this->user);
        $response = $this->seatController->index($request);

        $this->assertInstanceOf(View::class, $response);
    }

    public function testCreateFunction()
    {
        $response = $this->seatController->create();

        $this->assertInstanceOf(View::class, $response);
    }

    public function testStoreFunction()
    {
        $response = $this->actingAs($this->user)->post("/admin/seats", [
            "name" => "test 1",
            "room_id" => $this->room->id,
            "price_ratio" => 1.2,
            "type" => "couple"
        ]);

        $response->assertStatus(302);
    }

    public function testShowFunction()
    {
        $response = $this->seatController->show($this->seat);

        $this->assertInstanceOf(View::class, $response);
    }

    public function testEditFunction()
    {
        $response = $this->seatController->edit($this->seat);

        $this->assertInstanceOf(View::class, $response);
    }

    public function testUpdateFunction()
    {
        $response = $this->actingAs($this->user)->put("/admin/seats/{$this->seat->id}", [
            "name" => "test 1",
            "room_id" => $this->room->id,
            "price_ratio" => 1.2,
            "type" => "couplessss"
        ]);

        $response->assertStatus(302);
        $response->assertInvalid(['type']);
    }

    public function testSearchByRoomFunction()
    {
        $response = $this->get("/seats/{$this->room->id}/search");

        $response->assertStatus(200);
    }

    public function testDeleteFunction()
    {
        $response = $this->delete("/admin/seats/{$this->seat}");

        $response->assertStatus(302);
    }
}
