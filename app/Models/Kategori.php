<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
	protected $fillable = array('id', 'kategori');

	public $timestamps = false;

	protected $table = 'kategoribuku';
	protected $primaryKey = 'id';

	protected $hidden = array();
}
