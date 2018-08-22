<?php

namespace Kontenta\Kontour\Contracts;

use Illuminate\Support\Collection;

interface MenuWidget extends AdminWidget
{
    /**
     * Add an AdminLink to the menu, with the option to specify under what heading the link should appear
     * @param AdminLink $link
     * @param string $desiredHeading
     */
    public function addLink(AdminLink $link, string $desiredHeading = null): MenuWidget;

    /**
     * All registered AdminWidgets for the layout
     * @return Collection
     */
    public function getHeadings(): Collection;
}
