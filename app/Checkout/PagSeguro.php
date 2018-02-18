<?php

namespace App\Checkout;

class PagSeguro
{
    protected $preference = [];
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function createPayment()
    {
        $this->addCurrency()
            ->addItems()
            ->addCustomer()
            ->setAddress();
    }

    public function getPreference(): array
    {
        return $this->preference;
    }

    private function addItems()
    {
        foreach ($this->order->items() as $item) {
            $this->addNewItem($item);
        }

        return $this;
    }

    private function addCurrency()
    {
        $this->preference['currency'] = 'BRL';

        return $this;
    }

    private function addNewItem(Item $item)
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

    private function addCustomer()
    {
        $customer = $this->order->customer();
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

    private function setAddress()
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