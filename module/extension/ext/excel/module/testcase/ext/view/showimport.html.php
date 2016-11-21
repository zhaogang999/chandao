<?php include '../../../common/view/header.html.php';?>
<?php include '../../../common/ext/view/affix.html.php';?>
<form target='hiddenwin' method='post'>
  <table class='table table-fixed active-disabled table-custom'>
    <thead class='text-center'>
      <tr>
        <th class='w-80px'><?php echo $lang->testcase->id?></th>
        <th><?php echo $lang->testcase->title?></th>
        <th class='w-100px'><?php echo $lang->testcase->module?></th>
        <th class='w-120px'><?php echo $lang->testcase->story?></th>
        <th class='w-70px'><?php echo $lang->testcase->pri?></th>
        <th class='w-110px'><?php echo $lang->testcase->type?></th>
        <th class='w-90px'><?php echo $lang->testcase->status?></th>
        <th class='w-140px'><?php echo $lang->testcase->stage?></th>
        <th class='w-80px'><?php echo $lang->testcase->keywords?></th>
        <th><?php echo $lang->testcase->precondition?></th>
        <th class='w-300px'>
          <table class='w-p100 table-borderless'>
            <tr>
              <th><?php echo $lang->testcase->stepDesc?></th>
              <th><?php echo $lang->testcase->stepExpect?></th>
            </tr>
          </table>
        </th>
      </tr>
    </thead>
    <tbody>
      <?php $insert = true;?>
      <?php foreach($caseData as $key => $case):?>
      <tr class='text-top'>
        <td>
          <?php
          if(!empty($case->id))
          {
              echo $case->id . html::hidden("id[$key]", $case->id);
              $insert = false;
          }
          else
          {
              echo $key . " <sub style='vertical-align:sub;color:gray'>{$lang->testcase->new}</sub>";
          }
          echo html::hidden("product[$key]", $productID)
          ?>
        </td>
        <td><?php echo html::input("title[$key]", htmlspecialchars($case->title, ENT_QUOTES), "class='form-control'")?></td>
        <td style='overflow:visible'><?php echo html::select("module[$key]", $modules, isset($case->module) ? $case->module : ((!empty($case->id) and isset($cases[$case->id])) ? $cases[$case->id]->module : ''), "class='form-control chosen'")?></td>
        <td style='overflow:visible'><?php echo html::select("story[$key]", $stories, isset($case->story) ? $case->story : ((!empty($case->id) and isset($cases[$case->id])) ? $cases[$case->id]->story : ''), "class='form-control chosen'")?></td>
        <td><?php echo html::select("pri[$key]", $lang->testcase->priList, isset($case->pri) ? $case->pri : ((!empty($case->id) and isset($cases[$case->id])) ? $cases[$case->id]->pri : ''), "class='form-control'")?></td>
        <td><?php echo html::select("type[$key]", $lang->testcase->typeList, $case->type, "class='form-control'")?></td>
        <td><?php echo html::select("status[$key]", $lang->testcase->statusList, isset($case->status) ? $case->status : '', "class='form-control'")?></td>
        <td style='overflow:visible'><?php echo html::select("stage[$key][]", $lang->testcase->stageList, isset($case->stage) ? $case->stage : '', "multiple='multiple' class='form-control chosen'")?></td>
        <td><?php echo html::input("keywords[$key]", isset($case->keywords) ? $case->keywords : "", "class='form-control'")?></td>
        <td><?php echo html::textarea("precondition[$key]", isset($case->precondition) ? $case->precondition : "", "class='form-control' style='height:65px;'")?></td>
        <td>
          <?php if(isset($stepData[$key]['desc'])):?>
          <table class='table table-form'>
          <?php foreach($stepData[$key]['desc'] as $id => $desc):?>
            <tr>
              <td><?php echo html::textarea("desc[$key][$id]", $desc, "class='form-control'")?></td>
              <td><?php echo html::textarea("expect[$key][$id]", isset($stepData[$key]['expect'][$id]) ? $stepData[$key]['expect'][$id] : '', "class='form-control'")?></td>
            </tr>
          <?php endforeach;?>
          </table>
          <?php endif;?>
        </td>
      </tr>
      <?php endforeach;?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan='11' class='text-center'>
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
<script>$(function(){affix('thead')})</script>
<?php include '../../../common/view/footer.html.php';?>
