<?php

require("System/Pages/IndexPage.class.php");

class RequestHandler
{

    public function __construct($className)
    {
        $className = $className . 'Action';
        $classPath = "System/Actions/" . $className . '.class.php';


// za sve zahtjeve na bazu provjerava putanju, ako sadrzi neki naziv iz ActionFile-ova, izvrsava se ta akcija
// naziv se proslijedi kao parametar iznad u konstruktoru, i spaja sa stringom Action da se dobije ime isto kao nazivi action datoteka
// provjerava se je li doslo do iznimke, postoji li ta akcija i ako postoji vraca se kao output_add_rewrite_var
// preg_match koristi regularne izraze za provjru da li ime action klase sadrzi samo slova i brojeve
        try {
            if (!preg_match('/^[a-z0-9_]+$/i', $className) || !file_exists($classPath)) {
                echo ("Bad request");
                return;
            }
        } catch (Exception $e) {
            echo ("Unhandled error");
        }

        require_once($classPath);

        if (!class_exists($className)) {
            throw new SystemException("Class '" . $className . "' not found");
        }
        
        new $className();
    }

// ako su uneseni neki podaci za dodavanje, skupi ih i kreira od njih post request
// tj request za kreiranje nekog objekta, inace trazi podatke na putanji do URL parametra action
// i salje get request, tj dohvaca te podatke.
    public static function handle()
    {
        if (!empty($_GET['action']) || !empty($_POST['action'])) {
            new RequestHandler((!empty($_GET['action']) ? $_GET['action'] : $_POST['action']));
        } else {
            new IndexPage();
        }
    }
}
