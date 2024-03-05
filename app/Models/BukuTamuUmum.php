<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BukuTamuUmum extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bukutamu_umum'; // Specify the table name if it's different from the default "bukutamu_umum" table name.

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama', 'asal_daerah'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * Get the date of the guestbook entry's creation.
     *
     * @return string
     */

    /**
     * Get the date of the guestbook entry's last update.
     *
     * @return string
     */
    public function getUpdatedAtAttribute()
    {
        return $this->attributes['updated_at']->format('Y-m-d H:i:s');
    }
}
