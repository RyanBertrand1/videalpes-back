<?php


namespace App\Controller;


use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
 * @ApiResource(itemOperations={
 *     "POST",
 *     "File"={"route_name"="uploadFile"},
 *      "book_post_discontinuation",
 * })
 */
class FileController extends AbstractController
{
    /**
     * @Route(
     *     name="uploadFile",
     *     path="/api/uploadFile",
     *     methods={"POST"},
     * )
     */
    public function uploadFile(Request $request){
        /** @var UploadedFile $uploadedFile */
        $uploadedFile = $request->files->get('file');

        $fileName = $uploadedFile->getClientOriginalName();
        $destination = $this->getParameter('kernel.project_dir').'/public/images';
        $uploadedFile->move($destination, $fileName);

        return new Response();
    }
}