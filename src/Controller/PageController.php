<?php

namespace App\Controller;

use App\ImageGatherer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'images')]
    public function images(): Response
    {
        $gatherer = new ImageGatherer();
        $images = $gatherer->fromDir($this->getParameter('kernel.project_dir') . '/public/images');

        $columns = [];

        // sort the images into roughly equal columns
        $current_column = 1;
        foreach ($images as $filename) {
            $current_column = $current_column > 3 ? 1 : $current_column;

            $columns[$current_column][] = $filename;

            $current_column++;
        }

        return $this->render('pages/images.html.twig', ['columns' => $columns]);
    }
}
