<?php

namespace App\Repositories;

use App\Marker;

class MarkerRepository
{

    protected $marker;

    public function __construct(Marker $marker)
	{
		$this->marker = $marker;
	}

	private function save(Marker $marker, Array $inputs)
	{
		$marker->name = $inputs['nom'];
		$marker->lat = $inputs['lat'];
		$marker->lng = $inputs['lng'];
		$marker->type = $inputs['type'];
		$marker->etat = $inputs['etat'];

		$marker->save();
	}

	public function index()
	{
		return $this->marker->all();
	}

	public function store(Array $inputs)
	{
		$marker = new $this->marker;		

		$this->save($marker, $inputs);

		return $marker;
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