<?php

namespace FuturaMkt\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 *
 * @author Afranio Martins <afranioce@gmail.com>
 *
 * @api
 */
class HasAttributeValue extends Constraint
{

    public String $attrValue = '';
    public String $message   = 'the attribute name does not have a value:  {{ attrValue }}';

}