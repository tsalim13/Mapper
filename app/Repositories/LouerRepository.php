<?php

namespace App\Repositories;

use App\Marker;
use App\Client;
use App\Louer;

class LouerRepository
{

    protected $louer;

    public function __construct(Louer $louer)
	{
		$this->louer = $louer;
	}

	private function save(Louer $louer, Array $inputs)
	{
		$louer->client_id = $inputs['idClient'];
		$louer->marker_id = $inputs['idMarker'];
		$louer->fromDate = $inputs['dateDebut'];
		$louer->toDate = $inputs['dateFin'];

		$louer->save();
	}

	public function index()
	{
		//
	}

	public function store(Array $inputs)
	{
		$louer = new $this->louer;		
		$this->save($louer, $inputs);
		return $louer;
	}

	public function getById($id)
	{
		return $this->marker->findOrFail($id);
	}

	public function update($id, Array $inputs)
	{
		$this->save($this->getById($id), $inputs);
	}

	public function destroy($id)
	{
		$this->getById($id)->delete();
	}

}