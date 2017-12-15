<?php
/**
 * The mail file of storyReview module of ZenTaoPMS.
 *
 * @copyright   RabbitDog
 * @license     ZPL (http://zpl.pub/page/zplv12.html)
 * @author      RabbitDog
 * @package     storyReview
 * @version     20171214
 */
?>
<?php $mailTitle = 'STORYREVIEW #' . $storyReview->id . ' ' . $storyReview->title;?>
<?php include $this->app->getModuleRoot() . 'common/view/mail.header.html.php';?>
<tr>
  <td>
    <table cellpadding='0' cellspacing='0' width='600' style='border: none; border-collapse: collapse;'>
      <tr>
        <td style='padding: 10px; background-color: #F8FAFE; border: none; font-size: 14px; font-weight: 500; border-bottom: 1px solid #e5e5e5;'><?php echo html::a(zget($this->config->mail, 'domain', common::getSysURL()) . helper::createLink('storyreview', 'view', "storyReviewID=$storyReview->id&from=project"), $mailTitle, '', "style='color: #333; text-decoration: underline;'");?></td>
      </tr>
    </table>
  </td>
</tr>
<tr>
  <td style='padding: 10px; border: none;'>
    <fieldset style='border: 1px solid #e5e5e5'>
      <legend style='color: #114f8e'><?php echo $this->lang->storyreview->solvedProblem;?></legend>
      <div style='padding:5px;'><?php echo $storyReview->solvedProblem;?></div>
    </fieldset>
    <fieldset style='border: 1px solid #e5e5e5'>
      <legend style='color: #114f8e'><?php echo $this->lang->storyreview->influence;?></legend>
      <div style='padding:5px;'><?php echo $storyReview->influence;?></div>
    </fieldset>
    <fieldset style='border: 1px solid #e5e5e5'>
      <legend style='color: #114f8e'><?php echo $this->lang->storyreview->problemTracking;?></legend>
      <div style='padding:5px;'><?php echo $storyReview->problemTracking;?></div>
    </fieldset>
    <fieldset style='border: 1px solid #e5e5e5'>
      <legend style='color: #114f8e'><?php echo $this->lang->storyreview->result;?></legend>
      <div style='padding:5px;'><?php echo $storyReview->result;?></div>
    </fieldset>
    <fieldset style='border: 1px solid #e5e5e5'>
      <legend style='color: #114f8e'><?php echo $this->lang->storyreview->progressInfo;?></legend>
      <div style='padding:5px;'>
        <p><?php echo $this->lang->storyreview->testDate;?> : <?php echo $storyReview->testDate;?></p>
        <p><?php echo $this->lang->storyreview->acceptanceDate;?> : <?php echo $storyReview->acceptanceDate;?></p>
        <p><?php echo $this->lang->storyreview->releasedDate;?> : <?php echo $storyReview->releasedDate;?></p>
      </div>
    </fieldset>
    <fieldset style='border: 1px solid #e5e5e5'>
      <legend style='color: #114f8e'><?php echo $this->lang->storyreview->comment;?></legend>
      <div style='padding:5px;'><?php echo $storyReview->comment;?></div>
    </fieldset>
  </td>
</tr>
<?php include $this->app->getModuleRoot() . 'common/view/mail.footer.html.php';?>
