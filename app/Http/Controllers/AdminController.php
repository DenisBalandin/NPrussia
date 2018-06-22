<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Blogitem;

class AdminController extends Controller
{
    function ShowAll()
    {
        if($_FILES["filename"]["size"] > 1024*3*1024)
        {
            echo ("Размер файла превышает три мегабайта");
            exit;
        }
        $destination = dirname(dirname(dirname(dirname(__FILE__))))."/public/image/";
        if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
        {
            move_uploaded_file($_FILES['filename']['tmp_name'], $destination.$_FILES["filename"]['name']);

        } else {
            echo("Ошибка загрузки файла");
        }
        
        if (isset($_POST['cpulink'])) {
            $projects = new Blogitem();
            $projects->cpulink = $_POST['cpulink'];
            $projects->title = $_POST['title'];
            $projects->date = $_POST['date'];
            $projects->img = '/image/'.$_FILES["filename"]['name'];
            $projects->title_head = $_POST['title_head'];
            $projects->title_desc = $_POST['title_desc'];
            $projects->tegs = $_POST['tegs'];
            $projects->description = $_POST['description'];
            $projects->text = $_POST['text'];
            $projects->	keywords = '';
            $projects->save();
            ?>
            <script type="text/javascript">
                setTimeout('location.replace("http://nprussia.su/addpage?login=temhbin&password=2295825")', 0);
            </script>
            <?php
        }
        return view('addpage');
    }
    function SendMessage(){
        if (isset($_POST['email'])) {
            $to = "nprussia@bk.ru";
            $subject = "Сообщение с сайта от ".$_POST['name'].' '.$_POST['email'];
            $message = $_POST['text'];
            $headers = $_POST['email'];
            mail ($to, $subject, $message, $headers);
        }
        return view('message', ['email'=>'on']);
    }

    function ChangeSt(){
        Blogitem::where(
            'cpulink', $_POST['linkold'])->update([
                'cpulink'=>$_POST['cpulink'],
                'title_head'=>$_POST['title_head'],
                'title_desc'=>$_POST['title_desc'],
                'title'=>$_POST['title'],
                'date'=>$_POST['date'],
                'img'=>$_POST['img'],
                'description'=>$_POST['description'],
                'text'=>$_POST['text'],
                'tegs'=>$_POST['tegs'],
                'created_at'=>$_POST['created'],
                'active'=>$_POST['active'],
                'keywords'=>'',
        ]);
        header('Location: http://nprussia.su/addpage ');
    }
    function DownloadImg(){
        if($_FILES["filename"]["size"] > 1024*3*1024)
        {
            echo ("Размер файла превышает три мегабайта");
            exit;
        }
        $destination = dirname(dirname(dirname(dirname(__FILE__))))."/public/image/";
        if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
        {
            move_uploaded_file($_FILES['filename']['tmp_name'], $destination.$_FILES["filename"]['name']);

        } else {
            echo("Ошибка загрузки файла");
        }
    }
    function Dellrowbd(){
        Blogitem::where('cpulink', $_POST['idname'])->delete();
        header('Location: http://nprussia.su/addpage?addpage=changallst');
    }
}