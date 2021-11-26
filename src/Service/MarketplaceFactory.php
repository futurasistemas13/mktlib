<?php declare(strict_types=1);

namespace FuturaMkt\Service;

use Exception;
use FuturaMkt\Type\TypeMarketplaces;
use InvalidArgumentException;


class MarketplaceFactory
{
    /**
     * @param TypeMarketplaces $mktType
     * @return Meli\Meli
     */
    public static function factory(TypeMarketplaces $mktType): Marketplace{
        return match ($mktType) {
            TypeMarketplaces::MercadoLivre => new Meli\Meli(),
            default => throw new InvalidArgumentException('Unknown format given'),
        };
    }

}