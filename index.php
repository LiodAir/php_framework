<?php
/**
 * Created by PhpStorm.
 * User: lioders
 * Date: 18-6-2
 * Time: 上午11:39
 */
/*
 *
 * 目标预想展示每天爬虫的数据，按照datatime字段展示今天的字段
 * 然后在加载到前端表单渲染输出 创建链接类型
 *
 * */
include_once("./static/modile.html");
include_once("./config/config_db.php");
include_once("./config/db_init.php");
$db = new DB($config);

function Today_result_Array($conn){
    return $conn->select("select * from news where to_days(采集时间) = to_days(now())");
}


function news($pageNum = 1, $pageSize = 15, $conn){
    $rs = "select * from news where to_days(采集时间) = to_days(now()) limit " .(($pageNum -1 )* $pageSize . "," . $pageSize);
    return $conn->select($rs);
}

function allPages($conn){
    $sql = "select count(*) ID from news where to_days(采集时间) = to_days(now())";
    return $conn->select($sql);
}

$allNum = allPages($db)[0][0];
$pageSize = 15; //约定没页显示几条信息
$pageNum = empty($_GET["pageNum"])?1:(int)$_GET["pageNum"];
$endPage = ceil($allNum/$pageSize); //总页数
$result = news($pageNum,$pageSize, $db);


//$result = (Today_result_Array($db));   
foreach ($result as $val){
    print "<tr>";
    foreach ($table as $vaa=>$result){
        print("<td>".$val[(int)($vaa)]."</td>");
    }}
    print "</tr>";
echo "</table>";

include_once("./static/foot.html")
?>
