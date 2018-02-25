<?php
/**
 * 需求进展统计
 *
 * @param $stories array
 * @return string
 */
public function storyProgressSummary($stories)
{
    $storyCount = count($stories);
    $notReviewStoryCount = 0;
    $notTestStoryCount   = 0;
    $notVerifyStoryCount = 0;
    
    foreach ($stories as $story)
    {
        if (empty($story->reviewStatus) or $story->reviewStatus == 'notReview') $notReviewStoryCount++;
        if (empty($story->testStatus) or $story->testStatus == 'notTest') $notTestStoryCount++;
        if (empty($story->verifyStatus) or strpos('failed,noVerified,portVerified', $story->verifyStatus) !== false) $notVerifyStoryCount++;
    }
    
    $reviewedStoryRate = $storyCount == 0 ? 0 : 1 - round($notReviewStoryCount/$storyCount, 2);
    $TestedStoryRate   = $storyCount == 0 ? 0 : 1 - round($notTestStoryCount/$storyCount, 2);
    $verifiedStoryRate = $storyCount == 0 ? 0 : 1 - round($notVerifyStoryCount/$storyCount, 2);

    return sprintf($this->lang->story->storyProgressSummary, $storyCount, $notReviewStoryCount, $reviewedStoryRate * 100 . "%", $notTestStoryCount, $TestedStoryRate * 100 . "%", $notVerifyStoryCount, $verifiedStoryRate * 100 . "%");
}