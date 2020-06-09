<?php

namespace Kontenta\Kontour\Tests\Feature\Fakes;

use Illuminate\Routing\Controller as BaseController;
use Kontenta\Kontour\AdminLink;
use Kontenta\Kontour\Concerns\AuthorizesAdminRequests;
use Kontenta\Kontour\Concerns\RegistersAdminWidgets;
use Kontenta\Kontour\Contracts\AdminViewManager;
use Kontenta\Kontour\Contracts\CrumbtrailWidget;
use Kontenta\Kontour\Contracts\ItemHistoryWidget;
use Kontenta\Kontour\Contracts\MessageWidget;

class UserlandController extends BaseController
{
    use RegistersAdminWidgets;
    use AuthorizesAdminRequests;

    private $viewManager;

    public function __construct(CrumbtrailWidget $crumbtrail, AdminViewManager $viewManager)
    {
        $this->crumbtrail = $crumbtrail;
        $this->viewManager = $viewManager;
        $link1 = new AdminLink('Userland Index', route('userland.index'));
        $this->crumbtrail->addLink($link1);
        $this->viewManager->addStylesheetUrl(url('userland.css'));
        $this->viewManager->addJavascriptUrl('userland.js');
    }

    public function index()
    {
        $this->authorizeShowAdminVisit('access userland tool', 'Userland Index');
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
        $this->authorizeEditAdminVisit('access userland tool', 'Userland Edit');

        $widget = $this->findOrRegisterAdminWidget(ItemHistoryWidget::class);
        $widget->addCreatedEntry(new \DateTime(), $this->adminUser());
        $widget->addUpdatedEntry(new \DateTime(), $this->adminUser());

        $link2 = AdminLink::create('Edit item ' . $id, url()->full());
        $this->crumbtrail->addLink($link2);
        $this->registerAdminWidget($this->crumbtrail, 'kontourToolHeader');

        $messageWidget = $this->findOrRegisterAdminWidget(MessageWidget::class, 'kontourToolHeader');
        $messageWidget->addMessage('Hello World!');

        return view('userland::edit');
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
