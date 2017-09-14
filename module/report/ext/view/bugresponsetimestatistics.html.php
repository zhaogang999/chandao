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
  <table class='table table-condensed table-hover table-striped table-bordered tablesorter active-disabled table-selectable' id="bugList">
    <thead>
      <tr class='colhead'>
        <th class="w-30px" rowspan="2"><?php echo $lang->report->productID;?></th>
        <th class='w-80px' rowspan="2"><?php echo $lang->report->product;?></th>
        <th colspan='3'><?php echo $lang->report->bugresolveperiod;?></th>
        <th colspan='6'><?php echo $lang->report->responsetime;?></th>
      </tr>
      <tr class='colhead'>
        <th class="w-30px"><?php echo $lang->report->resolving1week;?></th>
        <th class="w-30px"><?php echo $lang->report->resolving2weeks;?></th>
        <th class="w-35px"><?php echo $lang->report->resolvinglong;?></th>
        <th class="w-30px"><?php echo $lang->report->responsed1week;?></th>
        <th class="w-100px"><?php echo $lang->report->responsed1weekbugs;?></th>
        <th class="w-30px"><?php echo $lang->report->responsed2weeks;?></th>
        <th class="w-100px"><?php echo $lang->report->responsed2weeksbugs;?></th>
        <th class="w-35px"><?php echo $lang->report->responsedlong;?></th>
        <th class="w-200px"><?php echo $lang->report->responsedlongbugs;?></th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($info as $id  =>$data):?>
      <tr class="a-center">
        <td align="center"><?php echo $id;?></td>
        <td align="center"><?php echo $data->productName;?></td>
        <td align="center"><?php echo $data->resolving1week;?></td>
        <td align="center"><?php echo $data->resolving2weeks;?></td>
        <td align="center"><?php echo $data->resolvinglong;?></td>
        <td align="center"><?php echo $data->responsed1week;?></td>
        <td>
          <?php
          foreach ($data->responsed1weekbugs as $key => $bugID)
          {
            if(!common::printLink('bug', 'view', "bug=$bugID", sprintf('%03d', $bugID))) printf('%03d', $bugID);
          }
          ?>
        </td>
        <td align="center"><?php echo $data->responsed2weeks;?></td>
        <td>
          <?php
          foreach ($data->responsed2weeksbugs as $key => $bugID)
          {
            if(!common::printLink('bug', 'view', "bug=$bugID", sprintf('%03d', $bugID))) printf('%03d', $bugID);
          }
          ?>
        </td>
        <td align="center"><?php echo $data->responsedlong;?></td>
        <td>
          <?php
          foreach ($data->responsedlongbugs as $key => $bugID)
          {
            if(!common::printLink('bug', 'view', "bug=$bugID", sprintf('%03d', $bugID))) printf('%03d', $bugID);
          }
          ?>
        </td>
      </tr>
    <?php endforeach;?>
    </tbody>
  </table> 
</div>
<script language="JavaScript">
  $(function()
  {
    setTimeout(function(){fixedTheadOfList('#bugList')}, '100');
  })
</script>
<?php include '../../../common/view/footer.html.php';?>
