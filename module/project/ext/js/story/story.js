/**
 * 2911 优化需求提测计划、发版计划等内容
 * Created by 月下亭中人 on 2017/12/19.
 */
$(function()
{
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
    var diffTime = ev.date.getTimezoneOffset();
    console.log(ev.date.valueOf());
    var changeDate= + ev.date.getFullYear().toString() + "-"+ (ev.date.getMonth()+1).toString()+ "-"+ ev.date.getDate().toString();
    var field = $(this).text();
    $(".dropup").removeClass('open');

    field = field == '提测时间'?'testDate':'releasedDate';
    var url = createLink('story', 'batchEditDate', "field=" + field + "&value=" + changeDate);

    setFormAction(url,'hiddenwin');
}
