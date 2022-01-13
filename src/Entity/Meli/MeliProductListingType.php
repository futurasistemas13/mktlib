<?php declare(strict_types=1);

namespace FuturaMkt\Entity\Meli;

use Serializable;
use JsonSerializable;
use Futuralibs\Futurautils\Trait\JsonSerializable\JsonWithOutNull;


class MeliProductListingType implements JsonSerializable{

  use JsonWithOutNull;    

  #[Serializable]
  private  String $id;  

  #[Serializable]
  private  String $name;

  public function __construct(string $id = '', string $name = '')
  {
      if($id != ''){
          $this->setId($id);
      }

      if($name != ''){
          $this->setName($name);
      }
      
  }

  /**
   * Get the value of id
   */ 
  public function getId(): string
  {
    return $this->id;
  }

  /**
   * Set the value of id
   *
   * @return  MeliProductListingType
   */ 
  public function setId($id): MeliProductListingType 
  {
    $this->id = $id;

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
   * @return  MeliProductListingType
   */ 
  public function setName($name): MeliProductListingType
  {
    $this->name = $name;

    return $this;
  }
}
