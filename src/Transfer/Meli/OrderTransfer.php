<?php declare(strict_types=1);

namespace FuturaMkt\Transfer\Meli;

use FuturaMkt\Entity\Customer\Address;
use FuturaMkt\Entity\Customer\Customer;
use FuturaMkt\Entity\Order\Order;
use FuturaMkt\Entity\Order\OrderItem;
use FuturaMkt\Utils\Meli\MeliConstants;
use Serializable;

class OrderTransfer{

    public function MeliToOrderObject(array $meliOrder, array $meliShipping): Order{

        $order    = new Order();
        $customer = new Customer();

        $order->setMktId((string)$meliOrder['id'])
              ->setDateCreated(new \DateTime($meliOrder['date_created']))
              ->setTotal($meliOrder['total_amount']);

        if($this->hasShippingId($meliOrder)){
            $receiverAddress = $meliShipping['receiver_address'];

            $shippingAddress = new Address();
            $shippingAddress->setAddress($receiverAddress['street_name'])
                            ->setCity($receiverAddress['city']['name'])
                            ->setComplement($receiverAddress['comment'] ?? '')
                            ->setNeighborhood($receiverAddress['neighborhood']['name'])
                            ->setNumber($receiverAddress['street_number'])
                            ->setState(MeliConstants::getStatusTypeFromInitial(str_replace('BR-', '', $receiverAddress['state']['id'])))
                            ->setZipCode($receiverAddress['zip_code']);
            $customer->setShippingAddress($shippingAddress);
        }

        $customerArray = $meliOrder['buyer'];        
        $customer->setPhone('(' . $customerArray['phone']['area_code'] . ') ' . $customerArray['phone']['number'])
                 ->setName($customerArray['first_name'] . ' ' . $customerArray['last_name'])
                 ->setEmail($customerArray['email'])
                 ->setMktCustomerId($customerArray['id']);

        $orderItems = $meliOrder['order_items'];

        foreach($orderItems as $item){
            $orderItem = new OrderItem();

            $orderItem->setMktProductId($item['item']['id'])
                      ->setProductName($item['item']['title'])
                      ->setMktVariationId($item['item']['variation_id'])
                      ->setQuantity($item['quantity'])
                      ->setUnitVal($item['full_unit_price']);

            $order->setItem($orderItem);
        }

        $order->setBuyer($customer);


        return $order;
    }

    public function getIdShipping(array $meliOrder): int{

        if((array_key_exists('shipping', $meliOrder) && (array_key_exists('id', $meliOrder['shipping'])))){
            return $meliOrder['shipping']['id'];
        }else{
            return 0;
        }
    }

    public function hasShippingId(array $meliOrder): bool{

        return ((array_key_exists('shipping', $meliOrder)) && 
                (array_key_exists('id', $meliOrder['shipping'])) && 
                (!empty($meliOrder['shipping']['id'])));


    }

}