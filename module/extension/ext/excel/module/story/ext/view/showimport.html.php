<?php include '../../../common/view/header.html.php';?>
<?php include '../../../common/view/datepicker.html.php';?>
<?php include '../../../common/ext/view/affix.html.php';?>
<form target='hiddenwin' method='post'>
<table class='table table-fixed active-disabled table-custom'>
<thead class='text-center'>
  <tr>
    <th class='w-60px'><?php echo $lang->story->id?></th>
    <th class='w-150px'><?php echo $lang->story->title?></th>
    <th class='w-150px'><?php echo $lang->story->module?></th>
    <th class='w-150px'><?php echo $lang->story->plan?></th>
    <th class='w-100px'><?php echo $lang->story->source?></th>
    <th class='w-70px'><?php echo $lang->story->pri?></th>
    <th class='w-80px'><?php echo $lang->story->estimate?></th>
    <th class='w-80px'><?php echo $lang->story->keywords?></th>
    <th><?php echo $lang->story->spec?></th>
    <th><?php echo $lang->story->verify?></th>
  </tr>
</thead>
<tbody>
  <?php $insert = true;?>
  <?php foreach($storyData as $key => $story):?>
  <tr class='text-top'>
    <td>
      <?php
      if(!empty($story->id))
      {
          echo $story->id . html::hidden("id[$key]", $story->id);
          $insert = false;
      }
      else
      {
          echo $key . " <sub style='vertical-align:sub;color:gray'>{$lang->story->new}</sub>";
      }
      echo html::hidden("product[$key]", $productID);
      ?>
    </td>
    <td><?php echo html::input("title[$key]", htmlspecialchars($story->title, ENT_QUOTES), "class='form-control'")?></td>
    <td style='overflow:visible'><?php echo html::select("module[$key]", $modules, !empty($story->module) ? $story->module : ((!empty($story->id) and isset($stories[$story->id])) ? $stories[$story->id]->module : ''), "class='form-control chosen'")?></td>
    <td style='overflow:visible'><?php echo html::select("plan[$key]", $plans, !empty($story->plan) ? $story->plan : ((!empty($story->id) and isset($stories[$story->id])) ? $stories[$story->id]->plan : ''), "class='form-control chosen'")?></td>
    <td><?php echo html::select("source[$key]", $lang->story->sourceList, !empty($story->source) ? $story->source : ((!empty($story->id) and isset($stories[$story->id])) ? $stories[$story->id]->source : ''), "class='form-control'")?></td>
    <td><?php echo html::select("pri[$key]", $lang->story->priList, !empty($story->pri) ? $story->pri : ((!empty($story->id) and isset($stories[$story->id])) ? $stories[$story->id]->pri : ''), "class='form-control'")?></td>
    <td><?php echo html::input("estimate[$key]", !empty($story->estimate) ? $story->estimate : ((!empty($story->id) and isset($stories[$story->id])) ? $stories[$story->id]->estimate : ''), "class='form-control' autocomplete='off'")?></td>
    <td><?php echo html::input("keywords[$key]", !empty($story->keywords) ? $story->keywords : ((!empty($story->id) and isset($stories[$story->id])) ? $stories[$story->id]->keywords : ''), "class='form-control'")?></td>
    <td><?php echo html::textarea("spec[$key]", $story->spec, "class='form-control' cols='35' rows='1'")?></td>
    <td><?php echo html::textarea("verify[$key]", $story->verify, "class='form-control' cols='35' rows='1'")?></td>
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
