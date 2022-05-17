<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreUpdateUserFormRequest;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userService->getAllUsers();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }


    public function store(StoreUpdateUserFormRequest $request)
    {
        $userCreated = $this->userService->createNewUser($request);

        if($userCreated)
            return redirect()->route('users.index')->with('user_success', 'Usuário criado com sucesso!');
    }

    public function edit($id)
    {
        if (!$user = $this->userService->getUser($id))
            return redirect()->route('users.index');

        return view('admin.users.edit', compact('user'));
    }

    public function update(StoreUpdateUserFormRequest $request, $id)
    {
        if (!$this->userService->getUser($id))
            return redirect()->route('users.index');

        $userUpdated = $this->userService->updateUser($id, $request);

        if ($userUpdated)
            return redirect()->route('users.index')->with('user_success', 'Usuário Atualizado com sucesso!');
    }

    public function destroy($id)
    {
        if (!$this->userService->getUser($id))
            return redirect()->route('users.index');

        $this->userService->deleteUser($id);

        return redirect()->route('users.index')->with('user_success', 'Usuário Deletado com sucesso!');
    }

    private function verifyUserExists($id, $route = 'users.index')
    {
        if (!$this->userService->getUser($id))
            return redirect()->route($route);
    }
}
