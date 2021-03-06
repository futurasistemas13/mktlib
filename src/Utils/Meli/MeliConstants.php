<?php declare(strict_types=1);

namespace FuturaMkt\Utils\Meli;

use FuturaMkt\Type\TypePeriodDate;
use FuturaMkt\Type\Product\TypeWarranty;
use FuturaMkt\Type\TypeStatus;
use FuturaMkt\Type\Customer\TypeAddressState;

class MeliConstants{


    const endPoint = 'https://api.mercadolibre.com';

    /**
     * @param TypeStatus $status
     * @return string
     */
    public static function getProductStatus(TypeStatus $status): string
    {
        return match($status){
            TypeStatus::Active          => 'active',
            TypeStatus::Inactive        => 'paused'
        };
    }

    /**
     * @param TypeWarranty $warranty
     * @return string
     */
    public static function getWarrantId(TypeWarranty $warranty): string
    {
        return match($warranty){
            TypeWarranty::Factory          => '2230279',
            TypeWarranty::Seller           => '2230280',
            TypeWarranty::NoWarranty       => '6150835'
        };
    }

    /**
     * @param TypePeriodDate $periodtype
     * @param int $period
     * @return string
     */
    public static function getWarrantTime(TypePeriodDate $periodtype, int $period): string
    {
        return match($periodtype){
            TypePeriodDate::Day        => strval($period) . ' dias',
            TypePeriodDate::Month      => strval($period) . ' meses',
            TypePeriodDate::Year       => strval($period) . ' anos',
        };
    }

    public static function getStatusTypeFromInitial($initial): TypeAddressState
    {
        foreach(TypeAddressState::cases() as $case){
            if(strtoupper($case->value) == strtoupper($initial)){
                return $case;
            }
        }
        return null;
    }
    

}