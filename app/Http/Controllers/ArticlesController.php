<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Laracasts\Flash\Flash;
use App\Category;
use App\Image;
use App\Tag;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articles = Article::searchByTitle($request->title)->orderBy('id', 'DESC')->paginate(5);

        return view('admin.articles.index')->with('articles', $articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories= Category::orderBy('name', 'ASC')->pluck('name','id');
        $tags= Tag::orderBy('name', 'ASC')->pluck('name','id');
        return view('admin.articles.create',compact('categories','tags'));
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
            'title'       => 'min:8|max:250|required',
            'category_id' => 'required',
            'content'     => 'min:60|max:1200|required',
            'image'       => 'image|required'
        ];
        $this->validate($request, $rules);

        $article=new Article($request->all());
        $article->user_id= \Auth::user()->id;

        $article->save();

        $article->tags()->sync($request->tags) ;

        $file = $request->file('image');
        $name = pathinfo($file->getClientOriginalName())['filename'].'_'.time().'.'.$file->getClientOriginalExtension();
        $path = public_path().'/images/articles/';
        $file->move($path, $name);

        $image=new Image();
        $image->name=$name;
        $image->article()->associate($article);

        $image->save();

        Flash::success('Se ha creado el artículo: '.$article->title);

        return redirect()->route('articles.index');
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
        $article    = Article::find($id);
        $tags_ids   = $article->tags->pluck('id');
        $categories = Category::orderBy('name', 'ASC')->pluck('name','id');
        $tags= Tag::orderBy('name', 'ASC')->pluck('name','id');

        return view('admin.articles.edit',compact(
            'categories',
            'tags',
            'article',
            'tags_ids'
        ));
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
            'title'       => 'min:8|max:250|required',
            'category_id' => 'required',
            'content'     => 'min:60|max:1200|required'
        ];
        $this->validate($request, $rules);

        $article = Article::find($id);
        $article->fill($request->all());
        $article->save();
        $article->tags()->sync($request->tags);
        Flash::success('Se ha editado el artículo: '.$article->title);

        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);

        if($article->delete())
            Flash::error('Artículo: '.$article->title.', eliminado con éxito.');
        else
            Flash::error('Error: '.$article->title.', no pudeo ser eliminado.');

        return redirect()->route('articles.index');
    }

    public function searchByCategoryName($name)
    {
        $category = Category::searchByName($name)->first();
        $articles = Article::searchByCategoryId($category->id)->orderBy('id', 'DESC')->paginate(5);

        return view('admin.articles.index')->with('articles', $articles);
    }

    public function searchByTagId($id)
    {
        $tag =  Tag::find($id);
        $articles =$tag->articles()->orderBy('id', 'DESC')->paginate(5);

        return view('admin.articles.index')->with('articles', $articles);
    }

}
