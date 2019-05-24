$.fn.dataTable.ext.errMode = 'throw';//设置DataTables的错误提示方式为抛出异常 
var table=$('.dataTables-goods').DataTable({
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
        //第1列参与排序
        "aaSorting": [[1, "asc"]],
        "ajax":{
            "url":'/goods/get_datatable_data',

        },
        "columns": [
            { 
              "data": "go_uid" ,'title':'',"orderable": false,"searchable": false,//不参与排序 不参与检索              
              "render": function (data, type, row) {                  
                  return $("#option").html();
              }
            },
            { "data": "gt_name" ,'title':'大类'},
            { "data": "go_code",'title':'款号' },
            { "data": "go_name" ,'title':'品名'},
            { "data": "go_price1" ,'title':'零售'},
            { "data": "go_price2",'title':'会员' },           
            { "data": "count" ,'title':'件数'},
            { "data": "first_time" ,'title':'首次入库'},
            { "data": "last_time" ,'title':'最后销账'},
            { "data": "in_count" ,'title':'累入'},  
            { "data": "sell_count" ,'title':'累销'},
            { "data": "return_count" ,'title':'累返'},
            { "data": "sort" ,'name':'排序','title':'排序', "targets":1}
        ]        
    });
//新增按钮追加到表格工具栏上
$("div.dataTables_filter").append($("#toolbar_option").html());
