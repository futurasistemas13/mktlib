<?php declare(strict_types=1);

namespace FuturaMkt\Entity\Meli;

class MeliDataSheetValue{

  private  String $value;  
  private  String $mktCode;
  private  bool $defaultValue;

  public function __construct(string $value = '', string $mktCode = '', bool $defaultValue = false)
  {
    if($value !== ''){
      $this->setValue($value);
    }

    if($mktCode !== ''){
      $this->setMktCode($mktCode);
    }

    $this->setDefaultValue($defaultValue);    
  }

  /**
   * Get the value of value
   */ 
  public function getValue(): string
  {
    return $this->value;
  }

  /**
   * Set the value of value
   *
   * @return  MeliDataSheetValue
   */ 
  public function setValue($value): MeliDataSheetValue
  {
    $this->value = $value; 
    return $this;
  }

  /**
   * Get the value of mktCode
   */ 
  public function getMktCode(): String
  {
    return $this->mktCode;
  }

  /**
   * Set the value of mktCode
   *
   * @return  MeliDataSheetValue
   */ 
  public function setMktCode($mktCode): MeliDataSheetValue
  {
    $this->mktCode = $mktCode;
    return $this;
  }

  /**
   * Get the value of defaultValue
   */ 
  public function getDefaultValue()
  {
    return $this->defaultValue;
  }

  /**
   * Set the value of defaultValue
   *
   * @return  self
   */ 
  public function setDefaultValue($defaultValue)
  {
    $this->defaultValue = $defaultValue;

    return $this;
  }
}
