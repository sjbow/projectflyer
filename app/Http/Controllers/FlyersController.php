<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests\FlyerRequest;
use App\Flyer;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;

//use Requests;


class FlyersController extends Controller
{


	public function __construct(){
		$this->middleware('auth', ['except' => ['show']]);
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('flyers.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(FlyerRequest $request)
	{
		Flyer::create($request->all());

		flash()->success("Success", "Your flyer has been created");

		return redirect()->back(); //temp
	}

	/**
	 * Show the flyer
	 * @author <sbow>
	 * @added on the 25/02/2016
	 * @param $zip
	 * @param $street
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function show($zip, $street)
	{
		$flyer = Flyer::locatedAt($zip, $street);

		return view('flyers.show', compact('flyer'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		//
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
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}

	public function addPhoto($zip, $street,Request $request){

		$this->validate($request, [
			'photo' => 'required|mimes:jpg,jpeg,png,bmp'
		]);

		$photo = $this->makePhoto($request->file('photo'));

		Flyer::locatedAt($zip, $street)->addPhoto($photo);

	}

	public function makePhoto(UploadedFile $file){

		return Photo::named($file->getClientOriginalName())->move($file);
	}
}