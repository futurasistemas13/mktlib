<?php declare(strict_types=1);

namespace FuturaMkt\Type\Meli\Product;

enum Type_MercadoLivreMercaListType: String {
    case Tp_Free         = 'free' ;
    case Tp_GoldSpecial  = 'gold_special' ;
    case Tp_GoldPro      = 'gold_pro' ;
    case Tp_Bronze       = 'bronze' ;
    case Tp_Silver       = 'silver' ;
    case Tp_GoldPremium  = 'gold_premium';
    case Tp_Gold         = 'gold';
}