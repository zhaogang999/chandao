<?php include '../../../common/view/header.html.php';?>
<?php include '../../../common/view/datepicker.html.php';?>
<?php include '../../../common/ext/view/affix.html.php';?>
<form target='hiddenwin' method='post'>
<table class='table table-fixed active-disabled table-custom'>
<thead class='text-center'>
  <tr>
<<<<<<< HEAD
    <th class='w-60px'><?php echo $lang->task->id?></th>
    <th class='w-150px'><?php echo $lang->task->name?></th>
    <th class='w-150px'><?php echo $lang->task->module?></th>
    <th class='w-150px'><?php echo $lang->task->story?></th>
    <th class='w-70px'><?php echo $lang->task->pri?></th>
    <th class='w-90px'><?php echo $lang->task->type?></th>
    <th class='w-80px'><?php echo $lang->task->estimate?></th>
    <th class='w-120px'><?php echo $lang->task->estStarted?></th>
    <th class='w-120px'><?php echo $lang->task->deadline?></th>
    <th><?php echo $lang->task->desc?></th>
=======
    <th class='w-40px'><?php echo $lang->task->id?></th>
    <th class='w-140px'><?php echo $lang->task->name?></th>
    <th class='w-140px'><?php echo $lang->task->module?></th>
    <th class='w-140px'><?php echo $lang->task->story?></th>
    <th class='w-70px'><?php echo $lang->task->pri?></th>
    <th class='w-160px'><?php echo $lang->task->type?></th>
    <th class='w-60px'><?php echo $lang->task->estimate?></th>
    <th class='w-110px'><?php echo $lang->task->estStarted?></th>
    <th class='w-110px'><?php echo $lang->task->deadline?></th>
    <!--完善任务导入功能，增加status-->
    <th class='w-110px'><?php echo $lang->task->status?></th>

    <th class='w-200px'><?php echo $lang->task->desc?></th>
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
  </tr>
</thead>
<tbody>
  <?php $insert = true;?>
  <?php foreach($taskData as $key => $task):?>
  <tr class='text-top'>
    <td>
      <?php
      if(!empty($task->id))
      {
          echo $task->id . html::hidden("id[$key]", $task->id);
          $insert = false;
      }
      else
      {
          echo $key . " <sub style='vertical-align:sub;color:gray'>{$lang->task->new}</sub>";
      }
      echo html::hidden("project[$key]", $projectID);
      ?>
    </td>
    <td><?php echo html::input("name[$key]", htmlspecialchars($task->name, ENT_QUOTES), "class='form-control'")?></td>
    <td style='overflow:visible'><?php echo html::select("module[$key]", $modules, !empty($task->module) ? $task->module : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->module : ''), "class='form-control chosen'")?></td>
    <td style='overflow:visible'><?php echo html::select("story[$key]", $stories, !empty($task->story) ? $task->story : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->story : ''), "class='form-control chosen'")?></td>
    <td><?php echo html::select("pri[$key]", $lang->task->priList, !empty($task->pri) ? $task->pri : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->pri : ''), "class='form-control'")?></td>
    <td><?php echo html::select("type[$key]", $lang->task->typeList, !empty($task->type) ? $task->type : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->type : ''), "class='form-control'")?></td>
    <td><?php echo html::input("estimate[$key]", !empty($task->estimate) ? $task->estimate : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->estimate : ''), "class='form-control' autocomplete='off'")?></td>
    <td><?php echo html::input("estStarted[$key]", !empty($task->estStarted) ? $task->estStarted : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->estStarted : ''), "class='form-control date'")?></td>
    <td><?php echo html::input("deadline[$key]", !empty($task->deadline) ? $task->deadline : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->deadline : ''), "class='form-control date'")?></td>
<<<<<<< HEAD
    <td><?php echo html::textarea("desc[$key]", $task->desc, "class='form-control' cols='50' rows='1'")?></td>
