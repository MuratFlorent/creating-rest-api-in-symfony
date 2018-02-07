<?php

namespace AppBundle\Controller;

use AppBundle\Exception\ValidationException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;

class ExceptionController{

	use ControllerTrait;

   /**
	*
	* @param Request $request
	* @param $exception
	* @param DebugLoggerInterface|null $logger
	* @return View
	*
	*/
	public function showAction(Request $request, $exception, DebugLoggerInterface $logger =null)
	{
 		if($exception instanceof ValidationException){
 			return $this->getView($exception->getStatusCode(), json_decode($exception->getMessage(), true));
 		}

 		if($exception instanceof HttpException){
 			return $this->getView($exception->getStatusCode(), $exception->getMessage(), true);
 		}

 		return $this->getView(null, 'Unexpected error occured');
	}

	/**
	* @param int|null $statusCode
	* @param $message
	* @return View
	*/
	private function getView(int $statusCode, $message)	{
		$data = [
		'code' => $statusCode ?? 500,
		'message' => $message
		];

		return $this->view($data, $statusCode ?? 500);
	}
}