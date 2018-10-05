<?php

namespace Kontenta\Kontour\Contracts;

interface CrumbtrailWidget extends AdminWidget
{
    /**
     * Add an AdminLink to the crumb trail
     * @param AdminLink $link
     */
    public function addLink(AdminLink $link): CrumbtrailWidget;
}
