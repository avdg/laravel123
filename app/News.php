<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ["news", "public"];
    protected $table = "news";

    public function formatDate($date) {
        return \DateTime::createFromFormat("Y-m-d H:i:s", $date)->format("j F Y G:i");
    }
}
