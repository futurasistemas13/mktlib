<?php declare(strict_types=1);

namespace FuturaMkt\Type\Meli;

enum TypeMeliEndPoints: String {
    case ProductDescription  = '/items/{meliId}/description?api_version=2';
    case Product             = '/items/{meliId}/';
    case AuthToken           = '/oauth/token/';
    case ProductAttributes   = '/categories/{category_id}/technical_specs/input';
    case ListingTypes        = '/sites/MLB/listing_types/';
    case Orders              = '/orders/{order_id}/';
    case Shipments           = '/shipments/{shipment_id}';
}