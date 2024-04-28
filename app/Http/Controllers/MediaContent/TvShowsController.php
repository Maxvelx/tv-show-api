<?php

namespace App\Http\Controllers\MediaContent;

use App\Application\Utilities\MediaContent\TvShowsUtilitiesContract;
use App\Http\Requests\MediaContent\TvShowsRequest;
use Illuminate\Http\JsonResponse;

class TvShowsController
{
    /**
     * Class responsible for handling logic related to the TVShowsController.
     * 
     * @var TvShowsUtilitiesContract 
     */
    private TvShowsUtilitiesContract $utilities;
    
    public function __construct(TvShowsUtilitiesContract $utilities)
    {
        $this->utilities = $utilities;
    }

    /**
     * Process the request for TV shows.
     *
     * @param TvShowsRequest $request The request object containing validated data.
     *
     * @return JsonResponse A JSON response containing the result.
     */
    public function processRequest(TvShowsRequest $request): JsonResponse
    {
        $data = $request->validated();
        $result = $this->utilities->searchTvShowsByKeyword($data);

        return response()->json(
            [
                'status' => $result['status'],
                'result' => $result['result']
            ],
            $result['statusCode']
        );
    }
}
