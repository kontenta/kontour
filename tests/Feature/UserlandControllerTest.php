<?php

namespace Kontenta\Kontour\Tests\Feature;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Kontenta\Kontour\AdminLink;
use Kontenta\Kontour\EditAdminVisit;
use Kontenta\Kontour\Events\AdminToolVisited;
use Kontenta\Kontour\ShowAdminVisit;
use Kontenta\Kontour\Tests\Feature\Fakes\User;
use Kontenta\Kontour\Tests\UserlandAdminToolTest;

class UserlandControllerTest extends UserlandAdminToolTest
{
    /**
     * @var User
     */
    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->prepareDatabase();
        $this->user = factory(User::class)->create();

        Gate::define('access userland tool', function ($user) {
            return true;
        });
    }

    public function test_index_route()
    {
        Event::fake();

        $response = $this->actingAs($this->user, 'admin')->get(route('userland.index'));

        $response->assertSuccessful();
        $response->assertSee('<main', false);
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
        $response = $this->actingAs($this->user, 'admin')->get(route('userland.index'));

        $response->assertSuccessful();
        $response->assertSee('<ul data-kontour-widget="menu">', false);
        $response->assertSee('>main<', false);
        $response->assertSee('<a href="' . route('userland.index') . '" aria-current="page">Userland Tool</a>', false);
        $response->assertSee('>External<', false);
        $response->assertSee('<a href="http://external.com">External Link</a>', false);
    }

    public function test_recent_visits_widgets()
    {
        $otherUser = factory(User::class)->create();
        $link = new AdminLink('Recent Userland Tool', route('userland.edit', 1));
        $visit = new EditAdminVisit($link, $this->user);
        event(new AdminToolVisited($visit));
        event(new AdminToolVisited($visit));
        $link = new AdminLink('Other Recent Userland Tool', route('userland.index'));
        $visit = new ShowAdminVisit($link, $otherUser);
        event(new AdminToolVisited($visit));
        $link = new AdminLink('Other Recent Userland Tool', route('userland.edit', 1));
        $visit = new EditAdminVisit($link, $otherUser);
        event(new AdminToolVisited($visit));
        event(new AdminToolVisited($visit));

        $response = $this->actingAs($this->user, 'admin')->get(route('userland.index'));

        $response->assertSuccessful();

        // Check personal links
        $response->assertSee('<aside data-kontour-widget="personalRecentVisits">', false);
        $response->assertSee('<header>Recent</header>', false);

        $numberOfMatches = substr_count($response->content(), '<li data-kontour-visit-type="show" title="Recent Userland Tool"><a href="' . route('userland.index') . '" aria-current="page">Recent Userland Tool</a>');
        $this->assertEquals(0, $numberOfMatches);

        $numberOfMatches = substr_count($response->content(), '<li data-kontour-visit-type="edit" title="Recent Userland Tool"><a href="' . route('userland.edit', 1) . '">Recent Userland Tool</a>');
        $this->assertEquals(1, $numberOfMatches);

        // Check team links
        $response->assertSee('<aside data-kontour-widget="teamRecentVisits">', false);
        $response->assertSee('<header>Team Recent</header>', false);

        $numberOfMatches = substr_count($response->content(), '<li data-kontour-visit-type="edit" data-kontour-username="' . $otherUser->getDisplayName() . '" title="Other Recent Userland Tool"><a href="' . route('userland.edit', 1) . '">Other Recent Userland Tool</a>');
        $this->assertEquals(1, $numberOfMatches);

        $response->assertDontSee('<a href="' . route('userland.index') . '">Other Recent Userland Tool</a>', false);
    }

    public function test_item_history_widget()
    {
        $response = $this->actingAs($this->user, 'admin')->get(route('userland.edit', 1));

        $response->assertSuccessful();
        $response->assertSee('<section data-kontour-widget="itemHistory">', false);
        $response->assertSee('<header>Item History</header>', false);
        $response->assertSee('<li lang="en" data-kontour-entry-action="created" data-kontour-username="' . $this->user->getDisplayName() . '">', false);
        $response->assertSee('<li lang="en" data-kontour-entry-action="updated" data-kontour-username="' . $this->user->getDisplayName() . '">', false);
    }

    public function test_crumbtrail_widget()
    {
        $response = $this->actingAs($this->user, 'admin')->get(route('userland.edit', 1));

        $response->assertSuccessful();
        $response->assertSee('<nav aria-label="Crumb trail" data-kontour-widget="crumbtrail">', false);
        $response->assertSee('<a href="' . route('userland.index') . '">1</a>', false);
        $response->assertSee('<li aria-current="true"><a href="' . route('userland.edit', 1) . '" aria-current="page">2</a>', false);
    }

    public function test_message_widget()
    {
        $response = $this->actingAs($this->user, 'admin')->get(route('userland.edit', 1));

        $response->assertSuccessful();
        $response->assertSee('<section data-kontour-widget="message">', false);
        $response->assertSeeInOrder(['<li', 'data-kontour-message-level="info"', 'role="status"', '>Hello World!</li>'], false);
    }

    public function test_css_and_js_additions()
    {
        $response = $this->actingAs($this->user, 'admin')->get(route('userland.index'));

        $response->assertSuccessful();
        $response->assertSee('<link href="' . url('admin.css') . '" rel="stylesheet">', false);
        $response->assertSee('<link href="' . url('userland.css') . '" rel="stylesheet">', false);
        $response->assertSee('<link href="' . url('userland-index.css') . '" rel="stylesheet">', false);

        $response->assertSee('<script src="https://cdn.example.com/framework.js"></script>', false);
        $response->assertSee('<script src="' . url('admin.js') . '"></script>', false);
        $response->assertSee('<script src="' . url('userland.js') . '"></script>', false);
        $response->assertSee('<script src="' . url('userland-index.js') . '"></script>', false);
    }
}
