<?php

namespace App\Service;

use App\Entity\Client;
use Service\TransactionService;

class PaymentService
{
    public function __construct(private TransactionService $transactionService)
    {
    }
    public function processPayment(Client $client, float $orderTotal): void
    {
        $finalAmount = $orderTotal;

        // Condition 1: Customer Loyalty Tier
        if ($client->getLoyaltyTier()->isGold()) {
            $finalAmount *= 0.9; // 10% discount for Gold tier
        } elseif ($client->getLoyaltyTier()->isSilver()) {
            $finalAmount *= 0.95; // 5% discount for Silver tier
        }

        // Condition 2: Purchase History
        if ($client->getPurchaseHistory() > 5) {
            $finalAmount *= 0.92; // Additional 8% discount for loyal customers
        }

        // Condition 3: Order Total
        if ($orderTotal > 1000) {
            $finalAmount *= 0.85; // 15% discount for large orders
        } elseif ($orderTotal > 500) {
            $finalAmount *= 0.95; // 5% discount for medium-sized orders
        }

        // Condition 4: Payment Method
        switch ($client->getPaymentMethod()) {
            case 'Credit Card':
                $finalAmount *= 0.9; // 10% discount for credit card payments
                break;
            case 'Digital Wallet':
                $finalAmount *= 0.93; // 7% discount for digital wallet payments
                break;
                // Add more cases for other payment methods
        }

        // Condition 5: Referral Program
        if (!empty($client->getReferralCode())) {
            $referralDiscount = ($client->getPurchaseHistory() > 10) ? 0.2 * 1.5 : 0.2;
            $finalAmount *= (1 - $referralDiscount); // Apply referral discount
        }

        // Condition 6: Promotional Period
        if ($client->getPromotinalPeriod() == 'HolidaySale') {
            $finalAmount *= 0.8; // 20% discount during holiday sale
        }

        // Condition 7: First Purchase
        if ($client->isFirstPurchase()) {
            $finalAmount *= 0.85; // 15% discount for the first purchase
        }

        // Condition 8: Subscription-based Discounts
        if ($client->getSubscription()->isPremium()) {
            $finalAmount *= 0.8; // 20% discount for premium subscriptions
        } elseif ($client->getSubscription()->isBasic()) {
            $finalAmount *= 0.9; // 10% discount for basic subscriptions
        }

        // Condition 9: Customer Segment
        if ($client->getCustomerSegment() == 'VIP') {
            $finalAmount *= 0.85; // 15% discount for VIP customers
        } elseif ($client->getCustomerSegment() == 'Corporate') {
            $finalAmount *= 0.88; // 12% discount for corporate customers
        }

        // we create the transaction
        $this->transactionService->create($finalAmount, $client);
    }
}
