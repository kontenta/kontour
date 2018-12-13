<?php

namespace Kontenta\Kontour\Tests\Feature\Fakes;

use Illuminate\Routing\Controller as BaseController;
use Kontenta\Kontour\AdminLink;
use Kontenta\Kontour\Concerns\DispatchesAdminToolEvents;
use Kontenta\Kontour\Concerns\RegistersAdminWidgets;
use Kontenta\Kontour\Contracts\AdminViewManager;
use Kontenta\Kontour\Contracts\CrumbtrailWidget;
use Kontenta\Kontour\Contracts\ItemHistoryWidget;
use Kontenta\Kontour\Contracts\MessageWidget;

class UserlandController extends BaseController
{
    use RegistersAdminWidgets;
    use DispatchesAdminToolEvents;

    private $viewManager;

    public function __construct(CrumbtrailWidget $crumbtrail, AdminViewManager $viewManager)
    {
        $this->crumbtrail = $crumbtrail;
        $this->viewManager = $viewManager;
        $link1 = new AdminLink('1', route('userland.index'));
        $this->crumbtrail->addLink($link1);
        $this->viewManager->addStylesheetUrl(url('userland.css'));
        $this->viewManager->addJavascriptUrl('userland.js');
    }

    public function index()
    {
        $this->dispatchShowAdminToolVisitedEvent('Recent Userland Tool');
        $this->viewManager->addStylesheetUrl('userland-index.css');
        $this->viewManager->addJavascriptUrl('userland-index.js');
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
        $widget = $this->findOrRegisterAdminWidget(ItemHistoryWidget::class);
        $widget->addCreatedEntry(new \DateTime(), $this->adminUser());
        $widget->addUpdatedEntry(new \DateTime(), $this->adminUser());

        $link2 = AdminLink::create('2', url()->full());
        $this->crumbtrail->addLink($link2);
        $this->registerAdminWidget($this->crumbtrail, app(\Kontenta\Kontour\Contracts\AdminViewManager::class)->toolHeaderSection());

        $messageWidget = $this->findOrRegisterAdminWidget(MessageWidget::class, app(\Kontenta\Kontour\Contracts\AdminViewManager::class)->toolHeaderSection());
        $messageWidget->addMessage('Hello World!');

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
