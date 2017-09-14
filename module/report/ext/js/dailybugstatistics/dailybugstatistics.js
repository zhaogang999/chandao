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

    fixedTableHead('.table-wrapper');
});

(function()
{
    jQuery.fn.tableChart = function()
    {
        $(this).each(function()
        {
            var $table = $(this);
            var $xLabel = [];
            var $groupLabels = [];
            var $series =[];
            var $xth = $table.find('.x-label');
            $xth.each(function(idx){
                var $childXth = $(this);
                $xLabel.push($childXth.text());
            });
            $table.find('.chart-label').each(function(idx){
                var $child = $(this);
                $groupLabels.push($child.text());
            });

            var cols = $table.find('.chart-label').length;//3
            var rows = $table.find('.x-label').length;//2
            var td = $table.find('.dataTables');

            for (var i=1;i<=cols;i++){
                var colData = [];
                for (var j=1;j<=rows;j++){
                    colData.push(td.eq((j-1)*cols+i-1).text());

                }
                var $groupLabel = $table.find('.chart-label').eq(i-1).text();

                var $type = 'line';
                if (i==2||i==1){$type= 'bar';}

                $series.push({name:$groupLabel,type:$type,data:colData,itemStyle:{normal:{label:{show:true,position: 'top'}}}});
            }

            var dom = document.getElementById("dailyBugStatistics");
            var myChart = echarts.init(dom);

            option = {
                title : {
                    text: 'bug分布情况',
                    x: 'center',
                    //垂直安放位置，默认为全图顶端，可选为：'top' | 'bottom' | 'center' | {number}（y坐标，单位px）
                    y: '0'
                },
                tooltip : {
                    trigger: 'axis'
                },
                legend: {
                    data:$groupLabels,
                    x: 'right',
                    //垂直安放位置，默认为全图顶端，可选为：'top' | 'bottom' | 'center' | {number}（y坐标，单位px）
                    y: 30
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '10%',
                    y: '18%',
                    containLabel: true
                },
                xAxis : [
                    {
                        type : 'category',
                        //boundaryGap : false,
                        data : $xLabel,
                        axisLabel:{
                            interval:0,//横轴信息全部显示
                            rotate:-45//-30度角倾斜显示
                        }
                    }
                ],
                yAxis : [
                    {
                        type : 'value'
                    }
                ],
                series : $series
            };

            //setTimeout("myChart.resize()",100);
            // 使用刚指定的配置项和数据显示图表。
            myChart.resize();
            myChart.setOption(option,true);
        });
    };

    $(function()
    {
        $('.dailyBugStatisticsTable').tableChart();

        //浏览器大小改变时重置大小

    });
}());
window.onresize = function() {
    $('#main').width('100%');
    myChart.resize();
};