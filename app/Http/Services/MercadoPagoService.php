<?php

namespace App\Http\Services;

class MercadoPagoService
{
    public function createPreference(array $data)
    {
        $url = 'https://api.mercadopago.com/checkout/preferences';
        $accessToken = config('services.mercadopago.access_token');

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer $accessToken"
        ]);
        $payload = json_encode($data);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            curl_close($ch);
            return [
                'status' => false,
                'message' => 'Error al crear la preferencia: ' . curl_error($ch)
            ];
        }

        curl_close($ch);

        $result = json_decode($response, true);

        if (isset($result['init_point'])) {
            return [
                'status' => true,
                'preference' => $result['init_point']
            ];
        }

        return [
            'status' => false,
            'message' => 'No se pudo crear la preferencia de pago.'
        ];
    }
}
