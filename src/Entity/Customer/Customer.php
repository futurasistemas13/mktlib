<?php declare(strict_types=1);

namespace FuturaMkt\Entity\Customer;

use Symfony\Component\Validator\Constraints as Assert;
use FuturaMkt\Type\CustomerFuturaMkt\Entity\Product\Attribute;
use FuturaMkt\Type\Customer\TypeCustomer;

class Customer{

    private string $mktCustomerId = '';

    private string $phone = '';

    private string $cellphone = '';

    private string $email = '';

    private Address $shippingAddress;

    /**
     * @Assert\NotBlank
     * @Assert\NotNull
     */
    private string $name; 

    private TypeCustomer $type;
    
    /**
     * @Assert\NotBlank
     * @Assert\NotNull
     */
    private string $cpf_Cnpj;

    /** 
     * Get the value of phone
     */ 
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  Customer
     */ 
    public function setPhone(string $phone): Customer
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of cellphone
     */ 
    public function getCellphone(): string
    {
        return $this->cellphone;
    }

    /**
     * Set the value of cellphone
     *
     * @return  Customer
     */ 
    public function setCellphone(string $cellphone): Customer
    {
        $this->cellphone = $cellphone;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  Customer
     */ 
    public function setEmail(string $email): Customer
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  Customer
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of type
     */ 
    public function getType(): TypeCustomer
    {
        return $this->type;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType(TypeCustomer $type): Customer 
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of cpf_Cnpj
     */ 
    public function getCpf_Cnpj(): string
    {
        return $this->cpf_Cnpj;
    }

    /**
     * Set the value of Cpf_Cnpj
     *
     * @return  self
     */ 
    public function setCpf_Cnpj(string $cpf_Cnpj): Customer
    {
        $this->cpf_Cnpj = $cpf_Cnpj;

        return $this;
    }

    /**
     * Get the value of shippingAddress
     */ 
    public function getShippingAddress(): Address
    {
        return $this->shippingAddress;
    }

    /**
     * Set the value of shippingAddress
     *
     * @return  Address
     */ 
    public function setShippingAddress(Address $shippingAddress): Customer
    {
        $this->shippingAddress = $shippingAddress;

        return $this;
    }

    /**
     * Get the value of mktCustomerId
     */ 
    public function getMktCustomerId(): string
    {
        return $this->mktCustomerId;
    }

    /**
     * Set the value of mktCustomerId
     *
     * @return  Customer
     */ 
    public function setMktCustomerId(string $mktCustomerId): Customer
    {
        $this->mktCustomerId = $mktCustomerId;

        return $this;
    }
}