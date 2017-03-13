<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = "news";

    public function getDates() {
        return ["created_at", "modified_at"];
    }

    public function formatDate($date) {
        return \DateTime::createFromFormat("Y-m-d H:i:s", $date)->format("j F Y G:i");
    }
}
