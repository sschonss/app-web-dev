<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Models\Topic;
use App\Services\TopicService;
use Exception;
use Illuminate\Http\JsonResponse;

class TopicController extends Controller
{
    public function __construct(
        private readonly TopicService
        $topicService
    )
    {}

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->topicService->getTopics();
    }

    /**
     * Store a newly created resource in storage.
     * @throws Exception
     */
    public function store(StoreTopicRequest $request): JsonResponse
    {
        return $this->topicService->createTopic($request->validated());
    }

    /**
     * Display the specified resource.
     * @throws Exception
     */
    public function show(Topic $topic): JsonResponse
    {
        return $this->topicService->showTopic($topic);
    }

    /**
     * Update the specified resource in storage.
     * @throws Exception
     */
    public function update(UpdateTopicRequest $request, Topic $topic): JsonResponse
    {
        return response()->json($this->topicService->updateTopic($request->validated(), $topic));
    }

    /**
     * Remove the specified resource from storage.
     * @throws Exception
     */
    public function destroy(Topic $topic): JsonResponse
    {
        return response()->json($this->topicService->deleteTopic($topic));
    }
}
