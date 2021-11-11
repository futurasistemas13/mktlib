<?php

namespace FuturaMkt\Type\Meli;

enum TypeMeliEndPoints: String {
    case ProductDescription  = 'items/{meliId}/description?api_version=2';
    case Product = '/items/{meliId}/';
}