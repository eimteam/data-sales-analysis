 <div class="ibox-content" >
      <form id="gtypeform" class="form-horizontal">    
      <?php if(isset($go_data)){?>
          <input type="hidden" name="go_uid" value="<?= $go_data['go_uid']?>">
      <?php }?>  
          <div class="form-group">
            <label class="col-lg-3 control-label">大类</label>
            <div class="col-lg-8" id="select2type">             
              <select name="gt_uid" data-placeholder="请选择一个类别" class="chosen-select">  
                 <?php if(isset($typedata)){ foreach($typedata as $item){?>
                   <option value="<?= $item['gt_uid'];?>" <?php if(isset($go_data)&&$item['gt_uid']==$go_data['gt_uid']){echo 'selected';}?>>
                    <?= $item['gt_name'];?>
                   </option>
                 <?php }} ?>
              </select>
            </div>
          </div>      
          <div class="form-group">
            <label class="col-lg-3 control-label">款号</label>
            <div class="col-lg-8">
              <input type="text" name="go_code" placeholder="款号" class="form-control" value="<?php if(isset($go_data)){echo $go_data['go_code'];}?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">货品名称</label>
              <div class="col-lg-8">
                <input name="go_name" class="form-control" type="text" value="<?php if(isset($go_data)){echo $go_data['go_name'];}?>" placeholder="货品名称"/>
              </div>
          </div>
           <div class="form-group">
                <label class="col-lg-3 control-label">零售价</label>
                  <div class="col-lg-8">
                    <input name="go_price1" class="form-control" type="text" value="<?php if(isset($go_data)){echo $go_data['go_price1'];}?>" placeholder="零售价"/>
                  </div>
          </div>
          <div class="form-group">
                <label class="col-lg-3 control-label">会员价</label>
                  <div class="col-lg-8">
                    <input name="go_price2" class="form-control" type="text" value="<?php if(isset($go_data)){echo $go_data['go_price2'];}?>" placeholder="会员价"/>
                  </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">成本价</label>
            <div class="col-lg-8">
              <input type="text" name="go_price3" placeholder="成本价" class="form-control" value="<?php if(isset($go_data)){echo $go_data['go_price3'];}?>">
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-lg-3 control-label">排序</label>
            <div class="col-lg-5">
              <input class="touchspin form-control text-center" type="text" value="<?php if(isset($go_data)){echo $go_data['sort'];}else{echo 0;}?>" name="sort"  placeholder="排序">             
            </div>
          </div>
      </form>
  </div>
<script> 
  //排序 加减控件初始化
$(".touchspin").TouchSpin();
  //下拉选择控件初始化
$(".chosen-select").chosen({
  width:'100%',
  no_results_text: "未找到",
  search_contains:true,   //关键字模糊搜索。设置为true，只要选项包含搜索词就会显示
  case_sensitive_search: false, //搜索大小写敏感。此处设为不敏感
  disable_search_threshold: 0, //当选项少等于于指定个数时禁用搜索
});
</script>