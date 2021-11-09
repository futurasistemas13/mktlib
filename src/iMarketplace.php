<?php

namespace FuturaMkt;

use FuturaMkt\Authentication\Model\MktConnection;

interface iMarketplace{

    public function authenticate(MktConnection $data);

}