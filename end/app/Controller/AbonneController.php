<?php

namespace App\Controller;

use App\Model\AbonneModel;
use App\Service\Form;
use App\Service\Validation;
use App\Weblitzer\Controller;

/**
 *
 */
class AbonneController extends Controller
{

    public function index()
    {
        $abonnes = AbonneModel::all();
        $count = AbonneModel::count();
        $this->render('app.abonne.listing',array(
            'count'   => $count,
            'abonnes' => $abonnes
        ));
    }

    public function single($id)
    {
        $abonne = $this->ifAbonneExistOr404($id);
        $this->render('app.abonne.single',array(
            'abonne' => $abonne
        ));
    }

    public function add()
    {
        $errors = array();
        if(!empty($_POST['submitted'])) {
            $post = $this->cleanXss($_POST);
            // validation
            $validation = new Validation();
            $errors = $this->validationAbonne($validation,$errors,$post);
            if($validation->IsValid($errors)) {
                AbonneModel::insert($post);
                $this->redirect('abonnes');
            }
        }
        $form = new Form($errors);
        $this->render('app.abonne.add',array(
            'form'  => $form
        ));
    }

    public function update($id)
    {
        $errors = array();
        $abonne = $this->ifAbonneExistOr404($id);
        if(!empty($_POST['submitted'])) {
            $post = $this->cleanXss($_POST);
            // validation
            $validation = new Validation();
            $errors = $this->validationAbonne($validation,$errors,$post);
            if($validation->IsValid($errors)) {
                AbonneModel::update($id,$post);
                $this->redirect('abonnes');
            }
        }
        $form = new Form($errors);
        $this->render('app.abonne.update',array(
            'form'     => $form,
            'abonne'  => $abonne
        ));
    }

    public function delete($id)
    {
        $this->ifAbonneExistOr404($id);
        AbonneModel::delete($id);
        $this->redirect('abonnes');
    }


    private function ifAbonneExistOr404($id)
    {
        $abonne = AbonneModel::findById($id);
        if(empty($abonne)) {
            $this->Abort404();
        }
        return $abonne;

    }

    private function validationAbonne($validation,$errors,$post)
    {
        $errors['nom']    = $validation->textValid($post['nom'], 'nom',3,150);
        $errors['prenom'] = $validation->textValid($post['prenom'], 'prenom',3,  150);
        $errors['email']  = $validation->emailValid($post['email']);
        // validation age
        if(!empty($post['age'])) {
            if(!filter_var($post['age'], FILTER_VALIDATE_INT)) {
                $errors['age'] = 'Veuillez renseigner un entier';
            } else {
                if($post['age'] <= 0 || $post['age'] > 130) {
                    $errors['age'] = 'Veuillez renseigner un entier positif et pas supérieur à 130 ;)';
                }
            }
        }
        return $errors;
    }

}
