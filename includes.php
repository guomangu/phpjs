<?php
    date_default_timezone_set('Europe/Paris');
    
    function chargerClass($classe)
    {
        require 'classes/'.$classe.'.php';
    }
    spl_autoload_register('chargerClass');
?>