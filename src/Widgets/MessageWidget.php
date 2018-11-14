<?php

namespace Kontenta\Kontour\Widgets;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Support\Htmlable;
use Kontenta\Kontour\Contracts\MessageWidget as MessageWidgetContract;
use Illuminate\Support\Facades\View;

class MessageWidget implements MessageWidgetContract
{
    /**
     * @var Collection
     */
    protected $messages;

    public function __construct()
    {
        $this->messages = new Collection();
    }

    public function toHtml()
    {
        if($this->messages->isNotEmpty()) {
            return View::make('kontour::widgets.message', ['messages' => $this->messages])->render();
        }
    }

    protected function addGeneralMessage($message, string $level = 'info'): MessageWidgetContract
    {
        $this->messages->push([
            'message'   => $message,
            'level'     => $level
        ]);

        return $this;
    }

    public function addMessage(string $message, string $level = 'info'): MessageWidgetContract
    {
        return $this->addGeneralMessage($message, $level);
    }

    public function addHtmlMessage(Htmlable $message, string $level = 'info'): MessageWidgetContract
    {
        return $this->addGeneralMessage($message, $level);
    }

    public function addFromSession($key = 'status', $level = 'info'): MessageWidgetContract
    {
        if(session()->has($key)) {
            $this->addMessage(session($key), $level);
        }

        return $this;
    }

    public function isAuthorized(Authorizable $user = null): bool
    {
        return true;
    }
}
