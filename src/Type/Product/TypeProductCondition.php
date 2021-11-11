<?php declare(strict_types=1);

namespace FuturaMkt\Type\Product;

enum TypeProductCondition: String {
    case New  = 'new';
    case Used = 'used';
}