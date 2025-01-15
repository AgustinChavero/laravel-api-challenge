<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Services\MercadoPagoService;

class PaymentController extends Controller
{
    protected $mercadoPagoService;

    public function __construct(MercadoPagoService $mercadoPagoService)
    {
        $this->mercadoPagoService = $mercadoPagoService;
    }

    public function processPayment()
    {
        $authResponse = $this->validateAuthenticatedUser();
        if (is_string($authResponse)) {
            return response()->json([
                'status' => false,
                'message' => $authResponse,
            ], 404);
        }
        $user = $authResponse;

        $payment = Payment::create([
            'user_id' => $user->id,
            'status_id' => 1,
            'amount' => 100,
        ]);

        $preferenceData = [
            'items' => [
                [
                    'title' => 'Upgrade to Viewer Premium',
                    'quantity' => 1,
                    'currency_id' => 'ARS',
                    'unit_price' => 10,
                ],
            ],
            'payer' => [
                'email' => $user->email,
            ],
        ];

        $response = $this->mercadoPagoService->createPreference($preferenceData);

        if (!$response['status']) {
            return response()->json(['message' => $response['message']], 400);
        }

        return response()->json([
            'message' => 'Payment in progress.',
            'preference_url' => $response['preference'],
        ], 200);
    }

    public function completePayment()
    {
        $authResponse = $this->validateAuthenticatedUser();
        if (is_string($authResponse)) {
            return response()->json([
                'status' => false,
                'message' => $authResponse,
            ], 404);
        }
        $user = $authResponse;

        $payment = Payment::where('user_id', $user->id)
            ->where('status_id', 1)
            ->first();

        if (!$payment) {
            return response()->json([
                'status' => false,
                'message' => 'No pending payment found.',
            ], 404);
        }

        $payment->update(['status_id' => 2]);
        $user->update(['role_id' => 3]);

        return response()->json([
            'message' => 'Payment completed and role updated successfully.',
        ], 200);
    }
}
