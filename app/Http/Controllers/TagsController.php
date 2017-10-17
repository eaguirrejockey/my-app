<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tag;
use Laracasts\Flash\Flash;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $tags = Tag::search($request->name)->orderBy('id', 'DESC')->paginate(5);

        return view('admin.tags.index')->with('tags', $tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
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
        $tag = new Tag($request->all());

        if($tag->save())
            Flash::success('Tag: '.$tag->name.', creada con éxito');
        else
            Flash::error('Error: '.$tag->name.', no pudo ser creado.');

        return redirect()->route('tags.index');
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
        $tag = Tag::find($id);
        return view('admin.tags.edit', compact('tag'));
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

        $tag = Tag::find($id);

        $tag->fill($request->all());


        if($tag->save())
            Flash::success('Tag: '.$tag->name.', editado con éxito');
        else
            Flash::error('Error: '.$tag->name.', no pudo ser editado.');

        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);

        if($tag->delete())
            Flash::error('Tag: '.$tag->name.', eliminado con éxito.');
        else
            Flash::error('Error: '.$tag->name.', no pudeo ser eliminado.');

        return redirect()->route('tags.index');
    }
}
