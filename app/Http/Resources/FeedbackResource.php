<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FeedbackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'feedback',
            'id' => $this->id,
            'attributes' => [
                'user_id' => $this->user_id,
                'question_id' => $this->question_id,
                'review_id' => $this->last_namreview_ide,
                'reply_on_type' => $this->reply_on_type,
                'reply_on_feedback_id' => $this->reply_on_feedback_id,
                'sequence_number' => $this->sequence_number,
                'text' => $this->text,
                'like' => (int)$this->like,
                'dislike' => (int)$this->dislike,
            ],
            //'relationships' => new RelationshipResource($this->resource), // todo - Fill out to be truly JSON:API compliant
//            'links' => []
        ];
    }
}
