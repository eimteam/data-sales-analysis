$.fn.dataTable.ext.errMode = 'throw';//设置DataTables的错误提示方式为抛出异常 


//重置
function delrow(t,state){
  var row_data = table.row(t.parentNode).data();
  
  initTable();
  //table.ajax.reload(); 
}

var tData=[{"code":"1234","name":"T","type":"T1","color":"黑色","size":"M","number":0,"sizecount":3,"codecount":6},{"code":"1234","name":"T","type":"T1","color":"黑色","size":"L","number":0,"sizecount":0,"codecount":0},{"code":"1234","name":"T","type":"T1","color":"黑色","size":"XL","number":0,"sizecount":0,"codecount":0},{"code":"1234","name":"T","type":"T1","color":"白色","size":"M","number":0,"sizecount":3,"codecount":0},{"code":"1234","name":"T","type":"T1","color":"白色","size":"L","number":0,"sizecount":0,"codecount":0},{"code":"1234","name":"T","type":"T1","color":"白色","size":"XL","number":0,"sizecount":0,"codecount":0},{"code":"1235","name":"T","type":"T1","color":"黑色","size":"M","number":0,"sizecount":3,"codecount":6},{"code":"1235","name":"T","type":"T1","color":"黑色","size":"L","number":0,"sizecount":0,"codecount":0},{"code":"1235","name":"T","type":"T1","color":"黑色","size":"XL","number":0,"sizecount":0,"codecount":0},{"code":"1235","name":"T","type":"T1","color":"白色","size":"M","number":0,"sizecount":3,"codecount":0},{"code":"1235","name":"T","type":"T1","color":"白色","size":"L","number":0,"sizecount":0,"codecount":0},{"code":"1235","name":"T","type":"T1","color":"白色","size":"XL","number":0,"sizecount":0,"codecount":0}];

var table;
function initTable(){
   table=$('.dataTables-inventoryorder').DataTable({
      "destroy": true,
        "data": tData,  
        'pageLength': 10000,      
        "dom":'it', 
        "oLanguage": {
             "sInfo": "共 _TOTAL_条数据",           
        },       
        "columns": [
            {"data": null, class:'center',    title: "操作", "width": "8%"},            
            {"data": "code", class:'center',title: "货号", "width": "15%"},     
            {"data": "type",class:'center',title: "品类",   "width": "15%"},
            {"data": "name",class:'center',title: "品名",   "width": "15%"},            
            {"data": "color",class:'center',title: "颜色",   "width": "15%"},
            {"data": "size",class:'center',title: "尺寸",   "width": "40%"},                      
        ],
        "fnDrawCallback": function () {
            this.api().column(0).nodes().each(function (cell, i) {
                //cell.innerHTML = i + 1;
                cell.innerHTML ="<span class='btn btn-link' onclick='delrow(this)'><i class='fa fa-trash-o'></i>删</span>";
                
            });
        },
        "columnDefs": [
          {     //重要的部分专门处理货号、大类、品名的合并
              targets: [1], //要合并的列数
              createdCell: function (td, cellData, rowData, row, col) { 
                  return;
                  var rowspan = rowData.codecount;//这里主要是利用了数据中的codecount来控制接下来要合并的行数
                  if (rowspan > 1) { //相同的行这里codecount是0
                      $(td).attr('rowspan', rowspan);
                      $(td).attr('class', 'text-center')
                  }
                  if (rowspan == 0) {
                      $(td).remove();  //单元格移除掉 留给上一行合并
                  }
              }             
          },{     //重要的部分专门处理颜色的合并
              targets: [2], //要合并的列数
              createdCell: function (td, cellData, rowData, row, col) { 
                  return;
                  var rowspan = rowData.sizecount;//这里主要是利用了数据中的sizecount来控制接下来要合并的行数
                  if (rowspan > 1) { //相同的行这里sizecount是0
                      $(td).attr('rowspan', rowspan);
                      $(td).attr('class', 'text-center')
                  }
                  if (rowspan == 0) {
                      $(td).remove();  //单元格移除掉 留给上一行合并
                  }
              },
              "render": function (data, type, rowData) {
                  return "<span title='" + data + "'>" + data + "</span>";
              }  
          },{   
              targets: [-1],  //处理尺寸            
              "render": function (data, type, rowData) {
                return '<div class="input-group m-b">'+
                  '<span class="input-group-addon">'+data+'</span> '+
                  '<input type="text" placeholder="" class="form-control" value="'+rowData.number+'">'+
                '<span class="input-group-addon">件</span></div>';                 
              }  
          }]      
    });
}
initTable();
//新增按钮追加到表格工具栏上
//$("div.dataTables_filter").append($("#toolbar_option").html());
