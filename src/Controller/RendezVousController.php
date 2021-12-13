<?php

namespace App\Controller;

use App\Entity\RendezVous;
use App\Repository\RendezVousRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\StructureSanteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use ApiPlatform\Core\Bridge\Doctrine\Common\DataPersister;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    /**
    * @Route("/api")
    */
class RendezVousController extends AbstractController{

    /**
     * @Route("/rv-users", name="rv-users",  methods={"GET"})
    */
    public function getCurrentUserRendezVous(){
        // security du route
        if (!$this->getUser()) {
            return $this->json([
                'message' => 'No autorized',
            ]);
        }

        $results = $this->getUser()->getRendezVouses();

        return $this->json([
            'message' => 'Succes',
            'data' => $results
        ]);

    }

    /**
     * @Route("/rv-create", name="rv-create",  methods={"POST"})
    */
    public function createCurrentUserRendezVous(Request $request, EntityManagerInterface $em, StructureSanteRepository $repoStruct){
        // security du route
        if (!$this->getUser()) {
            return $this->json([
                'message' => 'No autorized',
            ]);
        }

        $re = json_decode($request->getContent(),true);
        
        $newrv = new RendezVous();
        
        $newrv->setDate(new \DateTime($re['date']));
        
        $newrv->setHeur($re['heur']);
        $newrv->setUser($this->getUser());

        $st = $repoStruct->find(intval($re['structureSante']));
        // return $this->json([
        //     'message' => 'Succes',
        //     'data' => $st
        // ]);
        $newrv->setStructureSante($st);
        $em->persist($newrv);
        $em->flush();
        
        return $this->json([
            'message' => 'Succes',
            'data' => $re
        ]);

    }
}