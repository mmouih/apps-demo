<?php

namespace App\Service;

use App\Entity\Client;
use App\Entity\LoyaltyTier;
use App\Entity\Subscription;
use Service\TransactionService;

class PaymentService
{
    public function __construct(private TransactionService $transactionService)
    {
    }

    public function processPayment(Client $client, float $orderTotal): void
    {
        $finalAmount = $this->applyLoyaltyDiscount($orderTotal, $client->getLoyaltyTier());
        $finalAmount = $this->applyPurchaseHistoryDiscount($finalAmount, $client->getPurchaseHistory());
        $finalAmount = $this->applyOrderTotalDiscount($finalAmount, $orderTotal);
        $finalAmount = $this->applyPaymentMethodDiscount($finalAmount, $client->getPaymentMethod());
        $finalAmount = $this->applyReferralDiscount($finalAmount, $client->getReferralCode(), $client->getPurchaseHistory());
        $finalAmount = $this->applyPromotionalDiscount($finalAmount, $client->getPromotionalPeriod());
        $finalAmount = $this->applyFirstPurchaseDiscount($finalAmount, $client->isFirstPurchase());
        $finalAmount = $this->applySubscriptionDiscount($finalAmount, $client->getSubscription()->getType());
        $finalAmount = $this->applyCustomerSegmentDiscount($finalAmount, $client->getCustomerSegment());

        $this->transactionService->create($finalAmount, $client);
    }

    private function applyLoyaltyDiscount(float $amount, LoyaltyTier $loyaltyTier): float
    {
        if ($loyaltyTier->isGold()) {
            return $amount * 0.9; // 10% discount for Gold tier
        }

        if ($loyaltyTier->isSilver()) {
            return $amount * 0.95; // 5% discount for Silver tier
        }

        return $amount;
    }

    private function applyPurchaseHistoryDiscount(float $amount, int $purchaseHistory): float
    {
        if ($purchaseHistory > 5) {
            return $amount * 0.92; // Additional 8% discount for loyal customers
        }

        return $amount;
    }

    private function applyOrderTotalDiscount(float $amount, float $orderTotal): float
    {
        if ($orderTotal > 1000) {
            return $amount * 0.85; // 15% discount for large orders
        }

        if ($orderTotal > 500) {
            return $amount * 0.95; // 5% discount for medium-sized orders
        }

        return $amount;
    }

    private function applyPaymentMethodDiscount(float $amount, string $paymentMethod): float
    {
        switch ($paymentMethod) {
            case 'Credit Card':
                return $amount * 0.9; // 10% discount for credit card payments
            case 'Digital Wallet':
                return $amount * 0.93; // 7% discount for digital wallet payments
        }

        return $amount;
    }

    private function applyReferralDiscount(float $amount, string $referralCode, int $purchaseHistory): float
    {
        if (!empty($referralCode)) {
            $referralDiscount = ($purchaseHistory > 10) ? 0.2 * 1.5 : 0.2;
            return $amount * (1 - $referralDiscount); // Apply referral discount
        }
        return $amount;
    }

    private function applyPromotionalDiscount(float $amount, string $promotionalPeriod): float
    {
        if ($promotionalPeriod == 'HolidaySale') {
            return $amount * 0.8; // 20% discount during holiday sale
        }

        return $amount;
    }

    private function applyFirstPurchaseDiscount(float $amount, bool $isFirstPurchase): float
    {
        if ($isFirstPurchase) {
            return $amount * 0.85; // 15% discount for the first purchase
        }

        return $amount;
    }

    private function applySubscriptionDiscount(float $amount, Subscription $subscription): float
    {
        if ($subscription->isPremium()) {
            return $amount * 0.8; // 20% discount for premium subscriptions
        }

        if ($subscription->isBasic()) {
            return $amount * 0.9; // 10% discount for basic subscriptions
        }

        return $amount;
    }

    private function applyCustomerSegmentDiscount(float $amount, string $customerSegment): float
    {
        if ($customerSegment == 'VIP') {
            return $amount * 0.85; // 15% discount for VIP customers
        } elseif ($customerSegment == 'Corporate') {
            return $amount * 0.88; // 12% discount for corporate customers
        }
        return $amount;
    }
}
