<?php /* app/Model/AbonnesModel.php */

namespace App\Model;

use App\App;

class AbonnesModel extends \App\Weblitzer\Model
{
   protected static $table = 'abonnes';

   public static function insert($post)
   {  App::getDatabase()->prepareInsert("INSERT INTO " . self::getTable() .
                                       " (nom, prenom, email, age, created_at) VALUES (?,?,?,?,NOW()) ",
                                       [$post['nom'],$post['prenom'],$post['email'],$post['age']]);
   }

   public static function update($id, $post)
   {  App::getDatabase()->prepareInsert("UPDATE " . self::getTable() .
                                       " SET nom = ?, prenom = ?,email = ?,age = ? WHERE id = ? ",[$post['nom'],$post['prenom'],$post['email'],$post['age'], $id]);
   }

}
