/**
 * Created by 月下亭中人 on 2018/5/23.
 */
$(document).ready(function()
{
    setTimeout(function(){fixedTheadOfList('#userTaskSummary')}, 100);
});
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
        format: 'yyyy-mm-dd'
        //startDate: new Date()
    };
    $('input#begin,input#end').fixedDate().datetimepicker(options);
});