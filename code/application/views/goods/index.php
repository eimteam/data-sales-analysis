<div class="row">    
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <table class="table table-striped table-bordered table-hover dataTables-goods" width="100%">                                       
                </table>
            </div>
        </div>
    </div>
</div>

<script  type="text/tmplate" id="toolbar_option">
    <div class="btn-group">
        <?php if($controller->hash_auth('goods','add')){?>
        <button class="btn btn-sm btn-primary" onclick="add()">
            <i class="fa fa-plus"></i>新增款号
        </button>
        <?php }?>
        <button class="btn btn-sm btn-success" onclick="table.ajax.reload();">
            <i class="fa fa-refresh"></i>刷新
        </button>
    </div>
</script>
<script  type="text/tmplate" id="option">       
    <?php if($controller->hash_auth('goods','price')){?>
        &nbsp;
    <button class="btn label label-warning" onclick="price(this)">
        <i class="fa fa-rmb"></i>
    </button>
    <?php }?> 
    <?php if($controller->hash_auth('goods','edit')){?>
        &nbsp;
    <button class="btn label label-primary" onclick="edit(this)">
        <i class="fa fa-pencil"></i>编辑
    </button>
    <?php }?>  
</script>
<script>
    <?php if($controller->hash_auth('goods','add')){?>   
    var add_html="";
    //获取页面html   
    function add(){
        if (add_html!="") {
            return showAddPage();
        }
        layer.load(1); 
        $.post('/goods/addpage', {}, function(str){
          layer.close(layer.index);
          add_html=str.data;
          showAddPage();
        },'json').fail(function(data,status){
            layer.close(layer.index);
            layer.msg(status+',错误代码'+data.status,{'icon':5,'time':5000});
        });
    }
    //弹出页面
    function showAddPage(){
        layer.open({
            type: 1,
            area: ['40%','80%'],
            content:add_html,
            btn: ['保存', '关闭'],
            yes:function(index,layero){                
                save('add_goods');
                return false;
              }           
          });
    }
    <?php }?> 
    <?php if($controller->hash_auth('goods','edit')){?>      
    function edit(t){
        var row_data = table.row(t.parentNode).data();//t.parentNode 指的是按钮所在的行
        layer.load(1); 
        $.post('/goods/editpage', {'go_uid':row_data.go_uid,"gt_uid":row_data.gt_uid}, function(str){
          layer.close(layer.index);
          layer.open({
            type: 1,
            anim:-1,            
            area: ['40%','80%'],
            content: str.data,
            btn: ['保存', '关闭'],
            yes:function(index,layero){                
                save('save_goods');                
                return false;
              }           
          });          
        },'json').fail(function(data,status){
            layer.close(layer.index);
            layer.msg(status+',错误代码'+data.status,{'icon':5,'time':5000});
        });
    } 
    <?php }?> 
    <?php if($controller->hash_auth('goods','save')){?>                   
    //保存数据
    function save(url){
        var postData = $("#gtypeform").serializeArray(); 
        layer.load(1);              
        $.post('/goods/'+url,postData,function(res){
            layer.close(layer.index);
            if (res.status) {
                layer.closeAll();
                layer.msg('保存成功',{icon:6});
                table.ajax.reload(); 
            }else{                
                layer.msg('保存失败:'+JSON.stringify(res.info),{icon:5,time:5000});
            }
        },'json').fail(function(data,status){
            layer.close(layer.index);
            layer.msg(status+',错误代码'+data.status,{'icon':5,'time':5000});
        });
    }
    <?php }?>
    <?php if($controller->hash_auth('goods','price')){?>      
    function price(t){
        var row_data = table.row(t.parentNode).data();//t.parentNode 指的是按钮所在的行
        layer.load(1); 
        $.post('/goods/editpage', {'go_uid':row_data.go_uid,"gt_uid":row_data.gt_uid}, function(str){
          layer.close(layer.index);
          layer.open({
            type: 1,
            anim:-1,            
            area: ['40%','80%'],
            content: str.data,
            btn: ['保存', '关闭'],
            yes:function(index,layero){                
                save('save_goods');                
                return false;
              }           
          });          
        },'json').fail(function(data,status){
            layer.close(layer.index);
            layer.msg(status+',错误代码'+data.status,{'icon':5,'time':5000});
        });
    } 
    <?php }?> 
</script>