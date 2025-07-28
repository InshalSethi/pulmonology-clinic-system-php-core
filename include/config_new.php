<?php

session_start();

  
include "data.php";

class crud extends database
{
    public function selectcount($table,$row="*",$where=null,$order=null){
        $Result=array();
    $query='SELECT '.$row.' FROM '.$table;
        if($where!=null){
            $query.=' WHERE '.$where;
        }
        if($order!=null){
            $query.=' ORDER BY ';
        }
     
        $Result=$this->conn->query($query);
        return $Result=mysqli_num_rows($Result);
        }
    public function select($table,$row="*",$where=null,$order=null){
        $query='SELECT '.$row.' FROM '.$table;
        if($where!=null){
            $query.=' WHERE '.$where;
        }
        if($order!=null){
            $query.=' ORDER BY '.$order;
        }

        //echo "-----".$query;
        $Result=$this->conn->query($query);
        return $Result;
    }
	public function select1($table,$row="*",$where=null,$order=null){
        $Result=array();
	$query='SELECT '.$row.' FROM '.$table;
		if($where!=null){
			$query.=' WHERE '.$where;
		}
		if($order!=null){
			$query.=' ORDER BY ';
		}
        
		$Result=$this->conn->query($query);
        return $Result=mysqli_fetch_object($Result);
		}
        public function countrow($value)

        {
         $rows=mysqli_num_rows($value);
         return $rows;
        }
	public function insert($table,$value,$row=null){
       //print_r($value);

		$insert= " INSERT INTO ".$table;
		if($row!=null){
			$insert.=" (". $row." ) ";
		}
		for($i=0; $i<count($value); $i++){
			if(is_string($value[$i])){
				 $value[$i]= '"'. $value[$i] . '"';
			}
		}
		$value=implode(',',$value);
		$insert.=' VALUES ('.$value.')';
       // echo "----".$insert;
		$ins=$this->conn->query($insert);
		if($ins){
          
			return mysqli_insert_id($this->conn);
		}else{
       
			return false;
		}
	}

