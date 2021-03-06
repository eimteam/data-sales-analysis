<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>新增来货 <small>类别、货号、颜色</small></h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>        
            <a class="dropdown-toggle" href="javascript:;" onclick="addTempTable()">
                <i class="fa fa-plus"></i>添加</button>
            </a>
           
        </div>
    </div>
    <div class="ibox-content m-b-sm border-bottom">        
        <div class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label" for="go_code">货号</label>
                    <select id="go_code" name="go_code" class="form-control" required>
                       <?php if(isset($goodsdata)){ foreach($goodsdata as $item){?>
                       <option value="<?= $item['go_uid'];?>" data-name="<?= $item['go_name'];?>" data-price1="<?= $item['go_price1'];?>" data-price2="<?= $item['go_price2'];?>" data-price3="<?= $item['go_price3'];?>">
                        <?= $item['go_code'];?>
                       </option>
                       <?php }} ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label" for="gt_uid">品类</label>            
                    <select id="gt_uid" name="gt_uid" class="form-control" required>
                       <?php if(isset($typedata)){ foreach($typedata as $item){?>
                       <option value="<?= $item['gt_uid'];?>" data-color="<?= $item['gt_color'];?>" data-size="<?= $item['gt_size'];?>">
                        <?= $item['gt_name'];?>
                       </option>
                       <?php }} ?>
                    </select>
                </div>
            </div>  
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="gt_color">颜色</label>                
                    <select multiple="multiple" id="gt_color" name="gt_color" class="form-control" data-placeholder="请选择一个颜色" required>                       
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="control-label" for="gt_size">尺寸</label>                
                    <select multiple="multiple" id="gt_size" name="gt_size" class="form-control" data-placeholder="请选择一个尺寸" >                       
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label" for="go_name">品名</label>
                    <input type="text" id="go_name" name="go_name" placeholder="商品名称" class="form-control">
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label" for="go_price1">零售价</label>
                    <div class="input-group m-b"> 
                          <input type="text" id="go_price1" name="go_price1"  placeholder="零售价格" class="form-control">
                        <span class="input-group-addon">元</span>
                    </div>  
                    
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label" for="go_price2">会员价</label>
                    <div class="input-group m-b"> 
                          <input type="text" id="go_price2" name="go_price2" placeholder="会员价格" class="form-control">
                        <span class="input-group-addon">元</span>
                    </div>                
                </div>
            </div>  
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label" for="go_price3">单价</label>
                    <div class="input-group m-b"> 
                         <input type="text" id="go_price3" name="go_price3"  placeholder="入库价格" class="form-control">
                        <span class="input-group-addon">元</span>
                    </div>  
                    
                </div>
            </div>
            <div class="col-sm-2">
                <div class="form-group">
                    <label class="control-label" for="count">数量</label>
                    <div class="input-group m-b"> 
                          <input type="text" id="count" name="count" value="1" class="form-control">
                        <span class="input-group-addon">件</span>
                    </div>                
                </div>
            </div>           
        </div>         
    </div>
</div>
<div class="row">    
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <table class="table table-striped table-bordered table-hover dataTables-inventoryorder" width="100%">                                       
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    //保存数据
function savegoods(){ 
    <?php if($controller->hash_auth('goods','save')){?> 
        var postData={};
        $goods_code=$("#new_go_code").html();
        postData['gt_uid']=$('#go_code option:selected').val();
        postData['go_code']=$goods_code;
        postData['go_name']=$goods_code;
        layer.load(1);              
        $.post('/goods/add_goods',postData,function(res){
            layer.close(layer.index);
            if (res.data.data) {
                layer.closeAll();
                layer.msg('保存成功',{icon:6});
                update_code_select();
            }else{                
                layer.msg('保存失败:'+JSON.stringify(res.info),{icon:5,time:5000});
            }
        },'json').fail(function(data,status){
            layer.close(layer.index);
            layer.msg(status+',错误代码'+data.status,{'icon':5,'time':5000});
        });    
    <?php }else{?>
        layer.msg('您没有操作权限',{icon:5,time:5000});
    <?php }?>
}
/**
 * 更新货号选择器
 * @return {[type]} [description]
 */
function update_code_select(){
    $.post('/goods/getData',{},function(res){  
            var s_data=[];          
            if (res.data) {
                s_data=res.data;
                var options='';
                for(var i in s_data){
                    options+='<option value="{go_uid}" data-name="{go_name}" data-price1="{go_price1}" data-price2="{go_price2}" data-price3="{go_price3}">{go_code}</option>'.format({go_uid:s_data[i]['go_uid'],go_name:s_data[i]['go_name'],go_price1:s_data[i]['go_price1'],go_price2:s_data[i]['go_price2'],go_price3:s_data[i]['go_price3'],go_code:s_data[i]['go_code']});
                }
                $('#go_code').html(options);
                $('#go_code').trigger('chosen:updated');
            }
    },'json').fail(function(data,status){
        layer.close(layer.index);
        layer.msg(status+',错误代码'+data.status,{'icon':5,'time':5000});
    });  
}
</script>