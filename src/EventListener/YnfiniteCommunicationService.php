<?php
		  
namespace Kptec\LmBundle\EventListener;

use Contao\CoreBundle\Framework\ContaoFrameworkInterface;
use Contao\Config;

class YnfiniteCommunicationService {

	private $contao;
	private $ynfiniteComService;

	public function __construct($contaoFramework, $ynfiniteComService) {
        $this->contao = $contaoFramework;
        $this->ynfiniteComService = $YnfiniteCommunicationService;
    }

	public function cacheData($httpMethod, $data, $result){

	    error_log("IN DECORATOR SERVICE");

		if($result->hits) {
			if(count($result->hits->hits) > 0) {
				foreach($result->hits->hits as $key => $value) {
					$allImages = array();
					$allImages = array_merge($allImages, $value->content->galerie);
					$allImages = array_merge($allImages, $value->content->grundriss);
					$allImages = array_merge($allImages, $value->content->titelbild);

					$result->hits->hits[$key]->allImages = $allImages;
					
				}
			}
		}
		else {
			$allImages = array();
			$allImages = array_merge($allImages, $result->content->galerie);
			$allImages = array_merge($allImages, $result->content->grundriss);
			$allImages = array_merge($allImages, $result->content->titelbild);

			$result[$key]->allImages = $allImages;
		}


		$this->ynfiniteComService->cacheData($httpMethod, $data, $result);

		return $cache;
	}

}