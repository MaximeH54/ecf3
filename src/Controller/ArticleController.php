<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Mark;
use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="article")
     */
    public function index()
    {
				$article = new Article();

				$form = $this->createFormBuilder($article)

						->add('reference', TextType::class)
						->add('quantity', NumberType::class)
						->add('name', TextType::class)
						->add('description', TextareaType::class)
						->add('mark', EntityType::class, [
							'class' => Mark::class,
							'choice_label' => 'name',
						])
						->add('category', EntityType::class, [
							'class' => Category::class,
							'choice_label' => 'name',
						])
						->add('save', SubmitType::class, ['label' => 'Add an article'])
						->getForm();

        return $this->render('article/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
