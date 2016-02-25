<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Photo extends Model
{

	protected $table = 'flyer_photos';

	protected $fillable = ['path'];

	protected $baseDir = 'flyer/photos/';

	/**
	 * A belongs to a flyer
	 * @author <sbow>
	 * @added on the 28/01/2016
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function flyer(){

		return $this->belongsTo('App\Flyer');
	}

	public static function fromForm(UploadedFile $file){

		$photo = new static;

		$name = time() . $file->getClientOriginalName();

		$photo->path = $photo->baseDir . $name;

		$file->move($photo->baseDir, $name);

		return $photo;
	}
}
