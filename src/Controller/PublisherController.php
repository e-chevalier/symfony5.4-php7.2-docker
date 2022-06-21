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
     * @Route("/publisher/{topic}", name="app_publisher", methods={"POST"})
     */
    public function index(HubInterface $hub, $topic, Request $request): Response
    {
        
        dump($topic);
        dump(json_encode($request->getContent()));
        //dump($request->getContent());

        $update = new Update( $topic, $request->getContent());
        //$update = new Update( $topic, json_encode($request->getContent()));

        //$update = new Update( $topic, json_encode(['status' => 'OutOfStock']), false);

        $hub->publish($update);

        return new Response('published!');
    }
}
