<?php

use \Alura\Cursos\Entity\Curso;
//use Alura\Cursos\Infra\EntityManagerCreator;


namespace Alura\Cursos\Controller;

class Exclusao implements InterfaceControladorRequisicao{
    
    private $entityManager;
    
    public function __construct() {
    $this->entityManager = (new \Alura\Cursos\Infra\EntityManagerCreator())
            ->getEntityManager();
    }

    public function processaRequisicao(): void {
    $id = filter_input(
            INPUT_GET, 
            'id', 
            FILTER_VALIDATE_INT);

    if (is_null($id) || $id === false){
        header('Location: /listar-cursos');
        return;
    }
    
    $curso = $this->entityManager->getReference(Curso::class, $id);
    $this->entityManager->remove($curso);
    $this->entityManager->flush();
    
    header('Location: /listar-cursos');
    }
}
