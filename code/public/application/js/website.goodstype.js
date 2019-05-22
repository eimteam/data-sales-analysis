
$('.dataTables-example').DataTable({
        "serverSide": true,
        "info": true,
        'processing':true,
        'pageLength': 10,
        'responsive': true,
        "searching": true,
        "dom": 'lfrtip',
        "oLanguage": {
             "sLengthMenu": "每页显示 _MENU_ 条",
             "sZeroRecords": "对不起，查询不到任何相关数据",
             "sInfo": "当前显示 _START_ 到 _END_ 条，共 _TOTAL_条记录",
             "sInfoEmtpy": "找不到相关数据",
             "sInfoFiltered": "数据表中共为 _MAX_ 条记录)",
             "sProcessing": "正在加载中...",
             "sSearch": "全文检索",
             "oPaginate": {
                 "sFirst": "第一页",
                 "sPrevious":" 上一页 ",
                 "sNext": " 下一页 ",
                 "sLast": " 最后一页 "
            }
        },
        //指定地0列不参加排序
        "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0 ] }],
        //第一列参与排序
        "aaSorting": [[5, "asc"]],
        "ajax":{
            "url":'/goodstype/get_data',

        },
        "columns": [
            { "data": "gt_uid" },
            { "data": "gt_name" },
            { "data": "gt_size" },
            { "data": "gt_color" },
            { "data": "gt_data" },
            { "data": "sort" }
        ],
    });