<?php declare(strict_types=1);

namespace FuturaMkt\Entity\Meli;

use FuturaMkt\Entity\Meli\MeliDataSheetValue;
use Futuralibs\Futurautils\Trait\JsonSerializable\JsonWithOutNull;
use FuturaMkt\Entity\Product\Attribute;

class MeliDataSheet extends Attribute{
  use JsonWithOutNull;

  private string $fieldId;
  private string $fieldName;  
  private array  $valueList;
  private array  $allowed_units;
  private string $lint = '';

  public function __construct(String $fieldId, String $fieldName = '')
  {

    if($fieldId != ''){
      $this->setFieldId($fieldId);
    }

    if($fieldName != ''){
      $this->setFieldName($fieldName);
    }
    $this->valueList     = Array();
    $this->allowed_units = Array();
  }

  /**
   * Get the value of valueList
   */ 
  public function getValueList(): array
  {
    return $this->valueList;
  }

  /**
   * Set the value of valueList
   *
   * @return  MeliDataSheet
   */ 
  public function setValueList($value, $mktCode): MeliDataSheet
  {
    $this->valueList[] = new MeliDataSheetValue($value, $mktCode);

    return $this;
  }

  /**
   * Get the value of fieldName
   */ 
  public function getFieldName()
  {
    return $this->fieldName;
  }

  /**
   * Set the value of fieldName
   *
   * @return  self
   */ 
  public function setFieldName($fieldName)
  {
    $this->fieldName = $fieldName;

    return $this;
  }

  /**
   * Get the value of allowed_units
   */ 
  public function getAllowed_units()
  {
    return $this->allowed_units;
  }

  /**
   * Set the value of allowed_units
   *
   * @return  MeliDataSheet
   */ 
  public function setAllowed_units($value, $mktCode, $defaultValue = false): MeliDataSheet
  {
    $this->allowed_units[] = new MeliDataSheetValue($value, $mktCode, $defaultValue);
    return $this;
  }

  /**
   * Get the value of lint
   */ 
  public function getLint()
  {
    return $this->lint;
  }

  /**
   * Set the value of lint
   *
   * @return  self
   */ 
  public function setLint($lint)
  {
    $this->lint = $lint;

    return $this;
  }

  /**
   * Get the value of fieldId
   */ 
  public function getFieldId()
  {
    return $this->fieldId;
  }

  /**
   * Set the value of fieldId
   *
   * @return  self
   */ 
  public function setFieldId($fieldId)
  {
    $this->fieldId = $fieldId;

    return $this;
  }
}
