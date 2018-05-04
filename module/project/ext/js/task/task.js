/**
 * 4218批量编辑截止日期
 * Created by 月下亭中人 on 2018/04/16.
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
    var changeDate = ev.date.valueOf();
    var field = $(this).text();
    $(".dropup").removeClass('open');

    field = field == '截止日期'?'deadline':'';
    var url = createLink('task', 'batchEditDate', "field=" + field + "&value=" + changeDate);

    setFormAction(url,'hiddenwin');
}
