<?php




/**
 * 状态样式
 * @param  [type] $status [状态值]
 * @param  [type] $url    [提交地址]
 * @return [type]         [字符串]
 */
function statusStyle($status,$url='javascript:void(0);',$data=array('开启','锁定')){
	if($status ==1 ){
		$str = '<a href="'.$url.'" class="btn btn-sm btn-success" title="点击修改状态">'.$data[0].'</a>';
	}elseif($status == 0){
		$str = '<a href="'.$url.'" class="btn btn-sm btn-danger" title="点击修改状态">'.$data[1].'</a>';
	}
	return $str;
}


/**
 * 级别样式
 * @param  [type] $status [状态值]
 * @param  [type] $url    [提交地址]
 * @return [type]         [字符串]
 * levelStyle('1',array('xxx','xxx','xxx'));code,提示语
 */
function levelStyle($level=1,$data=array(),$url='javascript:void(0);'){
	// 级别一般从1级开始，所以减一
	$color = array('success','danger','info','primary','purple','warning','sky','yellow','darkorange','default','blueberry','magenta','maroon','darkpink','pink','azure','orange');
	$str = '<a href="'.$url.'" class="btn btn-sm btn-'.$color[$level-1].'">'.$data[$level-1].'</a>';
	return $str;
}



/**
 * 配置样式
 * @param  [type] $type [状态值]
 * @param  [type] $name    [name]
 * @param  [type] $value    [value]
 * @param  [type] $placeholder    [提交地址]
 * @return [type]         [字符串]
 * 配置类型[1:单行文本框2:文本域3:单选按钮4:复选框5:下拉菜单6:上传]
 */
function formStyle($type,$data=null){

	switch ($type) {
		case 1:
			$style = '<input class="form-control" name="'.$data['enname'].'"  type="text" value="'.$data['value'].'">';
			break;
		case 2:
			$style = '<textarea class="form-control" rows="6" name="'.$data['enname'].'">'.$data['value'].'</textarea>';
			break;
		case 3:
			$style = "";
			$values = explode(',',trim($data['values']));

			foreach ($values as $k => $v) {
				if($data["value"] == $v){
					$style .= '<div style="float: left;padding-right: 20px;">
					                <label>
					                    <input name="'.$data['enname'].'" value="'.$v.'" type="radio" checked >
					                    <span class="text">'.$v.'</span>
					                </label>
					            </div>';
				}else{
					$style .= '<div style="float: left;padding-right: 20px;">
					                <label>
					                    <input name="'.$data['enname'].'" value="'.$v.'" type="radio">
					                    <span class="text">'.$v.'</span>
					                </label>
					            </div>';
				}
				
			}
			break;
		case 4:
			$style = "";
			$value = explode(',',trim($data['value']));//分割value
			$values = explode(',',trim($data['values']));//分割values
			foreach ($values as $k => $v) {
				if(in_array($v,$value)){
					$style .= '<div style="float: left;padding-right: 20px;">
	                        <label>
	                            <input name="'.$data['enname'].'[]" type="checkbox" value="'.$v.'" checked >
	                            <span class="text">'.$v.'</span>
	                        </label>
	                    </div>';
				}else{
					$style .= '<div style="float: left;padding-right: 20px;">
	                        <label>
	                            <input name="'.$data['enname'].'[]" type="checkbox" value="'.$v.'">
	                            <span class="text">'.$v.'</span>
	                        </label>
	                    </div>';
				}
			}
			break;
		case 5:
			$values = explode(',',trim($data['values']));
			$style ='<select name="'.$data['enname'].'">';
			foreach ($values as $k => $v) {
				if($data['value'] == $v){
					$style .='<option value="'.$v.'" selected>'.$v.'</option>';
				}else{
					$style .='<option value="'.$v.'">'.$v.'</option>';
				}
			}
			$style .='</select>';
			break;
		case 6:
			$style= '<div style="width:100%;height:125px;border: 3px dashed #e6e6e6;padding: 5px 5px;position:relative;">
						<input style="display:none;" id="file" onchange="upload(this)" name="'.$data['enname'].'" type="file">
					  	<input style="width:34%;float:left;margin-right:5px;" class="form-control" placeholder="上传后文件路径"  id="filepath" name="'.$data['enname'].'" type="hidden" value="'.$data["value"].'">
				    	<img src="/'.$data["value"].'" width="110" height="110" id="fileimg">
				    	<a style="left:25%;" onClick="file_click()" class="btn btn-success">点击上传</a>
					</div>';
			$style .= '<script type="text/javascript">
							//上传按钮点击事件
						    function file_click(){
						       $("#file").click();
						    }
							//异步上传
						    function upload(eve) {
						        var obj = $(eve).parents("form");
						        uploadUrl = obj.attr("action");
						        $.ajax({
						            url: uploadUrl,
						            type: "POST",
						            cache: false,
						            data: new FormData(obj[0]),
						            dataType:"json",
						            processData: false,
						            contentType: false,
						            success:function(res){
						                console.log(res);
						                if(res.code == 1001){
											$("#filepath").val(res.data.data);
											$("#fileimg").attr("src","/"+res.data.data);
						                }else{
											$("#filepath").val(res.msg);
						                }
						            }
						        });
						    }
						</script>';
			break;
		default:
			$style = "";
			break;
	}
	return $style;
}


/**
 * 上传图片
 * @param  [type] $data [description]
 * @return [type]       [description]
 */
function uploadImg($data,$img=null){
	$name  = isset($data[0]) ? $data[0] : '';
	$value = isset($data[1]) ? $data[1] : '';
	$img   = isset($img) ? '/'.$img : '';
	$style = '<div style="width:100%;height:125px;border: 3px dashed #e6e6e6;padding: 5px 5px;position:relative;">
						<input style="display:none;" id="file" onchange="upload(this)" name="'.$name.'" type="file">
					  	<input style="width:34%;float:left;margin-right:5px;" class="form-control" placeholder="上传后文件路径"  id="filepath" name="'.$name.'" type="hidden" value="'.$value.'">
				    	<img src="'.$img.'" width="110" height="110" id="fileimg">
				    	<a style="left:25%;" onClick="file_click()" class="btn btn-success">点击上传</a>
					</div>';
	$style .= '<script type="text/javascript">
					//上传按钮点击事件
				    function file_click(){
				       $("#file").click();
				    }
					//异步上传
				    function upload(eve) {
				        var obj = $(eve).parents("form");
				        uploadUrl = obj.attr("action");
				        $.ajax({
				            url: uploadUrl,
				            type: "POST",
				            cache: false,
				            data: new FormData(obj[0]),
				            dataType:"json",
				            processData: false,
				            contentType: false,
				            success:function(res){
				                console.log(res);
				                if(res.code == 1001){
									$("#filepath").val(res.data.data);
									$("#fileimg").attr("src","/"+res.data.data);
				                }else{
									$("#filepath").val(res.msg);
				                }
				            }
				        });
				    }
				</script>';
	return $style;
}