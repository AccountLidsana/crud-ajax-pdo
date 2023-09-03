<?php
include "connect.php";


if (isset($_POST["save_student"]))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];

    if (empty($name))
    {
        $res = [
            "status" => 422,
            "message" => "ກະລຸນາປ້ອນຊື່"
        ];
        echo json_encode($res);

    } else if (empty($email))
    {
        $res = [
            "status" => 422,
            "message" => "ກະລຸນາປ້ອນອີເມວ"
        ];
        echo json_encode($res);

    } else if (empty($phone))
    {
        $res = [
            "status" => 422,
            "message" => "ກະລຸນາປ້ອນໂທ"
        ];
        echo json_encode($res);

    } else if (empty($course))
    {
        $res = [
            "status" => 422,
            "message" => "ກະລຸນາປ້ອນຄອດ"
        ];
        echo json_encode($res);

    } else
    
    {

        try
        {
            $selete_exist = "SELECT * FROM students WHERE email = :email";
            $selete_exist = $conn->prepare($selete_exist);
            $selete_exist->execute([':email'=>$email]);
            $rows = $selete_exist->fetchColumn();
            if($rows == 0){

            $sql_query = "INSERT INTO students (name,email,phone,course)values(:name,:email,:phone,:course)";
            $sql_query = $conn->prepare($sql_query);
            $sql_query->bindParam(":name", $name , PDO::PARAM_STR);
            $sql_query->bindParam(":email", $email, PDO::PARAM_STR);
            $sql_query->bindParam(":phone", $phone, PDO::PARAM_INT);
            $sql_query->bindParam(":course", $course, PDO::PARAM_STR);
            $sql_query->execute();
             if ($sql_query)
            {
                $res = [
                    "status" => 200,
                    "message" => 'ບັນທຶກຂໍ້ມູນສຳເລັດ'
                ];
                echo json_encode($res);
                return;
            } else
            {
                $res = [
                    "status" => 500,
                    "message" => 'ມີບາງຢ່າງຜິດຜາດ'
                ];
                echo json_encode($res);
                return;
            }
            
                        }else{
                             $res = [
                    "status" => 500,
                    "message" => 'ມີອີເມວນີ້ໃນລະບົບນີ້ແລ້ວ'
                ];
                echo json_encode($res);
                return;
                        }

           



        } catch (PDOException $e){
            echo $e->getMessage();
        }
    }
    
}
if (isset($_GET['editId']))
{
    $editId = $_GET['editId'];

    try{

    $sql_query_id = "SELECT * FROM students WHERE id=:id";
    $sql_query_id = $conn->prepare($sql_query_id);
    $sql_query_id->bindParam(":id", $editId,PDO::PARAM_INT);
    $sql_query_id->execute();
    $rowCount = $sql_query_id->fetchAll();
    $numRow = $sql_query_id->rowCount();

    }catch(PDOException $e){
        echo $e->getMessage();
    }

    if ($numRow == 1)
    {
        if ($rowCount)
        {
            foreach ($rowCount as $id)
            {
                $id['id'];
            }
            // $student = mysqli_fetch_array($query_run);

            $res = [
                'status' => 200,
                'message' => 'ລົບຂໍ້ມູນສຳເລັດ',
                'data' => $id
            ];
            echo json_encode($res);
            return;
        } else
        {
            $res = [
                'status' => 404,
                'message' => 'ບໍ່ມີຂໍ້ມູນນີ້'
            ];
            echo json_encode($res);
            return;
        }
    }
}


if (isset($_POST['update_student']))
{
    $editId = $_POST['editId'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];

   
    if (empty($name))
    {
        $res = [
            "status" => 422,
            "message" => "ກະລຸນາປ້ອນຊື່"
        ];
        echo json_encode($res);

    } else if (empty($email))
    {
        $res = [
            "status" => 422,
            "message" => "ກະລຸນາປ້ອນອີເມວ"
        ];
        echo json_encode($res);

    } else if (empty($phone))
    {
        $res = [
            "status" => 422,
            "message" => "ກະລຸນາປ້ອນໂທ"
        ];
        echo json_encode($res);

    } else if (empty($course))
    {
        $res = [
            "status" => 422,
            "message" => "ກະລຸນາປ້ອນຄອດ"
        ];
        echo json_encode($res);

    } else
    {
        try
        {

            $sql_query_update = "UPDATE students SET name=:name , email=:email , phone=:phone, course=:course WHERE id = :id";
            $sql_query_update = $conn->prepare($sql_query_update);
            $sql_query_update->bindParam(":id", $editId,PDO::PARAM_INT);
            $sql_query_update->bindParam(":name", $name, PDO::PARAM_STR);
            $sql_query_update->bindParam(":email", $email, PDO::PARAM_STR);
            $sql_query_update->bindParam(":phone", $phone, PDO::PARAM_STR);
            $sql_query_update->bindParam(":course", $course, PDO::PARAM_STR);
            $query_run = $sql_query_update->execute();

            if ($query_run)
            {
                $res = [
                    'status' => 200,
                    'message' => 'ແກ້ໄຂສຳເລັດ'
                ];
                echo json_encode($res);
                return;
            } else
            {
                $res = [
                    'status' => 500,
                    'message' => 'ຜິດຜາດ'
                ];
                echo json_encode($res);
                return;
            }

        } catch (PDOException $e)
        {
            echo $e->getMessage();
        }




    }

}

if(isset($_GET['deleteID'])){

    $del = $_GET['deleteID'];

    try{

    $sql_query_delete = "DELETE FROM students WHERE id=:id";
    $sql_query_delete = $conn->prepare($sql_query_delete);
    $sql_query_delete->bindParam(":id", $del);
    $delete=$sql_query_delete->execute();

    if($delete){
         $res = [
            'status' => 200,
            'message' => 'ລົບສຳເລັດ'
        ];
        echo json_encode($res);
    }else{
           $res = [
            'status' => 500,
            'message' => 'ມີບາງຢ່າງຜິດຜາດ'
        ];
        echo json_encode($res);
    }
        }catch(PDOException $e){
        echo $e->getMessage();
        }

}

?>