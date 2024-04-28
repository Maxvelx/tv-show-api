<?php

namespace App\Application\Utilities\MediaContent;

use App\Services\MediaContent\TvShowsApiContract;

class TvShowsUtilities implements TvShowsUtilitiesContract
{

    /**
     * Api to search TV shows.
     *
     * @var TvShowsApiContract
     */
    private $contentApi;

    public function __construct(TvShowsApiContract $mediaContentApi)
    {
        $this->contentApi = $mediaContentApi;
    }

    /**
     * Search TV shows by keyword.
     *
     * @param array $data An associative array containing the search data.
     *                    - 'q' (string): The keyword to search for.
     *
     * @return array An associative array with the search result.
     *               - 'status' (string): The status of the search operation ('success', 'not_found', 'error').
     *               - 'result' (array): An array containing the search result.
     *               - 'statusCode' (int): The HTTP status code of the response.
     */
    public function searchTvShowsByKeyword(array $data): array
    {
        $keyword = strtolower($data['q']);
        $searchResult = $this->contentApi->showSearch($keyword);

        if ($searchResult['status'] === 'success') {
            $tvShow = $this->filterShowsByKeyword($keyword, $searchResult['result']);

            if (! empty($tvShow)) {
                return ['status' => 'success', 'result' => $tvShow, 'statusCode' => 200];
            }
            return ['status' => 'not_found', 'result' => [], 'statusCode' => 404];
        }

        return ['status' => 'error', 'result' => [], 'statusCode' => 500];
    }

    /**
     * Filter shows by keyword.
     *
     * @param string $keyword The keyword to filter shows by.
     * @param array $searchResult The array containing the search results.
     *
     * @return array The filtered array of shows.
     */
    public function filterShowsByKeyword(string $keyword, array $searchResult): array
    {
        return array_filter($searchResult, function ($item) use ($keyword) {
            return strtolower($item['show']['name']) === trim($keyword);
        });
    }
}
