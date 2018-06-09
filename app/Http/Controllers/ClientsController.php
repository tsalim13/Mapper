<?php

namespace App\Http\Controllers;

use App\Repositories\ClientRepository;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\ClientUpdateRequest;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    protected $clientRepository;

    //protected $nbrPerPage = 4;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function index()
    {
        $clients = $this->clientRepository->index();
        return view('clients',compact('clients'));
    }

    public function create()
    {
        return view('createClient');
    }

    public function store(ClientRequest $request)
    {
        $this->clientRepository->store($request->all());
        return redirect('client-edit');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $client = $this->clientRepository->getById($id);
        return view('editClient',  compact('client'));
    }

    public function update(ClientUpdateRequest $request, $id)
    {
        $this->clientRepository->update($id, $request->all());
        return redirect('client-edit');
    }

    public function destroy($id)
    {
        $this->clientRepository->destroy($id);
        return redirect('client-edit');
    }
}
