<?php

namespace Tests\Unit;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\Unit\ModelTestCase as TestCase;

class RoleModelTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $role;
    protected $itemsCount = 3;

    protected function setUp(): void
    {
        parent::setUp();
        $this->role = Role::factory()->create(['name' => 'user']);
        User::factory($this->itemsCount)->create(['role_id' => $this->role->id]);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

    public function testModelConfiguration()
    {
        $this->runConfigurationAssertion(Role::class, [
            'name',
        ], [], ['*'], [], [
            'id' => 'int',
        ]);
    }

    public function testRoleHasManyUsers()
    {
        $this->assertEquals($this->itemsCount, $this->role->users->count());
        $this->assertInstanceOf(HasMany::class, $this->role->users());
        foreach ($this->role->users as $user) {
            $this->assertInstanceOf(User::class, $user);
        }
    }
}
