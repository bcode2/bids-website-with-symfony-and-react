<?php

namespace App\Services;

class BasicServices
{
    /*Will  persists all  object  changes in the  UnitofWork*/
    protected function flushObjects(): bool
    {
        $this->em->flush();

        return true;
    }
}


