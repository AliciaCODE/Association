<?php

namespace App\Controller;

use App\Model\AbonneModel;
use App\Model\BorrowModel;
use App\Model\ProductModel;
use App\Weblitzer\Controller;

/**
 *
 */
class DefaultController extends Controller
{

    public function index()
    {
        $message = 'Bienvenue sur le framework MVC';
        // Afficher le nombre d'abonnés.
        $count_abonnes = AbonneModel::count();
        //Afficher le nombre de produits.
        $count_products = ProductModel::count();
        //Afficher le nombre d’emprunts total.
        $count_borrows = BorrowModel::count();
        //Afficher le nombre d’emprunts en cours.(date_end IS NULL)
        $count_borrows_dateend_isnull = BorrowModel::count_dateend_is_null();


        $this->render('app.default.frontpage',array(
            'message' => $message,
            'count_abonnes' => $count_abonnes,
            'count_products'  => $count_products,
            'count_borrows'   => $count_borrows,
            'count_borrows_dateend_isnull' => $count_borrows_dateend_isnull
        ));
    }

    /**
     *
     */
    public function Page404()
    {
        $this->render('app.default.404');
    }

}
