<?php

namespace App\Controller;

use App\Entity\Image;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    #[Route('/images', name: 'images', methods: ['GET'])]
    #[Route('/', name: 'home', methods: ['GET'])]
    public function index(ImageRepository $imageRepository): Response
    {
        $images = $imageRepository->findAll();

        dump($images);

        $columns = [];

        // sort the images into roughly equal columns
        $current_column = 1;
        foreach ($images as $filename) {
            $current_column = $current_column > 3 ? 1 : $current_column;

            $columns[$current_column][] = $filename;

            $current_column++;
        }

        return $this->render('image/index.html.twig', ['columns' => $columns]);
    }

    #[Route('/image', name: 'createImage', methods: ['POST'])]
    public function create(EntityManagerInterface $entityManager)
    {
       $image = new Image();
       $image->setFilepath('images/')
    }
}
