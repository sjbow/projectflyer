<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Photo;

class Flyer extends Model
{

	/**
	 * @var array $fillable Fillable fields for flyer
	 */
	protected $fillable = [
		'street',
		'city',
		'state',
		'country',
		'zip',
		'price',
		'description'
	];

	/**
	 * A flyer is composed of many photos
	 * @author <sbow>
	 * @added on the 28/01/2016
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function photos(){

		return $this->hasMany('App\Photo');
	}

	/**
	 * Scope query for replacing spaces in the address and searching by zip and street
	 * @author <sbow>
	 * @added on the 28/01/2016
	 * @param $query
	 * @param $zip
	 * @param $street
	 * @return mixed
	 * @static
	 */
	public static function locatedAt( $zip, $street){

		$street = str_replace('-', ' ', $street);

		return static::where(compact('zip','street'))->first();
	}

	public function getPriceAttribute($price){
		return "$".money_format('%.2n', $price);
	}

	public function addPhoto(Photo $photo){

		return $this->photos()->save($photo);

	}
}
