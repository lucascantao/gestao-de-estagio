<?php

namespace App\Services;

use App\Http\DTO\Response\CompanyDTO;
use App\Http\DTO\Response\CourseDTO;
use App\Http\DTO\Response\PageResponseDTO;
use App\Repositories\Interface\CompanyRepository;
use App\Repositories\Interface\CourseRepository;
use App\utils\traits\ExceptionTrait;

class CourseService {

    use ExceptionTrait;

    public function __construct(
        protected CourseRepository $courseRepository
    ) {
    }

    public function getAllCourses(?int $page = null, ?int $perpage = null): PageResponseDTO | array {
        if($page === null || $perpage === null) {
            return $this->courseRepository->getCourses()
                ->map(fn($course) => CourseDTO::fromCourse($course))
                ->toArray();
        }

        $paginator = $this->courseRepository->getAllCourses($page, $perpage);
        $courses = $paginator
            ->values()
            ->map(fn($course) => CourseDTO::fromCourse($course))
            ->toArray();

        return PageResponseDTO::fromPaginator($paginator, $courses);
    }

    // public function assignSkillsToUser(array $skillIds, int $userId): array {
    //     $response = [];
    //     $response['metadata'] = null;
    //     $response['exception'] = null;
    //     try {
    //         $this->skillRepository->assignSkillsToUser($skillIds, $userId);
    //         $response['status'] = 'success';
    //         $response['data'] = ['message' => 'Skills atualizadas com sucesso.'];
    //         return $response;   
    //     } catch (Exception $e) {
    //         $response['status'] = 'error';
    //         $response['data'] = null;
    //         $response['exception'] = $this->exception($e, __FILE__, __METHOD__);
    //         return $response;
    //     }
    // }
}
