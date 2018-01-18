<?php

namespace Kptec\LmBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DebugController extends Controller {

	public function indexAction(Request $request){
		
		$loadDataService = $this->get("ynfinite.contao-com.listener.communication");

		$url = "http://www.test.de";
		$httpMethod = "GET";
		$data = "{'something':'test'}";

		$result = array("hits" => 
			(object)array("hits" => array(
				(object)array("content" => (object)array(
					"id" => "1",
					"galerie" => array(
						(object)array("path" => "1234-lang2_test.jpg", "title" => "test.jpg"),
						(object)array("path" => "1234-lang3_test2.jpg", "title" => "test2.jpg"),
						(object)array("path" => "1234-lang4_test3.jpg", "title" => "test3.jpg")
					),
					"titelbild" => array(
						(object)array("path" => "1234-lang7_test7.jpg", "title" => "test7.jpg")
					),
					"grundriss" => array(
						(object)array("path" => "1234-lang10_test10.jpg", "title" => "test10.jpg"),
						(object)array("path" => "1234-lang11_test11.jpg", "title" => "test11.jpg")
					)
				)),
				(object)array("content" => (object)array(
					"id" => "2",
					"galerie" => array(
						(object)array("path" => "1234-lang2_test.jpg", "title" => "test.jpg"),
						(object)array("path" => "1234-lang3_test2.jpg", "title" => "test2.jpg"),
						(object)array("path" => "1234-lang4_test3.jpg", "title" => "test3.jpg")
					),
					"titelbild" => array(
						(object)array("path" => "1234-lang7_test7.jpg", "title" => "test7.jpg")
					),
					"grundriss" => array(
						(object)array("path" => "1234-lang10_test10.jpg", "title" => "test10.jpg"),
						(object)array("path" => "1234-lang11_test11.jpg", "title" => "test11.jpg")
					)
				)),
				(object)array("content" => (object)array(
					"id" => "3",
					"galerie" => array(
						(object)array("path" => "1234-lang2_test.jpg", "title" => "test.jpg"),
						(object)array("path" => "1234-lang3_test2.jpg", "title" => "test2.jpg"),
						(object)array("path" => "1234-lang4_test3.jpg", "title" => "test3.jpg")
					),
					"titelbild" => array(
						(object)array("path" => "1234-lang7_test7.jpg", "title" => "test7.jpg")
					),
					"grundriss" => array(
						(object)array("path" => "1234-lang10_test10.jpg", "title" => "test10.jpg"),
						(object)array("path" => "1234-lang11_test11.jpg", "title" => "test11.jpg")
					)
				)),
			))
		);

		$returnData = $loadDataService->cacheData($url, $httpMethod, $data, (object)$result);

		return new JsonResponse($returnData);
	}
}