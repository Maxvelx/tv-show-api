<?php

namespace App\Application\Utilities\MediaContent;

interface TvShowsUtilitiesContract
{

    /**
     * Search TV shows by keyword.
     * 
     * @param array $data
     *
     * @return mixed
     */
    public function searchTvShowsByKeyword(array $data);
}
