<?php

namespace App\Services\MediaContent;

interface TvShowsApiContract
{

    /**
     * Search tv shows
     * 
     * @param string $data
     *
     * @return array
     */
    public function showSearch(string $data): array;
}
