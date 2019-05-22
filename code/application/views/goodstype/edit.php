<div class="ibox float-e-margins">    
    <div class="ibox-content">
        <form id="gtypeform" class="form-horizontal">    
        <?php if(isset($gt_data)){?>
            <input type="hidden" name="gt_uid" value="<?= $gt_data['gt_uid']?>">
        <?php }?>        
            <div class="form-group">
              <label class="col-lg-3 control-label">名称</label>
              <div class="col-lg-8">
                <input type="text" name="gt_name" placeholder="大类名称" class="form-control" value="<?php if(isset($gt_data)){echo $gt_data['gt_name'];}?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">尺寸</label>
                <div class="col-lg-8">
                  <input name="gt_size" class="tagsinput" data-role="tagsinput" value="<?php if(isset($gt_data)){echo $gt_data['gt_size'];}?>" placeholder="输入后回车"/>
                </div>
            </div>
             <div class="form-group">
                  <label class="col-lg-3 control-label">颜色</label>
                    <div class="col-lg-8">
                      <input name="gt_color" class="tagsinput" data-role="tagsinput" value="<?php if(isset($gt_data)){echo $gt_data['gt_color'];}?>" placeholder="输入后回车"/>
                    </div>
            </div>
            <div class="form-group">
                  <label class="col-lg-3 control-label">其他</label>
                    <div class="col-lg-8">
                      <input name="gt_data" class="tagsinput" data-role="tagsinput" value="<?php if(isset($gt_data)){echo $gt_data['gt_data'];}?>" placeholder="输入后回车"/>
                    </div>
            </div>
            <div class="form-group">
              <label class="col-lg-3 control-label">排序</label>
              <div class="col-lg-8">
                <input type="text" name="sort" placeholder="排序" class="form-control" value="<?php if(isset($gt_data)){echo $gt_data['sort'];}?>">
              </div>
            </div>
        </form>
    </div>
</div>
<script>
  //刷新标签
$(".tagsinput").tagsinput('refresh');
</script>