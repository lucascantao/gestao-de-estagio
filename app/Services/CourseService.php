<?php

namespace App\Services;

use App\Http\DTO\Response\CompanyDTO;
use App\Http\DTO\Response\CourseDTO;
use App\Http\DTO\Response\PageResponseDTO;
use App\Repositories\Interface\CompanyRepository;
use App\Repositories\Interface\CourseRepository;
use App\utils\traits\ExceptionTrait;
use Exception;

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

    public function assignCourseToUser(array $course, int $userId): array {
        $response = [];
        $response['metadata'] = null;
        $response['exception'] = null;
        // dd('teste');
        try {

            // dd($course);
            $courseObj = [
                'course_id' => $course['courseId'],
                'user_id' => $userId,
                'student_number' => $course['studentNumber']
            ];

            // dd($courseObj);
            
            $this->courseRepository->assignCourseToUser($courseObj, $userId);
            $response['status'] = 'success';
            $response['data'] = ['message' => 'Curso atualizado com sucesso.'];
            return $response;
        } catch (Exception $e) {
            $response['status'] = 'error';
            $response['data'] = null;
            $response['exception'] = $this->exception($e, __FILE__, __METHOD__);
            return $response;
        }
    }
}
