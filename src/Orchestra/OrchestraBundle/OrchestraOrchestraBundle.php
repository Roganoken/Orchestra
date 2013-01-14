<?php

namespace Orchestra\OrchestraBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class OrchestraOrchestraBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
