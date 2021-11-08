<?php

namespace FuturaMkt;

use FuturaMkt\Authentication\Model\iConnection;

interface iMarketplace{

    public function authenticate(iConnection $data);

}