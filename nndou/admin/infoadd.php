    <?php 
        include 'header.php' ;

        //查询咨询类型
        $casetype = casetype();
        //添加咨询
        if(isset($_POST['sub'])){
            $type = $_POST['casetype'];
            $title = $_POST['title'];
            $content = isset($_POST['editorValue']) ? trim($_POST['editorValue']) : '';
            $time = time();
            //上传图片
            if(!empty($_FILES)){
                $upload = upload('pic1');
                if($upload['code']==1){
                     $imgpath = $upload['imgpath'];

                     //截取数组最后一个元素
                     $arr_list=explode('/',$imgpath);
                     $c=count($arr_list)-1;
                     $filename=$arr_list[$c];

                     //生成缩略图
                     $thumbimg=thumb($imgpath,150,102,'uploads/thumb',$filename);

                   
                }else{
                     $msg=$upload['msg'];
                }
               
            }
            $sql="INSERT INTO nnd_info (`info_title`,`info_content`,`info_img`,`info_time`,`info_type`,`info_thumb`) VALUES( '$title',' $content',' $imgpath','$time',$type,'$thumbimg')";
           $res=insert($sql);
           if($res['code']==1){
                echo "<script> alert('添加成功');window.location.href='info.php';</script>";
               

           }else{
                echo "<script> alert('添加失败')</script>";
           }



        }

    ?>  

   





    <!-- End: Sidebar -->
    <!-- Start: Content -->
    <section id="content">
        <div id="topbar" class="affix">
            <ol class="breadcrumb">
                <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="active">添加资讯</li>
            </ol>
        </div>
        <div class="container">

            <div class="row">
                <div class="col-md-10 col-lg-8 center-column">
                    <form action="" method="post" class="cmxform" id="uploadForm" enctype='multipart/form-data'>
                        <div class="panel">
                            <div class="panel-heading">
                                <div class="panel-title">添加文章</div>
                                <div class="panel-btns pull-right margin-left">
                                    <a href="#"
                                       class="btn btn-default btn-gradient dropdown-toggle" onclick="window.history.go(-1)"><span
                                            class="glyphicon glyphicon-chevron-left"></span></a>
                                </div>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">分类</span>
                                            <select name="casetype" id="standard-list1" class="form-control">
                                               
                                                <?php foreach ($casetype as  $v) {?>
                                                <option value="<?php echo $v['info_type_id'] ?>"><?php echo $v['info_type_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">标题</span>
                                            <input type="text" name="title" value="" class="form-control">
                                        </div>
                                    </div>

                                    <div>
                                       
                                            <div class="fileinput fileinput-new" data-provides="fileinput"  id="exampleInputUpload">
                                                <div class="fileinput-new thumbnail" style="width: 200px;height: auto;max-height:150px;">
                                                    <img id='picImg' style="width: 100%;height: auto;max-height: 140px;" src="images/noimage.png" alt="" />
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                                <div>
                                                    <span class="btn btn-primary btn-file">
                                                        <span class="fileinput-new">选择文件</span>
                                                        <span class="fileinput-exists">换一张</span>
                                                        <input type="file" name="pic1" id="picID" accept="image/gif,image/jpeg,image/x-png"/>
                                                    </span>
                                                    <a href="javascript:;" class="btn btn-warning fileinput-exists" data-dismiss="fileinput">移除</a>
                                                </div>
                                            </div>

                                    </div>

                                </div>
                                <div class="form-group col-md-12">
                                <script type="text/plain" id="myEditor" style="width:100%;height:200px;">
					            <p></p>
                                </script>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <input type="submit" value="提交" class="submit btn btn-blue" name="sub">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </section>
    <!-- End: Content -->
</div>
<!-- End: Main -->

<link type="text/css" rel="stylesheet" href="umeditor/themes/default/_css/umeditor.css">
 <script src="js/bootstrap-fileinput.js"></script>
<script src="umeditor/umeditor.config.js" type="text/javascript"></script>
<script src="umeditor/editor_api.js" type="text/javascript"></script>
<script src="umeditor/lang/zh-cn/zh-cn.js" type="text/javascript"></script>
<script type="text/javascript">
    var ue = UM.getEditor('myEditor', {
        autoClearinitialContent: false,
        wordCount: false,
        elementPathEnabled: false,
        initialFrameHeight: 300
    });
</script>
<script type="text/javascript">
    $(function () {
        //比较简洁，细节可自行完善
        $('#uploadSubmit').click(function () {
            var data = new FormData($('#uploadForm')[0]);
            $.ajax({
                url: 'xxx/xxx',
                type: 'POST',
                data: data,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log(data);
                    if(data.status){
                        console.log('upload success');
                    }else{
                        console.log(data.message);
                    }
                },
                error: function (data) {
                    console.log(data.status);
                }
            });
        });

    })
</script>
</body>

</html>