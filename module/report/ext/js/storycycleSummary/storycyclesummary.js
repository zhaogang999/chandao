function getStories(project)
{

    link = createLink('report', 'storyCycleSummary', 'project=' + project);
    location.href=link;
}
