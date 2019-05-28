$.fn.dataTable.ext.errMode = 'throw';//设置DataTables的错误提示方式为抛出异常 
//赋值给表格的数据源
var tData=[];
var table;
//重置
function delrow(t,index){
  //var row_data = table.row(t.parentNode).data();
  if (index>-1) {
    tData.splice(index,1);
    initTable();
  }
  //table.ajax.reload(); 
}
//新增数据到表格上
function addTempTable(){

    //根据已选颜色进行循环
    var colors=$('#gt_color option:selected');
    var sizes=$('#gt_size option:selected');    
    for (var i = 0; i < colors.length; i++) {
        for (var j = 0; j <sizes.length; j++) {
            tData.push({            
            "go_uid":$('#go_code option:selected').val(),
            "go_code":$('#go_code option:selected').text(),
            "gt_uid":$('#gt_uid option:selected').val(),
            "gt_name":$('#gt_uid option:selected').text(),
            "go_name":$('#go_name').val(),
            "color":colors[i].text,
            "size":sizes[j].text,
            "number":$('#count').val()
          });
        }
    }
    if (colors.length&&sizes.length) {
      initTable();
    }else{
      layer.msg('颜色和尺寸是必选项');
    }
}

//初始化表格
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
            {"data": "go_code", class:'center',title: "货号", "width": "15%"},     
            {"data": "gt_name",class:'center',title: "品类",   "width": "15%"},
            {"data": "go_name",class:'center',title: "品名",   "width": "15%"},            
            {"data": "color",class:'center',title: "颜色",   "width": "15%"},
            {"data": "size",class:'center',title: "尺寸",   "width": "40%"},                      
        ],
        "fnDrawCallback": function () {
            this.api().column(0).nodes().each(function (cell, i) {
                //cell.innerHTML = i + 1;
                cell.innerHTML ="<button class='btn btn-sm btn-primary' onclick='delrow(this,{0})'><i class='fa fa-trash-o'></i>删</span>".format(i);
                
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
//
//颜色选择
$('#gt_color').chosen({width:'100%',disable_search:false,no_results_text: "未找到",});
$('#gt_size').chosen({width:'100%',disable_search:false,no_results_text: "未找到",});
//大类选择
$("#gt_uid").chosen({
  width:'100%',
  no_results_text: "未找到",
  search_contains:true,   //关键字模糊搜索。设置为true，只要选项包含搜索词就会显示
  case_sensitive_search: false, //搜索大小写敏感。此处设为不敏感
  disable_search_threshold: 0, //当选项少等于于指定个数时禁用搜索
}).on('change',function(e,params){
    //根据选定的类别 显示对应的颜色
    var _color=$('#gt_uid option:selected').attr('data-color');
    if (_color) {
      _color=_color.split(',');
      var options='';
      for(var i in _color){
          options+='<option value="{color}">{color}</option>'.format({'color':_color[i]});
      }
      $('#gt_color').html(options);
      $('#gt_color').trigger('chosen:updated');
    }  
    var _size=$('#gt_uid option:selected').attr('data-size');  
    if (_size) {
      _size=_size.split(',');
      var options='';
      for(var i in _size){
          options+='<option value="{size}">{size}</option>'.format({'size':_size[i]});
      }
      $('#gt_size').html(options);
      $('#gt_size').trigger('chosen:updated');      
    } 
}).trigger("change");//手动触发一下change事件
//款号选择
$("#go_code").chosen({
  width:'100%',
  //no_results_text:第一个span 就是搜索框的内容,如果不写span会自动加一个span
  no_results_text: "新货号<span id='new_go_code'></span><p/><label class='label btn' onclick='savegoods()'>点我创建</label>",
  search_contains:true,   //关键字模糊搜索。设置为true，只要选项包含搜索词就会显示
  case_sensitive_search: false, //搜索大小写敏感。此处设为不敏感
  disable_search_threshold: 0, //当选项少等于于指定个数时禁用搜索
}).on('change', function(e, params) {
  //赋值品名
  var _name=$('#go_code option:selected').attr('data-name');
  if (_name) {
    $('#go_name').val(_name);
    $('#go_price1').val($('#go_code option:selected').attr('data-price1'));
    $('#go_price2').val($('#go_code option:selected').attr('data-price2'));
    $('#go_price3').val($('#go_code option:selected').attr('data-price3'));
  }  
}).trigger("change");