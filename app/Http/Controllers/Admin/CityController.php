<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCityFormRequest;
use App\Services\CityService;

class CityController extends Controller
{
    protected $cityService;

    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = $this->cityService->getAllCities();

        return view('admin.cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cities.create');
    }

    public function store(StoreUpdateCityFormRequest $request)
    {
        $cityCreated = $this->cityService->createNewCity($request);

        if ($cityCreated)
            return redirect()->route('cities.index')->with('user_success', 'Cidade cadastrada com sucesso!');
    }

    public function edit($id)
    {
        if (!$city = $this->cityService->getCity($id))
            return redirect()->route('cities.index');

        return view('admin.cities.edit', compact('city'));
    }

    public function update(StoreUpdateCityFormRequest $request, $id)
    {
        if (!$this->cityService->getCity($id))
            return redirect()->route('cities.index');

        $cityUpdated = $this->cityService->updateCity($id, $request);

        if ($cityUpdated)
            return redirect()->route('cities.index')->with('user_success', 'Cidade Atualizada com sucesso!');
    }

    public function destroy($id)
    {
        if (!$this->cityService->getCity($id))
            return redirect()->route('cities.index');

        $this->cityService->deleteCity($id);

        return redirect()->route('cities.index')->with('user_success', 'Cidade Deletada com sucesso!');
    }
}
