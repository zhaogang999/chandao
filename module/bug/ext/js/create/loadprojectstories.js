/**
 * Created by 月下亭中人 on 2018/5/2.
 */
/**
 * Load project stories.
 *
 * @param  projectID $projectID
 * @access public
 * @return void
 */
function loadProjectStories(projectID)
{
    branch = $('#branch').val();
    if(typeof(branch) == 'undefined') branch = 0;
    link = createLink('story', 'ajaxGetProjectStories', 'projectID=' + projectID + '&productID=' + $('#product').val() + '&branch=0&moduleID=0&storyID=' + oldStoryID);
    $('#storyIdBox').load(link, function(){$('#story').chosen(defaultChosenOptions);});
}
