$(function()
{
    ajaxGetSearchForm();

    $('#storyList').on('sort.sortable', function(e, data)
    {
        var list = '';
        for(i = 0; i < data.list.length; i++) list += $(data.list[i]).attr('data-id') + ',';
        $.post(createLink('project', 'storySort', 'projectID=' + projectID), {'storys' : list, 'orderBy' : orderBy}, function()
        {
            var $target = $(data.element[0]);
            $target.hide();
            $target.fadeIn(1000);
            order = 'order_asc';
            history.pushState({}, 0, createLink('project', 'story', "projectID=" + projectID + '&orderBy=' + order));
        });
    });

    fixedTfootAction('#projectStoryForm');
    fixedTheadOfList('#storyList');

    $('#module' + moduleID).addClass('active');
    $('#product' + productID).addClass('active');

    var options =
    {
        language: config.clientLang,
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1,
        minView: 2,
        format: 'yyyy-mm-dd',
        startDate: '1970-1-1'
        //onSelect: gotoDate
    };
    $('.change-date').fixedDate().datetimepicker(options).on('changeDate',gotoDate);
});
function gotoDate(ev) {
    var changeDate = ev.date.valueOf();
    var field = $(this).text();
    $(".dropup").removeClass('open');

    field = field == '提测时间'?'testDate':'specialPlan';
    var url = createLink('story', 'batchEditDate', "field=" + field + "&value=" + changeDate);

    setFormAction(url,'hiddenwin');
}
