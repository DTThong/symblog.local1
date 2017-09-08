<?php

namespace Blogger\Bundle\Controller;

use Blogger\Bundle\Form\BlogType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Blogger\Bundle\Entity\Blog;
use Blogger\Bundle\Entity\Category;

class BlogController extends Controller
{
    //INDEX - GET DATA IN LIST 
    // indexAction - show all people
    public function listAction()
    {
        $em = $this->getDoctrine()
                   ->getEntityManager();

        $blog = $em->createQueryBuilder()
                    ->select('b')
                    ->from('BloggerBundle:Blog',  'b')
                    ->addOrderBy('b.id', 'ASC')
                    ->getQuery()
                    ->getResult();

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }
        
        return $this->render('BloggerBundle:Blog:index.html.twig', array(
            'blogs' => $blog
        ));
    }
    
    // adminAction
    // show all people; that contains add, edit, delete
    public function adminAction()
    {
        $em = $this->getDoctrine()
                   ->getEntityManager();

        $blog = $em->createQueryBuilder()
                    ->select('b')
                    ->from('BloggerBundle:Blog',  'b')
                    ->addOrderBy('b.id', 'ASC')
                    ->getQuery()
                    ->getResult();

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }
        
        return $this->render('BloggerBundle:Blog:admin.html.twig', array(
            'blogs' => $blog
        ));
    }
    
    // SHOW DATA IN ID
    // showAction
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $blog = $em->getRepository('BloggerBundle:Blog')->find($id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        return $this->render('BloggerBundle:Blog:show.html.twig', array(
            'blog'  =>  $blog,
        ));
        
        $blog = $repository->findAll();
    }
    
    //addAction
    public function addAction(Request $request) {
      
        $category = new Category();
        $category->setName('think');
        
        $blog = new Blog();
        
        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);    
        if ($form->isSubmitted() && $form->isValid()) {
            
          // Liên quan đến blog và category  
          $blog->setCategory($category);
          
          $em = $this->getDoctrine()->getManager();
          
          $em->persist($category);
          
          $em->persist($blog);
          $em->flush();
          
          // IF addAction SUCCESS
          return $this->redirectToRoute('blog_admin');
        }

        $build['form'] = $form->createView();
        return $this->render('BloggerBundle:Blog:addForm.html.twig', $build);
    }
    
    //editAction
    public function editAction($id, Request $request) {
   
        $blog = new Blog();
     
        $em = $this->getDoctrine()->getManager();
        
        //Find id
        $blog = $em->getRepository('BloggerBundle:Blog')->find($id);
        
        $form = $this->createForm(BlogType::class, $blog);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            
            // IF updateAction SECCESS
            return $this->redirectToRoute('blog_admin');
        }

        $build['form'] = $form->createView();

        return $this->render('BloggerBundle:Blog:addForm.html.twig', $build); 
        
    }
     
    //deleteAction
    public function deleteAction($id, Request $request) {
        
        $blog = new Blog();
        
        $em = $this->getDoctrine()->getManager();
        
        $blog = $em->getRepository('BloggerBundle:Blog')->find($id);
        
        $form = $this->createForm(BlogType::class, $blog);
        
        $form->handleRequest($request);

        $em->remove($blog);
        $em->flush();
          
        // IF deleteAction SUCCESS
        return $this->redirectToRoute('blog_admin');
        
    }
}
