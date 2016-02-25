<?php

namespace App;

use Intervention\Image\Facades\Image as Image;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class Photo extends Model
{

	protected $table = 'flyer_photos';

	protected $fillable = ['path'];

	protected $baseDir = 'flyer/photos';

	/**
	 * A belongs to a flyer
	 * @author <sbow>
	 * @added on the 28/01/2016
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function flyer(){

		return $this->belongsTo('App\Flyer');
	}

	public static function named($name){

		return (new static)->saveAs($name);
	}

	public function saveAs($name){

		$this->name = sprintf("%s-%s", time(), $name);
		$this->path = sprintf("%s/%s", $this->baseDir, $this->name);
		$this->thumbnail_path = sprintf("%s/tn-%s", $this->baseDir, $this->name);

		return $this;
	}

	public function move(UploadedFile $file){

		$file->move($this->baseDir, $this->name);

		$this->makeThumbnail();

		return $this;
	}

	protected function makeThumbnail(){

		Image::make($this->path)->fit(200)->save($this->thumbnail_path);
	}
}
