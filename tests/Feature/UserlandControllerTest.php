<?php

namespace Kontenta\KontourSupport\Tests\Feature;

use Illuminate\Support\Facades\Event;
use Kontenta\KontourSupport\AdminLink;
use Kontenta\KontourSupport\Tests\Feature\Fakes\User;
use Kontenta\KontourSupport\Tests\UserlandAdminToolTest;
use Kontenta\Kontour\EditAdminVisit;
use Kontenta\Kontour\Events\AdminToolVisited;
use Kontenta\Kontour\ShowAdminVisit;

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
        $response->assertSee('<a href="' . route('userland.index') . '">Userland Tool</a>');
        $response->assertSee('>main<');
        Event::assertDispatched(AdminToolVisited::class, function ($e) {
            $now = new \DateTimeImmutable();
            return $e->visit->getLink()->getUrl() == route('userland.index') and
            $this->user->is($e->visit->getUser()) and
            $now->getTimestamp() - $e->visit->getDateTime()->getTimestamp() >= 0;
        });
    }

    public function test_recent_visits_widgets()
    {
        $otherUser = factory(User::class)->create();
        $link = new AdminLink(route('userland.edit'), 'Recent Userland Tool');
        $visit = new EditAdminVisit($link, $this->user);
        event(new AdminToolVisited($visit));
        event(new AdminToolVisited($visit));
        $link = new AdminLink(route('userland.index'), 'Other Recent Userland Tool');
        $visit = new ShowAdminVisit($link, $otherUser);
        event(new AdminToolVisited($visit));
        $link = new AdminLink(route('userland.edit'), 'Other Recent Userland Tool');
        $visit = new EditAdminVisit($link, $otherUser);
        event(new AdminToolVisited($visit));
        event(new AdminToolVisited($visit));

        $response = $this->actingAs($this->user)->get(route('userland.index'));

        $response->assertOk();

        // Check personal links
        $response->assertSee('<aside data-kontour-widget="PersonalRecentVisitsWidget">');
        $response->assertSee('<header>Recent</header>');

        $numberOfMatches = substr_count($response->content(), '<li data-kontour-visit-type="show"><a href="' . route('userland.index') . '">Recent Userland Tool</a>');
        $this->assertEquals(1, $numberOfMatches);

        $numberOfMatches = substr_count($response->content(), '<li data-kontour-visit-type="edit"><a href="' . route('userland.edit') . '">Recent Userland Tool</a>');
        $this->assertEquals(1, $numberOfMatches);

        // Check team links
        $response->assertSee('<aside data-kontour-widget="TeamRecentVisitsWidget">');
        $response->assertSee('<header>Team Recent</header>');

        $numberOfMatches = substr_count($response->content(), '<li data-kontour-visit-type="edit" data-kontour-username="' . $otherUser->getDisplayName() . '"><a href="' . route('userland.edit') . '">Other Recent Userland Tool</a>');
        $this->assertEquals(1, $numberOfMatches);

        $response->assertDontSee('<a href="' . route('userland.index') . '">Other Recent Userland Tool</a>');
    }
}
