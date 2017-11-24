<?php include '../../../common/view/header.html.php';?>
<?php include '../../../common/view/tablesorter.html.php';?>
<?php include '../../../common/view/datepicker.html.php';?>
<?php js::import($jsRoot . 'echarts/echarts.min.js');?>

<div id='titlebar'>
  <div class='heading'>
    <span class='prefix'><?php echo html::icon($lang->icons['report-file']);?></span>
    <strong> <?php echo $title;?></strong>
  </div>
</div>
<div class='side'>
  <?php include '../../view/blockreportlist.html.php';?>
  <div class='panel panel-body' style='padding: 10px 6px'>
    <div class='text proversion'>
      <strong class='text-danger small text-latin'>PRO</strong> &nbsp;<span class='text-important'><?php echo $lang->report->proVersion;?></span>
    </div>
  </div>
</div>

<div class='main'>
    <form class='form-condensed' method='post' enctype='multipart/form-data' id='dataform' data-type='ajax'>
        <div class='row' style='margin-bottom:5px;'>
            <div class='col-sm-7'>
                <div class='input-group input-group-sm'>
                    <span class='input-group-addon'><?php echo $lang->report->project;?></span>
                    <?php echo html::select('project[]', $projects, str_replace(' ' , '', $data->project), 'class="form-control chosen" multiple');?>
                </div>
            </div>
            <div class='col-sm-4'>
                <div class='input-group input-group-sm'>
                    <span class='input-group-addon'><?php echo $lang->report->taskAssignedDate;?></span>
                    <div class='datepicker-wrapper datepicker-date'><?php echo html::input('begin', $data->begin, "class='w-100px form-control'");?></div>
                    <span class='input-group-addon fix-border'><?php echo $lang->report->to;?></span>
                    <div class='datepicker-wrapper datepicker-date'><?php echo html::input('end', $data->end, "class='form-control'");?></div>
                </div>
            </div>
            <div class='col-sm-1'>
                <div class='input-group'><?php echo html::submitButton('提交');?></div>
            </div>
        </div>
    </form>
    <?php if (isset($info)):?>
    <table class='table table-borderless active-disabled' style="word-break:break-all; word-wrap:break-word;">
        <tr style="height: 400px">
            <td><div id="main" style="width: 525px;height:350px;"></div></td>
            <td><div id="detail" style="width: 525px;height:350px;"></div></td>
        </tr>
        <tr style="height: 450px;">
            <td><div id="storyTaskProgress" style="width: 525px;height:400px;"></td>
            <td><div id="develTaskProgress" style="width: 525px;height:400px;"></td>
        </tr>
        <tr style="height: 450px;">
            <td><div id="testTaskProgress" style="width: 525px;height:400px;"></div></td>
            <td><div id="undoneStoryTasks" style="width: 525px;height:400px;"></td>
        </tr>
        <tr style="height: 450px;">
            <td><div id="undoneDevelTasks" style="width: 525px;height:400px;"></td>
            <td><div id="undoneTestTasks" style="width: 525px;height:400px;"></td>
        </tr>
        <tr style="height: 450px;">
            <td><div id="undoneTaskByType" style="width: 525px;height:400px;"></td>
            <td><div id="finishedTasksPerDay" style="width: 525px;height:400px;"></td>
        </tr>
    </table>
    <div><h3 class="title" style="text-align:center">整体统计</h3></div>
    <table class='table table-condensed table-hover table-striped table-bordered table-chart'>
        <thead>
        <tr class='table-bordered text-center'>
            <th>任务类型</th>
            <th>已完成</th>
            <th>待完成</th>
            <th>总数</th>
            <th>已完成</th>
            <th>待完成</th>
        </tr>
        </thead>
        <tbody>
        <tr class='text-center'>
            <td  class='chart-label'>测试</td>
            <td class ='doneTaskCountPercent'><?php echo $echartData['testTaskStatusCount']['doneTaskCountPercent']?></td>
            <td class="undoneTaskCountPercent"><?php echo $echartData['testTaskStatusCount']['undoneTaskCountPercent']?></td>
            <td class="taskCount"><?php echo $echartData['testTaskStatusCount']['taskCount']?></td>
            <td class="doneTaskCount"><?php echo $echartData['testTaskStatusCount']['doneTaskCount']?></td>
            <td class="undoneTaskCount"><?php echo $echartData['testTaskStatusCount']['undoneTaskCount']?></td>
        </tr>
        <tr class='text-center'>
            <td class='chart-label'>开发</td>
            <td class ='doneTaskCountPercent'><?php echo $echartData['develTaskStatusCount']['doneTaskCountPercent']?></td>
            <td class="undoneTaskCountPercent"><?php echo $echartData['develTaskStatusCount']['undoneTaskCountPercent']?></td>
            <td class="taskCount"><?php echo $echartData['develTaskStatusCount']['taskCount']?></td>
            <td class="doneTaskCount"><?php echo $echartData['develTaskStatusCount']['doneTaskCount']?></td>
            <td class="undoneTaskCount"><?php echo $echartData['develTaskStatusCount']['undoneTaskCount']?></td>
        </tr>
        <tr class='text-center'>
            <td class='chart-label'>需求</td>
            <td class ='doneTaskCountPercent'><?php echo $echartData['storyTaskStatusCount']['doneTaskCountPercent']?></td>
            <td class="undoneTaskCountPercent"><?php echo $echartData['storyTaskStatusCount']['undoneTaskCountPercent']?></td>
            <td class="taskCount"><?php echo $echartData['storyTaskStatusCount']['taskCount']?></td>
            <td class="doneTaskCount"><?php echo $echartData['storyTaskStatusCount']['doneTaskCount']?></td>
            <td class="undoneTaskCount"><?php echo $echartData['storyTaskStatusCount']['undoneTaskCount']?></td>
        </tr>
        </tbody>
    </table>
    <div><h3 class="title" style="text-align:center">各项目分类型任务进展</h3></div>
    <div style="overflow: auto; width: 100%; max-height: 300px;" class='table-wrapper'>
        <table class='table table-condensed active-disabled table-hover table-striped table-bordered projectProgress' style='width: 100%;'>
            <thead>
            <tr class='colhead'>
                <th>项目ID</th>
                <th>项目代号</th>
                <th>需求</th>
                <th>已完成</th>
                <th>待完成</th>
                <th>开发</th>
                <th>已完成</th>
                <th>待完成</th>
                <th>测试</th>
                <th>已完成</th>
                <th>待完成</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($info as $id  =>$project):?>
                <tr class='text-center'>
                    <td align="center"><?php echo $id;?></td>
                    <td class='chart-label'><?php echo $project->projectInfo->code;?></td>
                    <td align="center"><?php echo $project->storyTaskSum;?></td>
                    <td class="doneStoryTask"><?php echo isset($project->newStoryTaskStatusSum['doneTask'])?$project->newStoryTaskStatusSum['doneTask']:0;?></td>
                    <td class="undoneStoryTask"><?php echo isset($project->newStoryTaskStatusSum['undone'])?$project->newStoryTaskStatusSum['undone']:0;?></td>
                    <td align="center"><?php echo $project->develTaskSum;?></td>
                    <td class="doneDevelTask"><?php echo isset($project->newDevelTaskStatusSum['doneTask'])?$project->newDevelTaskStatusSum['doneTask']:0;?></td>
                    <td class="undoneDevelTask"><?php echo isset($project->newDevelTaskStatusSum['undone'])?$project->newDevelTaskStatusSum['undone']:0;?></td>
                    <td align="center"><?php echo $project->testSum;?></td>
                    <td class="doneTestTask"><?php echo isset($project->newTestStatusSum['doneTask'])?$project->newTestStatusSum['doneTask']:0;?></td>
                    <td class="undoneTestTask"><?php echo isset($project->newTestStatusSum['undone'])?$project->newTestStatusSum['undone']:0;?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <div><h3 class="title" style="text-align:center">需求待完成工作</h3></div>
    <div style="overflow: auto; width: 100%;" class='table-wrapper'>
        <table class='table table-condensed table-hover table-striped table-bordered unDoneStoryTaskReport'>
            <thead>
            <tr class='colhead'>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <?php foreach($data->project as $project):?>
                    <th class="chart-label"><?php echo $projects[$project];?></th>
                <?php endforeach;?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($undoneTaskCount as $date => $value ):?>
                <tr class='text-center'>
                    <td class='x-label'><?php echo date('m-d', strtotime($date))?></td>
                    <?php foreach ($value as $val):?>
                        <td class="taskData"><?php echo isset($val->undoneStoryTaskCount)?$val->undoneStoryTaskCount:0;?></td>
                    <?php endforeach;?>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <div><h3 class="title" style="text-align:center">开发待完成工作</h3></div>
    <div style="overflow: auto; position: relative;" class='table-wrapper'>
        <table class='table table-condensed table-hover table-striped table-bordered unDoneDevelTaskReport'>
            <thead>
            <tr class='colhead'>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <?php foreach($data->project as $project):?>
                    <th class="chart-label"><?php echo $projects[$project];?></th>
                <?php endforeach;?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($undoneTaskCount as $date => $value ):?>
                <tr class='text-center'>
                    <td class='x-label'><?php echo date('m-d', strtotime($date))?></td>
                    <?php foreach ($value as $val):?>
                        <td class="taskData"><?php echo $val->undoneDevelTaskCount;?></td>
                    <?php endforeach;?>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <div><h3 class="title" style="text-align:center">测试待完成工作</h3></div>
    <div style="overflow: auto; position: relative;" class='table-wrapper'>
        <table class='table table-condensed table-hover table-striped table-bordered unDoneTestTaskReport'>
            <thead>
            <tr class='colhead'>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                <?php foreach($data->project as $project):?>
                    <th class="chart-label"><?php echo $projects[$project];?></th>
                <?php endforeach;?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($undoneTaskCount as $date => $value ):?>
                <tr class='text-center'>
                    <td class='x-label'><?php echo date('m-d', strtotime($date))?></td>
                    <?php foreach ($value as $val):?>
                        <td class="taskData"><?php echo $val->undoneTestTaskCount;?></td>
                    <?php endforeach;?>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <div><h3 class="title" style="text-align:center">各组开发未完成任务情况</h3></div>
    <div style="overflow: auto; max-height: 300px;" class='table-wrapper'>
        <table class='table table-condensed table-hover table-striped table-bordered undoneTaskByTypeReport'>
            <thead>
            <tr class='text-center'>
                <th>项目名称</th>
                <th class="x-label">服务</th>
                <th class="x-label">前端</th>
                <th class="x-label">开发</th>
                <th class="x-label">ios</th>
                <th class="x-label">android</th>
                <th class="x-label">sdk</th>
                <th class="x-label">脚本</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($info as $id  =>$project):?>
                <tr class='text-center'>
                    <td class='chart-label'><?php echo $projects[$id]?></td>
                    <td class="taskData"><?php echo isset($undoneTaskByType[$id]['fos'])?$undoneTaskByType[$id]['fos']->taskSum:0;?></td>
                    <td class="taskData"><?php echo isset($undoneTaskByType[$id]['web'])?$undoneTaskByType[$id]['web']->taskSum:0;?></td>
                    <td class="taskData"><?php echo isset($undoneTaskByType[$id]['devel'])?$undoneTaskByType[$id]['devel']->taskSum:0;?></td>
                    <td class="taskData"><?php echo isset($undoneTaskByType[$id]['ios'])?$undoneTaskByType[$id]['ios']->taskSum:0;?></td>
                    <td class="taskData"><?php echo isset($undoneTaskByType[$id]['android'])?$undoneTaskByType[$id]['android']->taskSum:0;?></td>
                    <td class="taskData"><?php echo isset($undoneTaskByType[$id]['sdk'])?$undoneTaskByType[$id]['sdk']->taskSum:0;?></td>
                    <td class="taskData"><?php echo isset($undoneTaskByType[$id]['script'])?$undoneTaskByType[$id]['script']->taskSum:0;?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <div><h3 class="title" style="text-align:center">每日开发完成情况</h3></div>
    <div style="overflow: auto; max-height: 300px; position: relative;" class='table-wrapper'>
        <table class='table table-condensed table-hover table-striped table-bordered finishedTasksPerDayReport'>
            <thead>
            <tr class='text-center'>
                <th></th>
                <?php foreach($info as $id  =>$project):?>
                    <th class="groupLabel"><?php echo $project->projectInfo->name;?></th>
                <?php endforeach;?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($finishedTasksPerDay as $date =>$value):?>
                <tr class='text-center'>
                    <td class="x-label"><?php echo date('m-d', strtotime($date))?></td>
                    <?php foreach ($value as $project=>$count):?>
                        <td class="taskPerDay"><?php echo $count?></td>
                    <?php endforeach;?>
                </tr>
            <?php endforeach;?>

            </tbody>
        </table>
    </div>
    <div><h3 class="title" style="text-align:center">各项目任务分状态统计</h3></div>
    <table class='table table-condensed table-striped table-bordered tablesorter active-disabled taskTable' style="word-break:break-all; word-wrap:break-word;">
        <thead>
        <tr class='colhead'>
            <th class='w-id'><?php echo $lang->report->projectID;?></th>
            <th class='w-200px'><?php echo $lang->report->projectName;?></th>
            <th class="w-id"><?php echo $lang->report->develSum;?></th>
            <th class="w-id"><?php echo $lang->report->taskWaitSum;?></th>
            <th class="w-id"><?php echo $lang->report->taskDoingSum;?></th>
            <th class="w-id"><?php echo $lang->report->taskDoneSum;?></th>
            <th class="w-id"><?php echo $lang->report->taskPauseSum;?></th>
            <th class="w-id"><?php echo $lang->report->taskCancelSum;?></th>
            <th class="w-id"><?php echo $lang->report->taskClosedSum;?></th>
            <th class="w-id"><?php echo $lang->report->testSum;?></th>
            <th class="w-id"><?php echo $lang->report->taskWaitSum;?></th>
            <th class="w-id"><?php echo $lang->report->taskDoingSum;?></th>
            <th class="w-id"><?php echo $lang->report->taskDoneSum;?></th>
            <th class="w-id"><?php echo $lang->report->taskPauseSum;?></th>
            <th class="w-id"><?php echo $lang->report->taskCancelSum;?></th>
            <th class="w-id"><?php echo $lang->report->taskClosedSum;?></th>
            <th class="w-id"><?php echo $lang->report->taskSum;?></th>
            <th class="w-id"><?php echo $lang->report->delayedTaskSum;?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($info as $id  =>$project):?>
            <tr class="a-center">
                <td align="center"><?php echo $id;?></td>
                <td><?php echo $project->projectInfo->name;?></td>
                <td align="center"><?php echo $project->develTaskSum;?></td>
                <td align="center"><?php echo isset($project->newDevelTaskStatusSum['wait'])?$project->newDevelTaskStatusSum['wait']:0;?></td>
                <td align="center"><?php echo isset($project->newDevelTaskStatusSum['doing'])?$project->newDevelTaskStatusSum['doing']:0;?></td>
                <td align="center"><?php echo isset($project->newDevelTaskStatusSum['done'])?$project->newDevelTaskStatusSum['done']:0;?></td>
                <td align="center"><?php echo isset($project->newDevelTaskStatusSum['pause'])?$project->newDevelTaskStatusSum['pause']:0;?></td>
                <td align="center"><?php echo isset($project->newDevelTaskStatusSum['cancel'])?$project->newDevelTaskStatusSum['cancel']:0;?></td>
                <td align="center"><?php echo isset($project->newDevelTaskStatusSum['closed'])?$project->newDevelTaskStatusSum['closed']:0;?></td>
                <td align="center"><?php echo $project->testSum;?></td>
                <td align="center"><?php echo isset($project->newTestStatusSum['wait'])?$project->newTestStatusSum['wait']:0;?></td>
                <td align="center"><?php echo isset($project->newTestStatusSum['doing'])?$project->newTestStatusSum['doing']:0;?></td>
                <td align="center"><?php echo isset($project->newTestStatusSum['done'])?$project->newTestStatusSum['done']:0;?></td>
                <td align="center"><?php echo isset($project->newTestStatusSum['pause'])?$project->newTestStatusSum['pause']:0;?></td>
                <td align="center"><?php echo isset($project->newTestStatusSum['cancel'])?$project->newTestStatusSum['cancel']:0;?></td>
                <td align="center"><?php echo isset($project->newTestStatusSum['closed'])?$project->newTestStatusSum['closed']:0;?></td>
                <td align="center"><?php echo $project->taskSum;?></td>
                <td align="center"><?php echo $project->delayedTaskSum;?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <?php endif;?>
</div>
<?php include '../../../common/view/footer.html.php';?>
