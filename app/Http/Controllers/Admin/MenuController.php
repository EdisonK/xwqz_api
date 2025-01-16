<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menu_list = Menu::where('pid',0)
            ->where('status',1)
            ->with('children')->get();
        return $this->successWithData($menu_list);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'path' => 'required',
            'name' => 'nullable|string',
            'label' => 'required',
            'icon' => 'required',
            'url' => 'nullable|string',
        ],[
            'path.required' => '路径 不能为空'
        ]);

        $menu = Menu::create($request->only(['path','name','label','icon','url']));
        return $this->successWithData($menu);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
