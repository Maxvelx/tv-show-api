<?php

namespace Tests\Feature\MediaContent;
use App\Application\Utilities\MediaContent\TvShowsUtilities;
use App\Services\MediaContent\TvShowsApiContract;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TvShowsUtilitiesTest extends TestCase
{
    use WithFaker;

    public function testSearchTvShowsByKeyword()
    {
        $apiMock = $this->createMock(TvShowsApiContract::class);

        $apiMock->expects($this->once())
            ->method('showSearch')
            ->willReturn([
                'status' => 'success',
                'result' => [
                    ['show' => ['name' => 'Girls']],
                    ['show' => ['name' => 'GIRLS']],
                    ['show' => ['name' => 'Beauty girls']]
                ]
            ]);

        $tvShowsUtilities = new TvShowsUtilities($apiMock);
        $result = $tvShowsUtilities->searchTvShowsByKeyword(['q' => 'girls']);

        $this->assertEquals([
            'status' => 'success',
            'result' => [['show' => ['name' => 'Girls']], ['show' => ['name' => 'GIRLS']]],
            'statusCode' => 200
        ], $result);
    }
}
