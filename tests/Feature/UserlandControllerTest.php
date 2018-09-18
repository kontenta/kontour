<?php

namespace Kontenta\KontourSupport\Tests\Feature;

use Illuminate\Support\Facades\Event;
use Kontenta\Kontour\Events\AdminToolShowVisited;
use Kontenta\KontourSupport\Tests\UserlandAdminToolTest;
use Kontenta\KontourSupport\Tests\Feature\Fakes\User;

class UserlandControllerTest extends UserlandAdminToolTest
{
    /**
     * @var User
     */
    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->prepareDatabase();
        $this->user = factory(User::class)->create();
    }

    public function test_index_route()
    {
        Event::fake();

        $response = $this->actingAs($this->user)->get(route('userland.index'));
        
        $response->assertSee('<main');
        $response->assertSee('UserlandAdminWidget');
        $response->assertDontSee('UnauthorizedWidget');
        $response->assertSee('<a href="'.route('userland.index').'">Userland Tool</a>');
        $response->assertSee('>main<');
        Event::assertDispatched(AdminToolShowVisited::class, function($e) {
            $now = new \DateTimeImmutable();
            return $e->visit->getLink()->getUrl() == route('userland.index') and
                $this->user->is($e->visit->getUser()) and
                $now->getTimestamp() - $e->visit->getDateTime()->getTimestamp() >= 0;
        });
    }

    public function test_recent_links_widget()
    {
        $response = $this->actingAs($this->user)->get(route('userland.index'));
        $response->assertSee('<a href="'.route('userland.index').'">Recent Userland Tool</a>');
    }
}
