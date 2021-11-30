<?php

namespace FuturaMkt\Entity\Product;

use FuturaMkt\Type\TypePeriodDate;
use FuturaMkt\Type\Product\TypeWarranty;

class Warranty
{
    private TypeWarranty $type   = TypeWarranty::NoWarranty;
    private int $period          = 0;
    private TypePeriodDate $unid;

    /**
     * @return TypeWarranty
     */
    public function getType(): TypeWarranty
    {
        return $this->type;
    }

    /**
     * @param TypeWarranty $type
     * @return Warranty
     */
    public function setType(TypeWarranty $type): Warranty
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return int
     */
    public function getPeriod(): int
    {
        return $this->period;
    }

    /**
     * @param int $period
     * @return Warranty
     */
    public function setPeriod(int $period): Warranty
    {
        $this->period = $period;
        return $this;
    }

    /**
     * @return TypePeriodDate
     */
    public function getUnid(): TypePeriodDate
    {
        return $this->unid;
    }

    /**
     * @param TypePeriodDate $unid
     * @return Warranty
     */
    public function setUnid(TypePeriodDate $unid): Warranty
    {
        $this->unid = $unid;
        return $this;
    }

}