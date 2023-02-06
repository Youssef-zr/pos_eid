<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\client\ClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:read_clients'])->only('index');
        $this->middleware(['permission:create_clients'])->only(['create', "store"]);
        $this->middleware(['permission:update_clients'])->only(['edit', "update"]);
        $this->middleware(['permission:delete_clients'])->only('destroy');
    }

    public function index()
    {
        $title = trans('lang.clients_list');
        $clients = Client::all();

        return view("dashboard.views.clients.index", compact('clients', "title"));
    }

    public function create()
    {
        $title = trans('lang.clients_create');

        return view('dashboard.views.clients.create', compact('title'));
    }

    public function store(ClientRequest $request)
    {
        $data = $request->all();
        
        $new = new Client();
        $new->fill($data)->save();

        return redirect_with_flash("msgSuccess", trans("lang.record_added_successfully"), 'clients');
    }

    public function edit(Client $client)
    {
        $title = trans("clients.client_new");

        return view("dashboard.views.clients.update", compact("title", "client"));
    }

    public function update(ClientRequest $request, Client $client)
    {
        $data = $request->all();
        $client->fill($data)->save();

        return redirect_with_flash("msgSuccess", trans("lang.record_updated_successfully"), "clients");
    }

    public function destroy(Client $client)
    {
        $client->delete();

        return redirect_with_flash("msgSuccess", trans("lang.record_deleted_successfully"), "clients");
    }
}
