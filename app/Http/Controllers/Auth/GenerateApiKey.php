<?php

namespace App\Http\Controllers\Auth;

use App\Application\Utilities\Users\DataRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GenerateApiKey
{
    /**
     * Data repository instance
     *
     * @var DataRepository
     */
    private DataRepository $dataRepository;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->dataRepository = new DataRepository();
    }
    /**
     * Generate new api_key
     *
     * @return JsonResponse
     */
    public function generateNewApiKey(): JsonResponse
    {
        try {
            $apiKey = Str::random(32);
            $user = auth()->user();
            $this->dataRepository->update($user, ['api_key' => $apiKey]);

            return response()->json(['status' => 'success', 'api_key' => $apiKey]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Something went wrong'], 500);
        }
    }
}
