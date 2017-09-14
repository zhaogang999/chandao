<?php include '../../../common/view/header.html.php';?>
<?php include '../../../common/view/tablesorter.html.php';?>
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
          <?php echo html::select('product', $products, $product, "class='form-control chosen' onchange='getStories(this.value)'");?>
        </div>
      </div>
      <div class='col-sm-1'>
      </div>
    </div>
  </form>
  <table class='table table-condensed table-striped table-bordered tablesorter active-disabled' style="word-break:break-all; word-wrap:break-all;">
    <thead>
        <tr class='colhead'>
          <th class='w-200px'><?php echo $lang->report->branch;?></th>
          <th class="w-id"><?php echo $lang->report->activeBugSum;?></th>
          <th class="w-id"><?php echo $lang->report->bugSum;?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($branchs as $id  =>$branch):?>
      <tr class="a-center">
        <td><?php echo $branch;?></td>
        <td align="center"><?php echo $result->activedBugs[$id];?></td>
        <td align="center"><?php echo $result->bugs[$id];?></td>
      </tr>
    <?php endforeach;?>
    </tbody>
  </table> 
</div>
<?php include '../../../common/view/footer.html.php';?>
