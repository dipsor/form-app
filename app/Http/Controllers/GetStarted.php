<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetStartedRequest;
use App\Models\User;
use App\Services\FileUploader;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class GetStarted extends Controller
{
    /**
     * @param GetStartedRequest $request
     * @param FileUploader $uploader
     *
     * @return JsonResponse
     */
    public function __invoke(GetStartedRequest $request, FileUploader $uploader): JsonResponse
    {
        $user = $this->getUser($request);

        if (!empty($request->file('image'))) {
            $uploadedFile = $uploader->upload($request->file('image'));

            $user->uploadedFiles()->save($uploadedFile);
        }

        return new JsonResponse('ok', Response::HTTP_CREATED);
    }

    /**
     * @param GetStartedRequest $request
     *
     * @return User
     */
    private function getUser(GetStartedRequest $request): User
    {
        return User::updateOrCreate([
            'email' => $request->email
        ],[
            'name' => $request->name
        ]);
    }
}
