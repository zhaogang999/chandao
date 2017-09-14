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
                    <span class='input-group-addon'><?php echo $lang->report->product;?></span>
                    <?php echo html::select('product', $products, $product, 'class="form-control chosen"');?>
                </div>
            </div>
            <div class='col-sm-4'>
                <div class='input-group input-group-sm'>
                    <span class='input-group-addon'><?php echo $lang->report->taskAssignedDate;?></span>
                    <div class='datepicker-wrapper datepicker-date'><?php echo html::input('begin', $begin, "class='w-100px form-control'");?></div>
                    <span class='input-group-addon fix-border'><?php echo $lang->report->to;?></span>
                    <div class='datepicker-wrapper datepicker-date'><?php echo html::input('end', $end, "class='form-control'");?></div>
                </div>
            </div>
            <div class='col-sm-1'>
                <div class='input-group'><?php echo html::submitButton('提交');?></div>
            </div>
        </div>
    </form>
    <?php if(isset($result)):?>
    <div class="panel" style="margin-top: 20px;">
        <div class="panel-body">
            <div id="dailyBugStatistics" style="width: 100%;height:450px;"></div>
        </div>
    </div>
    <table class='table table-condensed table-striped table-bordered tablesorter active-disabled dailyBugStatisticsTable' style="word-break:break-all; word-wrap:break-all;">
        <thead>
        <tr class='colhead'>
            <th><?php echo $lang->report->date;?></th>
            <th class="chart-label"><?php echo $lang->report->createdPerDay;?></th>
            <th class="chart-label"><?php echo $lang->report->resolvedPerDay;?></th>
            <th class="chart-label"><?php echo $lang->report->active;?></th>
            <th class="chart-label"><?php echo $lang->report->resolved;?></th>
            <th class="chart-label"><?php echo $lang->report->opened;?></th>
            <th><?php echo $lang->report->count;?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($result as $date  => $data):?>
            <tr class="a-center">
                <td align="center" class="x-label"><?php echo date('m-d', strtotime($data->date));?></td>
                <td align="center" class="dataTables"><?php echo $data->createdPerDay;?></td>
                <td align="center" class="dataTables"><?php echo $data->resolvedPerDay;?></td>
                <td align="center" class="dataTables"><?php echo $data->active;?></td>
                <td align="center" class="dataTables"><?php echo $data->resolved;?></td>
                <td align="center" class="dataTables"><?php echo $data->opened;?></td>
                <td align="center"><?php echo $data->count;?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>
    <?php endif;?>
</div>
<?php include '../../../common/view/footer.html.php';?>
