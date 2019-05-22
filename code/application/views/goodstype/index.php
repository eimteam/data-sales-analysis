<div class="row">
    <div class="col-lg-12">
        <table class="layui-hide" id="test" lay-filter="test"></table>
 
        <script type="text/html" id="toolbarDemo">
          <div class="layui-btn-container">
            <button class="layui-btn layui-btn-sm" lay-event="add">新增大类</button>
          </div>
        </script>         
        <script type="text/html" id="barDemo">
            <div id="bar">
              <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
              <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
          </div>
        </script>
     
    </div>
</div>
<div class="row">    
    <div class="col-lg-12">
        <table class="table table-striped table-bordered table-hover dataTables-example" >
            <thead>
                <tr>
                    <th>操作</th>
                    <th>名称</th>
                    <th>尺寸</th>
                    <th>颜色</th>
                    <th>其他</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($goodstypeData)){foreach($goodstypeData as $item){ ?>
                    <tr>
                        <td class="center">                           
                            <span class="btn label label-danger"><i class="fa fa-trash"></i></span>
                        </td>
                        <td class="center"><?= $item['gt_name'] ?></td>
                        <td class="center">
                            <input name="gt_size" class="tagsinput" data-role="tagsinput" value="<?= $item['gt_size'] ?>" placeholder="输入后回车"/>
                        </td>
                        <td >                           
                            <input name="gt_color" class="tagsinput" data-role="tagsinput" value="<?= $item['gt_color'] ?>" placeholder="输入后回车"/>
                        </td>
                        <td class="center"><?= $item['gt_data'] ?></td>
                    </tr>
                <?php }}?>
            </tbody>
            <tfoot>
                <tr>
                    <th>操作</th>
                    <th>名称</th>
                    <th>尺寸</th>
                    <th>颜色</th>
                    <th>其他</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>