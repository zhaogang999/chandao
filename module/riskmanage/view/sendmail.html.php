<?php
/**
 * The mail file of riskmanage module of ZenTaoPMS.
 *
 * @copyright   RabbitDog
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      RabbitDog
 * @package     riskmanage
 * @version     20171214
 */
?>
<?php $mailTitle = '流出问题 #' . $riskManage->id . ' ' . $riskManage->title;?>
<?php include $this->app->getModuleRoot() . 'common/view/mail.header.html.php';?>
<tr>
  <td>
    <table cellpadding='0' cellspacing='0' width='600' style='border: none; border-collapse: collapse;'>
      <tr>
        <td style='padding: 10px; background-color: #F8FAFE; border: none; font-size: 14px; font-weight: 500; border-bottom: 1px solid #e5e5e5;'><?php echo html::a(zget($this->config->mail, 'domain', common::getSysURL()) . helper::createLink('riskmanage', 'view', "riskmanageID=$riskManage->id&from=project"), $mailTitle, '', "style='color: #333; text-decoration: underline;'");?></td>
      </tr>
    </table>
  </td>
</tr>
<tr>
  <td style='padding: 10px; border: none;'>
    <fieldset style='border: 1px solid #e5e5e5'>
      <legend style='color: #114f8e'><?php echo $this->lang->riskmanage->desc;?></legend>
      <div style='padding:5px;'><?php echo $riskManage->desc;?></div>
    </fieldset>
    <fieldset style='border: 1px solid #e5e5e5'>
      <legend style='color: #114f8e'><?php echo $this->lang->riskmanage->preventiveMeasure;?></legend>
      <div style='padding:5px;'><?php echo nl2br($riskManage->preventiveMeasure);?></div>
    </fieldset>
    <fieldset style='border: 1px solid #e5e5e5'>
      <legend style='color: #114f8e'><?php echo $this->lang->riskmanage->emergencyMeasure;?></legend>
      <div style='padding:5px;'><?php echo nl2br($riskManage->emergencyMeasure);?></div>
    </fieldset>
  </td>
</tr>
<?php include $this->app->getModuleRoot() . 'common/view/mail.footer.html.php';?>
