<?php
// StripeController.php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../models/UserModel.php';

class StripeController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new UserModel($pdo);
    }

    public function stripeWebhook($request, $response, $args) {
        $payload = $request->getBody()->getContents();
        $endpoint_secret = 'your_stripe_endpoint_secret';
        $signature = $request->getHeaderLine('Stripe-Signature');

        try {
            $event = \Stripe\Webhook::constructEvent($payload, $signature, $endpoint_secret);

            switch ($event->type) {
                case 'checkout.session.completed':
                    $session = $event->data->object;
                    $userEmail = $session->customer_email;

                    if ($userEmail) {
                        $this->userModel->setUserAsPaid($userEmail);
                    }
                    break;
                // ... handle other event types as needed
            }

            return $response->withStatus(200);
        } catch (\Exception $e) {
            // Log the error and respond with an error status
            error_log("Stripe Webhook Error: " . $e->getMessage());
            return $response->withStatus(500)->write("Error: " . $e->getMessage());
        }
    }

    // Additional methods as necessary
}
