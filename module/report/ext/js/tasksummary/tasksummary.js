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

fixedTableHead('.table-wrapper');

(function ()
{
    jQuery.fn.getTaskDate = function()
    {
        $(this).each(function() {
            var $table = $(this);
            var $done = [];
            var $undone = [];
            var $donePercent = [];
            var $undonePercent = [];
            var $rows = $table.find('tbody > tr').each(function(idx)
            {
                var $row = $(this);
                $done.push($row.find('.doneTaskCount').text());
                $undone.push($row.find('.undoneTaskCount').text());
                $donePercent.push(parseInt($row.find('.doneTaskCountPercent').text()));
                $undonePercent.push(parseInt($row.find('.undoneTaskCountPercent').text()));
                //console.log($row);
            });
            option = {
                title : {
                    text : "具体进展",
                    x: 'center',
                    //垂直安放位置，默认为全图顶端，可选为：'top' | 'bottom' | 'center' | {number}（y坐标，单位px）
                    y: 'top'
                },
                tooltip : {
                    trigger: 'axis',
                    axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                        type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                    }
                },
                legend: {
                    data:['已完成','待完成'],
                    x: 'right',
                    //垂直安放位置，默认为全图顶端，可选为：'top' | 'bottom' | 'center' | {number}（y坐标，单位px）
                    y: 30
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis : [
                    {
                        type : 'category',
                        data : ['测试','开发', '需求']
                    }
                ],
                yAxis : [
                    {
                        type : 'value'
                    }
                ],
                series : [
                    {
                        name:'已完成',
                        barWidth : 70,
                        itemStyle : { normal: {label : {show: true, position: 'inside'}}},
                        type:'bar',
                        stack: '广告',
                        data:$done
                    },
                    {
                        name:'待完成',
                        barWidth : 70,
                        itemStyle : { normal: {label : {show: true, position: 'inside'}}},
                        type:'bar',
                        stack: '广告',
                        data:$undone
                    }
                ]
            };
            var myChart = echarts.init(document.getElementById('detail'));
            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(option);


            // 基于准备好的dom，初始化echarts实例

            var myChart = echarts.init(document.getElementById('main'));

            // 指定图表的配置项和数据
            optionPercent = {
                title : {
                    text : "整体进展",
                    x: 'center',
                    //垂直安放位置，默认为全图顶端，可选为：'top' | 'bottom' | 'center' | {number}（y坐标，单位px）
                    y: 'top'
                },
                tooltip : {
                    trigger: 'axis',
                    axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                        type : 'shadow',        // 默认为直线，可选为：'line' | 'shadow'
                        formatter: '{c}%'
                    }
                },
                legend: {
                    data:['已完成','未完成'],
                    x: 'right',
                    //垂直安放位置，默认为全图顶端，可选为：'top' | 'bottom' | 'center' | {number}（y坐标，单位px）
                    y: 30
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                yAxis : [
                    {
                        type : 'category',
                        data : ['测试','开发','需求']
                    }
                ],
                xAxis : [
                    {
                        type : 'value',
                        axisLabel: {
                            show: true,
                            interval: 'auto',
                            formatter: '{value} %'
                        },
                        show: true
                    }
                ],
                series : [
                    {
                        name:'已完成',
                        itemStyle : { normal: {color:'#616161', label : {show: true, position: 'inside',formatter: '{c}%'}}},
                        type:'bar',
                        stack: '完成情况',
                        data:$donePercent
                    },
                    {
                        name:'未完成',
                        itemStyle : { normal: {color:'#B3B3B3', label : {show: true, position: 'inside', formatter: '{c}%'}}},
                        type:'bar',
                        stack: '完成情况',
                        data:$undonePercent
                    }
                ]
            };
            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(optionPercent);
        });
    };

    jQuery.fn.getProjectProgress = function()
    {
        $(this).each(function() {
            var $table = $(this);
            var $label = [];
            var $doneStoryTask = [];
            var $undoneStoryTask = [];
            var $doneDevelTask = [];
            var $undoneDevelTask = [];
            var $doneTestTask = [];
            var $undoneTestTask = [];
            var $rows = $table.find('tbody > tr').each(function(idx)
            {
                var $row = $(this);
                $label.push($row.find('.chart-label').text());
                $doneStoryTask.push($row.find('.doneStoryTask').text());
                $undoneStoryTask.push($row.find('.undoneStoryTask').text());
                $doneDevelTask.push($row.find('.doneDevelTask').text());
                $undoneDevelTask.push($row.find('.undoneDevelTask').text());
                $doneTestTask.push($row.find('.doneTestTask').text());
                $undoneTestTask.push($row.find('.undoneTestTask').text());
            });

            getBarCharts('storyTaskProgress', '需求&设计进展', $label, $doneStoryTask, $undoneStoryTask);
            getBarCharts('develTaskProgress', '开发进展', $label, $doneDevelTask, $undoneDevelTask);
            getBarCharts('testTaskProgress', '测试进展', $label, $doneTestTask, $undoneTestTask);


        });
    };

    function getBarCharts (idName, title, label, done, undone)
    {
        option = {
            title : {
                text : title,
                x: 'center',
                //垂直安放位置，默认为全图顶端，可选为：'top' | 'bottom' | 'center' | {number}（y坐标，单位px）
                y: 'top'
            },
            tooltip : {
                trigger: 'axis',
                axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                    type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                }
            },
            legend: {
                data:['已完成','待完成'],
                x: 'right',
                //垂直安放位置，默认为全图顶端，可选为：'top' | 'bottom' | 'center' | {number}（y坐标，单位px）
                y: 30
            },
            grid: {
                left: '5%',
                right: '5%',
                bottom: '10%',
                containLabel: true
            },
            xAxis : [
                {
                    type : 'category',
                    data : label,
                    axisLabel:{
                        interval:0,//横轴信息全部显示
                        rotate:-23//-30度角倾斜显示
                    }
                }
            ],
            yAxis : [
                {
                    type : 'value'
                }
            ],
            series : [
                {
                    name:'已完成',
                    barWidth : 30,
                    itemStyle : { normal: {label : {show: true, position: 'inside'}}},
                    type:'bar',
                    stack: '广告',
                    data:done
                },
                {
                    name:'待完成',
                    barWidth : 30,
                    itemStyle : { normal: {label : {show: true, position: 'inside'}}},
                    type:'bar',
                    stack: '广告',
                    data:undone
                }
            ]
        };
        var myChart = echarts.init(document.getElementById(idName));
        // 使用刚指定的配置项和数据显示图表。
        //option = getOption($title, $doneStoryTask, $undoneStoryTask);
        myChart.setOption(option);
        //return option;
    }

    $(function () {
        $('.table-chart').getTaskDate();
        $('.projectProgress').getProjectProgress();
    });
})();
