<?php declare(strict_types=1);

namespace FuturaMkt\Entity\Customer;

use Symfony\Component\Validator\Constraints as Assert;
use FuturaMkt\Entity\Product\Attribute;
use FuturaMkt\Type\Customer\TypeAddressState;

class Address{
    private string $city;
    
    private TypeAddressState $state;

    private string $zipCode;

    private string $address;

    private string $number;

    private string $complement;

    private string $neighborhood;

    /**
     * Get the value of city
     */ 
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * Set the value of city
     *
     * @return  Address
     */ 
    public function setCity(string $city): Address
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get the value of zipCode
     */ 
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * Set the value of zipCode
     *
     * @return  Address
     */ 
    public function setZipCode(string $zipCode): Address
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get the value of address
     */ 
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @return  Address
     */ 
    public function setAddress(string $address): Address
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of number
     */ 
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * Set the value of number
     *
     * @return  Address
     */ 
    public function setNumber(string $number): Address
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get the value of complement
     */ 
    public function getComplement(): string
    {
        return $this->complement;
    }

    /**
     * Set the value of complement
     *
     * @return  Address
     */ 
    public function setComplement(string $complement): Address
    {
        $this->complement = $complement;

        return $this;
    }

    /**
     * Get the value of neighborhood
     */ 
    public function getNeighborhood(): string 
    {
        return $this->neighborhood;
    }

    /**
     * Set the value of neighborhood
     *
     * @return  Address
     */ 
    public function setNeighborhood(string $neighborhood): Address
    {
        $this->neighborhood = $neighborhood;

        return $this;
    }

    /**
     * Get the value of state
     */ 
    public function getState(): TypeAddressState
    {
        return $this->state;
    }

    /**
     * Get the value of state
     */ 
    public function getStateInitials(): TypeAddressState
    {
        return $this->state->value;
    }


    /**
     * Get the value of state
     */ 
    public function getStateComplete(): string
    {
        $brStates = array(
            'AC'=>'Acre',
            'AL'=>'Alagoas',
            'AP'=>'Amapá',
            'AM'=>'Amazonas',
            'BA'=>'Bahia',
            'CE'=>'Ceará',
            'DF'=>'Distrito Federal',
            'ES'=>'Espírito Santo',
            'GO'=>'Goiás',
            'MA'=>'Maranhão',
            'MT'=>'Mato Grosso',
            'MS'=>'Mato Grosso do Sul',
            'MG'=>'Minas Gerais',
            'PA'=>'Pará',
            'PB'=>'Paraíba',
            'PR'=>'Paraná',
            'PE'=>'Pernambuco',
            'PI'=>'Piauí',
            'RJ'=>'Rio de Janeiro',
            'RN'=>'Rio Grande do Norte',
            'RS'=>'Rio Grande do Sul',
            'RO'=>'Rondônia',
            'RR'=>'Roraima',
            'SC'=>'Santa Catarina',
            'SP'=>'São Paulo',
            'SE'=>'Sergipe',
            'TO'=>'Tocantins'
        );

        return $brStates[strtoupper($this->state->value)];
    }

    /**
     * Set the value of state
     *
     * @return  Address
     */ 
    public function setState(TypeAddressState $state): Address
    {
        $this->state = $state;

        return $this;
    }
}