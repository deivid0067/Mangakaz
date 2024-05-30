<?php

//função que faz parte da SPL que significa Standard PHP Library
spl_autoload_register('carregarClasseCliente');

function carregarClasseCliente($nomeClasse)
{
    if (file_exists('../model/' . $nomeClasse . '.php')) {
        require_once '../model/' .$nomeClasse . '.php';
    }
    if (file_exists('../dao/' . $nomeClasse . '.php')) {
        require_once '../dao/' .$nomeClasse . '.php';
    }
    if (file_exists('../controller/' . $nomeClasse . '.php')) {
        require_once '../controller/' .$nomeClasse . '.php';
    }

}