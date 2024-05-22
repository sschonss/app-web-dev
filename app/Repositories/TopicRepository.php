<?php

namespace App\Repositories;

use App\Models\Topic;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class TopicRepository
{
    public function all(): Collection|null
    {
        return Topic::unfinished()->get() ?? null;
    }

    /**
     * @throws Exception
     */
    public function create(array $validated): array
    {
        try {
            Topic::create($validated);
            return ['message' => 'Topic created'];
        } catch (Exception $e) {
            throw new Exception('Error creating topic');
        }
    }

    /**
     * @throws Exception
     */
    public function get(Topic $topic): Topic
    {
        try {
            return $topic;
        } catch (Exception $e) {
            throw new Exception('Error getting topic');
        }
    }

    /**
     * @throws Exception
     */
    public function update(array $validated, Topic $topic): Topic
    {
        try {
            $topic->update($validated);
            return $topic;
        } catch (Exception $e) {
            throw new Exception('Error updating topic');
        }
    }

    public function delete(Topic $topic): array
    {
        try {
            $topic->delete();
            return ['message' => 'Topic deleted'];
        } catch (Exception $e) {
            throw new Exception('Error deleting topic');
        }
    }

}
