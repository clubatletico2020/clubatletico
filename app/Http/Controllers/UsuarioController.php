<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Usuario\UsuarioRequest;
use Illuminate\Support\Facades\Hash;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use App\User;

class UsuarioController extends Controller
{   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   

        $usuarios = User::all();
        $roles = Role::all();
        $permisos = Permission::all();
        return view('backend.pages.usuario.index', compact('usuarios', 'roles', 'permisos'));
    }

    public function create()
    {
        $usuarios = User::all();
        return response()->json($usuarios);
    }

    public function store(UsuarioRequest $request)
    {
        $user = User::create(['name' => ucwords(strtolower($request->name)), 'email' => $request->email, 'password' => Hash::make($request->password)]);
        $user->roles()->sync($request->get('roles'));
        $user->permissions()->sync($request->get('permissions'));
        return response()->json("Usuario añadido exitosamente. ");
    }

    public function edit($id)
    {
        $usuario = User::find($id);
        $roles = Role::all();
        $permisos = Permission::all();
        return view('backend.pages.usuario.edit', compact('usuario', 'roles', 'permisos'));
    }

    public function update(UsuarioRequest $request, $id)
    {
        $user = User::updateOrCreate(['id' => $id],['name' => ucwords(strtolower($request->name)), 'email' => $request->email]);
        $user->roles()->sync($request->get('roles'));
        $user->permissions()->sync($request->get('permissions'));
        return redirect()->route('usuario.index')->with('success', 'Usuario actualizado exitosamente. ');
    }

    public function password(UsuarioRequest $request, $id)
    {
        User::updateOrCreate(['id' => $id],['password' => Hash::make($request->password)]);
        return response()->json("Contraseña de usuario actualizada exitosamente.");
    }

    public function destroy($id)
    {
        User::destroy($id);
        return response()->json("Usuario eliminado exitosamente. ");
    }
}