=======
    <td><?php echo html::select("status[$key]", $lang->task->statusList, !empty($task->status) ? $task->status : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->status : ''), "class='form-control'")?></td>
    <td><?php echo html::textarea("desc[$key]", $task->desc, "class='form-control' cols='50' rows='1'")?>
      <!--完善任务导入功能,新增mailto,openedBy,openedDate,assignedTo,assignedDate,finishedBy,finishedDate,canceledBy,canceledDate,closedBy,closedDate,closedReason,lastEditedBy,lastEditedDate,files-->
    <?php echo html::hidden("assignedTo[$key]", !empty($task->assignedTo) ? $task->assignedTo : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->assignedTo : ''), "class='form-control date'")?>
    <?php echo html::hidden("assignedDate[$key]", !empty($task->assignedDate) ? $task->assignedDate : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->assignedDate : ''), "class='form-control'")?>
    <?php echo html::hidden("mailto[$key]", !empty($task->mailto) ? $task->mailto : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->mailto : ''), "class='form-control date'")?>
      <?php echo html::hidden("consumed[$key]", !empty($task->consumed) ? $task->consumed : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->consumed : ''), "class='form-control'")?>
      <?php echo html::hidden("left[$key]", !empty($task->left) ? $task->left : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->left : ''), "class='form-control'")?>
      <?php echo html::hidden("openedBy[$key]", !empty($task->openedBy) ? $task->openedBy : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->openedBy : ''), "class='form-control'")?>
      <?php echo html::hidden("openedDate[$key]", !empty($task->openedDate) ? $task->openedDate : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->openedDate : ''), "class='form-control date'")?>
      <?php echo html::hidden("realStarted[$key]", !empty($task->realStarted) ? $task->realStarted : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->realStarted : ''), "class='form-control date'")?>
      <?php echo html::hidden("finishedBy[$key]", !empty($task->finishedBy) ? $task->finishedBy : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->finishedBy : ''), "class='form-control'")?>
      <?php echo html::hidden("finishedDate[$key]", !empty($task->finishedDate) ? $task->finishedDate : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->finishedDate : ''), "class='form-control date'")?>
      <?php echo html::hidden("canceledBy[$key]", !empty($task->canceledBy) ? $task->canceledBy : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->canceledBy : ''), "class='form-control date'")?>
      <?php echo html::hidden("canceledDate[$key]", !empty($task->canceledDate) ? $task->canceledDate : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->canceledDate : ''), "class='form-control date'")?>
      <?php echo html::hidden("closedBy[$key]", !empty($task->closedBy) ? $task->closedBy : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->closedBy : ''), "class='form-control'")?>
      <?php echo html::hidden("closedDate[$key]", !empty($task->closedDate) ? $task->closedDate : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->closedDate : ''), "class='form-control date'")?>
<?php echo html::hidden("closedReason[$key]", !empty($task->closedReason) ? $task->closedReason : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->closedReason : ''), "class='form-control date'")?>
<?php echo html::hidden("lastEditedBy[$key]", !empty($task->lastEditedBy) ? $task->lastEditedBy : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->lastEditedBy : ''), "class='form-control'")?>
<?php echo html::hidden("lastEditedDate[$key]", !empty($task->closedDate) ? $task->lastEditedDate : ((!empty($task->id) and isset($tasks[$task->id])) ? $tasks[$task->id]->lastEditedDate : ''), "class='form-control date'")?>
    </td>

>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
  </tr>
  <?php endforeach;?>
</tbody>
<tfoot>
  <tr>
    <td colspan='10' class='text-center'>
      <?php
      if(!$insert)
      {   
        include '../../../common/view/noticeimport.html.php';
        echo "<button type='button' data-toggle='myModal' class='btn btn-primary'>{$lang->save}</button>";
      }   
      else
      {   
          echo html::submitButton();
      }   
      echo ' &nbsp; ' . html::backButton()
      ?>  
    </td>
  </tr>
</tfoot>
</table>
</form>
<script>
$(function(){affix('thead')})
</script>
<?php include '../../../common/view/footer.html.php';?>
