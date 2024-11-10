<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PetStoreService
{
    private string $baseUrl;
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->baseUrl = env('PET_API_URL');
    }
    public function addPet(array $data)
    {
        $response = Http::post("{$this->baseUrl}", $data);
        return $response;
    }

    public function getPet(int $id)
    {
        $response = Http::get("{$this->baseUrl}/{$id}");
        \Log::info('API GET Response:', [
            'id' => $id,
            'response_data' => $response->json(),
            'status_code' => $response->status()
        ]);
        return $response->json();
    }
    

    public function updatePet(array $data, int $id)
    {
        $data['id'] = $id;  // Add the id to the data array
        $response = Http::put("{$this->baseUrl}", $data);
        return $response->json();
    }

    public function deletePet(int $id)
    {
        $response = Http::delete("{$this->baseUrl}/{$id}");
        return $response->json();
    }

}
