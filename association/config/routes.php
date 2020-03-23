<?php

$routes = array(
  array('home','default','index'),

  array('liste','abonnes','liste'),
  array('add','abonnes','add'),
  array('update','abonnes','update',array('id')),
  array('delete','abonnes','delete',array('id')),
);
