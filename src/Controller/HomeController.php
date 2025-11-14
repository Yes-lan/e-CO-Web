<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/map', name: 'app_map')]
    public function map(): Response
    {
        return $this->render('map/index.html.twig');
    }

    #[Route('/course/create', name: 'app_course_create')]
    public function createCourse(): Response
    {
        return $this->render('course/create.html.twig');
    }

    #[Route('/course/manage', name: 'app_course_manage')]
    public function manageCourses(): Response
    {
        return $this->render('course/manage.html.twig');
    }

    #[Route('/api/course/save', name: 'api_course_save', methods: ['POST'])]
    public function saveCourse(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        
        if (!$data || !isset($data['name'])) {
            return new JsonResponse(['error' => 'Invalid data'], 400);
        }

        // Path to courses JSON file
        $coursesFile = $this->getParameter('kernel.project_dir') . '/public/assets/data/courses.json';
        
        // Read existing courses
        $coursesData = ['description' => 'Courses créés - Fichier de stockage temporaire avant implémentation BDD', 'courses' => []];
        if (file_exists($coursesFile)) {
            $content = file_get_contents($coursesFile);
            $coursesData = json_decode($content, true) ?: $coursesData;
        }

        // Generate unique ID
        $data['id'] = time() . rand(1000, 9999);

        // Add new course
        $coursesData['courses'][] = $data;

        // Save to file
        file_put_contents($coursesFile, json_encode($coursesData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return new JsonResponse(['success' => true, 'id' => $data['id']]);
    }
}