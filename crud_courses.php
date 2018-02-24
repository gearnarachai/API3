<?php
include("config/db.php");
include("cmd/exec.php");

$db = new Database();
$str_conn = $db->getConnection();
$str_exe = new ExecSQL($str_conn);
$action = $_GET['cmd'];

$code = $_GET['code'];
$name = $_GET['name'];
$speaker_name = $_GET['speaker_name'];
$img_path = $_GET['img_path'];
$detail = $_GET['detail'];
$course_outline = $_GET['course_outline'];
$date_open = $_GET['date_open'];
$date_end = $_GET['date_end'];
$place = $_GET['place'];
$seat_num = $_GET['seat_num'];
$cost = $_GET['cost'];
$comment = $_GET['comment'];
$count_view_page = $_GET['count_view_page'];
$status = $_GET['status'];

switch($action){
    case 'select' :
    $stmt = $str_exe->readAll("courses");
    $data_arr['rs'] = array();
    
    foreach($stmt as $row ){
        $item = array(
            'Code'=>$row['code'],
            'Name'=>$row['name'],
            'speaker_name'=>$row['speaker_name'],
            'img_path'=>$row['img_path'],
            'detail'=>$row['detail'],
            'course_outline'=>$row['course_outline'],
            'date_open'=>$row['date_open'],
            'date_end'=>$row['date_end'],
            'place'=>$row['place'],
            'seat_num'=>$row['seat_num'],
            'cost'=>$row['cost'],
            'comment'=>$row['comment'],
            'count_view_page'=>$row['count_view_page'],
            'status'=>$row['status']
        );
        array_push($data_arr['rs'],$item);
        
        }echo json_encode($data_arr);
    break;   

    case 'insert':
    $strSQL = $str_exe->insert("courses",
                               " name, speaker_name ,img_path ,detail,course_outline,date_open,date_end,
                                place,seat_num,cost,comment,count_view_page,status ",
                                " '".$name."','".$speaker_name."','".$img_path."','".$detail."','".$course_outline."'
                                ,'".$date_open."','".$date_end."','".$place."','".$seat_num."','".$cost."'
                                ,'".$comment."','".$count_view_page."','".$status."' ");
    if($strSQL){
        echo json_encode(array('msg'=>'บันทึกข้อมูลเรีบยร้อยแล้ว'));
    }else{
        echo json_encode(array('msg'=>'ไม่สามารถบันทึกข้อมูลได้'));
    }
    break;

    case 'update': 
    $strSQL = $str_exe->update("courses "," SET name = '$name' ,speaker_name = '$speaker_name' ,img_path = '$img_path' ,detail = '$detail' 
                                ,course_outline = '$course_outline', date_open = '$date_open',date_end = '$date_end',
                                place = '$place',seat_num = '$seat_num',cost = '$cost',comment = '$comment',
                                count_view_page = '$count_view_page',status = '$status' WHERE code = $code");
    if($strSQL){
        echo json_encode(array('msg'=>'สำเร็จ'));
    }else{
        echo json_encode(array('msg'=>'ไม่สำเร็จ'));
    }
    break;

    case 'delete':  
    $code = $_GET['code'];
    $strSQL = $str_exe->delete("courses","code ",$code);
    if($strSQL){
        echo json_encode(array('msg'=>'ลบสำเร็จ'));
    }else{
        echo json_encode(array('msg'=>'ลบไม่สำเร็จ'));
    }
    break;
}
?>
