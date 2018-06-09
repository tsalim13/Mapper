<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Client;
use App\Louer;

class EtatMarkerController extends Controller
{

	protected $marker;
	protected $louer;

    public function __construct(Client $client,Louer $louer)
	{
		$this->client = $client;
		$this->louer = $louer;
	}

    public function find($id)
    {
        $louer = $this->louer->where('marker_id', $id)->first();
        //$marker = $this->marker->findOrFail($id);
        if($louer != null)
        {
        	$client = $this->client->find($louer->client_id);
        	$collection = collect(['client' => $client->name, 'toDate' => $louer->toDate]);
        	return $collection;
        }
        else { return false; }
    }
}
