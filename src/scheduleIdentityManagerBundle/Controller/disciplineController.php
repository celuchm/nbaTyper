<?php

namespace scheduleIdentityManagerBundle\Controller;

use scheduleIdentityManagerBundle\Entity\discipline;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Season controller.
 *
 * @Route("discipline")
 */

class disciplineController extends Controller{

    /**
     * Lists all disciplines
     *
     * @Route("/", name="discipline_index")
     * @Method("GET")
     */

    public function indexAction(){
        $em = $this->getDoctrine()->getManager();

        $disciplines = $em->getRepository('scheduleIdentityManagerBundle:discipline')->findAll();

        return $this->render('scheduleIdentityManagerBundle:scheduleManager:disciplineIndex.html.twig', array(
            'disciplines' => $disciplines,
        ));
    }

    /**
     * Creates a new season entity.
     *
     * @Route("/new", name="discipline_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $discipline = new discipline();

        $form = $this->createForm('scheduleIdentityManagerBundle\Form\disciplineType', $discipline);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($discipline);
            $em->flush();

            return $this->redirectToRoute('discipline_index');
        }

        return $this->render('scheduleIdentityManagerBundle:scheduleManager:disciplineNew.html.twig', array(
            'discipline' => $discipline,
            'form' => $form->createView(),
        ));
    }


    /**
     * Deletes a season entity.
     *
     * @Route("remove/{id}", name="discipline_delete")
     */

    public function deleteAction(Request $request, $id)
    {

            $em = $this->getDoctrine()->getManager();
            $discipline = $em->getRepository('scheduleIdentityManagerBundle:discipline')->findOneBy(array('id' => $id));
            $em->remove($discipline);
            $em->flush();

        return $this->redirectToRoute('discipline_index');
    }



}
