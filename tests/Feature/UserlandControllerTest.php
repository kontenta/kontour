<?php

namespace Kontenta\Kontour\Tests\Feature;

use Illuminate\Support\Facades\Event;
use Kontenta\Kontour\AdminLink;
use Kontenta\Kontour\Tests\Feature\Fakes\User;
use Kontenta\Kontour\Tests\UserlandAdminToolTest;
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

        Event::assertDispatched(AdminToolVisited::class, function ($e) {
            $now = new \DateTimeImmutable();
            return $e->visit->getLink()->getUrl() == route('userland.index') and
            $this->user->is($e->visit->getUser()) and
            $now->getTimestamp() - $e->visit->getDateTime()->getTimestamp() >= 0;
        });
    }

    public function test_menu_widget()
    {
        $response = $this->actingAs($this->user)->get(route('userland.index'));

        $response->assertSee('<ul data-kontour-widget="menu">');
        $response->assertSee('>main<');
        $response->assertSee('<a href="' . route('userland.index') . '">Userland Tool</a>');
    }

    public function test_recent_visits_widgets()
    {
        $otherUser = factory(User::class)->create();
        $link = new AdminLink(route('userland.edit', 1), 'Recent Userland Tool');
        $visit = new EditAdminVisit($link, $this->user);
        event(new AdminToolVisited($visit));
        event(new AdminToolVisited($visit));
        $link = new AdminLink(route('userland.index'), 'Other Recent Userland Tool');
        $visit = new ShowAdminVisit($link, $otherUser);
        event(new AdminToolVisited($visit));
        $link = new AdminLink(route('userland.edit', 1), 'Other Recent Userland Tool');
        $visit = new EditAdminVisit($link, $otherUser);
        event(new AdminToolVisited($visit));
        event(new AdminToolVisited($visit));

        $response = $this->actingAs($this->user)->get(route('userland.index'));

        $response->assertSuccessful();

        // Check personal links
        $response->assertSee('<aside data-kontour-widget="personalRecentVisits">');
        $response->assertSee('<header>Recent</header>');

        $numberOfMatches = substr_count($response->content(), '<li data-kontour-visit-type="show"><a href="' . route('userland.index') . '">Recent Userland Tool</a>');
        $this->assertEquals(1, $numberOfMatches);

        $numberOfMatches = substr_count($response->content(), '<li data-kontour-visit-type="edit"><a href="' . route('userland.edit', 1) . '">Recent Userland Tool</a>');
        $this->assertEquals(1, $numberOfMatches);

        // Check team links
        $response->assertSee('<aside data-kontour-widget="teamRecentVisits">');
        $response->assertSee('<header>Team Recent</header>');

        $numberOfMatches = substr_count($response->content(), '<li data-kontour-visit-type="edit" data-kontour-username="' . $otherUser->getDisplayName() . '"><a href="' . route('userland.edit', 1) . '">Other Recent Userland Tool</a>');
        $this->assertEquals(1, $numberOfMatches);

        $response->assertDontSee('<a href="' . route('userland.index') . '">Other Recent Userland Tool</a>');
    }

    public function test_item_history_widget()
    {
        $response = $this->actingAs($this->user)->get(route('userland.edit', 1));
        $response->assertSee('<section data-kontour-widget="itemHistory">');
        $response->assertSee('<li lang="en" data-kontour-entry-action="created" data-kontour-username="' . $this->user->getDisplayName() . '">');
        $response->assertSee('<li lang="en" data-kontour-entry-action="updated" data-kontour-username="' . $this->user->getDisplayName() . '">');
    }

    public function test_crumbtrail_widget()
    {
        $response = $this->actingAs($this->user)->get(route('userland.edit', 1));
        $response->assertSee('<nav aria-label="Crumb trail" data-kontour-widget="crumbtrail">');
        $response->assertSee('<a href="'.route('userland.index').'">1</a>');
        $response->assertSee('<li aria-current="page"><a href="'.route('userland.edit', 1).'">2</a>');
    }

    public function test_message_widget()
    {
        $response = $this->actingAs($this->user)->get(route('userland.edit', 1));
        $response->assertSee('<section data-kontour-widget="message">');
        $response->assertSee('<li data-kontour-message-level="info">Hello World!</li>');
    }
}
