$.fn.dataTable.ext.errMode = 'throw';//设置DataTables的错误提示方式为抛出异常 
var table=$('.dataTables-example').DataTable({
        "serverSide": true,
        "info": true,
        "stateSave": true,
        'processing':true,
        'pageLength': 10,
        "lengthMenu": [5,10,15, 25, 50, 75, 100],
        'responsive': true,
        "searching": true,
        "deferRender": true,//延迟渲染
        "autoWidth": true,
        "dom":'lfrtip',
        "oLanguage": {
             "sLengthMenu": "每页显示 _MENU_ 条",
             "sZeroRecords": "对不起，查询不到任何相关数据",
             "sInfo": "当前 _START_ - _END_ 条,(共 _TOTAL_条)",
             "sInfoEmtpy": "找不到相关数据",
             "sInfoFiltered": ",全部总数 _MAX_ 条记录",
             "sProcessing": "正在加载中...",
             "sSearch": "全文检索",
             "oPaginate": {
                 "sFirst": "第一页",
                 "sPrevious":" 上一页 ",
                 "sNext": " 下一页 ",
                 "sLast": " 最后一页 "
            }
        },
        //状态保存到本地
        'stateSaveCallback': function(settings,data) {
          localStorage.setItem( 'DataTables_' + settings.sInstance, JSON.stringify(data) );
        },
        //状态本地获取
        'stateLoadCallback': function(settings) {
            return JSON.parse( localStorage.getItem( 'DataTables_' + settings.sInstance ) );
        },   
        "ajax":{
            "url":'/goodstype/get_datatable_data',

        },
        //第1列参与排序
        "aaSorting": [[1, "asc"]],
        "columns": [
            { 
              "data": "gt_uid" ,"orderable": false,"searchable": false,//不参与排序 不参与检索
              "render": function (data, type, row) {                  
                  return $("#option").html();
              }
            },
            { "data": "gt_name" },
            { "data": "gt_size" },
            { "data": "gt_color" },
            { "data": "gt_data" },
            { "data": "sort","targets":1}
        ]        
    });
//新增按钮追加到表格工具栏上
$("div.dataTables_filter").append($("#toolbar_option").html());
