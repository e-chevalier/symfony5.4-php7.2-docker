<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;

class PublisherController extends AbstractController
{

     /**
     * @Route("/publish", name="app_publish")
     */
    public function publish(): Response
    {
        return $this->render('publisher/index.html.twig', [
            'controller_name' => 'PublisherController',
        ]);
    }

    /**
     * @Route("/publisher/{topic}", name="app_publisher", methods={"POST"})
     */
    public function index(HubInterface $hub, $topic, Request $request): Response
    {
        $parameters = $request->request->all();

        $update = new Update( $topic, json_encode($parameters));
        $hub->publish($update);

        return new Response('published!');
    }
}
