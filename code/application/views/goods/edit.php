 <div class="ibox-content">
      <form id="gtypeform" class="form-horizontal">    
      <?php if(isset($go_data)){?>
          <input type="hidden" name="gt_uid" value="<?= $go_data['go_uid']?>">
      <?php }?>        
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
            <label class="col-lg-3 control-label">大类</label>
            <div class="col-lg-8">
              <input type="hidden"  name="sort" placeholder="大类" class="form-control" value="<?php if(isset($go_data)){echo $go_data['gt_uid'];}?>">
              <select class="select2 form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                <option value="1">Option 1</option>
                <option value="2">Option 2</option>
                <option value="3">Option 3</option>
                <option value="4">Option 4</option>
                <option value="5">Option 5</option>
            </select>
            </div>
            <div class="col-md-12">
                                  
                                    <select class="select2_demo_1 form-control select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                        <option value="1">Option 1</option>
                                        <option value="2">Option 2</option>
                                        <option value="3">Option 3</option>
                                        <option value="4">Option 4</option>
                                        <option value="5">Option 5</option>
                                    </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" style="width: 326.328px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-mz63-container"><span class="select2-selection__rendered" id="select2-mz63-container" title="Option 1">Option 1</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">排序</label>
            <div class="col-lg-5">
              <input class="touchspin form-control text-center" type="text" value="<?php if(isset($go_data)){echo $go_data['sort'];}?>" name="sort"  placeholder="排序">             
            </div>
          </div>
      </form>
  </div>

<script>
  alert(1);
  //排序 加减控件初始化
$(".touchspin").TouchSpin();
  //下拉选择控件初始化
$(".select2_demo_1").select2();
</script>