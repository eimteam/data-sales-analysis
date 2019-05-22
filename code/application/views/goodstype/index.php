<div class="row">    
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                        <tr>
                            <th>操作</th>
                            <th>名称</th>
                            <th class="center">尺寸</th>
                            <th>颜色</th>
                            <th>其他</th>
                            <th>排序</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(isset($goodstypeData)){foreach($goodstypeData as $item){ ?>
                            <tr>
                                <td class="center">   
                                    <?php if($controller->hash_auth('goodstype','delete')){?>
                                    <span class="btn label label-danger">
                                        <i class="fa fa-trash"></i>
                                    </span>
                                    <?php }?>
                                    <?php if($controller->hash_auth('goodstype','edit')){?>
                                        &nbsp;
                                    <span class="btn label label-primary" onclick="edittype('<?= $item['gt_uid'] ?>')">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    <?php }?>
                                </td>
                                <td class="center"><?= $item['gt_name'] ?></td>
                                <td class="center">
                                    <?php foreach(explode(',',$item['gt_size'] ) as $size){?>
                                        <label class="label"><?= $size ?></label>
                                    <?php } ?>
                                </td>
                                <td >       
                                    <?php foreach(explode(',',$item['gt_color'] ) as $color){?>
                                        <label class="label"><?= $color ?></label>
                                    <?php } ?>
                                </td>
                                <td class="center"><?= $item['gt_data'] ?></td>
                                <td class="center"><?= $item['sort'] ?></td>
                            </tr>
                        <?php }}?>
                    </tbody>                    
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    <?php if($controller->hash_auth('goodstype','edit')){?>    
    function edittype(uid){
        $.post('/goodstype/editpage', {'gt_uid':uid}, function(str){
          layer.open({
            type: 1,
            area: ['40%','60%'],
            content: str.data,
            btn: ['保存', '关闭'],
            yes:function(index,layero){
                layer.load(); 
                save();
                return false;
              }           
          });
        },'json');          
    }
    //保存数据
    function save(){
        var postData = $("#gtypeform").serializeArray();                
        $.post('/goodstype/save_goodstype',postData,function(res){
            if (res.status) {
                layer.closeAll();
                layer.msg('保存成功',{icon:6});
            }else{
                layer.msg(res.info,{icon:5});
            }
        },'json');
    }
    <?php }?>
</script>