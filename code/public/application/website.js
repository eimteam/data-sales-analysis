/*
通用JS文件
 */

/**
 * 为string字符串追加一个format函数 用于格式化替换
 * 两种调用方式 
 * var template1="我是{0}，今年{1}了"; 
 * var template2="我是{name}，今年{age}了"; 
 * var result1=template1.format("loogn",22); 
 * var result2=template1.format({name:"loogn",age:22});
 * @param  {[type]} args [要替换的结果]
 * @return {[type]}      [description]
 */
String.prototype.format = function(args)
{
    if (arguments.length > 0)
    {
        var result = this;
        if (arguments.length == 1 && typeof (args) == "object")
        {
            for (var key in args)
            {
                var reg = new RegExp("({" + key + "})", "g");
                result = result.replace(reg, args[key]);
            }
        }
        else
        {
            for (var i = 0; i < arguments.length; i++)
            {
                if (arguments[i] == undefined)
                {
                    return "";
                }
                else
                {
                    var reg = new RegExp("({[" + i + "]})", "g");
                    result = result.replace(reg, arguments[i]);
                }
            }
        }
        return result;
    }
    else
    {
        return this;
    }
}
/**
 * 全局的JS错误捕获
 * @param  {[type]} msg      [error内容]
 * @param  {[type]} url      [错误发生的路径]
 * @param  {[type]} lineNo   [错误行号]
 * @param  {[type]} columnNo [错误列号]
 * @param  {[type]} error    [error对象]
 * @return {[type]}          [description]
 */
window.onerror = function (msg, url, lineNo, columnNo, error) 
{ 
    console.log(error);
    console.log(columnNo);
   // 处理error信息
   layer.alert("<p>发生错误可能是您没有操作权限.<p/><p>请联系管理员!<p/>错误信息:"+msg,{icon:5,title:'错误提示'});
}