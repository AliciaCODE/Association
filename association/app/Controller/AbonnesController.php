<?php

namespace App\Controller;

use App\Weblitzer\Controller;
use App\Model\AbonnesModel;
use App\Service\Form;
use App\Service\Validation;

/**
 *
 */
class AbonnesController extends Controller
{  private $abonne;
   private $errors = array();
   private $post = array();

//  -----------------     listing des abonnés   -------------------------//
   public function liste()
   {  $abonnes = AbonnesModel::all();
      $titre = 'Liste des abonnés';

      $this->render('app.abonnes.liste',array(
         'titre' => $titre,
         'abonnes' => $abonnes
      ));
   }

// ----------------------- ajouter un abonné ------------------------------//
   public function add()
   {  $titre = 'Ajouter un abonné';

      if ($this->validData($this->errors))
      {  if (empty($this->post['age']))
         {  $this->post['age'] = NULL;
         }
         AbonnesModel::insert($this->post);
         $this->redirect('liste');
      }

      $form = new Form($this->errors);

      $this->render('app.abonnes.add',array(
         'titre' => $titre,
         'form' => $form
      ));
   }

// --------------------------- modifier un abonné --------------------------//
   public function update($id)
   {  $titre = 'Editer un abonné';
      $this->getAbonne($id);

      if ($this->validData($this->errors))
      {  AbonnesModel::update($this->abonne->id, $this->post);
         $this->redirect('liste');
      }

      $form = new Form($this->errors);

      $this->render('app.abonnes.update',array(
         'titre'     => $titre,
         'form'      => $form,
         'abonne'   => $this->abonne
      ));
   }

// ------------------------ supprimer un abonné --------------------------//
   public function delete($id)
   {  $this->getAbonne($id);
      AbonnesModel::delete($this->abonne->id);
      $this->redirect('liste');
   }

   private function getAbonne($id)
   {  if (empty($this->abonne = AbonnesModel::findById($id)))
      {  $this->page404();
      }
   }

   private function validData($post)
   {  if(!empty($_POST['submitted']))
      {  $this->post = $this->cleanXss($_POST);
         $validation = new Validation();

         $this->errors['nom'] = $validation->textValid($this->post['nom'], 'nom');
         $this->errors['prenom'] = $validation->textValid($this->post['prenom'], 'prenom');
         $this->errors['email'] = $validation->emailValid($this->post['email'], 'email', 3, 100, false);
         $this->errors['age'] = $validation->intValid($this->post['age'], 'age', 1, 130, false);

         if($validation->IsValid($this->errors))
         {  return true;
         }
      }
      return false;
   }

}
