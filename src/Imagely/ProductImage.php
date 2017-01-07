<?php
namespace Imagely;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'images';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
