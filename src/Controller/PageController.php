<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $imageDirectory = $this->getParameter('kernel.project_dir') . '/public/images';

        $dir_contents = scandir($imageDirectory, SCANDIR_SORT_NONE);

        // filter out everything except images
        $images = array_filter($dir_contents, function ($filename) use ($imageDirectory) {
            $file_extension = pathinfo("{$imageDirectory}/{$filename}", PATHINFO_EXTENSION);

            return in_array(strtolower($file_extension), ['jpeg', 'jpg', 'png', 'gif']);
        });

        $columns = [];

        // sort the images into roughly equal columns
        $current_column = 1;
        foreach ($images as $filename) {
            $current_column = $current_column > 3 ? 1 : $current_column;

            $columns[$current_column][] = $filename;

            $current_column++;
        }

        return $this->render('pages/home.html.twig', ['columns' => $columns]);
    }
}
