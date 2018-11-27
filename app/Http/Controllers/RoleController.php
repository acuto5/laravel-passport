<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $roles = Role::query()->paginate();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        Role::query()->create($request->toArray());

        return redirect()->route('role.index')
            ->with('status', 'Role created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $role = Role::query()->findOrFail($role->id);

        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleRequest $request
     * @param  \App\Role $role
     * @return RedirectResponse
     */
    public function update(RoleRequest $request, Role $role): RedirectResponse
    {
        Role::query()->find($role->id)->update($request->toArray());

        return redirect()->route('role.index')
            ->with('status', 'Role updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role $role
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Role $role): RedirectResponse
    {
        Role::query()->findOrFail($role->id)->delete();

        return redirect()->route('role.index')
            ->with('status', 'Role deleted successfully!');
    }
}
