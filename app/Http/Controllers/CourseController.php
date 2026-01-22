<?php

namespace App\Http\Controllers;

use App\Http\DTO\Response\APIResponseDTO;
use App\Http\Requests\PageableRequest;
use App\Services\CompanyService;
use App\Services\CourseService;
use Illuminate\Http\Request;

class CourseController
{

    public function __construct(protected CourseService $courseService) {
    }

    public function listCourses(PageableRequest $request) {
        $res = $this->courseService->getAllCourses(
            $request->query('page'),
            $request->query('perPage')
        );

        return response()->json(APIResponseDTO::fromData(
            [
                'status' => 'success',
                'data' => $res->toArray(),
                'metadata' => null,
                'exception' => null
            ]
        ));
    }

    public function getCourses() {
        $res = $this->courseService->getAllCourses();

        return response()->json(APIResponseDTO::fromData(
            [
                'status' => 'success',
                'data' => $res,
                'metadata' => null,
                'exception' => null
            ]
        ));
    }

    public function updateUserCourse(Request $request, $userId) {
        $courseObject = $request->all();
        // dd('teste');
        $this->courseService->assignCourseToUser($courseObject, $userId);
        return response()->json(['message' => 'Curso atualizado com sucesso'], 200);
    }
}
