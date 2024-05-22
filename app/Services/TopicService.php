<?php

namespace App\Services;

use App\Models\Topic;
use App\Repositories\TopicRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Services\RedisService;
readonly class TopicService
{

    public function __construct(
        private TopicRepository
        $topicRepository
    )
    {}

    public function getTopics(): JsonResponse
    {
        try {
            $topics = RedisService::get('topics');
            if ($topics) {
                return response()->json(json_decode($topics), 200);
            }
            $topics = $this->topicRepository->all();
            RedisService::set('topics', $topics, 60);
            return response()->json($topics, 200);
        } catch (Exception $e) {
            return response()->json($this->topicRepository->all(), 200);
        }
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
        try {
            $topic_data = RedisService::get('topic_' . $topic->id);
            if ($topic_data) {
                return response()->json(json_decode($topic_data), 200);
            }
            $topic_data = $this->topicRepository->get($topic);
            RedisService::set('topic_' . $topic->id, $topic_data, 60);
            return response()->json($topic_data, 200);

        } catch (Exception $e) {
            return response()->json($this->topicRepository->get($topic), 200);
        }
    }

    /**
     * @throws Exception
     */
    public function updateTopic(array $validated, Topic $topic): JsonResponse
    {
        RedisService::delete('topic_' . $topic->id);
        return response()->json($this->topicRepository->update($validated, $topic), 200);
    }

    /**
     * @throws Exception
     */
    public function deleteTopic(Topic $topic): JsonResponse
    {
        RedisService::delete('topic_' . $topic->id);
        return response()->json($this->topicRepository->delete($topic), 200);
    }
}
