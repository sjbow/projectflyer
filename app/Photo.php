<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

	protected $table = 'flyer_photos';

	protected $fillable = ['photo'];

	/**
	 * A belongs to a flyer
	 * @author <sbow>
	 * @added on the 28/01/2016
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function flyer(){

		return $this->belongsTo('App\Flyer');
	}
}
