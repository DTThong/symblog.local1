<?php

namespace Blogger\Bundle\Controller;

use Blogger\Bundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Blogger\Bundle\Entity\Category;

class CategoryController extends Controller
{
    //INDEX - GET DATA IN LIST 
    // listCategoryAction - show all 
    public function listCategoryAction()
    {
        $em = $this->getDoctrine()
                   ->getEntityManager();

        $category = $em->createQueryBuilder()
                    ->select('b')
                    ->from('BloggerBundle:Category',  'b')
                    ->addOrderBy('b.id', 'ASC')
                    ->getQuery()
                    ->getResult();

        if (!$category) {
            throw $this->createNotFoundException('Unable to find Cate post.');
        }
        
        return $this->render('BloggerBundle:Category:listCategory.html.twig', array(
            'categorys' => $category
        ));
    }
    
    //addAction
    public function addCategoryAction(Request $request) {
      
        $category = new Category();
        
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);    
        if ($form->isSubmitted() && $form->isValid()) {
          
          $em = $this->getDoctrine()->getManager();
          
          $em->persist($category);
          $em->flush();
          
          // IF addAction SUCCESS
          return $this->redirectToRoute('category_home');
        }

        $build['form'] = $form->createView();
        return $this->render('BloggerBundle:Category:addCategoryForm.html.twig', $build);
    }
    
    //editAction
    public function editCategoryAction($id, Request $request) {
        
        $category = new Category();
        
     
        $em = $this->getDoctrine()->getManager();
        
        //Find id
        $category = $em->getRepository('BloggerBundle:Category')->find($id);
        
        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            
            // IF updateAction SECCESS
            return $this->redirectToRoute('category_home');
        }

        $build['form'] = $form->createView();

        return $this->render('BloggerBundle:Category:addCategoryForm.html.twig', $build); 
        
    }
     
    //deleteAction
    public function deleteCategoryAction($id, Request $request) {
        
        $category = new Category();
        
        $em = $this->getDoctrine()->getManager();
        
        $category = $em->getRepository('BloggerBundle:Category')->find($id);
        
        $form = $this->createForm(CategoryType::class, $category);
        
        $form->handleRequest($request);

        $em->remove($category);
        $em->flush();
          
        // IF deleteAction SUCCESS
        return $this->redirectToRoute('category_home');
        
    }
}
