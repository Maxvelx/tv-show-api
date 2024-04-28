<?php

namespace App\Services\MediaContent;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class TVMazeAPI implements TvShowsApiContract
{

    /**
     * Guzzle client instance
     *
     * @var Client
     */
    private $client;

    /**
     * Constructor for TVMazeAPI
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = new Client([
            'base_uri' => config('services.tvmaze.base_url'),
        ]);
    }

    /**
     * Search TV shows.
     *
     * @param string $data The search query.
     *
     * @return array An array containing the search result.
     *               - 'status' (string): The status of the search operation ('success', 'error').
     *               - 'result' (array): An array containing the search result.
     */
    public function showSearch(string $data): array
    {
        try {
            return Cache::remember('tvs-q='.$data, now()->addHour(), function () use ($data) {
                $response = $this->client->request('GET', 'search/shows', [
                    'query' => [
                        'q' => $data
                    ]
                ]);
                return ['status' => 'success', 'result' => json_decode($response->getBody()->getContents(), true)];
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return ['status' => 'error', 'result' => []];
        }
    }
}
