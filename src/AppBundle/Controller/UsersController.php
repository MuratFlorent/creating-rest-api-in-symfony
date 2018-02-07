<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Person;
use FOS\RestBundle\Controller\ControllerTrait;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use AppBundle\Exception\ValidationException;

class UsersController extends AbstractController
{
	use ControllerTrait;

	/**
     * @Rest\View()
     */
    public function getUsersAction()
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:Person')->findAll();

        return $user;
    }

    /**
     * @Rest\View(statusCode=201)
     * @ParamConverter("person", converter="fos_rest.request_body")
     * @Rest\NoRoute()
     */
    public function postUsersAction(Person $person, ConstraintViolationListInterface $validationErrors)
    {
        if(count($validationErrors) > 0){
            throw new ValidationException($validationErrors);
        }
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($person);
        $em->flush();

        return $person;
    }

    /**
     * @Rest\View()
     */
    public function deleteUserAction(Person $person){
        
        if(null === $person)
        {
            return $this->view(null,404);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($person);
        $em->flush();
    }

    /**
     * @Rest\View()
     */
    public function getUserAction(Person $person){

        if(null === $person)
        {
            return $this->view(null,404);
        }

        return $person;
    }
}