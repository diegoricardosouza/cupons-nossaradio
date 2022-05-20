<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateListMailFormRequest;
use App\Services\ListMailService;
use Illuminate\Http\Request;

class ListMailController extends Controller
{
    protected $listMailService;

    public function __construct(ListMailService $listMailService)
    {
        $this->listMailService = $listMailService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mails = $this->listMailService->getAllMails();

        return view('admin.listmail.index', compact('mails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.listmail.create');
    }

    public function store(StoreUpdateListMailFormRequest $request)
    {
        $mailCreated = $this->listMailService->createNewMail($request);

        if ($mailCreated)
            return redirect()->route('list.index')->with('user_success', 'Email criado com sucesso!');
    }

    public function edit($id)
    {
        if (!$mail = $this->listMailService->getMail($id))
            return redirect()->route('list.index');

        return view('admin.listmail.edit', compact('mail'));
    }

    public function update(StoreUpdateListMailFormRequest $request, $id)
    {
        if (!$this->listMailService->getMail($id))
            return redirect()->route('list.index');

        $mailUpdated = $this->listMailService->updateMail($id, $request);

        if ($mailUpdated)
            return redirect()->route('list.index')->with('user_success', 'E-mail Atualizado com sucesso!');
    }

    public function destroy($id)
    {
        if (!$this->listMailService->getMail($id))
            return redirect()->route('list.index');

        $this->listMailService->deleteMail($id);

        return redirect()->route('list.index')->with('user_success', 'Email Deletado com sucesso!');
    }
}
