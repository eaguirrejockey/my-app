<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Laracasts\Flash\Flash;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(5);

        return view('admin.categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules=[
            'name'=>'min:4|max:120|required'
        ];

        $this->validate($request, $rules);
        $category = new Category($request->all());

        if($category->save())
            Flash::success('Categoría: '.$category->name.', creada con éxito');
        else
            Flash::error('Error: '.$category->name.', no pudo ser creado.');

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules=[
            'name'=>'min:4|max:120|required'
        ];

        $this->validate($request, $rules);

        $category = Category::find($id);

        $category->fill($request->all());


        if($category->save())
            Flash::success('Categoría: '.$category->name.', editado con éxito');
        else
            Flash::error('Error: '.$category->name.', no pudo ser editada.');

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if($category->delete())
            Flash::error('Categoría: '.$category->name.', eliminado con éxito.');
        else
            Flash::error('Error: '.$category->name.', no pudeo ser eliminada.');

        return redirect()->route('categories.index');
    }
}
