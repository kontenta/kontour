<?php

namespace Kontenta\Kontour;

final class ShowAdminVisit extends AdminVisit
{
    public function getType(): string
    {
        return 'show';
    }
}
