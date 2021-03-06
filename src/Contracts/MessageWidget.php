<?php

namespace Kontenta\Kontour\Contracts;

use Illuminate\Contracts\Support\Htmlable;

interface MessageWidget extends AdminWidget
{
    public function addMessage(string $message, string $level = 'info'): MessageWidget;

    public function addHtmlMessage($message, string $level = 'info'): MessageWidget;

    public function addFromSession($key = 'status', $level = 'info'): MessageWidget;

    public function addErrorsFromSession($level = 'error', $bag = 'default'): MessageWidget;

    public function addMessageIfSessionHasErrors(string $message, $level = 'error', $bag = 'default'): MessageWidget;
}
