<?php declare(strict_types=1);

namespace FuturaMkt\Entity\Product;

class Attribute{
    private String $name;
    private String $value;

    function __construct(String $name = '', String $value = '')
    {
         $this->setName($name);
         $this->setValue($value);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }
}