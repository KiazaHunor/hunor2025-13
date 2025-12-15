<?php
    mysqli_report(MYSQLI_REPORT_OFF);
    include_once("utils.php");

    if(!empty($_GET["path"]))
    {
        //  phpinfo(32);
        $servername="localhost";
        $username="root";
        $password="";
        $db="todolista";
        //CREATE TABLE `todolista`.`todo` (`id` INT NOT NULL AUTO_INCREMENT , `szoveg` VARCHAR(200) NOT NULL , `datum` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , `vege` DATETIME NOT NULL , PRIMARY KEY (`id`)


        $conn = mysqli_connect($servername, $username, $password,$db);

        $apiParts=explode("/",$_GET["path"]);

        //var_dump($apiParts);
        
        //todo
        //todo/
        if($apiParts[0]== "todo")
            {
                //todo elemek lekerdezese
                //phpinfo(32);
                //echo json_encode(["success" => true]);
                if($_SERVER['REQUEST_METHOD']=="GET")
                    {
                        if(isset($apiParts[1]))
                        {
                            //phpinfo(32);
                            if(isset($_GET["memberId"]))
                            {
                                $query="SELECT id, szoveg, datum, vege FROM todo WHERE id='".mysqli_real_escape_string($conn,$apiParts[1])."'";
                                //$query;
                                $results=mysqli_query($conn,$query);
                                if(mysqli_num_rows($results)==0)
                                    {
                                        $jsonTomb=["status"=>"error"];
                                        $jsonTomb["errorMessage"]="Hiba: Érvénytelen azonosító! (".$apiParts[1].")";
                                    }
                                else
                                {      
                                $jsonTomb = ["status" => "success"];
                                $jsonTomb["data"] = [];

                                while($row = mysqli_fetch_assoc($results)) 
                                {
                                    $jsonTomb["data"][]=$row;                        
                                }  
                                }
                                
                                //d($jsonTomb); 
                                $json=json_encode($jsonTomb);
                                echo $json;
                            }
                        }
                        else
                        {

                        }
                        $query="SELECT id, szoveg, datum, vege FROM todo";
                        $results=mysqli_query($conn,$query);
                        $jsonTomb = [];

                        while($row = mysqli_fetch_assoc($results)) 
                        {
                            $jsonTomb[]=$row;                        
                        }
                        //d($jsonTomb); 
                        $json=json_encode($jsonTomb);
                        echo $json;              
                    }  
                    elseif($_SERVER['REQUEST_METHOD']=="POST")
                    {
                        $input=json_decode(file_get_contents('php://input'),true);
                        //d($input);
                        //phpinfo(32);
                        if(isset($input["memberid"]))
                        {
                            $query="INSERT INTO todo (szoveg, datum) VALUES('". mysqli_real_escape_string($conn,$input["feladat"]) . "',now())";
                            $results=mysqli_query($conn,$query);

                            $jsonTomb=[];
                            if(!$results)
                            {
                                $jsonTomb["status"]="error";
                                $jsonTomb["errorMessage"]=mysqli_error($conn);
                            
                            }
                            else
                                {
                                    $jsonTomb["status"]="success";
                            echo json_encode($jsonTomb);
                                }
                                
                        }                
                    }
                    elseif($_SERVER['REQUEST_METHOD']== "DELETE")
                        {
                            $input=json_decode(file_get_contents('php://input'),true);

                            if(isset($input["memberid"]))
                            {
                                if($apiParts[1]=="all")
                                {
                                    $query="DELETE FROM todo";
                                }
                                else
                                {
                                    $query="DELETE FROM todo WHERE id='".mysqli_real_escape_string($conn,$apiParts[1])."'";
                                }
                                

                                $results=mysqli_query($conn,$query);

                                $jsonTomb=[];
                                if(!$results)
                            {
                                $jsonTomb["status"]="error";
                                $jsonTomb["errorMessage"]=mysqli_error($conn);
                            
                            }
                            else
                                {
                                    $jsonTomb["status"]="success";
                            echo json_encode($jsonTomb);
                                }


                            }

                        }
                    // PUT cucc
                    elseif($_SERVER['REQUEST_METHOD']=="PUT")
                    {
                        $input=json_decode(file_get_contents('php://input'),true);
                        //d($input);
                        //phpinfo(32);
                        if(isset($input["memberid"]) && isset($apiParts[2]))
                        {
                            if($apiParts[2]=="pipa")
                            {
                                $query="UPDATE todo SET vege=NOW() WHERE id='".mysqli_real_escape_string($conn,$apiParts[1])."'";
                            }
                            elseif($apiParts[2]=="edit")
                            {
                                $query="UPDATE todo SET szoveg=NOW() WHERE id='".mysqli_real_escape_string($conn,$input["feladat"])."'";
                            }
                            else
                            {
                                $query="";
                            }
                            $results=mysqli_query($conn,$query);

                            $jsonTomb=[];
                            if(!$results)
                            {
                                $jsonTomb["status"]="error";
                                $jsonTomb["errorMessage"]=mysqli_error($conn);                            
                            }
                            else
                                {
                                    $jsonTomb["status"]="success";
                                }
                                echo json_encode($jsonTomb);                                
                            }                
                    }                                                                                              
            }
    }
    else
    {
?>
 <h3>API help</h3>
 <?php } ?>