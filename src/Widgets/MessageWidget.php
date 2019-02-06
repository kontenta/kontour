<?php

namespace Kontenta\Kontour\Widgets;

use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\Support\MessageBag;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Illuminate\Support\HtmlString;
use Illuminate\Support\ViewErrorBag;
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
            $this->addGeneralMessage(session($key), $level);
        }

        return $this;
    }

    public function addErrorsFromSession($level = 'error', $bag = 'default'): MessageWidgetContract
    {
        return $this->addGeneralMessage($this->getSessionErrorsBag($bag)->all(), $level);
    }

    public function addMessageIfSessionHasErrors(
        string $message,
        $level = 'error',
        $bag = 'default'
    ): MessageWidgetContract {
        return $this->addMessage($this->getSessionErrorsBag($bag)->isEmpty() ? null : $message, $level);
    }

    public function isAuthorized(Authorizable $user = null): bool
    {
        return true;
    }

    protected function getSessionErrorsBag($bag = 'default'): MessageBag
    {
        $errors = session('errors');
        if (!$errors instanceof ViewErrorBag) {
            $errors = new ViewErrorBag();
        }

        return $errors->getBag($bag);
    }
}
