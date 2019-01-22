<?php

namespace Kontenta\Kontour\Widgets;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Illuminate\Support\HtmlString;
use Kontenta\Kontour\Contracts\MessageWidget as MessageWidgetContract;

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
        if ($this->messages->isNotEmpty()) {
            return View::make('kontour::widgets.message', ['messages' => $this->messages])->render();
        }
    }

    protected function addGeneralMessage($messages, string $level = 'info'): MessageWidgetContract
    {
        collect($messages)->each(function ($message) use ($level) {
            $this->messages->push([
                'message' => $message,
                'level' => $level,
            ]);
        });

        return $this;
    }

    public function addMessage(string $message, string $level = 'info'): MessageWidgetContract
    {
        return $this->addGeneralMessage($message, $level);
    }

    public function addHtmlMessage($message, string $level = 'info'): MessageWidgetContract
    {
        if ($message instanceof Htmlable) {
            $message = $message->toHtml();
        }
        return $this->addGeneralMessage(new HtmlString($message), $level);
    }

    public function addFromSession($key = 'status', $level = 'info'): MessageWidgetContract
    {
        if (session()->has($key)) {
            $this->addMessage(session($key), $level);
        }

        return $this;
    }

    public function isAuthorized(Authorizable $user = null): bool
    {
        return true;
    }
}
