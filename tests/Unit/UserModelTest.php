<?php

namespace Tests\Unit;

use App\Models\Film;
use App\Models\Role;
use App\Models\Room;
use App\Models\Screening;
use App\Models\Seat;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Unit\ModelTestCase as TestCase;

class UserModelTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    protected $user;
    protected $itemsCount = 3;

    protected function setUp(): void
    {
        parent::setUp();
        Role::insert([['id' => 1, 'name' => 'admin'], ['id' => 2, 'name' => 'user']]);
        $this->user = User::factory()->create(['first_name' => 'kiet', 'last_name' => 'vu tuan']);
        Film::factory()->create();
        Room::factory()->create();
        Seat::factory()->create();
        Screening::factory()->create();
        Ticket::factory($this->itemsCount)->create();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }
    
    public function testModelConfiguration()
    {
        $this->runConfigurationAssertion(User::class, [
        ], [
            'password',
            'remember_token',
        ], [
            'role_id',
        ], [], [
            'email_verified_at' => 'datetime',
            'id' => 'int',
        ]);
    }

    public function testUserAccessorsMutators()
    {
        $this->assertEquals('Kiet Vu Tuan', $this->user->getFullNameAttribute());
        $this->assertEquals('Vu Tuan', $this->user->getAttributeValue('last_name'));
        $this->assertEquals('Kiet', $this->user->getAttributeValue('first_name'));
    }

    public function testUserBelongsToRole()
    {
        $this->assertInstanceOf(Role::class, $this->user->role);
    }

    public function testUserHasManyTickets()
    {
        $this->assertEquals($this->itemsCount, $this->user->tickets->count());
        $this->assertInstanceOf(HasMany::class, $this->user->tickets());
        foreach ($this->user->tickets as $ticket) {
            $this->assertInstanceOf(Ticket::class, $ticket);
        }
    }
}
