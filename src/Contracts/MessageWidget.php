<?php

namespace Kontenta\Kontour\Contracts;

use Illuminate\Contracts\Support\Htmlable;

interface MessageWidget extends AdminWidget
{
    public function addMessage(string $message, string $level = 'info'): MessagelWidget;
    
    public function addHtmlMessage(Htmlable $message, string $level = 'info'): MessagelWidget;
}
