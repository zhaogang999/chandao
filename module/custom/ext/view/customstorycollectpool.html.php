<?php
/**
 * The set view file of custom module of ZenTaoPMS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      Congzhi Chen <congzhi@cnezsoft.com>
 * @package     custom
 * @version     $Id$
 * @link        http://www.zentao.net
 */
?>
<?php include '../../../common/view/header.html.php';?>
<div id='featurebar'>
  <ul class='nav'>
  <?php
  foreach($lang->custom->object as $object => $name)
  {
      echo "<li id='{$object}Tab'>"; 
      common::printLink('custom', 'set', "module=$object",  $name); 
      echo '</li>';
  }
  echo "<li>";
  common::printLink('custom', 'flow', "",  $lang->custom->flow); 
  echo '</li><li>'; 
  common::printLink('custom', 'working', '',  $lang->custom->working);
  echo "</li><li>";
  common::printLink('custom', 'loginDefaultPage', '',  $lang->custom->loginDefaultPage);
  echo "</li><li class='active'>";
  common::printLink('custom', 'customStoryCollectPool', '',  $lang->custom->customStoryCollectPool);
  echo '</li>';
  ?>
  </ul>
</div>
<div class='main'>
  <form method='post' class='form-condensed' target='hiddenwin'>
    <table class='table table-form'>
      <tr>
        <th class='w-150px'><?php echo $lang->custom->customStoryCollectPool;?></th>
        <td>
          <p>
          <?php echo html::input('customStoryCollectPool', $nowCustomStoryCollectPool, "class='form-control w-500px' autocomplete='off'");?></p>
        </td>
      </tr>
      <tr><td></td><td><?php echo html::submitButton()?></td></tr>
      <tr>
        <td colspan='2' class='pd-0'>
          <div class='alert alert-info alert-block'><strong><?php echo $lang->custom->notice->customStoryCollectPool?></strong></div>
        </td>
      </tr>
    </table>
  </form>
</div>
<?php include '../../../common/view/footer.html.php';?>
