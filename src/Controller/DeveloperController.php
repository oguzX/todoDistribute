<?php

namespace App\Controller;

use App\Entity\Developer;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="developer_")
 */
class DeveloperController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @Template("developer/all.twig")
     */
    public function all(EntityManagerInterface $entityManager)
    {
        $developers = $entityManager->getRepository(Developer::class)->findBy(['deletedAt' => null]);

        return [
            'developers' => $developers
        ];
    }
    /**
     * @Route("/{id}/assigments", name="assignments")
     * @Template("developer/assigments.twig")
     */
    public function assigments(Developer $developer, \App\Service\Decorate\Developer $decorate)
    {
        $tasks = $decorate->getDeveloperTasksByWeekGroup($developer);

        return [
            'developer' => $developer,
            'weeks' => $tasks
        ];
    }
}