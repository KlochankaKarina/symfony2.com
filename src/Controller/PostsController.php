<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Comment;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request; 
use Cocur\Slugify\Slugify;
use App\Form\PostType;
use App\Form\CommentType;

class PostsController extends AbstractController
{
	/** @var PostRepository $postRepository */
    private $postRepository;
    public $com;
    public function __construct(PostRepository $postRepository, CommentRepository $commentRepository)
    {
        $this->postRepository = $postRepository;
        $this->commentRepository = $commentRepository;
    }
    
    /**
     * @Route("/posts", name="blog_posts")
     */
    public function posts()
    {
        $posts = $this->postRepository->findAll();

        return $this->render('posts/index.html.twig', [
           'posts' => $posts
        ]);
    }

     /**
     * @Route("/posts/new", name="new_blog_post")
     */
    public function addPost(Request $request, Slugify $slugify)
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setSlug($slugify->slugify($post->getTitle()));
            $post->setCreatedAt(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('blog_posts');
        }
        return $this->render('posts/new.html.twig', [
            'form' => $form->createView()
        ]);
}

   
	
	/**
     * @Route("/posts/{id}/edit", name="blog_post_edit")
     */
    public function edit(Post $post, Request $request, Slugify $slugify)
    {
         $form = $this->createForm(PostType::class, $post);
         $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
            $post->setSlug($slugify->slugify($post->getTitle()));
             $em = $this->getDoctrine()->getManager();
            	$em->flush();

            return $this->redirectToRoute('blog_posts');
         }

         return $this->render('posts/new.html.twig', [
             'form' => $form->createView()
         ]);
    }

    	/**
     * @Route("/posts/{id}/delete", name="blog_post_delete")
     */
    public function delete(Post $post)
    {     
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('blog_posts');
    }

    /**
     * @Route("/posts/search", name="blog_search")
     */
    public function search(Request $request)
    {
        $query = $request->query->get('q');
        $posts = $this->postRepository->searchByQuery($query);

        return $this->render('posts/query_post.html.twig', [
            'posts' => $posts
        ]);
    }
    
    /**
     * @Route("/posts/{id}", name="blog_show")
     */
    public function show(Post $post, Request $request)
    {
            $comment = new Comment();
            $comment->setUser($this->getUser());
           
            $post->addComment($comment);

            $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);
            //$query = $request->query->get('comment');
        
        //dd($form);
            //$comment->setComment($q);
            if ($form->isSubmitted() && $form->isValid()) {
                $comment=$form->getData();
                //dd($comment);
                
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

               return $this->redirectToRoute('blog_show', ['id' => $post->getId()]);
           }
          
        return $this->render('posts/show.html.twig', [
            'post' => $post,
            'form'=>$form->createView()
           
            
        ]);
    }
    
}