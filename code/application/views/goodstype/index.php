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
                        <td>Trident</td>
                        <td class="center"><?= $item['gt_name'] ?></td>
                        <td class="center">
                            <span class='btn label label-default'>查看</span>
                        </td>
                        <td >                           
                            <span class="btn label label-primary"><i class="fa fa-plus"></i></span>
                        </td>
                        <td class="center">X</td>
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