<?php


namespace App\Repositories;


use App\Models\Coaster;
use Illuminate\Support\Facades\Http;

class CaptainCoasterApiRepository implements CoasterRepository
{

    private $api_auth_token = 'c8435c21-2d27-4927-96d3-14e42f3b827e';
    private $url = 'https://captaincoaster.com/api/coasters';

    public function get($id)
    {
        $response = Http::withHeaders([
            'X-AUTH-TOKEN' => $this->api_auth_token
        ])->get($this->url."/".$id);
        $data = json_decode($response, true);
        return $this->makeCoaster($data);
    }

    public function getByName($name) {
        $response = Http::withHeaders([
            'X-AUTH-TOKEN' => $this->api_auth_token
        ])->get($this->url, [
            'name' => $name
        ]);
        $coasters = [];
        $dataCollection = json_decode($response, true)['hydra:member'];
        foreach ($dataCollection as $coasterData) {
            array_push($coasters, $this->makeCoaster($coasterData));
        }
        return $coasters;
    }

    public function all($page)
    {
        $response = Http::withHeaders([
            'X-AUTH-TOKEN' => $this->api_auth_token
        ])->get($this->url, [
            'page' => $page
        ]);
        $coasters = [];
        $dataCollection = json_decode($response, true)['hydra:member'];
        foreach ($dataCollection as $coasterData) {
            array_push($coasters, $this->makeCoaster($coasterData));
        }
        return $coasters;
    }

    public function count()
    {
        $response = Http::withHeaders([
            'X-AUTH-TOKEN' => $this->api_auth_token
        ])->get($this->url);

        return json_decode($response, true)['hydra:totalItems'];
    }



    private function makeCoaster($data): Coaster
    {
        $statuses = [
            'status.operating' => 'Operating',
            'status.closed.definitely' => 'Permanently Closed',
            'status.construction' => 'Under Construction',
            'status.relocated' => 'Relocated',
            'status.announced' => 'Announced',
            'status.unknown' => 'Unknown',
            'status.retracked' => 'Retracked',
            'status.closed.temporarily' => 'Temporarily Closed',
            'status.rumored' => 'Rumored'
        ];

        return new Coaster(
            $data['id'],
            $data['name'],
            ($data['materialType']) ? $data['materialType']['name'] : null,
            ($data['seatingType']) ? $data['seatingType']['name'] : null,
            $data['speed'],
            $data['height'],
            $data['length'],
            $data['inversionsNumber'],
            ($data['manufacturer']) ? $data['manufacturer']['name'] : null,
            ($data['park']) ? $data['park']['name'] : null,
            ($data['park']) ? explode('/', $data['park']['@id'])[3] : null,
            ($data['status']) ? $statuses[$data['status']['name']] : null,
            $data['rank'],
            ($data['mainImage']) ? $data['mainImage']['path'] : null
        );
    }
}
