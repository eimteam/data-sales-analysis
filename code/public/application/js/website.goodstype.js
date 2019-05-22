layui.use('table', function(){
  var table = layui.table;  
  table.render({
    elem: '#test'
    ,url:'/goodstype/getdata'
    ,toolbar: '#toolbarDemo'
    ,title: '用户数据表'
    ,cols: [[         
      {field:'gt_name', title:'名称', width:120, edit: 'text'}
      ,{field:'gt_size', title:'尺码'}
      ,{field:'gt_color', title:'颜色', width:80, edit: 'text', sort: true}
      ,{field:'gt_data', title:'其他信息', width:100}
      ,{field:'sort', title:'排序',sort: true}  
      ,{fixed: 'right', title:'操作', toolbar: '#barDemo', width:150}
    ]]
    ,page: true
    ,parseData: function(res){ //res 即为原始返回的数据
        return {
          "code": res.data.code, //解析接口状态
          "msg": res.data.msg, //解析提示文本
          "count": res.data.count, //解析数据长度
          "data": res.data.data //解析数据列表
        };
      }
  });
  
  //头工具栏事件
  table.on('toolbar(test)', function(obj){
    var checkStatus = table.checkStatus(obj.config.id);
    switch(obj.event){
      case 'add':
        $.post('/goodstype/editpage', {}, function(str){
          layer.open({
            type: 1,
            area: ['30%','60%'],
            content: str.data
          });
        },'json');
      break;      
    };
  });
  
  //监听行工具事件
  table.on('tool(test)', function(obj){
    var data = obj.data;
    //console.log(obj)
    if(obj.event === 'del'){
      layer.confirm('真的删除行么', function(index){
        obj.del();
        layer.close(index);
      });
    } else if(obj.event === 'edit'){
      $.post('/goodstype/editpage', {}, function(str){
        layer.open({
          type: 1,
          content: str.data
        });
      },'json');
    }
  });
});

$(document).ready(function(){
    $('.dataTables-example').DataTable({
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
    });
});
