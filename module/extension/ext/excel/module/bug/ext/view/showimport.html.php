<?php include '../../../common/view/header.html.php';?>
<?php include '../../../common/ext/view/affix.html.php';?>
<form target='hiddenwin' method='post'>
<table class='table active-disabled table-fixed table-custom'>
<thead class='text-center'>
  <tr>
    <th class='w-80px'><?php echo $lang->bug->id?></th>
    <th class='w-150px'><?php echo $lang->bug->title?></th>
    <th class='w-150px'><?php echo $lang->bug->module?></th>
    <th class='w-150px'><?php echo $lang->bug->project?></th>
    <th class='w-150px'><?php echo $lang->bug->story?></th>
    <th class='w-70px'><?php echo $lang->bug->pri?></th>
    <th class='w-80px'><?php echo $lang->bug->keywords?></th>
    <th class='w-100px'><?php echo $lang->bug->openedBuild?></th>
    <th><?php echo $lang->bug->steps?></th>
    <th class='w-120px'><?php echo $lang->bug->lblTypeAndSeverity?></th>
    <th class='w-120px'><?php echo $lang->bug->lblSystemBrowserAndHardware?></th>
  </tr>
</thead>
<tbody>
  <?php $insert = true;?>
  <?php foreach($bugData as $key => $bug):?>
  <tr class='text-top'>
    <td>
      <?php
      if(!empty($bug->id))
      {
          echo '#' . $bug->id . html::hidden("id[$key]", $bug->id);
          $insert = false;
      }
      else
      {
          echo $key . " <sub style='vertical-align:sub;color:gray'>{$lang->bug->new}</sub>";
      }
      echo html::hidden("product[$key]", $productID)
      ?>
    </td>
    <td><?php echo html::input("title[$key]", htmlspecialchars($bug->title, ENT_QUOTES), "class='form-control'")?></td>
    <td style='overflow:visible'><?php echo html::select("module[$key]", $modules, !empty($bug->module) ? $bug->module : ((!empty($bug->id) and isset($bugs[$bug->id])) ? $bugs[$bug->id]->module : ''), "class='form-control chosen'")?></td>
    <td style='overflow:visible'>
    <?php
    $bug->project = !empty($bug->project) ? $bug->project : ((!empty($bug->id) and isset($bugs[$bug->id])) ? $bugs[$bug->id]->project : '');
    echo html::select("project[$key]", $projects, in_array($bug->project, $projects) ? $flipProjects[$bug->project] : $bug->project, "class='form-control chosen' onchange='loadBuilds(this.value, $key)'")
    ?>
    </td>
    <td style='overflow:visible'><?php echo html::select("story[$key]", $stories, !empty($bug->story) ? $bug->story : ((!empty($bug->id) and isset($bugs[$bug->id])) ? $bugs[$bug->id]->story : ''), "class='form-control chosen'")?></td>
    <td><?php echo html::select("pri[$key]", $lang->bug->priList, !empty($bug->pri) ? $bug->pri : ((!empty($bug->id) and isset($bugs[$bug->id])) ? $bugs[$bug->id]->pri : ''), "class='form-control'")?></td>
    <td><?php echo html::input("keywords[$key]", $bug->keywords, "class='form-control'")?></td>
    <?php
    if(!empty($bug->openedBuild) and !array_key_exists($bug->openedBuild, $builds))
    {
        $openedBuilds     = explode(';', $bug->openedBuild);
        $bug->openedBuild = array();
        foreach($openedBuilds as $openedBuild)
        {
            $openedBuild = trim($openedBuild);
            if($openedBuild == 'trunk')
            {
                $bug->openedBuild[] = $openedBuild;
                continue;
            }
            if(isset($flipBuilds[$openedBuild])) $bug->openedBuild[] = $flipBuilds[$openedBuild];
        }
        $bug->openedBuild = join(',', $bug->openedBuild);
    }
    ?>
    <td style='overflow:visible'><?php echo html::select("openedBuild[$key][]", $builds, !empty($bug->openedBuild) ? $bug->openedBuild : ((!empty($bug->id) and isset($bugs[$bug->id])) ? $bugs[$bug->id]->openedBuild : key($builds)), "multiple=multiple class='form-control chosen'");?></span>
    <td><?php echo html::textarea("steps[$key]", $bug->steps, "class='form-control bug-area'")?></td>
    <td>
    <?php echo html::select("type[$key]", $lang->bug->typeList, $bug->type, 'class=form-control');?>
    <?php echo html::select("severity[$key]", $lang->bug->severityList, $bug->severity, 'class=form-control');?>
    </td>
    <td>
    <?php echo html::select("os[$key]", $lang->bug->osList, $bug->os, 'class=form-control');?>
    <?php echo html::select("browser[$key]", $lang->bug->browserList, $bug->browser, 'class=form-control');?>
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
<script language='Javascript'>
var builds = <?php echo json_encode($builds)?>;
function loadBuilds(project, key)
{
    var selected = $('#openedBuild' + key).val();
    if(project)
    {
        $('#openedBuild' + key).empty();
        for(id in builds[project])
        {
            $('#openedBuild' + key).append("<option value='" + id + "'>" + builds[project][id] + "</option>");
        }
    }
    else
    {
        $('#openedBuild' + key).append("<option value='trunk'>Trunk</option>")
    }
    $('#openedBuild' + key).val(selected);
}

$(function()
{
    affix('thead');
})
</script>
<?php include '../../../common/view/footer.html.php';?>
