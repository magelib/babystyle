<?php
namespace Magenest\Moneris\Gateway\Response;

use Magento\Sales\Model\Order\Payment;
use Magento\Payment\Gateway\Helper\SubjectReader;
use Magento\Payment\Gateway\Helper\ContextHelper;
use Magento\Payment\Gateway\Response\HandlerInterface;

/**
 * Class ResponseMessagesHandler
 */
class ResponseMessagesHandler implements HandlerInterface
{
    /**
     * @inheritdoc
     */
    public function handle(array $handlingSubject, array $response)
    {
        $paymentDO = SubjectReader::readPayment($handlingSubject);
        /** @var Payment $payment */
        $payment = $paymentDO->getPayment();
        ContextHelper::assertOrderPayment($payment);

        $responseCode = $response['ResponseCode'];
        $messages = $response['Message'];
        $state = $this->getState($responseCode);

        if ($state) {
            $payment->setAdditionalInformation(
                'approve_messages',
                $messages
            );
        } else {
            $payment->setIsTransactionPending(false);
            $payment->setIsFraudDetected(true);
            $payment->setAdditionalInformation('error_messages', $messages);
        }
    }

    /**
     * @param int $responseCode
     * @return boolean
     */
    protected function getState($responseCode)
    {
        if ($responseCode == 'null' || (int)$responseCode >= 50) {
            return false;
        }
        return true;
    }
}
