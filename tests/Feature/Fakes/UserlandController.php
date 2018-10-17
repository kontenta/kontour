<?php

namespace Kontenta\Kontour\Tests\Feature\Fakes;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Kontenta\Kontour\AdminLink;
use Kontenta\Kontour\Concerns\RegistersAdminWidgets;
use Kontenta\Kontour\Contracts\CrumbtrailWidget;
use Kontenta\Kontour\Contracts\ItemHistoryWidget;
use Kontenta\Kontour\Contracts\MessageWidget;
use Kontenta\Kontour\Events\AdminToolVisited;
use Kontenta\Kontour\RouteAdminLink;
use Kontenta\Kontour\ShowAdminVisit;

class UserlandController extends BaseController
{
    use RegistersAdminWidgets;

    public function __construct(CrumbtrailWidget $crumbtrail)
    {
        $this->crumbtrail = $crumbtrail;
        $link1 = new RouteAdminLink('1', 'userland.index');
        $this->crumbtrail->addLink($link1);
    }

    public function index()
    {
        $link = new AdminLink('Recent Userland Tool', url()->full());
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

        $link2 = new AdminLink('2', url()->full());
        $this->crumbtrail->addLink($link2);
        $this->registerAdminWidget($this->crumbtrail, app(\Kontenta\Kontour\Contracts\AdminViewManager::class)->toolHeaderSection());

        $messageWidget = app(MessageWidget::class);
        $messageWidget->addMessage('Hello World!');
        $this->registerAdminWidget($messageWidget, app(\Kontenta\Kontour\Contracts\AdminViewManager::class)->toolHeaderSection());

        return view('userland::index');
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
