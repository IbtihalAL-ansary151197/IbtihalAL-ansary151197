<?php
 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asminModel extends Model
{
    use HasFactory;
    protected $table    = "test";
    protected $fillable = [
                            "title",
                            "description",
                            "start_date",
                            "end_date",
                            "image",
                           
                        ];

}
