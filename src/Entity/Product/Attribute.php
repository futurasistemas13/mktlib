<?php declare(strict_types=1);

namespace FuturaMkt\Entity\Product;

use Symfony\Component\Validator\Constraints as Assert;

class Attribute{

    /**
     * @Assert\NotBlank
     * @Assert\NotNull
     */
    private String $name;

    private mixed $value;

    function __construct(String $name = '', mixed $value = '')
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
     * @return Attribute
     */
    public function setName(string $name): Attribute
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue(): mixed
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return Attribute
     */
    public function setValue(mixed $value): Attribute
    {
        $this->value = $value;
        return $this;
    }
}