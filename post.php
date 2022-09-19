<?php
//（2）$_FILEに情報があれば（formタグからpost送信されていれば）以下の処理を実行する
if (!empty($_FILES)) {

    //（3）$_FILESからファイル名を取得する
    $filename = $_FILES['upload_image']['name'];

    //（4）$_FILESから保存先を取得して、images_after（ローカルフォルダ）に移す
    //move_uploaded_file（第1引数：ファイル名,第2引数：格納後のディレクトリ/ファイル名）
    $uploaded_path = './img/' . $filename;
    //echo $uploaded_path.'<br>';

    $result = move_uploaded_file($_FILES['upload_image']['tmp_name'], $uploaded_path);

    if ($result) {
        $MSG = 'アップロード成功！ファイル名：' . $filename;
        $img_path = $uploaded_path;
    } else {
        $MSG = 'アップロード失敗！エラーコード：' . $_FILES['upload_image']['error'];
    }
} else {
    $MSG = '画像を選択してください';
}

// 入力値をそのまま引き継ぐ
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['title'])) {
        $title_value = $_POST['title'];
        $locations_value = $_POST['locations'];
        $updates_value = $_POST['updates'];
        $urls_value = $_POST['urls'];
        $contents_value = $_POST['contents'];
    } else {
        $title_value = '';
        $locations_value = '';
        $updates_value = '';
        $urls_value = '';
        $contents_value = '';
    }
} else {
    $title_value = '';
    $locations_value = '';
    $updates_value = '';
    $urls_value = '';
    $contents_value = '';
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$_FILESの基本</title>
</head>

<body>
    <main>
        <section class="form-container">
            <!--  メッセージを表示している箇所-->
            <p><?php if (!empty($MSG)) echo $MSG; ?></p>

            <!-- （1）form タグからpost送信する -->
            <form method="POST" action="./post.php" enctype="multipart/form-data">
                <table>
                    <tr>
                        <th>title</th>
                        <td><input type="text" name="title" required="required" value="<?php echo $title_value; ?>" size="50"></td>
                    </tr>
                    <tr>
                        <th>locations</th>
                        <td><input type="text" name="locations" required="required" value="<?php echo $locations_value; ?>" size="20"></td>
                    </tr>
                    <tr>
                        <th>date</th>
                        <td><input type="date" name="updates" required="required" value="<?php echo $updates_value; ?>"></td>
                    </tr>
                    <tr>
                        <th>urls</th>
                        <td><input type="text" name="urls" required="required" value="<?php echo $urls_value; ?>" size="50"></td>
                    </tr>
                    <tr>
                        <th>images</th>
                        <td><input type="file" name="upload_image" required="required"></td>
                    </tr>
                    <tr>
                        <th>contents</th>
                        <td><textarea required="required" name="contents" rows="5" cols="40"><?php echo $contents_value; ?></textarea></td>
                    </tr>
                </table>
                <input class="submit-btn" type="submit" value="送信">
            </form>
        </section>

        <section class="img-area">
            <?php
            if (!empty($img_path)) {
                //(5）ローカルフォルダに移動した画像を画面に表示する 
                print('<img class="img-sample" src="' . $img_path . '" alt="">');
                print('<table class="table"><tr><td class="table-img">');
                print('</td>');
                print('<td class="table-txt">');
                print($_POST['title'] . '<br>');
                print($_POST['locations'] . '　｜　' . $_POST['updates'] . '<br>');
                print($_POST['contents'] . '<br>');
                print('</td>');

                // print('<img src=' . $img_path . '>');
                // // print(htmlspecialchars($_POST['upload_image'], ENT_QUOTES, 'UTF-8'));
                // print('<h1>' . $_POST['title'] . '</h1>');
            }
            ?>
            </tr>
            </table>
            <?php
            // DBに登録する用
            if (!empty($img_path)) {
                session_start();
                $id = uniqid();
                $_SESSION['locations'] = $_POST['locations'];
                $_SESSION['title'] = $_POST['title'];
                $_SESSION['updates'] = $_POST['updates'];
                $_SESSION['urls'] = $_POST['urls'];
                $_SESSION['images'] = $img_path;
                $_SESSION['contents'] = $_POST['contents'];
            ?>
                <form action="post.php" method="post">
                    <button type="submit" name="add">DBへ登録</button>
                </form>
            <?php }
            ?>
        </section>

        <section>
            <?php
            // DBにinsertする
            $finish = "";
            if (isset($_POST['add'])) {
                session_start();
                if (isset($_POST['add'])) {
                    $id = mt_Rand(100000, 999999);
                    $locations = $_SESSION['locations'];
                    $title = $_SESSION['title'];
                    $updates = $_SESSION['updates'];
                    $urls = $_SESSION['urls'];
                    $images = $_SESSION['images'];
                    $contents = $_SESSION['contents'];
                    error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
                    // $conn = "host=localhost dbname=myblog user=iryosuke password=ryosuke8121";
                    $conn = "host=localhost dbname=s2022053 user=s2022053 password=J6LLllOC";
                    $link = pg_connect($conn);
                    $sql="INSERT INTO mylink (
                        id, title, locations, updates, contents, urls, images
                    ) VALUES (
                        $id, '$title', '$locations',date '$updates', '$contents', '$urls', '$images');";
                    $result = pg_query($sql);
                    if (!$result) {
                        echo $sql;
                        die('クエリーが失敗しました。' . pg_last_error() . $sql);
                    }
                }
                $finish = "登録しました";
            }
            echo $finish;
            ?>
        </section>
    </main>

    <style>
        .contact-form {
            width: 80%;
            margin: 0 auto;
            /* text-align: center; */
        }

        .contact-form table {
            width: 100%;
            margin-bottom: 15px;
        }

        .contact-form th {
            text-align: left;
            width: 25%;
            padding: 8px 0;
            vertical-align: top;
        }

        .contact-form td {
            background-color: blue;
            width: 75%;
        }

        .contact-form input:not(input[type="radio"]),
        .contact-form textarea {
            width: 100%;
        }

        .contact-form input:not(input[type="radio"]) {
            height: 35px;
        }

        .contact-form textarea {
            height: 200px;
        }

        .contact-form label {
            display: block;
        }

        .img-sample {
            width: 300px;
            height: auto;
            margin: 5%;
        }

        .table {
            border: solid;
            overflow-wrap: break-word;
        }

        .table-txt {
            background: #f8f8ff;
        }
    </style>
</body>

</html>