	public function delete($table,$where=null){
		if($where == null)
            {
                $delete = "DELETE ".$table;
            }
            else
            {
                $delete = "DELETE  FROM ".$table." WHERE ".$where;
            }
			$del=$this->conn->query($delete);
			if($del){
				return true;
			}else{
				return false;
			}
	}
	public function update($table,$rows,$where){
		 // Parse the where values
            // even values (including 0) contain the where rows
            // odd values contain the clauses for the row
            for($i = 0; $i < count($where); $i++)
            {
                if($i%2 != 0)
                {
                    if(is_string($where[$i]))
                    {
                        if(($i+1) != null)
                            $where[$i] = '"'.$where[$i].'" AND ';
                        else
                            $where[$i] = '"'.$where[$i].'"';
                    }
                }
            }
            $where = implode(" ",$where);
            $update = 'UPDATE '.$table.' SET ';
            $keys = array_keys($rows);
            for($i = 0; $i < count($rows); $i++)
            {
                if(is_string($rows[$keys[$i]]))
                {
                   $update .= $keys[$i].'="'.$rows[$keys[$i]].'"';
                }
                else
                {
                    $update .= $keys[$i].'='.$rows[$keys[$i]];
                }
                // Parse to add commas
                if($i != count($rows)-1)
                {
                    $update .= ',';
                }
            }
           $update .= ' WHERE '.$where;
            $query = $this->conn->query($update);
            if($query)
            {
                return true;
            }
            else
            {
                return false;
            }
	    
         }


    
    function pagination($totalNumRows, $pagename="", $start_paging=0, $limit_paging=12)
    {
        if($pagename=="")$pagename = $this->getPagename();

    // How many adjacent pages should be shown on each side?
    $adjacents = 3;
    
    $total_pages = $totalNumRows;
    $targetpage = $pagename;
    $srtposition = strpos($targetpage,'?');
    if($srtposition>0)
        $targetpage.='&page';
    else
        $targetpage.='?page';
    
    $limit = $limit_paging;
    /* Setup vars for query. */
    //$targetpage = "product.php";  //your file name  (the name of this file)
    
    //$limit = 5;                               //how many items to show per page
     $page = (int)$_GET['page'];
    if($page) 
        $start = ($page - 1) * $limit;          //first item to display on this page
    else
        $start = $start_paging;                             //if no page var is given, set start to 0
    
    $pagin_limit=  " LIMIT $start, $limit" ;
    
    /* Setup page vars for display. */
    if ($page == 0) $page = 1;                  //if no page var is given, default to 1.
    $prev = $page - 1;                          //previous page is page - 1
    $next = $page + 1;                          //next page is page + 1
    $lastpage = ceil($total_pages/$limit);      //lastpage is = total pages / items per page, rounded up.
    $lpm1 = $lastpage - 1;                      //last page minus 1
    
    /* 
        Now we apply our rules and draw the pagination object. 
        We're actually saving the code to a variable in case we want to draw it more than once.
    */
    $pagination = "";
    if($lastpage > 1)
    {   
        $pagination .= "<ul class='pagination pagination-custom pg-cen'>";
        //previous button
        if ($page > 1) 
            $pagination.= "<li><a class=\"pagination previous abd_custom\" href=\"$targetpage=$prev\">previous</a></li>";
        else
            $pagination.= "<li class=\"disabled\"><a class=\"pagination previous abd_custom\" href=\"\">previous</a></li>";    
        
        //pages 
        if ($lastpage < 7 + ($adjacents * 2))   //not enough pages to bother breaking it up
        {   
            for ($counter = 1; $counter <= $lastpage; $counter++)
            {
                if ($counter == $page)
                    $pagination.= "<li class=\"active pg-set \"><a href=\"$targetpage=$counter\" >$counter</a></li>";
                else
                    $pagination.= "<li><a href=\"$targetpage=$counter\">$counter</a></li>";                 
            }
        }
        elseif($lastpage > 5 + ($adjacents * 2))    //enough pages to hide some
        {
            //close to beginning; only hide later pages
            if($page < 1 + ($adjacents * 2))        
            {
                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<li class=\"active pg-set\"><a href=\"$targetpage=$counter\">$counter</a></li>";
                    else
                        $pagination.= "<li><a href=\"$targetpage=$counter\">$counter</a></li>";                 
                }
                $pagination.= "<li ><a href='#' > ... </a></li>";
                $pagination.= "<li ><a href=\"$targetpage=$lpm1\">$lpm1</a></li>";
                $pagination.= "<li ><a href=\"$targetpage=$lastpage\">$lastpage</a></li>";       
            }
            //in middle; hide some front and some back
            elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
            {
                $pagination.= "<li ><a href=\"$targetpage=1\">1</a></li>";
                $pagination.= "<li ><a href=\"$targetpage=2\">2</a></li>";
                $pagination.= "<li ><a href='#' > ... </a></li>";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<li class=\"active pg-set \"><a href=\"$targetpage=$counter\">$counter</a></li></li>";
                    else
                        $pagination.= "<li><a href=\"$targetpage=$counter\">$counter</a></li></li>";                    
                }
                $pagination.= "<li ><a href='#' > ... </a></li>";
                $pagination.= "<li ><a href=\"$targetpage=$lpm1\">$lpm1</a></li>";
                $pagination.= "<li ><a href=\"$targetpage=$lastpage\">$lastpage</a></li>";       
            }
            //close to end; only hide early pages
            else
            {
                $pagination.= "<li ><a href=\"$targetpage=1\" class=\"pg-set\">1</a></li>";
                $pagination.= "<li ><a href=\"$targetpage=2\" class=\"pg-set\">2</a></li>";
                $pagination.= "<li ><a href='#'  class=\"pg-set\"> ... </a></li>";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= "<li class=\"active pg-set \"><a href=\"$targetpage=$counter\">$counter</a></li>";
                    else
                        $pagination.= "<li><a href=\"$targetpage=$counter\">$counter</a></li>";                 
                }
            }
        }
        
        //next button
        if ($page < $counter - 1) 
            $pagination.= "<li><a class=\"pagination next abd_custom\" href=\"$targetpage=$next\">next</a></li>";
        else
            $pagination.= "<li class=\"disabled\"><a class=\"pagination next abd_custom\" href=\"\">next</a></li>";
        
        $pagination.= "</ul>\n";        
    }

    return array($pagin_limit,$pagination);
    }

        
	
};
function upload($file_id, $folder="", $types="") {
    if(!$_FILES[$file_id]['name']) return array('','No file specified');

     $file_title = $_FILES[$file_id]['name'];
    //Get file extension
    $ext_arr = split("\.",basename($file_title));
    $ext = strtolower($ext_arr[count($ext_arr)-1]); //Get the last extension

    //Not really uniqe - but for all practical reasons, it is
    $uniqer = substr(md5(uniqid(rand(),1)),0,5);
    $file_name = $uniqer . '_' . $file_title;//Get Unique Name

    $all_types = explode(",",strtolower($types));
    if($types) {
        if(in_array($ext,$all_types));
        else {
            $result = "'".$_FILES[$file_id]['name']."' is not a valid file."; //Show error if any.
            return array('',$result);
        }
    }

    //Where the file must be uploaded to
    if($folder) $folder .= '/';//Add a '/' at the end of the folder
    $uploadfile = $folder . $file_name;

    $result = '';
    //Move the file from the stored location to the new location
    if (!move_uploaded_file($_FILES[$file_id]['tmp_name'], $uploadfile)) {
        $result = "Cannot upload the file '".$_FILES[$file_id]['name']."'"; //Show error if any.
        if(!file_exists($folder)) {
            $result .= " : Folder don't exist.";
        } elseif(!is_writable($folder)) {
            $result .= " : Folder not writable.";
        } elseif(!is_writable($uploadfile)) {
            $result .= " : File not writable.";
        }
        $file_name = '';
        
    } else {
        if(!$_FILES[$file_id]['size']) { //Check if the file is made
            @unlink($uploadfile);//Delete the Empty file
            $file_name = '';
            $result = "Empty file found - please use a valid file."; //Show the error message
        } else {
            chmod($uploadfile,0777);//Make it universally writable.
        }
    }

    return array($file_name,$result);
}

/*if (isset($_POST['submit'])) {

     $email =$_POST['email'];
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $status = $_POST['optionsRadiosInline'];
    
    $email = mysqli_real_escape_string($conn,trim($_POST['email']));
    $user_name = mysqli_real_escape_string($conn,trim($_POST['user_name']));
    $password = mysqli_real_escape_string($conn,trim($_POST['password']));
    $status = mysqli_real_escape_string($conn,trim($_POST['optionsRadiosInline']));

    $a= new crud();
   

/*$upd=array('username'=>'root',
'password'=>'12345678',
'email'=>'badshah@gmail.com');*/
//$a->update('user',$upd,array('id=3','id=4','id=5','id=6'));
//$a->delete('user',' id = 1');
/*$ins=array('',$email,$user_name,$password,$status);
if($a->insert('register',$ins,null)==true)
{
 echo "Inserted";    
}
else {
    echo "Not Inserted";
}*/

//$ab=$a->select('member');
//while($a=$ab->fetch_array()){
 // echo $a[0]." ".$a[1]." ".$a[2]."<br />";
//}
//}
function encode($value)
{
    $enc=base64_encode($value);
    return $enc;
}
function decode($value1)
{
    $dec=base64_decode($value1);
    return $dec;
}

?>