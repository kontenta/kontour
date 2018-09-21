<?php

namespace Kontenta\Kontour;

final class EditAdminVisit extends AdminVisit
{
    public function getType(): string
    {
        return 'edit';
    }
}
