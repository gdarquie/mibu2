<?php

namespace App\Controller;

use App\Component\ExportFileFactory;
use App\Component\FragmentManager;
use App\Repository\FragmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ExportFileController extends AbstractController
{
    /**
     * @Route("/file/export/{format}", name="export_file")
     *
     * @param FragmentRepository $fragmentRepository
     * @param FragmentManager $fragmentManager
     * @param string $format
     * @return JsonResponse
     * @throws \Exception
     */
    public function createFile(FragmentRepository $fragmentRepository, FragmentManager $fragmentManager, string $format)
    {
        // select a list of fragments
        $fragments = $fragmentManager->getFragmentsCollection($fragmentRepository);

        // generate file
        ExportFileFactory::create($format, $fragments);
        return new JsonResponse('File has been created successfully!');
    }

}
