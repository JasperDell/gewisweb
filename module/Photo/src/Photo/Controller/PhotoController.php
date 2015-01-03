<?php

namespace Photo\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PhotoController extends AbstractActionController
{

    public function indexAction()
    {
        $album_service = $this->getAlbumService();
        $albums = $album_service->getAlbums();
        $photo_service = $this->getPhotoService();
        //$photo_service->storeUploadedPhoto('public/data/photo/00001-DSC_9275-2.jpg', $albums[0]);
        return new ViewModel(array(
            'albums' => $albums
        ));
    }

    /**
     * Gets the album service.
     * 
     * @return Photo\Service\Album
     */
    public function getAlbumService()
    {
        return $this->getServiceLocator()->get("photo_service_album");
    }

    /**
     * Gets the photo service.
     * 
     * @return Photo\Service\Photo
     */
    public function getPhotoService()
    {
        return $this->getServiceLocator()->get("photo_service_photo");
    }

}
