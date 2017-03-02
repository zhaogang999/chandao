<style>
#featurebar .actions #exportAction{display:none;};
</style>
<div class='sub-featurebar'>
  <ul class='nav'>
    <?php 
    echo "<li id='relation'>" . html::a($this->createLink('project', 'relation', "projectID=$projectID"), $lang->project->gantt->relationOfTasks) . "</li>";
    echo "<li id='maintainRelation'>" . html::a($this->createLink('project', 'maintainRelation', "projectID=$projectID"), $lang->project->gantt->editRelationOfTasks) . "</li>";
    ?>
  </ul>
</div>
