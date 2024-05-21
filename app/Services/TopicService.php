<?php

namespace App\Services;

use App\Models\Topic;
use App\Repositories\TopicRepository;
use Exception;
use Illuminate\Http\JsonResponse;

readonly class TopicService
{

    public function __construct(
        private TopicRepository
        $topicRepository
    )
    {}

    public function getTopics(): JsonResponse
    {
        return response()->json($this->topicRepository->all(), 200);
    }
    /**
     * @throws Exception
     */
    public function createTopic(array $validated): JsonResponse
    {
        return response()->json($this->topicRepository->create($validated), 201);
    }

    /**
     * @throws Exception
     */
    public function showTopic(Topic $topic): JsonResponse
    {
        return response()->json($this->topicRepository->get($topic), 200);
    }

    /**
     * @throws Exception
     */
    public function updateTopic(array $validated, Topic $topic): JsonResponse
    {
        return response()->json($this->topicRepository->update($validated, $topic), 200);
    }

    /**
     * @throws Exception
     */
    public function deleteTopic(Topic $topic): JsonResponse
    {
        return response()->json($this->topicRepository->delete($topic), 200);
    }
}
