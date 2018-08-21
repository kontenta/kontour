<?php

namespace Kontenta\Kontour\Contracts;

interface AdminLink extends Authorizes
{
    public function getUrl(): string;
    
    public function getName(): string;
    
    public function getDescription(): string;
}
