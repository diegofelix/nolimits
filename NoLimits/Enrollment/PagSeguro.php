<?php
namespace NoLimits\Enrollment;

use NoLimits\Championship\Competition;
use PagSeguro\Configuration\Configure;
use PagSeguro\Domains\AccountCredentials;
use PagSeguro\Domains\Requests\Payment;

/**
 * This class act as a wrapper for business logic inside PagSeguro.
 * Currently this class works only for redirect url payment.
 */
class PagSeguro
{
    /**
     * Default value for competition quantity.
     */
    const COMPETITION_QUANTITY = 1;

    /**
     * @var Enroll
     */
    protected $enroll;

    public function getRedirectUrlForPayment(Enroll $enroll): string
    {
        $this->enroll = $enroll;
        $credentials = $this->getCredentials();
        $payment = $this->generateNewPayment();
        $this->setCustomerInformation($payment);
        $this->setCompetitions($payment);
        $this->disableSendingAddressInformation($payment);

        return $payment->register($credentials);
    }

    private function generateNewPayment(): Payment
    {
        $payment = new Payment();
        $payment->setCurrency('BRL');
        $payment->setReference($this->enroll->getKey());

        return $payment;
    }

    private function setCustomerInformation(Payment $payment): void
    {
        $user = $this->enroll->user();
        $areaCode = substr($user->phone, 0, 2);
        $phone = substr($user->phone, 2);

        $payment->setSender()->setName($user->name);
        $payment->setSender()->setEmail($user->email);
        $payment->setSender()->setPhone()->withParameters($areaCode, $phone);
        $payment->setSender()->setDocument()->withParameters('CPF', $user->cpf);
    }

    private function setCompetitions(Payment $payment): void
    {
        $competitions = $this->enroll->competitions();

        foreach ($competitions as $competition) {
            $this->addGameFor($payment, $competition);
        }
    }

    /**
     * This config sets the shipping address as disable. That means
     * that the user will not need to fill address information.
     *
     * @param Payment $payment
     */
    private function disableSendingAddressInformation(Payment $payment): void
    {
        $payment->setShipping()->setAddressRequired()->withParameters("false");
    }

    private function getCredentials(): AccountCredentials
    {
        return Configure::getAccountCredentials();
    }

    private function addGameFor(Payment $payment, Competition $competition): void
    {
        $game = $competition->game();

        $payment->addItems()->withParameters(
            $game->getKey(),
            $game->title,
            static::COMPETITION_QUANTITY,
            $competition->getPrice()
        );
    }
}
