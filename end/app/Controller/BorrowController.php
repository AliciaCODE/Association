<?php

namespace App\Controller;

use App\Model\AbonneModel;
use App\Model\BorrowModel;
use App\Model\ProductModel;
use App\Service\Form;
use App\Service\Validation;
use App\Weblitzer\Controller;

/**
 *
 */
class BorrowController extends Controller
{

    public function index()
    {
        $errors = array();
        // je vais chercher la totalité des entités produits et abonné pour les select de mon form
        // request => tous les produits
        $products = ProductModel::all();
        // request => tous les abonnés
        $abonnes  = AbonneModel::all();
        // request avec jointure pour aller cherche tous les emprunts avec le nom de l'abonne et le titre du produit pour chaque emprunt et cela avec une seule request
        $borrows =  BorrowModel::getAllStartWithProductAndAbonne();

        if(!empty($_POST['submitted'])) {
            $post = $this->cleanXss($_POST);
            $validation = new Validation();

            // je verifie que l'abonné et le produit existe bien dans la bdd avavnt de faire un insert
                // ceci pour preserver l'intégrité referentiel des tables
            $get_abonne = AbonneModel::findById($post['id_abonne']);
            $get_product = ProductModel::findById($post['id_product']);
            if(!empty($get_abonne) || !empty($get_product)) {
                $error['id_abonne'] = 'Etrange';
            }
            if($validation->IsValid($errors)) {
                BorrowModel::insert($post);
                $this->redirect('borrows');
            }
        }
        $form = new Form($errors);
        // je fait passer toutes les variables à la view/app/borrow/listing.php
        $this->render('app.borrow.listing',array(
            'borrows'   => $borrows,
            'products' => $products,
            'abonnes'  => $abonnes,
            'form'     => $form
        ));
    }


    public function rendu($id)
    {
        // verification si emprunt existe dans BDD
        $borrow = BorrowModel::findById($id);
        if(empty($borrow)){
            // si existe pas 404
            $this->Abort404();
        }
        // Dans le model je met date_end à la date actuelle => nOW()
        BorrowModel::rendu($id);
        $this->redirect('borrows');
    }

    // ici le but est de faire une page qui montre les emprunts passé
    public function historique()
    {
        $borrows = BorrowModel::historique();
        $this->render('app.borrow.historique',array(
            'borrows'   => $borrows
        ));
    }

}
