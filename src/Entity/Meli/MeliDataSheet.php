<?php declare(strict_types=1);

namespace FuturaMkt\Entity\Meli;

use FuturaMkt\Entity\Meli\MeliDataSheetValue;
use Futuralibs\Futurautils\Trait\JsonSerializable\JsonWithOutNull;
use JsonSerializable;
use Serializable;
use Futuralibs\Futurautils\Type\TypeAttributeIgnore;
use FuturaMkt\Entity\Meli\MeliDataSheet as MeliMeliDataSheet;

class MeliDataSheet implements JsonSerializable{

  use JsonWithOutNull;

  #[Serializable]
  private string $fieldId;

  #[Serializable]
  private string $fieldName;  

  #[Serializable]
  private array  $valueList;

  #[Serializable]
  private array  $allowed_units;

  //It is a small explanation about what the field does
  #[Serializable]
  private string $hint = '';

  //It is a TIP to use on the field
  #[Serializable]
  private string $toolTip = '';

  #[Serializable]
  private bool $attributeVariation = false;

  #[Serializable]
  private bool $fixed = false;

  #[Serializable]
  private bool $multiValued = false;

  #[Serializable]
  private bool $required = false;

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
   * Get the value of hint
   */ 
  public function getHint()
  {
    return $this->hint;
  }

  /**
   * Set the value of hint
   *
   * @return  self
   */ 
  public function setHint($hint)
  {
    $this->hint = $hint;

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

  /**
   * Get the value of attributeVariation
   */ 
  public function getAttributeVariation(): bool
  {
    return $this->attributeVariation;
  }

  /**
   * Set the value of attributeVariation
   *
   * @return  MeliMeliDataSheet
   */ 
  public function setAttributeVariation($attributeVariation): MeliMeliDataSheet
  {
    $this->attributeVariation = $attributeVariation;

    return $this;
  }

  /**
   * Get the value of fixed
   */ 
  public function getFixed(): bool
  {
    return $this->fixed;
  }

  /**
   * Set the value of fixed
   *
   * @return  MeliMeliDataSheet
   */ 
  public function setFixed($fixed): MeliMeliDataSheet
  {
    $this->fixed = $fixed;

    return $this;
  }

  /**
   * Get the value of multiValued
   */ 
  public function getMultiValued(): bool
  {
    return $this->multiValued;
  }

  /**
   * Set the value of multiValued
   *
   * @return  MeliMeliDataSheet
   */ 
  public function setMultiValued($multiValued): MeliMeliDataSheet
  {
    $this->multiValued = $multiValued;

    return $this;
  }

  /**
   * Get the value of required
   */ 
  public function getRequired(): bool
  {
    return $this->required;
  }

  /**
   * Set the value of required
   *
   * @return  MeliMeliDataSheet
   */ 
  public function setRequired($required): MeliMeliDataSheet
  {
    $this->required = $required;

    return $this;
  }

  /**
   * Get the value of toolTip
   */ 
  public function getToolTip(): string
  {
    return $this->toolTip;
  }

  /**
   * Set the value of toolTip
   *
   * @return  MeliMeliDataSheet
   */ 
  public function setToolTip($toolTip): MeliMeliDataSheet
  {
    $this->toolTip = $toolTip;

    return $this;
  }
}
