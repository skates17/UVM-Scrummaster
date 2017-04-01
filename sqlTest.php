<?php

include "top.php";
?>

<article>

<form action="index.php"
          method="GET"
          id="frmRegister">
<?php
//##############################################################################
//
// This page lists the departments based on the query given
// 
// i tend to print out each array to see what is inside it. this helps with my
// understanding
// if (DEBUG) {
//    print "<p>Contents of the array<pre>";
//    print_r($array_name);
//    print "</pre></p>";
// }
//##############################################################################
$whereCount = 0;
$whereClause= "";
$deptCode = "";
$data = "";
$whereCount2 = 0;
$whereClause2= "";
$deptCode2 = "";
$data2 = "";

//to gather info from the first list box nd send it to the second list box
if(isset($_GET["lstDepartment"])){
    $deptCode = htmlentities($_GET[lstDepartment], ENT_QUOTES, "UTF-8");//it takes the value and sends it to $whereClause through $data
    $data = array($deptCode);
    $whereClause = ' WHERE fldSubject LIKE ?';
    $whereCount++;//needed for select class in database.php
}
//to gather info from the second list box an send to orgonize the description
if(isset($_GET["lstDepartment"])){
    $deptCode2 = htmlentities($_GET[classes], ENT_QUOTES, "UTF-8");
    $data2 = array($deptCode2);
    $whereClause2 = ' WHERE fldTitle LIKE ?';
    $whereCount2++;
}
 
//build up the q
$query = 'SELECT pmkCourseId, fldSubject FROM tblClass GROUP BY fldSubject';//first list box
$query2 = 'SELECT pmkCourseId, fldSubject, fldNumber, fldTitle FROM tblClass';//second
$query2 .=$whereClause;
$query2 .=' GROUP BY fldSubject, fldNumber, fldTitle';
$query3 = 'SELECT pmkCourseId, fldSubject, fldNumber, fldTitle, fnkNetId, fnkCourseId, fldCompNum, fldSec, fldLec, fldCamp, fldMaxEnr, fldCurEnr, fldStart, fldEnd, fldDay, fldCredits, fldBldg, fldRoom, pmkNetId, fldLastName, fldFirstName, fldEmail';//second
$query3 .=" FROM tblTeacherClass JOIN tblClass ON pmkCourseId = fnkCourseId JOIN tblTeacher on pmkNetId = fnkNetId";
$query3 .=$whereClause2;
//$query3 .=' GROUP BY fldSubject, fldNumber, fldTitle';


$departments = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);
$departments2 = $thisDatabaseReader->select($query2, $data, $whereCount, 0, 0, 0, false, false);
$departments3 = $thisDatabaseReader->select($query3, $data2, $whereCount2, 0, 0, 0, false, false);

if (DEBUG) {
    print "<p>Contents of the array<pre>";
    print_r($departments);
    print "</pre></p>";
}

//print '<h2 class="alternateRows">Meet the Jetsons!</h2>';
//if (is_array($departments)) {
//    foreach ($departments as $department) {
//        print "<p>" . $department['fldSubject'] . " " . $department['fldNumber'] . "</p>";
//    }
//}
?>
    
    <fieldset  class="lists">
    <legend>Departments are listed bellow. </legend>
    <select class="classes" 
            name="lstDepartment" 
            tabindex="520" >
<?php
    include "departments.php";
?>
        </select>

        
</fieldset> 
    
        <fieldset  class="lists">
    <legend>Classes in selected department are listed bellow. </legend>
    <select class="classes" 
            name="classes" 
            tabindex="521" >
<?php
    include "classes.php";
?>
        </select>
</fieldset> 
            <fieldset class="buttons">
                <input type="submit" id="btnSubmit" name="btnSubmit" value="Register" tabindex="900" class="button">
            </fieldset> <!-- ends buttons -->  
    </form>
    
    <p>(The description will only show up if the proper department box is chosen for that class)</p>
    <h4>Here's your class description:</h4>
    
<?php
    include "description.php";
?>
    
</article>


</body>
</html>