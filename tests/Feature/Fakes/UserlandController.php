<?php

namespace Kontenta\KontourSupport\Tests\Feature\Fakes;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Kontenta\Kontour\Events\AdminToolVisited;
use Kontenta\KontourSupport\AdminLink;
use Kontenta\KontourSupport\RouteAdminLink;
use Kontenta\Kontour\ShowAdminVisit;
use Kontenta\Kontour\Concerns\RegistersAdminWidgets;
use Kontenta\Kontour\Contracts\ItemHistoryWidget;
use Kontenta\Kontour\Contracts\CrumbtrailWidget;

class UserlandController extends BaseController
{
    use RegistersAdminWidgets;

    public function __construct(CrumbtrailWidget $crumbtrail)
    {
        $this->crumbtrail = $crumbtrail;
        $link1 = new RouteAdminLink('userland.index', '1');
        $this->crumbtrail->addLink($link1);
    }
    

    public function index()
    {
        $link = new AdminLink(url()->full(), 'Recent Userland Tool');
        $user = Auth::guard(config('kontour.guard'))->user();
        $visit = new ShowAdminVisit($link, $user);
        event(new AdminToolVisited($visit));
        return view('userland::index', ['crumbtrail' => $this->crumbtrail]);
    }

    public function create()
    {
        //
    }

    public function store()
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $widget = app(ItemHistoryWidget::class);
        $this->registerAdminWidget($widget);
        $widget->addCreatedEntry(new \DateTime(), Auth::guard(config('kontour.guard'))->user());
        $widget->addUpdatedEntry(new \DateTime(), Auth::guard(config('kontour.guard'))->user());

        $link2 = new AdminLink(url()->full(), '2');
        $this->crumbtrail->addLink($link2);

        return view('userland::index', ['crumbtrail' => $this->crumbtrail]);
    }

    public function update($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

}
