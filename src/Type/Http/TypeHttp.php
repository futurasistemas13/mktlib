<?php declare(strict_types=1);

namespace FuturaMkt\Type\Http;

enum TypeHttp: String{
    case POST = 'post';
    case GET  = 'get';
    case PUT  = 'put';


}