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
        $dir_contents = scandir('images', SCANDIR_SORT_NONE);

        // filter out everything except images
        $images = array_filter($dir_contents, function ($filename) {
            $file_extension = pathinfo('images/' . $filename, PATHINFO_EXTENSION);

            return in_array(strtolower($file_extension), ['jpeg', 'jpg', 'png', 'gif']);
        });

        $columns = [];

        // sort the images into roughly equal columns
        $current_column = 0;
        foreach ($images as $filename) {
            $current_column = $current_column > 2 ? 1 : $current_column;

            $columns[$current_column][] = $filename;

            $current_column++;
        }

        return $this->render('pages/home.html.twig', ['columns' => $columns]);
    }
}
