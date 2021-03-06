<?php
namespace Magenest\Moneris\Gateway\Response\Direct;

use Magento\Sales\Api\Data\OrderPaymentInterface;
use Magento\Sales\Model\Order\Payment;
use Magento\Payment\Model\Config;
use Magento\Payment\Gateway\Helper\ContextHelper;
use Magento\Payment\Gateway\Helper\SubjectReader;
use Magento\Payment\Gateway\Response\HandlerInterface;

/**
 * Class CardDetailsHandler
 * @package Magenest\Moneris\Gateway\Response\Direct
 */
class CardDetailsHandler implements HandlerInterface
{
    /**
     * @var Config
     */
    private $config;

    /**
     * CardDetailsHandler constructor.
     * @param Config $config
     */
    public function __construct(
        Config $config
    ) {
        $this->config = $config;
    }

    /**
     * @inheritdoc
     */
    public function handle(array $handlingSubject, array $response)
    {
        $paymentDO = SubjectReader::readPayment($handlingSubject);

        /** @var Payment $payment */
        $payment = $paymentDO->getPayment();
        ContextHelper::assertOrderPayment($payment);

        $ccTypes = $this->config->getCcTypes();
        $payment->setAdditionalInformation(
            'cc_type',
            $ccTypes[$payment->getAdditionalInformation(OrderPaymentInterface::CC_TYPE)]
        );

        $maskCcNumber = 'XXXX-' .
            substr($payment->decrypt(
                $payment->getAdditionalInformation(OrderPaymentInterface::CC_NUMBER_ENC)
            ), -4);

        $payment->setAdditionalInformation('card_number', $maskCcNumber);

        $payment->setAdditionalInformation(
            'card_expiry_date',
            sprintf(
                '%s/%s',
                $payment->getAdditionalInformation(OrderPaymentInterface::CC_EXP_MONTH),
                $payment->getAdditionalInformation(OrderPaymentInterface::CC_EXP_YEAR)
            )
        );

        $payment->unsAdditionalInformation(OrderPaymentInterface::CC_NUMBER_ENC);
        $payment->unsAdditionalInformation('cc_sid_enc');
    }
}
