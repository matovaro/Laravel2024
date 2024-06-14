<?php

namespace App\Http\Livewire;

use App\Models\Like;
use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLiked;
    public $LikesCount;

    public function mount($post)
    {
        $this->isLiked = $this->post->checkLike(auth()->user());
        $this->LikesCount = $this->post->likes->count();
        
    }

    public function like()
    {
        if ($this->post->checkLike(auth()->user())) {
            $like = $this->post->likes()->where('user_id', auth()->user()->id);
            $like->delete();
            $this->isLiked = false;
            $this->LikesCount-=1;
        } else {
            Like::create([
                'user_id' => auth()->user()->id,
                'post_id' => $this->post->id
            ]); 
            $this->isLiked = true;
            $this->LikesCount+=1;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
