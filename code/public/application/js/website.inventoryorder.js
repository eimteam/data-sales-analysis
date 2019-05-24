$.fn.dataTable.ext.errMode = 'throw';//设置DataTables的错误提示方式为抛出异常 

var d=[
{code:'1234','name':'T','type':'T1','color':['黑色','白色'],'size':['M','L','XL']},
{code:'1235','name':'T','type':'T1','color':['黑色','白色'],'size':['M','L','XL']},
];

var cc=[];
function resetData(){
    cc=[];
    for(var i in d){
      //算出有几个颜色
      var codecount=d[i]['color'].length;
      for(var color in d[i]['color']){
        //该颜色下有几个尺寸
        var sizecount=d[i]['size'].length;
        codecount=codecount*sizecount;
        for(var size in d[i]['size']){      
          cc.push({            
            'code':d[i]['code'],
            'name':d[i]['name'],
            'type':d[i]['type'],
            'color':d[i]['color'][color],
            'size':d[i]['size'][size],
            'number':0,
            'sizecount':sizecount,
            'codecount':codecount,
          });         
          sizecount=0;
          codecount=0;
        }
      }
    }
}
resetData();
function delrow(t,state){
  var row_data = table.row(t.parentNode).data();
  //cc.splice(row_data.id,1)
  //这里得去d数组删除 重新组建cc数组
  for(var i in d){
    if(row_data['code']==d[i]['code']){
      switch(state){
        case "code":
            d.splice(i,1);
            break;
        case "color":
          break;
        case "size":
          break;
      }
      break;
    }
  }
  resetData();
  initTable();
  //table.ajax.reload(); 
}
console.log(cc);
var table;
function initTable(){
   table=$('.dataTables-inventoryorder').DataTable({
      "destroy": true,
        "data": cc,  
        'pageLength': 10000,      
        "dom":'it', 
        "oLanguage": {
             "sInfo": "共 _TOTAL_条数据",           
        },       
        "columns": [
            {"data": null, class:'center',    title: "序号",     "width": "8%"},            
            {"data": "code", class:'center',title: "货号", "width": "15%"},                 
            {"data": "color",class:'center',title: "颜色",   "width": "15%"},
            {"data": "size",class:'center',title: "尺寸",   "width": "40%"},                      
        ],
        "fnDrawCallback": function () {
            this.api().column(0).nodes().each(function (cell, i) {
                cell.innerHTML = i + 1;
            });
        },
        "columnDefs": [
          {     //重要的部分专门处理货号、大类、品名的合并
              targets: [1], //要合并的列数
              createdCell: function (td, cellData, rowData, row, col) { 
                  var rowspan = rowData.codecount;//这里主要是利用了数据中的codecount来控制接下来要合并的行数
                  if (rowspan > 1) { //相同的行这里codecount是0
                      $(td).attr('rowspan', rowspan);
                      $(td).attr('class', 'text-center')
                  }
                  if (rowspan == 0) {
                      $(td).remove();  //单元格移除掉 留给上一行合并
                  }
              },
              "render": function (data, type, rowData) {
                 var str= "<span class='label'>货号:{code}</span><br/><br/><span  class='label label-success'>品名:{name}</span><br/><br/><span  class='label label-info'>品类:{type}</span>"
                 .format({'code':rowData['code'],'name':rowData['name'],'type':rowData['type']});
                 str+="<br/><br/><span class='btn btn-link' onclick='delrow(this,\"code\")'><i class='fa fa-trash-o'></i>删</span>";
                 return str;
              }  
          },{     //重要的部分专门处理颜色的合并
              targets: [2], //要合并的列数
              createdCell: function (td, cellData, rowData, row, col) { 
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
                  return "<span title='" + data + "'>" + data + "</span>"+
                  '<span class="btn btn-link" onclick="delrow(this,\'color\')"><i class="fa fa-trash-o "></i>删</span>';
              }  
          },{   
              targets: [-1],  //处理尺寸            
              "render": function (data, type, rowData) {
                return '<div class="input-group m-b">'+
                  '<span class="input-group-addon">'+data+'</span> '+
                  '<input type="text" placeholder="" class="form-control" value="'+rowData.number+'">'+
                '<span class="input-group-addon">件</span>'+
                '<span class="input-group-addon btn btn-info" onclick="delrow(this.parentNode,\'size\')"><i class="fa fa-trash-o "></i>删</span></div>';                 
              }  
          }]      
    });
}
initTable();
//新增按钮追加到表格工具栏上
//$("div.dataTables_filter").append($("#toolbar_option").html());
