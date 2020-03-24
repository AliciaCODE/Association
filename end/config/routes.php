<?php

$routes = array(
    array('home','default','index'),
    // abonnes
    array('abonnes','abonne','index'),
    array('detailabonne','abonne','single',array('id')),
    array('addabonne','abonne','add'),
    array('updateabonne','abonne','update',array('id')),
    array('deleteabonne','abonne','delete',array('id')),

    // produits
    array('produits','product','index'),
    array('detailproduit','product','single',array('id')),
    array('addproduit','product','add'),
    array('updateproduit','product','update',array('id')),
    array('deleteproduit','product','delete',array('id')),

    // borrows
    array('borrows','borrow','index'),
    array('renduemprunt','borrow','rendu',array('id')),
    array('borrow_historique','borrow','historique')

);









