<?php

namespace App\Services\ThirdParty;

use App\Exceptions\InvalidResponseException;
use App\Services\ThirdParty\Contracts\IntegrationInterface;
use App\Services\ThirdParty\Providers\Trendyol;

class TrendyolAdapter implements IntegrationInterface
{
    public Trendyol $library;

    public function __construct()
    {
        $this->library = new Trendyol();
    }

    /**
     * @throws InvalidResponseException
     */
    public function createIntegration(array $data): array
    {
        $response = [];

        try {
            $response = $this->library->saveIntegration($data);
            $result = $response['SaveIntegrationResponse'];

            $adapterData = ['status' => $result['status']];
            $result['status'] ?
                $adapterData['reference'] = $result['trendyol_reference'] :
                $adapterData['message'] = $result['message'];

            return $adapterData;
        } catch (\Exception $exception) {
            throw new InvalidResponseException($exception->getMessage() . ': ' . json_encode($response));
        }
    }

    /**
     * @throws InvalidResponseException
     */
    public function updateIntegration(string $reference, array $data): array
    {
        $response = [];

        try {
            $response = $this->library->modifyIntegration($reference, $data);
            $result = $response['ModifyIntegrationResponse'];

            $adapterData = ['status' => $result['status']];
            if (!$result['status'])
                $adapterData['message'] = $result['message'];

            return $adapterData;
        } catch (\Exception $exception) {
            throw new InvalidResponseException($exception->getMessage() . ': ' . json_encode($response));
        }
    }

    /**
     * @throws InvalidResponseException
     */
    public function deleteIntegration(string $reference): array
    {
        $response = [];

        try {
            $response = $this->library->destroyIntegration($reference);
            $result = $response['DestroyIntegrationResponse'];

            $adapterData = ['status' => $result['status']];
            if (!$result['status'])
                $adapterData['message'] = $result['message'];

            return $adapterData;
        } catch (\Exception $exception) {
            throw new InvalidResponseException($exception->getMessage() . ': ' . json_encode($response));
        }
    }
}
