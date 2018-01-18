<?php
		  
namespace Kptec\LmBundle\EventListener;

use Contao\CoreBundle\Framework\ContaoFrameworkInterface;
use Contao\Config;
use Ynfinite\ContaoComBundle\EventListener\YnfiniteCommunicationService;

class ExtYnfiniteCommunicationService extends YnfiniteCommunicationService {

	private $contao;
	private $ynfiniteComService;

	public function cacheData($url, $httpMethod, $data, $result){

		if($result->hits) {
			if(count($result->hits->hits) > 0) {
				foreach($result->hits->hits as $key => $value) {
					$allImages = array();
					if($value->content->galerie) {
						$allImages = array_merge($allImages, $value->content->galerie);
					}

					if($value->content->grundriss) {
						$allImages = array_merge($allImages, $value->content->grundriss);
					}

					if($value->content->titelbild) {
						$allImages = array_merge($allImages, $value->content->titelbild);
					}

					$finalImages = $this->finalizeImages($allImages);

					$result->hits->hits[$key]->allImages = (object)$finalImages;
					
				}
			}
		}
		else {
			$allImages = array();
			
			if($value->content->galerie) {
				$allImages = array_merge($allImages, $result->content->galerie);
			}
			if($value->content->grundriss) {
				$allImages = array_merge($allImages, $result->content->grundriss);
			}
			if($value->content->titelbild) {
				$allImages = array_merge($allImages, $result->content->titelbild);
			}

			$finalImages = $this->finalizeImages($allImages);

			$result->allImages = $allImages;
		}

		$cache = parent::cacheData($url, $httpMethod, $data, $result);
		return $cache;
	}

	public function finalizeImages($allImages){
		$finalImages = array();

		foreach($allImages as $image) {
			$path = $image->path;
			$splittedPath = explode("-", $path);
			$fieldName = explode("_", $splittedPath[1])[0];

			$finalImages[$fieldName] = $image;
		}

		return $finalImages;
	}

}