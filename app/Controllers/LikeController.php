<?php

/**
 * TestsController
 */
class LikeConntroller
{
    public function like()
    {
        $result = Like::putLike();
    
        echo $result;
    }



    public function dislike()
    {
        $result = Like::putDislike();
    
        echo $result;
    }
}
?>