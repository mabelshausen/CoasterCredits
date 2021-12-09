<?php


namespace App\Repositories;


use App\Models\Coaster;
use Illuminate\Support\Facades\Http;

class CaptainCoasterApiRepository implements CoasterRepository
{

    private $api_auth_token = 'c8435c21-2d27-4927-96d3-14e42f3b827e';

    public function get($id)
    {
        $response = Http::withHeaders([
            'X-AUTH-TOKEN' => $this->api_auth_token
        ])->get('https://captaincoaster.com/api/coasters', [
            'id' => $id
        ]);
        $data = json_decode($response, true)['hydra:member'][0];
        return $this->makeCoaster($data);
    }

    public function all($page)
    {
        // TODO: Implement all() method.
    }

    private function makeCoaster($data): Coaster
    {
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
            ($data['status']) ? $data['status']['name'] : null,
            $data['rank'],
            ($data['mainImage']) ? $data['mainImage']['path'] : null
        );
    }
}
