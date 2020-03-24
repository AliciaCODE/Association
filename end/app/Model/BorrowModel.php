<?php

// app/Model/AbonneModel.php

namespace App\Model;

use App\App;
use App\Weblitzer\Model;


class BorrowModel extends Model
{
    protected static $table = 'borrows';

    public static function insert($post)
    {
        App::getDatabase()->prepareInsert("INSERT INTO " . self::getTable() . " (id_abonne,id_product,date_start,date_end) VALUES (?,?,NOW(),NULL) ",[$post['id_abonne'],$post['id_product']]);
    }

    public static function getAllStartWithProductAndAbonne()
    {
        // selectionne toutes les collones que je veux utiliser sur mes trois table
            // je l'ai renomme avec AS pour etre sure de bien cibler les bonnes collones de bonnes table qui m'interresse

        // Je fait successivement mes deux jointures
            // je joins abonnes que je renomme a =>  ou abonnes.id = borrow.id_abonne
            // je joins produits que je renomme p => ou produits.id = borrow.id_product


        return App::getDatabase()->query("SELECT b.id AS id,a.nom AS nom, a.prenom AS prenom, p.titre AS titre,b.date_start
                    FROM " . self::getTable() . " AS b
                    LEFT JOIN abonnes AS a
                    ON b.id_abonne = a.id
                    LEFT JOIN produits AS p
                    ON b.id_product = p.id
                    WHERE date_end IS NULL
                    ORDER BY date_start DESC",get_called_class());

    }

    public static function historique()
    {
        return App::getDatabase()->query("SELECT b.id AS id,a.nom AS nom, a.prenom AS prenom, p.titre AS titre ,b.date_start,b.date_end
                    FROM " . self::getTable() . " AS b
                    LEFT JOIN abonnes AS a
                    ON b.id_abonne = a.id
                    LEFT JOIN produits AS p
                    ON b.id_product = p.id
                    WHERE date_end IS NOT NULL
                    ORDER BY date_end DESC",get_called_class());
    }

    public static function count_dateend_is_null()
    {
        $sql = "SELECT COUNT(id) FROM " . self::getTable() . " WHERE date_end IS NULL";
        return App::getDatabase()->aggregation($sql);
    }

    public static function rendu($id)
    {
        App::getDatabase()->prepareInsert("UPDATE " . self::getTable() . " SET date_end = NOW() WHERE id = ?",[$id]);
    }

}
