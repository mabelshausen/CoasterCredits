<?php


namespace App\Repositories;


use App\Models\Park;
use Illuminate\Support\Facades\Http;

class CaptainParkApiRepository implements ParkRepository
{
    private $api_auth_token = 'c8435c21-2d27-4927-96d3-14e42f3b827e';
    private $url = 'https://captaincoaster.com/api/parks';

    public function get($id)
    {
        $response = Http::withHeaders([
            'X-AUTH-TOKEN' => $this->api_auth_token
        ])->get($this->url."/".$id);
        $data = json_decode($response, true);
        return $this->makePark($data);
    }

    private function makePark($data) : Park {
        return new Park(
            $data['id'],
            $data['name'],
            ($data['country']) ? $data['country']['name'] : null,
            $data['longitude'],
            $data['latitude']
        );
    }
}
