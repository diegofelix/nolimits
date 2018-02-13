<?php

namespace App\Checkout;

class Pagseguro
{
    protected $preference = [];

    public function createPayment(Order $order)
    {
        $this->addCurrency($order)
            ->addItems($order)
            ->addCustomer($order)]
            ->setAddress();
    }

    public function addCurrency(Order $order)
    {
        $this->preference['currency'] = 'BRL';

        return $this;
    }

    public function addNewItem(Item $item)
    {
        $championship = $item->championship();
        $this->preference = array_merge(
            $this->preference,
            [
                'itemId' => $championship->id,
                'itemDescription' => $championship->title,
                'itemAmount' => $item->getPrice(),
                'itemWeight' => 1,
                'itemQuantity' => $item->getQuantity(),
            ]
        );

        return $this;
    }

    public function addCustomer(Order $order)
    {
        $customer = $order->customer();
        $this->preference = array_merge(
            $this->preference,
            [
                'senderName' => $customer->name.
                'senderAreaCode' => substr($customer->phone, 0, 2),
                'senderPhone' => substr($customer->phone, 2),
                'senderEmail' => $customer->email,
            ]
        );

        return $this;
    }

    public function setAddress()
    {
        $address = condig('checkout.address');

        $this->preference = array_merge(
            $this->preference,
            [
                'shippingType' => $address['type'],
                'shippingAddressStreet' => $address['street'],
                'shippingAddressNumber' => $address['number'],
                'shippingAddressComplement' => $address['complement'],
                'shippingAddressDistrict' => $address['district'],
                'shippingAddressPostalCode' => $address['postal_code'],
                'shippingAddressCity' => $address['city'],
                'shippingAddressState' => $address['state'],
                'shippingAddressCountry' => $address['country'],
            ];
        );
    }
}