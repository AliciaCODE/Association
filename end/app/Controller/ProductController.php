<?php

namespace App\Controller;

use App\Model\ProductModel;
use App\Service\Form;
use App\Service\Validation;
use App\Weblitzer\Controller;

/**
 *
 */
class ProductController extends Controller
{

    public function index()
    {
        $products = ProductModel::all();
        $count = ProductModel::count();
        $this->render('app.product.listing',array(
            'count'   => $count,
            'products' => $products
        ));
    }

    public function single($id)
    {
        $product = $this->ifProductExistOr404($id);
        $this->render('app.product.single',array(
            'product' => $product
        ));
    }

    public function add()
    {
        $errors = array();
        if(!empty($_POST['submitted'])) {
            $post = $this->cleanXss($_POST);
            // validation
            $validation = new Validation();
            $errors = $this->validationProduct($validation,$errors,$post);
            if($validation->IsValid($errors)) {
                ProductModel::insert($post);
                $this->redirect('produits');
            }
        }
        $form = new Form($errors);
        $this->render('app.product.add',array(
            'form'  => $form
        ));
    }

    public function update($id)
    {
        $errors = array();
        $product = $this->ifProductExistOr404($id);
        if(!empty($_POST['submitted'])) {
            $post = $this->cleanXss($_POST);
            // validation
            $validation = new Validation();
            $errors = $this->validationProduct($validation,$errors,$post);
            if($validation->IsValid($errors)) {
                ProductModel::update($id,$post);
                $this->redirect('produits');
            }
        }
        $form = new Form($errors);
        $this->render('app.product.update',array(
            'form'     => $form,
            'product'  => $product
        ));
    }

    public function delete($id)
    {
        $this->ifProductExistOr404($id);
        ProductModel::delete($id);
        $this->redirect('produits');
    }


    private function ifProductExistOr404($id)
    {
        $product = ProductModel::findById($id);
        if(empty($product)) {
            $this->Abort404();
        }
        return $product;
    }

    private function validationProduct($validation,$errors,$post)
    {
        $errors['titre']       = $validation->textValid($post['titre'], 'nom',3,250);
        $errors['reference']   = $validation->textValid($post['reference'], 'référence',3,  90);
        $errors['description'] = $validation->textValid($post['description'], 'description',10,  2500);
        return $errors;
    }

}
