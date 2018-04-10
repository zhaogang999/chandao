function showAction(value, obj)
{
    if(value == 'pass')
    {
        $(obj).addClass('hidden');
        if($(obj).parent().prop('tagName') == 'TR')
        {
            $(obj).closest('tbody').children('tr').each(function(){
                var $td = $(this).children('td:first');
                if($td.attr('colspan') != undefined) $td.attr('colspan', 2);
            });
        }
    }
    else
    {
        $(obj).removeClass('hidden');
        if($(obj).parent().prop('tagName') == 'TR')
        {
            $(obj).closest('tbody').children('tr').each(function(){
                var $td = $(this).children('td:first');
                if($td.attr('colspan') != undefined) $td.attr('colspan', 4);
                //bug10478 批量执行测试用例时的测试结果如果为失败，则用例中个各个步骤执行结果默认失败
                $(this).children('td' + obj + ':first').children('select').val(value);
            });
        }
    }
}
