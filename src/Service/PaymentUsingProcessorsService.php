<?php

namespace App\Service;

use App\Entity\Client;
use App\Domain\Payment\PaymentProcessor;
use Service\TransactionService;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

class PaymentHandler
{
    /**
     * @param array $processors<PaymentProcessor>
     */
    public function __construct(
        #[TaggedIterator(tag: 'app.payment.processor')]
        private iterable $processors,
        private TransactionService $transactionService,
    ) {
    }

    public function processPayment(Client $client, float $orderTotal): void
    {
        $finalAmount = $orderTotal;

        foreach ($this->processors as $processor) {
            if ($processor->supports($client)) {
                $finalAmount = $processor->handle($finalAmount, $client);
            }
        }

        $this->transactionService->create($finalAmount, $client);
    }
}
