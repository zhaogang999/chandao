function getStories(product)
{
    link = createLink('report', 'bugBranchStatistics', 'product=' + product);
    location.href=link;
}
