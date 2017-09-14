<?php
/**
 * 抓取燃起图数据
 * 
 * @return void
 */
public function getBurnUpData()
{
    $this->loadModel('story');

    $projects = $this->dao->select("id")->from(TABLE_PROJECT)->where('status')->ne('done')->andWhere('deleted')->eq('0')->fetchPairs('id');

    foreach ($projects as $project)
    {
        $data = new stdClass();

        $stories = $this->story->getProjectStories($project,'id_desc');
        $data->storyCount = count($stories);
        $data->testedStoryCount = 0;
        $data->developedStoryCount = 0;

        foreach ($stories as $story)
        {
            switch ($story->stage)
            {
                case 'tested':
                    $data->testedStoryCount++;
                    $data->developedStoryCount++;
                    break;
                case 'released':
                    $data->developedStoryCount++;
                    $data->testedStoryCount++;
                    break;
                case 'developed':
                    $data->developedStoryCount++;
                    break;
                case 'testing':
                    $data->developedStoryCount++;
                    break;
            }
        }

        $data->project = $project;
        $data->date = date('Y-m-d');

        $this->dao->insert(TABLE_BURNUP)->data($data)->exec();
        //unset($data);
    }
}