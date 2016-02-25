<?php

/**
 *
 * @author <sbow>
 * @added on the 25/02/2016
 * @param null $title
 * @param null $message
 * @return \Illuminate\Foundation\Application|mixed
 */
function flash($title = null, $message = null){
	$flash = app('App\Http\Flash');

	if(func_num_args() == 0){
		return $flash;
	}
	return $flash->info($title, $message);
}