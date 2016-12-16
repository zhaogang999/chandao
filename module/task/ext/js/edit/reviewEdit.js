//新增，控制增减评审详情
$(function(){
    $('.add').live('click',function(){
        var tr = $(this).parent().parent().clone();
<<<<<<< HEAD
=======
        //console.log($(this).parent().parent().find(':hidden').val());
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
         tr.find('input[type="hidden"]').attr('value','');
         tr.find('input[type="text"]').attr('value','');
         tr.find('textarea').attr('value','');
         tr.find('select').attr('value','0');
        //追加新的tr元素
        $(this).parent().parent().after(tr);

    });
    $('.del').live('click',function(){
        //事件处理程序
<<<<<<< HEAD
=======
        //console.log($(this).parent().parent().find('').val());
>>>>>>> 56ce38b3ee68171c3a03a5f43eb2e61413da34c5
        if($(this).parent().parent().find(':hidden').val() == '')
        {
            $(this).parent().parent().remove();
        }
        if($(this).parent().parent().find(':hidden').val() != '')
        {
            if(confirm('点击确定将会永久删除该条记录'))
            {
                var _this = $(this);
                var reviewDetailID = $(this).parent().parent().find('input[type="hidden"]').val();
                $url = createLink('task', 'deleteReview', 'reviewDetailID=' + reviewDetailID);
                $.get($url, function(data) {
                    window.location.reload();
                    //_this.parent().parent().remove();
                },'json');
            }
        }
    });
});