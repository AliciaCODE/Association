<?php

// app/Model/AbonneModel.php

namespace App\Model;

use App\App;
use App\Weblitzer\Model;


class ProductModel extends Model
{
    protected static $table = 'products';


    public static function insert($post)
    {
        App::getDatabase()->prepareInsert("INSERT INTO " . self::getTable() . " (titre,reference,description,created_at) VALUES (?,?,?,NOW()) ",[$post['titre'],$post['reference'],$post['description']]);
    }

    public static function update($id,$post)
    {
        App::getDatabase()->prepareInsert(
            "UPDATE ". self::getTable() . "
            SET titre = ?,reference = ?,description = ?
            WHERE id = ?",
            array($post['titre'],$post['reference'],$post['description'],$id)
        );
    }

}
