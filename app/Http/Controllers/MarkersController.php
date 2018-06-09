<?php

namespace App\Http\Controllers;

use App\Gestion\DataXmlGestion;
use App\Repositories\MarkerRepository;
use Illuminate\Http\Request;

class MarkersController extends Controller
{

    protected $markerRepository;
    protected $dataXmlGestion;

    public function __construct(MarkerRepository $markerRepository,DataXmlGestion $dataXmlGestion)
    {
        $this->markerRepository = $markerRepository;
        $this->dataXmlGestion = $dataXmlGestion;
    }

    public function index()
    {
        $markers = $this->markerRepository->index();
        $this->dataXmlGestion->generateXml($markers);
        return view('mapEdit',compact('markers'));
    }

    /*public function create()
    {
        return view('create');
    }*/

    public function store(Request $request)
    {
        $marker = $this->markerRepository->store($request->all());
        return redirect('edit');
    }

    public function show($id)
    {
        $marker = $this->markerRepository->getById($id);
        return view('mapEdit');
    }

    /*public function edit($id)
    {
        $user = $this->userRepository->getById($id);

        return view('edit',  compact('user'));
    }*/

    /*public function update(UserUpdateRequest $request, $id)
    {
        $this->userRepository->update($id, $request->all());
        
        return redirect('user')->withOk("L'utilisateur " . $request->input('name') . " a été modifié.");
    }*/

    public function destroy($id)
    {
        $this->markerRepository->destroy($id);
        return redirect('edit');
    }

}