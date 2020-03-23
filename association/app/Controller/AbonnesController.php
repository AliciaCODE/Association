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

   public function liste()
   {  $abonnes = AbonnesModel::all();
      $titre = 'Liste des abonnés';

      $this->render('app.abonnes.liste',array(
         'titre' => $titre,
         'abonnes' => $abonnes
      ));
   }

   public function detail($id)
   {  $titre = 'Detail abonné';
      $this->getAbonne($id);

      $this->render('app.abonnes.detail',array(
         'titre' => $titre,
         'abonne' => $this->abonne
      ));
   }

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

   /**
   *
   */
   public function Page404()
   {
      $this->render('app.default.404');
   }

}
