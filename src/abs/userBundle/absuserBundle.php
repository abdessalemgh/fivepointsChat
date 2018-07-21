<?php

namespace abs\userBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class absuserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
